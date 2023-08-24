<?php

namespace App\Http\Controllers;

use App\Models\Convenios;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ConveniosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $convenios = Convenios::all();
        return view('administracion.convenios.index')->with('convenios', $convenios);
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
            'universidad' => 'required',
        ]);

        $convenio = Convenios::create([
            'nombre' => $request->universidad,
            'imagen' => '',
        ]);

        if ($request->hasFile('imagen')) {
            $name = str_replace(' ','',$request->file('imagen')->getClientOriginalName());
            $storage = Storage::putFileAs('convenios/' . $convenio->id.'/img', $request->file('imagen'), $name);
            $url = Storage::url($storage);
            $convenio->imagen = $url;
            $convenio->save();
        }

        return redirect()->route('convenios.list');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Convenios  $convenios
     * @return \Illuminate\Http\Response
     */
    public function show(Convenios $convenios)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Convenios  $convenios
     * @return \Illuminate\Http\Response
     */
    public function edit(Convenios $convenios)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Convenios  $convenios
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Convenios $convenios)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Convenios  $convenios
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $convenio = Convenios::find($id);
        $convenio->delete();
        return redirect()->route('convenios.list');
    }
}
