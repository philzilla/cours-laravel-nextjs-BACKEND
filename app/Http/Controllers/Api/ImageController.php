<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use File;
use Response;

class ImageController extends Controller
{

  public function getImage($filename) 
  { 

    $path = storage_path('app/public/uploads/'. $filename); 
    if (!File::exists($path)) { 
        abort(404); 
    } 

    $file = File::get($path); 
    $type = File::mimeType($path); 

    $response = Response::make($file, 200); 
    $response->header("Content-Type", $type); 
    return $response; 
  }	

}
