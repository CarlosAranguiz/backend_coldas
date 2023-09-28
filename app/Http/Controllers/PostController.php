<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostResource;
use App\Models\Post;
use App\Models\PostDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function index()
    {
        $allPost = Post::all();
        return view('administracion.post.index')->with(['posts' => $allPost]);
    }

    public function create()
    {
        return view('administracion.post.create');
    }

    public function edit($id)
    {
        $post = Post::find($id);
        return view('administracion.post.edit')->with(['post' => $post]);
    }

    function update(Request $request, $id){
        $post = Post::find($id);
        $post->title = $request->title;
        $post->description = $request->description;
        $post->category = $request->category;
        $post->author = $request->autor;
        $post->content = $request->content;
        $post->save();

        if ($request->hasFile('image')) {
            $name = str_replace(' ','',$request->file('image')->getClientOriginalName());
            $storage = Storage::putFileAs('documentos/post/' . $post->id.'/img', $request->file('image'), $name);
            $url = Storage::url($storage);
            $post->image = $url;
            $post->save();
        }

        if ($request->hasFile('docs')) {

            foreach ($request->file('docs') as $file) {
                $nameDoc = str_replace(' ','',$file->getClientOriginalName());
                $storageDoc = Storage::putFileAs('documentos/post/' . $post->id, $file, $nameDoc);
                $urlDoc = Storage::url($storageDoc);
                PostDocument::create([
                    'post_id' => $post->id,
                    'document_path' => $urlDoc,
                    'document_name' => $nameDoc,
                ]);
            }

        }
        Session::flash('message', 'Publicación actualizada correctamente');
        Session::flash('alert', 'alert-success');
        return redirect()->route('publicaciones.list');
    }

    public function store(Request $request)
    {
        $post = Post::create([
            'title' => $request->title,
            'description' => $request->description,
            'category' => $request->category,
            'author' => $request->autor,
            'content' => $request->content,
            'only_image' => $request->has('only_image') ? 1 : 0,
        ]);

        if ($request->hasFile('image')) {
            $name = str_replace(' ','',$request->file('image')->getClientOriginalName());
            $storage = Storage::putFileAs('documentos/post/' . $post->id.'/img', $request->file('image'), $name);
            $url = Storage::url($storage);
            $post->image = $url;
            $post->save();
        }

        if ($request->hasFile('docs')) {

            foreach ($request->file('docs') as $file) {
                $nameDoc = str_replace(' ','',$file->getClientOriginalName());
                $storageDoc = Storage::putFileAs('documentos/post/' . $post->id, $file, $nameDoc);
                $urlDoc = Storage::url($storageDoc);
                PostDocument::create([
                    'post_id' => $post->id,
                    'document_path' => $urlDoc,
                    'document_name' => $nameDoc,
                ]);
            }

        }
        Session::flash('message', 'Publicación creada correctamente');
        Session::flash('alert', 'alert-success');
        return redirect()->route('publicaciones.list');
    }

    public function delete($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();
        return redirect()->route('publicaciones.list');
    }


    public function getPosts()
    {
        $allPost = Post::paginate(10);
        return PostResource::collection($allPost);
    }

    public function buscarPosts(Request $request)
    {
        $search = $request->get('query');
        $allPost = Post::where('title', 'like', "%{$search}%")
        ->orWhere('description', 'like', "%{$search}%")
        ->paginate(10);
        return PostResource::collection($allPost);
    }
}
