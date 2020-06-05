<?php

namespace App\Traits;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Str; // para crear nombres aleatorios
use \stdClass; //para crear objetos vacíos

trait FileUpload
{
    public function NovedadFileUpload($query) // Taking input image as parameter
    {
        $file = new stdClass();

        $file_name = Str::random(20);
        $ext = strtolower($query->getClientOriginalExtension()); // You can use also getClientOriginalName()
        $file_full_name = $file_name.'_'.time().'.'.$ext;
        $upload_path = 'storage/novedades/';    //Creating Sub directory in Public folder to put image
        $file_url = $upload_path.$file_full_name;
        $success = $query->move($upload_path,$file_full_name);

        $file->url = $file_url;
        $file->ext = $ext;
        return $file; // retorna un objeto 
    }

    public function PortadaFileUpload($query) // Taking input image as parameter
    {
        $file = new stdClass();

        $file_name = Str::random(20);
        $ext = strtolower($query->getClientOriginalExtension()); // You can use also getClientOriginalName()
        $file_full_name = $file_name.'_'.time().'.'.$ext;
        $upload_path = 'storage/portadas/';    //Creating Sub directory in Public folder to put image
        $file_url = $upload_path.$file_full_name;
        $success = $query->move($upload_path,$file_full_name);

        $file->url = $file_url;
        $file->ext = $ext;
        return $file; // retorna un objeto 
    }

    public function TrailerFileUpload($query) // Taking input image as parameter
    {
        $file = new stdClass();

        $file_name = Str::random(20);
        $ext = strtolower($query->getClientOriginalExtension()); // You can use also getClientOriginalName()
        $file_full_name = $file_name.'_'.time().'.'.$ext;
        $upload_path = 'storage/trailers/';    //Creating Sub directory in Public folder to put image
        $file_url = $upload_path.$file_full_name;
        $success = $query->move($upload_path,$file_full_name);

        $file->url = $file_url;
        $file->ext = $ext;
        return $file; // retorna un objeto 
    }

    public function CapituloFileUpload($query) // Taking input image as parameter
    {
        $file = new stdClass();

        $file_name = Str::random(20);
        $ext = strtolower($query->getClientOriginalExtension()); // You can use also getClientOriginalName()
        $file_full_name = $file_name.'_'.time().'.'.$ext;
        $upload_path = 'storage/capitulos/';    //Creating Sub directory in Public folder to put image
        $file_url = $upload_path.$file_full_name;
        $success = $query->move($upload_path,$file_full_name);

        $file->url = $file_url;
        $file->ext = $ext;
        return $file; // retorna un objeto 
    }
}