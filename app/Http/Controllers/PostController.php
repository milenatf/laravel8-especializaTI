<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Requests\StoreUpdatePostRequest;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::get();

        return view('admin.posts.index', compact('posts'));
    }

    public function create()
    {
        return view('admin.posts.create');
    }

    public function store(StoreUpdatePostRequest $request)
    {
        $post = Post::create($request->all());

        return redirect()->route('posts.index');
    }

    public function show($id)
    {
        if(!$post = Post::find($id))
            return redirect()->route('posts.index');

        return view('admin.posts.show', compact('post'));
    }

    public function destroy($id)
    {
        if(!$post = Post::find($id))
            return redirect()->back()->with('message', 'Post não encontrado.');

        if(!$post->delete())
            return redirect()->route('message', 'Não foi possível excluir o post.');

        return redirect()->route('posts.index')->with('message', 'Post deletado com sucesso!');
    }
}
