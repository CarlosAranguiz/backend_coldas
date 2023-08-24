<?php

namespace App\Http\Controllers;

use App\Models\Convenios;
use App\Models\Nosotros;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class NosotrosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $nosotros = Nosotros::all();
        return view('administracion.nosotros.index')->with(['nosotros' => $nosotros]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('administracion.nosotros.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(['nombre' => 'required','anexo' => 'required','correo' => 'required','ubicacion' => 'required']);
        $nosotros = Nosotros::create([
            'nombre' => $request->nombre,
            'anexo' => $request->anexo,
            'correo' => $request->correo,
            'cargo' => $request->cargo,
            'ubicacion' => $request->ubicacion,
            'foto' => ''
        ]);
        if ($request->hasFile('imagen')) {
            $name = str_replace(' ','',$request->file('imagen')->getClientOriginalName());
            $storage = Storage::putFileAs('departamento/' . $nosotros->id.'/img', $request->file('imagen'), $name);
            $url = Storage::url($storage);
            $nosotros->foto = $url;
            $nosotros->save();
        }

        return redirect()->route('nosotros.list');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Nosotros  $nosotros
     * @return \Illuminate\Http\Response
     */
    public function show(Nosotros $nosotros)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Nosotros  $nosotros
     * @return \Illuminate\Http\Response
     */
    public function edit(Nosotros $nosotros)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Nosotros  $nosotros
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Nosotros $nosotros)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Nosotros  $nosotros
     * @return \Illuminate\Http\Response
     */
    public function destroy(Nosotros $nosotros)
    {
        //
    }

    public function delete($id)
    {
        $nosotros = Nosotros::find($id);
        $nosotros->delete();
        return redirect()->route('nosotros.list');
    }

    public function editNosotros($id)
    {
        $nosotros = Nosotros::find($id);
        return view('administracion.nosotros.edit')->with(['nosotros' => $nosotros]);
    }

    public function getNosotros()
    {
        $nosotros = Nosotros::all();
        $convenios = Convenios::all();

        return response()->json([
            'success' => true,
            'data' => ["nosotros" => $nosotros,"convenios" => $convenios]
        ]);
    }

}
