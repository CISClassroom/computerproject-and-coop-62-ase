<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\File;
use Storage;

class FileUploadController extends Controller


{
    public function upload ()
    {
      //upload file
      $fileName = Input::file('fileUpload')->getClientOriginalName();
      Storage::disk('public')->put($fileName, File::get(Input::file('fileUpload')));

      return back();
    }
    
    public function download ($filename){
        if(!Storage::disk('public')->has($filename)) abort(404);
        $storagePath  = Storage::disk('public')->getDriver()->getAdapter()->getPathPrefix();
        $file = $storagePath . $filename;

        return response()->download($file);
    }
}