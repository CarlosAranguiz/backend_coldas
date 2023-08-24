<?php

namespace App\Http\Controllers;

use App\Models\PostEventQuestionOption;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PostEventQuestionOptionController extends Controller
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
        $options = PostEventQuestionOption::create($request->all());
        Session::flash('msg','Opción creada con exito!');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PostEventQuestionOption  $postEventQuestionOption
     * @return \Illuminate\Http\Response
     */
    public function show(PostEventQuestionOption $postEventQuestionOption)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PostEventQuestionOption  $postEventQuestionOption
     * @return \Illuminate\Http\Response
     */
    public function edit(PostEventQuestionOption $postEventQuestionOption)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PostEventQuestionOption  $postEventQuestionOption
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PostEventQuestionOption $postEventQuestionOption)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PostEventQuestionOption  $postEventQuestionOption
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        PostEventQuestionOption::destroy($id);
        Session::flash('msg','Opción eliminada con exito!');
        return redirect()->back();
    }
}
