<?php

namespace App\Http\Controllers;

use App\Imagen;
use Hashids\Hashids;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ImagenController extends Controller
{

    public static function hash($id)
    {
        $hashids = new Hashids();
        return $hashids->decode($id)[0];
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validar la imagen en back
        $this->validate($request,[
            'titulo'=> 'required|string',
            'imagen'=> 'required|image',
        ]);

        //creas variable con la imagen y campos del Request para tratarlos de ser necesario
        $titulo = $request->input('titulo');
        $imagen = $request->file('imagen');

        //instancias el objeto
        $ImagenObjeto = new Imagen();

        // Das el Id a la imagen como nombre y validas que no sea el primero
        $id = 1;
        if(!is_null(Imagen::all()->last())){
            $id = Imagen::all()->last()->id+1;
        }
        //agregas la extension jpg (o la que desees)
        $imagen_name = $id.'.jpg';
        // Ahora trabajamos y guardamos la imagen con intervencion imagen
        $file = Image::make($imagen)
            ->resize('100', '100')
            ->encode('jpg', 90);
        $file->save(Storage::disk('public')->put('imagen/'.$imagen_name, $file));


        //seteamos el Objeto
        $ImagenObjeto->titulo = $titulo;
        $ImagenObjeto->ruta = $imagen_name;

        //guardamos el Objeto
        $ImagenObjeto->save();

        return redirect()->route('index');

        /*
         * Si Se dan Cuenta el nombre en la tabla no esta encriptado ni tampoco en el archivo,
         * si nosotros llamaremos directamente al archivo asi en la vista con la funcion Get imagen
         * con el inspector de elementos nos saldria 1.jpg, 2.jpg 3.jpg ect...
         * ahora llamaremos en el metodo get imagen al descript y en el modelo al encript para
         * pasar el id de forma encriptada y desencr5iptarlo en el controlador para que nos devuelva
         * por JSON el blob encriptado y lo imprima directamente en la vista
         * */
    }

    public function getImagen($id)
    {

        //llamamos al metodo estatico que creeamos arriba y pasamos el id encriptado para desencriptar
        $id = ImagenController::hash($id);
//        Buscamos la imagen en la BD
        $data = Imagen::where('id', $id)->first();
//        Recuperamos el archivo Storage
        $file = Storage::disk('public')->get('imagen/'.$data->ruta);
        //emitimos el codigo de respuesta
        $code = 200;
        return new Response($file,$code);
        /*
         * Ni que decir tiene que en este controlador podemos emitir las validaciones y
         * capas de seguridad que deseemos como Auth, isAdmin o la que deseemos
         * */
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Imagen  $imagen
     * @return \Illuminate\Http\Response
     */
    public function show(Imagen $imagen)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Imagen  $imagen
     * @return \Illuminate\Http\Response
     */
    public function edit(Imagen $imagen)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Imagen  $imagen
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Imagen $imagen)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Imagen  $imagen
     * @return \Illuminate\Http\Response
     */
    public function destroy(Imagen $imagen)
    {
        //
    }
}
