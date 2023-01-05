<?php

namespace App\Http\Controllers;

use App\Models\Universidad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class UniversidadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $universidades = Universidad::all();
        return view('administracion.universidades.list')->with(['universidades' => $universidades]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'nombre' => 'required'
        ],[
            'nombre.required' => 'Debe ingresar un nombre a la universidad'
        ]);

        Universidad::create([
            'nombre_universidad' => $request->nombre
        ]);

        Session::flash('message','Universidad creada con exito!');
        Session::flash('alert','alert-success');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Universidad  $universidad
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $universidad = Universidad::find($id);
        return view('administracion.universidades.detail')->with(['universidad' => $universidad]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Universidad  $universidad
     * @return \Illuminate\Http\Response
     */
    public function edit(Universidad $universidad)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Universidad  $universidad
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Universidad $universidad)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Universidad  $universidad
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        //
    }
}
