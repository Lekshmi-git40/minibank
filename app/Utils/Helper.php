<?php

namespace App\Utils;

use App\Attributes\DataTables;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;

class Helper
{
    public static function Encrypt($msg)
    {
        return openssl_encrypt($msg, 'AES-256-CBC', config('app.aeskey'), 0, config('app.aesiv'));
    }

    public static function Decrypt($msg)
    {
        return openssl_decrypt($msg, 'AES-256-CBC', config('app.aeskey'), 0, config('app.aesiv'));
    }

    public static function GetTitle()
    {
        $appname = config('app.name');
        $title = View::hasSection('Title') ? "${appname} - " . View::getSection('Title') : $appname;
        return $title;
    }

    public static function GetActiveMenu()
    {
        return View::hasSection('ActiveMenu') != null ? View::getSection('ActiveMenu') : '';
    }

    public static function GetViewModel($inputs, $class)
    {
        $model = new $class();
        foreach($inputs as $k => $v)
        {
            $exist = property_exists($model, $k);
            if ($exist)
                $model->{$k} = $v;
        }
        return $model;
    }

    public static function GetModelState($data, $vm)
    {
        $d = (array)$data;
        $v = Validator::make($d, $vm->rules, $vm->messages, empty($vm->niceNames) ? [] : $vm->niceNames);
        $state = new ModelState();
        $state->valid = $v->passes();
        $state->errors = $v->errors();
        return $state;
    }

    public static function Errors($errors, $name='All', $li='<li class="small">:message</li>', $span='<span class="text-danger small">:message</span>', $dobreak=false)
    {
        if (is_array($name))
        {
            $arr = [];
            foreach ($name as $nm)
            {
                array_push($arr, $errors->get($nm, $span));
            }

            $merged = array_merge(...$arr);
            return implode('<br />', $merged);
        }

        if($name == 'All')
            return implode('', $errors->get($name, $li));

        return implode('<br />', $errors->get($name, $span));
    }

    public static function DataTableColumns($class)
    {
        $columns = [];

        $reflection =  new \ReflectionClass($class);
        $properties = $reflection->getProperties();

        foreach($properties as $property)
        {
            $attributes = $property->getAttributes(DataTables::class);

            if (count($attributes) > 0)
            {
                $attribute = $attributes[0];
                $attr = $attribute->newInstance();
                $column = new DataTableColumn
                (
                    data: $attr->data,
                    name: $attr->name,
                    title: $attr->title,
                    className: $attr->className . ($attr->searchable ? ' searchable ' : ''),
                    visible: $attr->visible,
                    export: $attr->export,
                    orderable: $attr->orderable,
                    searchable: $attr->searchable,
                    caseInsensitive: $attr->caseInsensitive
                );

                $type = $property->getType();

                if ($type == 'bool')
                {
                    $column->className .= ' isboolean ';
                }
                if ($type == 'DateTime')
                {
                    $column->className .= ' isdatetime ';
                }

                $column->className = Str::squish($column->className);

                array_push($columns, $column);
            }
        };
        return collect($columns);
    }

    public static function DataTables(Builder $builder, $mapclass):JsonResponse
    {
        $dataTable =  \Yajra\DataTables\Facades\DataTables::of($builder);

        $reflection =  new \ReflectionClass($mapclass);
        $properties = $reflection->getProperties();

        foreach ($properties as $property)
        {
            $attributes = $property->getAttributes(DataTables::class);

            if (count($attributes) > 0)
            {
                $attribute = $attributes[0];
                $attr = $attribute->newInstance();
                $hasMethod = $reflection->hasMethod($attr->data);
                if ($hasMethod)
                {
                    $dataTable->editColumn($attr->data, function ($entity) use ($mapclass, $reflection, $attr)
                    {
                        $reflectionMethod = $reflection->getMethod($attr->data);
                        $m = new $mapclass();
                        return $reflectionMethod->invokeArgs($m, array($entity));
                    });
                }
                else
                {
                    $dataTable->editColumn($attr->data, function ($entity) use ($attr)
                    {
                        $s = Arr::get($entity, $attr->name);
                        return !empty($s) ? $s : null;
                    });
                }
            }
        }

        return $dataTable->make(true);
    }

    public static function ToISTDateTime($dt, $format='d/m/Y H:i:s')
    {
        return !empty($dt) ? date_format($dt, $format) : '';
    }

    public static function GenerateAlphaNumeric($length)
    {
        $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
        return substr(str_shuffle($str_result), 0, $length);
    }

    public static function HTMLDecodeForTemplate($data)
    {
        $data = htmlspecialchars_decode($data);
        $data = str_replace("&#039;", "'", $data);
        return $data;
    }
}
