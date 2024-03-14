<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Requests\StoreUpdatePostRequest;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::latest()->paginate(5); // latest() ordena dos mais antigos para os mais novos
        // $posts = Post::orderBy('id', 'ASC')->paginate(5);

        return view('admin.posts.index', compact('posts'));
    }

    public function create()
    {
        return view('admin.posts.create');
    }

    public function store(StoreUpdatePostRequest $request)
    {
        $post = Post::create($request->all());

        return redirect()->route('posts.index')->with('Post alterado com sucesso!');
    }

    public function show($id)
    {
        if(!$post = Post::find($id))
            return redirect()->route('posts.index');

        return view('admin.posts.show', compact('post'));
    }

    public function edit($id)
    {
        if(!$post = Post::find($id))
            return redirect()->route('posts.edit')->with('message', 'Post não encontrado');

        return view('admin.posts.edit', compact('post'));

    }

    public function update(StoreUpdatePostRequest $request, $id)
    {
        if(!$post = Post::find($id))
            return redirect()->back()->with('message', 'Post não encontrado');
            
        $update = $post->update($request->all());

        if(!$update)
            return redirect()->back()->with('message', 'Não foi possível alterar o post.');

        return redirect()->route('posts.index')->with('Post alterado com sucesso!');


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
