<?php

namespace App\Http\Controllers;

use App\Models\Publicacion;
use App\Models\Subcategoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class PublicacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $publicaciones = Publicacion::all();
        $categorias = Subcategoria::all();
        return view('administracion.publicaciones.list')->with(['publicaciones' => $publicaciones,'categorias' => $categorias]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'titulo' => ['required'],
        ]);
        
        $publicacion = Publicacion::create([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion ?? 'Sin descripción',
            'subcategoria' => $request->categoria,
            'ruta_documento' => 'no'
        ]);


        if ($request->hasFile('documento')) {
            $image = $request->file('documento');
            $nombre = date('dmYHmi_') . mt_rand() . '_' . $publicacion->id . $image->getClientOriginalExtension();
            $storage = Storage::putFileAs('documentos/' . $publicacion->id, $image, $nombre);
            $url = Storage::url($storage);
            $publicacion->ruta_documento = $url;
            $publicacion->save();
            Session::flash('msg','Publicación creada con exito!');
            return redirect()->back();
        }
        Session::flash('msg','Publicación creada con exito!');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Publicacion  $publicacion
     * @return \Illuminate\Http\Response
     */
    public function show(Publicacion $publicacion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Publicacion  $publicacion
     * @return \Illuminate\Http\Response
     */
    public function edit(Publicacion $publicacion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Publicacion  $publicacion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Publicacion $publicacion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Publicacion  $publicacion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Publicacion $publicacion)
    {
        //
    }


    public function listado($subcategoria)
    {
        $publicaciones = Publicacion::where(['subcategoria' => $subcategoria])->get();
        $response['ok'] = true;
        $response['publicaciones'] = $publicaciones;
        return $response;
    }

}
