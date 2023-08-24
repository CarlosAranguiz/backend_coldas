<?php

namespace App\Http\Controllers;

use App\Models\PostEventAnswer;
use Illuminate\Http\Request;

class PostEventAnswerController extends Controller
{
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PostEventAnswer  $postEventAnswer
     * @return \Illuminate\Http\Response
     */
    public function show(PostEventAnswer $postEventAnswer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PostEventAnswer  $postEventAnswer
     * @return \Illuminate\Http\Response
     */
    public function edit(PostEventAnswer $postEventAnswer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PostEventAnswer  $postEventAnswer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PostEventAnswer $postEventAnswer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PostEventAnswer  $postEventAnswer
     * @return \Illuminate\Http\Response
     */
    public function destroy(PostEventAnswer $postEventAnswer)
    {
        //
    }

    public function terminar_prueba_evaluacion(Request $request) {
        $respuestas = $request->all();
        $data = json_decode($respuestas['data'],true);
        $fundamentos = json_decode($respuestas['texto'],true);
        foreach ($data as $key => $value) {
            PostEventAnswer::create([
                'question_id' => $key,
                'option_id' => $value,
                'user_id' => auth()->user()->id,
            ]);

            // $table->unsignedBigInteger('question_id');
            // $table->unsignedBigInteger('option_id')->nullable();
            // $table->text('answer_text')->nullable(); //
        }

        foreach($fundamentos as $key => $justificacion){
            if(array_key_exists($key,$fundamentos)){
                $respuestaAlumno = PostEventAnswer::where('user_id',auth()->user()->id)->where('question_id',$key)->first();
                if($respuestaAlumno){
                    $respuestaAlumno->answer_text = $justificacion;
                    $respuestaAlumno->save();
                }else{
                    PostEventAnswer::create([
                        'question_id' => $key,
                        // 'option_id' => $value,
                        'answer_text' => $justificacion,
                        'user_id' => auth()->user()->id,
                    ]);
                }
            }
        }

        return response()->json(['message' => 'Prueba terminada','ok' => true]);
    }


}
