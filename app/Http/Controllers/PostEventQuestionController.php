<?php

namespace App\Http\Controllers;

use App\Models\Evento;
use App\Models\PostEventQuestion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PostEventQuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param  Evento $posteventquestion
     * @return \Illuminate\Http\Response
     */
    public function index(Evento $evento)
    {
        $questionx = PostEventQuestion::where(['event_id' => $evento->id])->get();
        return view('administracion.eventos.questions')->with(['questions' => $questionx,'id' => $evento->id]);
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
        $question = PostEventQuestion::create($request->all());
        Session::flash('msg','Pregunta creada con exito!');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PostEventQuestion  $postEventQuestion
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        $question = PostEventQuestion::find($id);
        return view('administracion.eventos.options')->with(['question' => $question]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PostEventQuestion  $postEventQuestion
     * @return \Illuminate\Http\Response
     */
    public function edit(PostEventQuestion $postEventQuestion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PostEventQuestion  $postEventQuestion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PostEventQuestion $postEventQuestion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PostEventQuestion  $postEventQuestion
     * @return \Illuminate\Http\Response
     */
    public function destroy(PostEventQuestion $postEventQuestion)
    {
        //
    }
}
