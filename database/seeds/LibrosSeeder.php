<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Perfil;
use App\Admin;
use App\Autor;
use App\Editorial;
use App\Genero;
use App\Libro;
use App\Novedad;
use App\Trailer;
use App\Capitulo;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;
use App\Traits\FileUpload;

class LibrosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    use FileUpload;
    public function run()
    {
    // Borrar archivos (Ya que vamos a re-crear la bd con semillas nuevas)
        // $files =   Storage::allFiles($dir);
        // $files =   Storage::files($dir);
        Storage::delete(Storage::files('public/novedades'));
        Storage::delete(Storage::files('public/capitulos'));
        Storage::delete(Storage::files('public/trailers'));
        Storage::delete(Storage::files('public/portadas'));

        //$file = $this->TrailerFileUpload(Form::file(public_path('image/seeds/portadas/hp6.jpg')));
        //$filePath = $file->url;
        //echo $filePath;
        //echo Storage::putFile('public/novedades', new File(public_path('image/seeds/portadas/hp6.jpg')), 'public');
        //
        // Luego de muchas pruebas esta es la mejor forma:
        //$this->guardarArchivo('portadas/hp6.jpg');

    // Libros
    //Libro::truncate();

        // Libro #1
        $libro = new Libro();
        $libro->titulo = "Harry Potter y el Príncipe Mestizo";
        $libro->portada = $this->guardarArchivo('portadas/hp6.jpg');
        $libro->isbn = "1234567891";
        $libro->autor_id = 4;
        $libro->editorial_id = 1;
        $libro->fecha_de_lanzamiento = Carbon::now();
        $libro->fecha_de_vencimiento = Carbon::now()->addYear();
        $libro->cantidad_capitulos = 2;
        $libro->terminado_de_cargar = TRUE;
        $libro->save();
        $libro->generos()->attach([4, 5]); //Relacionar el libro a dos etiquetas
            // Trailer para este libro
            $trailer = new Trailer();
            $trailer->titulo = "Trailer Harry Potter 6";
            $trailer->pdf = $this->guardarArchivo('trailers/sample.pdf');
            $trailer->libro_id = 1;
            $trailer->save();
            // Capitulos
                //Capítulo 1
                $capitulo = new Capitulo();
                $capitulo->titulo = "Capitulo 1";
                $capitulo->pdf = $this->guardarArchivo('trailers/sample.pdf');
                $capitulo->fecha_de_lanzamiento = Carbon::now();
                $capitulo->fecha_de_vencimiento = Carbon::now()->addYear()->subDay(); 
                $capitulo->libro_id = 1;
                $capitulo->save();
                //Capítulo 2
                $capitulo = new Capitulo();
                $capitulo->titulo = "Capitulo 2";
                $capitulo->pdf = $this->guardarArchivo('trailers/sample.pdf');
                $capitulo->fecha_de_lanzamiento = Carbon::now();
                $capitulo->fecha_de_vencimiento = Carbon::now()->addYear()->subDay(); 
                $capitulo->libro_id = 1;
                $capitulo->save();


        // Libro #2
        $libro = new Libro();
        $libro->titulo = "Diario de una Jovencita";
        $libro->portada = $this->guardarArchivo('portadas/anne.jpg');
        $libro->isbn = "1234567892";
        $libro->autor_id = 2;
        $libro->editorial_id = 2;
        $libro->fecha_de_lanzamiento = Carbon::now();
        $libro->fecha_de_vencimiento = Carbon::now()->addYear();
        $libro->cantidad_capitulos = 1;
        $libro->terminado_de_cargar = TRUE;
        $libro->save();
        $libro->generos()->attach([2, 6]);
            // Trailer para este libro
            $trailer = new Trailer();
            $trailer->titulo = "Trailer Libro de Anne Frank";
            $trailer->pdf = $this->guardarArchivo('trailers/sample.pdf');
            $trailer->libro_id = 2;
            $trailer->save();
            // Capitulos
                //Capítulo 1
                $capitulo = new Capitulo();
                $capitulo->titulo = "Capitulo I";
                $capitulo->pdf = $this->guardarArchivo('trailers/sample.pdf');
                $capitulo->fecha_de_lanzamiento = Carbon::now();
                $capitulo->fecha_de_vencimiento = Carbon::now()->addYear()->subDay(); 
                $capitulo->libro_id = 2;
                $capitulo->save();

        // Libro #3
        $libro = new Libro();
        $libro->titulo = "El Hobbit";
        $libro->portada = $this->guardarArchivo('portadas/hobbit.jpg');
        $libro->isbn = "1234567893";
        $libro->autor_id = 1;
        $libro->editorial_id = 2;
        $libro->fecha_de_lanzamiento = Carbon::now();
        $libro->fecha_de_vencimiento = Carbon::now()->addYear();
        $libro->cantidad_capitulos = 2;
        $libro->terminado_de_cargar = TRUE;
        $libro->save();
        $libro->generos()->attach([4, 5]);
            // Trailer para este libro
            $trailer = new Trailer();
            $trailer->titulo = "Trailer Hobbit";
            $trailer->pdf = $this->guardarArchivo('trailers/sample.pdf');
            $trailer->libro_id = 3;
            $trailer->save();
            // Capitulos
                //Capítulo 1
                $capitulo = new Capitulo();
                $capitulo->titulo = "1";
                $capitulo->pdf = $this->guardarArchivo('trailers/sample.pdf');
                $capitulo->fecha_de_lanzamiento = Carbon::now();
                $capitulo->fecha_de_vencimiento = Carbon::now()->addYear()->subDay(); 
                $capitulo->libro_id = 3;
                $capitulo->save();
                //Capítulo 2
                $capitulo = new Capitulo();
                $capitulo->titulo = "2";
                $capitulo->pdf = $this->guardarArchivo('trailers/sample.pdf');
                $capitulo->fecha_de_lanzamiento = Carbon::now();
                $capitulo->fecha_de_vencimiento = Carbon::now()->addYear()->subDay(); 
                $capitulo->libro_id = 3;
                $capitulo->save();

        // Libro #4
        $libro = new Libro();
        $libro->titulo = "The Connections In Our Brain";
        $libro->portada = $this->guardarArchivo('portadas/connection.jpg');
        $libro->isbn = "1234567894";
        $libro->autor_id = 5;
        $libro->editorial_id = 4;
        $libro->fecha_de_lanzamiento = Carbon::now();
        $libro->fecha_de_vencimiento = Carbon::now()->addYear();
        $libro->cantidad_capitulos = 1;
        $libro->terminado_de_cargar = TRUE;
        $libro->save();
        $libro->generos()->attach([1,7]);
            // Trailer para este libro
            $trailer = new Trailer();
            $trailer->titulo = "Trailer Connections";
            $trailer->pdf = $this->guardarArchivo('trailers/sample.pdf');
            $trailer->libro_id = 4;
            $trailer->save();
            // Capitulos
                //Capítulo 1
                $capitulo = new Capitulo();
                $capitulo->titulo = "Unico";
                $capitulo->pdf = $this->guardarArchivo('trailers/sample.pdf');
                $capitulo->fecha_de_lanzamiento = Carbon::now();
                $capitulo->fecha_de_vencimiento = Carbon::now()->addYear()->subDay(); 
                $capitulo->libro_id = 4;
                $capitulo->save();

        // Libro #5
        $libro = new Libro();
        $libro->titulo = "Yo, robot";
        $libro->portada = $this->guardarArchivo('portadas/robot.jpg');
        $libro->isbn = "1234567895";
        $libro->autor_id = 6;
        $libro->editorial_id = 3;
        $libro->fecha_de_lanzamiento = Carbon::now();
        $libro->fecha_de_vencimiento = Carbon::now()->addYear();
        $libro->cantidad_capitulos = 1;
        $libro->terminado_de_cargar = TRUE;
        $libro->save();
        $libro->generos()->attach([1]);
            // Trailer para este libro
            $trailer = new Trailer();
            $trailer->titulo = "Robot";
            $trailer->pdf = $this->guardarArchivo('trailers/sample.pdf');
            $trailer->libro_id = 5;
            $trailer->save();
            // Capitulos
                //Capítulo 1
                $capitulo = new Capitulo();
                $capitulo->titulo = "i";
                $capitulo->pdf = $this->guardarArchivo('trailers/sample.pdf');
                $capitulo->fecha_de_lanzamiento = Carbon::now();
                $capitulo->fecha_de_vencimiento = Carbon::now()->addYear()->subDay(); 
                $capitulo->libro_id = 5;
                $capitulo->save();

        // Libro #6
        $libro = new Libro();
        $libro->titulo = "Elementos";
        $libro->portada = $this->guardarArchivo('portadas/euclides.jpg');
        $libro->isbn = "1234567896";
        $libro->autor_id = 7;
        $libro->editorial_id = 4;
        $libro->fecha_de_lanzamiento = Carbon::now();
        $libro->fecha_de_vencimiento = Carbon::now()->addYear();
        $libro->cantidad_capitulos = 6;
        $libro->terminado_de_cargar = TRUE;
        $libro->save();
        $libro->generos()->attach([7]);
            // Trailer para este libro
            $trailer = new Trailer();
            $trailer->titulo = "Elementos";
            $trailer->pdf = $this->guardarArchivo('trailers/sample.pdf');
            $trailer->libro_id = 6;
            $trailer->save();
            // Capitulos
                //Capítulo 1
                $capitulo = new Capitulo();
                $capitulo->titulo = "I";
                $capitulo->pdf = $this->guardarArchivo('trailers/sample.pdf');
                $capitulo->fecha_de_lanzamiento = Carbon::now();
                $capitulo->fecha_de_vencimiento = Carbon::now()->addYear()->subDay(); 
                $capitulo->libro_id = 6;
                $capitulo->save();
                //Capítulo 1
                $capitulo = new Capitulo();
                $capitulo->titulo = "II";
                $capitulo->pdf = $this->guardarArchivo('trailers/sample.pdf');
                $capitulo->fecha_de_lanzamiento = Carbon::now();
                $capitulo->fecha_de_vencimiento = Carbon::now()->addYear()->subDay(); 
                $capitulo->libro_id = 6;
                $capitulo->save();
                //Capítulo 1
                $capitulo = new Capitulo();
                $capitulo->titulo = "III";
                $capitulo->pdf = $this->guardarArchivo('trailers/sample.pdf');
                $capitulo->fecha_de_lanzamiento = Carbon::now();
                $capitulo->fecha_de_vencimiento = Carbon::now()->addYear()->subDay(); 
                $capitulo->libro_id = 6;
                $capitulo->save();
                //Capítulo 1
                $capitulo = new Capitulo();
                $capitulo->titulo = "IV";
                $capitulo->pdf = $this->guardarArchivo('trailers/sample.pdf');
                $capitulo->fecha_de_lanzamiento = Carbon::now();
                $capitulo->fecha_de_vencimiento = Carbon::now()->addYear()->subDay(); 
                $capitulo->libro_id = 6;
                $capitulo->save();
                //Capítulo 1
                $capitulo = new Capitulo();
                $capitulo->titulo = "V";
                $capitulo->pdf = $this->guardarArchivo('trailers/sample.pdf');
                $capitulo->fecha_de_lanzamiento = Carbon::now();
                $capitulo->fecha_de_vencimiento = Carbon::now()->addYear()->subDay(); 
                $capitulo->libro_id = 6;
                $capitulo->save();
                //Capítulo 1
                $capitulo = new Capitulo();
                $capitulo->titulo = "VI";
                $capitulo->pdf = $this->guardarArchivo('trailers/sample.pdf');
                $capitulo->fecha_de_lanzamiento = Carbon::now();
                $capitulo->fecha_de_vencimiento = Carbon::now()->addYear()->subDay(); 
                $capitulo->libro_id = 6;
                $capitulo->save();
        
        // Libro #7
        $libro = new Libro();
        $libro->titulo = "LibroSinTrailerNiCapitulos";
        $libro->portada = $this->guardarArchivo('portadas/question.jpg');
        $libro->isbn = "1234567896";
        $libro->autor_id = 5;
        $libro->editorial_id = 4;
        $libro->cantidad_capitulos = 1;
        $libro->fecha_de_lanzamiento = Carbon::now();
        $libro->fecha_de_vencimiento = Carbon::now()->addYear();
        $libro->terminado_de_cargar = FALSE;
        $libro->save();
        
        // Novedades
        $novedad = new Novedad();
        $novedad->titulo = "Novedad sin archivo";
        $novedad->descripcion = "Una novedad sin archivo";
        $novedad->archivo = 'noFile';
        $novedad->fecha_de_publicacion = Carbon::now();
        $novedad->save();

        $novedad = new Novedad();
        $novedad->titulo = "Novedad con imagen";
        $novedad->archivo = $this->guardarArchivo('novedades/edward.jpg');
        $novedad->es_video = false;
        $novedad->descripcion = "Una novedad con archivo de imagen";
        $novedad->fecha_de_publicacion = Carbon::now();
        $novedad->save();

        $novedad = new Novedad();
        $novedad->titulo = "Novedad con video";
        $novedad->archivo = $this->guardarArchivo('novedades/video_earth.mp4');
        $novedad->es_video = true;
        $novedad->descripcion = "Una novedad con archivo de video";
        $novedad->fecha_de_publicacion = Carbon::now();
        $novedad->save();

        $novedad = new Novedad();
        $novedad->titulo = "Novedad Futura";
        $novedad->archivo = $this->guardarArchivo('novedades/question.jpg');
        $novedad->es_video = false;
        $novedad->descripcion = "Una novedad con fecha de publicacion futura";
        $novedad->fecha_de_publicacion = (Carbon::now()->addYear());
        $novedad->save();
    
        factory(Libro::class, 100)->create();
    }
    public function guardarArchivo($file){
        //$file = "novedades/edward.jpg";
        $folder = explode("/", $file)[0];
        $badname = Storage::putFile('public/'.$folder , new File(public_path('/image/seeds/'.$file)), 'public');
        // esto me da algo asi "public/portadas/mxiED6oizk413MyOBAoKuY49mUFxyiDg6CHDKyh1.jpeg"
        $filename = str_replace ( "public" , "storage" , $badname);
        // debe quedar asi "storage/portadas/mxiED6oizk413MyOBAoKuY49mUFxyiDg6CHDKyh1.jpeg";
        echo "archivo ".$file." guardado en ".$filename."\n";
        return $filename;
    }
}
