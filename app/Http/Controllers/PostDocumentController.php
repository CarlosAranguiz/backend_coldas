<?php

namespace App\Http\Controllers;

use App\Models\PostDocument;
use Illuminate\Http\Request;

class PostDocumentController extends Controller
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


    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PostDocument  $postDocument
     * @return \Illuminate\Http\Response
     */
    public function show(PostDocument $postDocument)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PostDocument  $postDocument
     * @return \Illuminate\Http\Response
     */
    public function edit(PostDocument $postDocument)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PostDocument  $postDocument
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PostDocument $postDocument)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PostDocument  $postDocument
     * @return \Illuminate\Http\Response
     */
    public function destroy(PostDocument $postDocument)
    {
        //
    }
}
