<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\BannerModel;
use App\Models\TherapyModel;
use App\Models\ContentModel;
use App\Models\LanguageModel;
use App\Models\VideoModel;
use Illuminate\Support\Facades\Storage;
use Alert;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class RichTextEditorsController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */

  public function rgallery()
  {
    $results = collect([]);
    $files = collect(Storage::disk('gallery')->files());
    $files->each(function($item) use($results) {
      $mimetype = Storage::disk('gallery')->mimeType($item);
      $this->allowed_types = collect(['image' => 'image', 'video' => 'video']);
      $kp = $this->allowed_types->filter(function($item) use ($mimetype) {
        return Str::startsWith($mimetype, $item);
      })->first();

      if (!empty($kp)) {

        $results->add([
          'name' => $item,
          'type' => $kp,

'src' => "/uploads/rte/".$item
        ]);
      }
    });
    $data = ['data' => $results->values()];
    return response($data);
  }
  public function ugallery(Request $request)
  {

   $results=collect([]);
    $files = collect($request->allFiles());
    $this->allowed_types = collect(['image' => 'image', 'video' => 'video']);
    $files->each(function($file) use ($results) {
      $mimetype = $file->getMimeType();
      $kp = $this->allowed_types->filter(function($item) use ($mimetype) {
        return Str::startsWith($mimetype, $item);
      })->first();

      if (!empty($kp)) {
        $uploaded = $this->UploadGallery($file);
        $file->move('uploads/rte',$uploaded);
        $results->add([
          'name' => $uploaded,
          'type' => $kp,
          'src'=>'/uploads/rte/'.$uploaded

        ]);
      }
    });
    $data = ['data' => $results->values()];
    return response($data);
  }

  public function UploadGallery($file)
  {

    $filename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
    $hash = $file->hashName();
    //$path = $request->file('avatar')->storeAs($path, $name, $options);
    //$file->move('uploads/rte/',$filename-$hash);
    return $file->storeAs('', "$filename-$hash", 'gallery');
  }
}
