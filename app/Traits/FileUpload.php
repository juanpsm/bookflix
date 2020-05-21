<?php

namespace App\Traits;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Str; // para crear nombres aleatorios
use \stdClass; //para crear objetos vacíos

trait FileUpload
{
    public function NovedadesFileUpload($query) // Taking input image as parameter
    {
        $file = new stdClass();

        $file_name = Str::random(20);
        $ext = strtolower($query->getClientOriginalExtension()); // You can use also getClientOriginalName()
        $file_full_name = $file_name.'_'.time().'.'.$ext;
        $upload_path = 'image/novedades/';    //Creating Sub directory in Public folder to put image
        $file_url = $upload_path.$file_full_name;
        $success = $query->move($upload_path,$file_full_name);

        $file->url = $file_url;
        $file->ext = $ext;
        return $file; // retorna un objeto 
    }
}