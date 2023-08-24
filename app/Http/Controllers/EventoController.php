<?php

namespace App\Http\Controllers;

use App\Exports\AnswersExport;
use App\Models\Evento;
use App\Models\PostEventQuestion;
use Hamcrest\Core\Set;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class EventoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $eventos = Evento::all();
        return view('administracion.eventos.index')->with(['eventos' => $eventos]);
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
            'titulo' => ['required','string'],
            'descripcion' => ['required','string'],
        ],[
            'titulo.required' => 'Debe ingresar el título',
            'descripcion.required' => 'Debe ingresar la descripción',
        ]);

        $evento = Evento::create([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'hora_desde' => $request->desde,
            'hora_fin' => $request->hasta,
            'fecha' => $request->fecha,
        ]);

        if ($request->hasFile('imagen')) {
            $name = str_replace(' ','',$request->file('imagen')->getClientOriginalName());
            $storage = Storage::putFileAs('eventos/' . $evento->id.'/img', $request->file('imagen'), $name);
            $url = Storage::url($storage);
            $evento->imagen = $url;
            $evento->save();
        }

        Session::flash('success','Evento creado correctamente');
        Session::flash('alert','alert-success');
        return redirect()->route('eventos.list');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Evento  $evento
     * @return \Illuminate\Http\Response
     */
    public function show(Evento $evento)
    {
        $questions = PostEventQuestion::where('event_id',$evento->id)->get();
        return view('administracion.eventos.questions')->with(['questions' => $questions,'evento' => $evento]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Evento  $evento
     * @return \Illuminate\Http\Response
     */
    public function edit(Evento $evento)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Evento  $evento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Evento $evento)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Evento  $evento
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Evento::destroy($id);
        Session::flash('success','Evento eliminado correctamente');
        Session::flash('alert','alert-success');
        return redirect()->route('eventos.list');
    }

    public function getEventos()
    {
        $eventos = Evento::with(['questions.options'])->get();
        return response()->json($eventos);
    }

    public function comprobarEvento(Request $request)
    {
        // FUNCION PARA COMPROBAR SI EL USUARIO RESPONDIO LAS PREGUNTAS DEL EVENTO
        $evento = Evento::find($request->evento_id);
        $user = auth()->user();
        $preguntas = $user->postEventAnswers->pluck('question_id')->toArray();
        foreach ($preguntas as $pregunta) {
            if ($evento->questions->contains('id',$pregunta)) {
                return response()->json(['status' => true,'ok' => true]);
            }
        }
        return response()->json(['status' => false,'ok' => true]);
    }

    public function excelExport($id)
    {
        return Excel::download(new AnswersExport($id), 'respuestas.xlsx');
    }

}
