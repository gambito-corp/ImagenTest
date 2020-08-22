<?php

namespace App\Http\Controllers;

use App\Imagen;
use Hashids\Hashids;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImagenController extends Controller
{

    public static function hash($id, $decode = null)
    {
        $hashids = new Hashids();
        return is_null($decode)
            ?  $hashids->encode($id, 0,1,2,3,4,5,6,5,4,3,2,1,0 ,$id)
            :  $hashids->decode($id)[0];
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

        // Das el Id a la imagen como nombre
        $id = Imagen::all()->last()->id+1;
        //agregas la extension jpg (o la que desees)
        $imagen_name = $id.'.jpg';
        //Trtabajamos con el Storage (en este punto previuo a ello suelo usar el paquete intervencion image para tratar la imagen pero eso lo dejo a su gusto)
        Storage::disk('public')->put('/'.$imagen_name, $imagen);

        //seteamos el Objeto
        $ImagenObjeto->titulo = $titulo;
        $ImagenObjeto->ruta = $imagen_name;

        //guardamos el Objeto
        $ImagenObjeto->save();

        return redirect()->route('index');
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
