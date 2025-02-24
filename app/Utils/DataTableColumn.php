<?php

namespace App\Utils;

class DataTableColumn
{
    public $data;
    public $name;
    public $title;
    public $className;
    public $visible;
    public $export;
    public $orderable;
    public $searchable;
    public $caseInsensitive;

    public function __construct($data, $name, $title, $className, $visible, $export, $orderable, $searchable, $caseInsensitive)
    {
        $this->data = $data;
        $this->name = $name;
        $this->title = $title;
        $this->className = $className;
        $this->visible = $visible;
        $this->export = $export;
        $this->orderable = $orderable;
        $this->searchable = $searchable;
        $this->caseInsensitive = $caseInsensitive;
    }
}
