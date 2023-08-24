<?php

namespace App\Http\Controllers;

use App\Models\InscritoEvento;
use Illuminate\Http\Request;

class InscritoEventoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $inscritos = InscritoEvento::where('id_evento',$id)->with(['usuario'])->get();
        return view('administracion.eventos.inscritos')->with(['inscritos' => $inscritos]);
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
        $inscrito = InscritoEvento::where(['id_evento' => $request->id,'id_usuario' => auth()->user()->id])->first();
        if($inscrito){
            $response = [
                'success' => false,
                'message' => 'Ya te encuentras inscrito en este evento',
            ];
            return response()->json($response);
        }
        InscritoEvento::create([
            'id_evento' => $request->id,
            'id_usuario' => auth()->user()->id,
        ]);

        $response = [
            'success' => true,
            'message' => 'Inscripción realizada con éxito',
        ];

        return response()->json($response);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\InscritoEvento  $inscritoEvento
     * @return \Illuminate\Http\Response
     */
    public function show(InscritoEvento $inscritoEvento)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\InscritoEvento  $inscritoEvento
     * @return \Illuminate\Http\Response
     */
    public function edit(InscritoEvento $inscritoEvento)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\InscritoEvento  $inscritoEvento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, InscritoEvento $inscritoEvento)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\InscritoEvento  $inscritoEvento
     * @return \Illuminate\Http\Response
     */
    public function destroy(InscritoEvento $inscritoEvento)
    {
        //
    }
}
