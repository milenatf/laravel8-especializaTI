<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\StoreUpdatePostRequest;
use App\Models\Post;
use Illuminate\Support\Facades\Storage;

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
        $data = $request->all();

        // Verifica se a imagem enviada é válida
        if($request->image->isValid()) {

            // Cria o nome da imagem a partir do título do post
            $fileName = Str::slug($request->title, '-') . '.' . $request->image->getClientOriginalExtension();

            // Grava a imagem no storage local
            $image = $request->image->storeAs('posts', $fileName);

            // Acrescentar o atributo "imagem" ao $request com o novo nome para armazenar no banco de dados
            $data['image'] = $image;

        }

        Post::create($data);

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
        $data = $request->all();

        if(!$post = Post::find($id))
            return redirect()->back()->with('message', 'Post não encontrado');

        // Verifica se a imagem enviada é válida
        if($request->image->isValid()) {

            // Verifica se o arquivo existe
            if( Storage::exists($post->image) )
                Storage::delete($post->image); // Deleta o arquivo do storage, caso exista

            // Cria o nome da imagem a partir do título do post
            $fileName = Str::slug($request->title, '-') . '.' . $request->image->getClientOriginalExtension();

            // Grava a imagem no storage local
            $image = $request->image->storeAs('posts', $fileName);

            // Acrescentar o atributo "imagem" ao $request com o novo nome para armazenar no banco de dados
            $data['image'] = $image;

        }
            
        $update = $post->update($data);

        if(!$update)
            return redirect()->back()->with('message', 'Não foi possível alterar o post.');

        return redirect()->route('posts.index')->with('Post alterado com sucesso!');


    }

    public function destroy($id)
    {
        if(!$post = Post::find($id))
            return redirect()->back()->with('message', 'Post não encontrado.');

        // Verifica se o arquivo existe
        if(Storage::exists($post->image))
            Storage::delete($post->image); // Deleta o arquivo do storage, caso exista

        if(!$post->delete())
            return redirect()->route('message', 'Não foi possível excluir o post.');

        return redirect()->route('posts.index')->with('message', 'Post deletado com sucesso!');
    }

    public function search(Request $request)
    {
        $filters = $request->except('_token');

        $posts = Post::where('title', 'LIKE', "%{$request->search}%")
                        ->orWhere('content', 'LIKE', "%{$request->search}%")
                        ->paginate(5);

        return view('admin.posts.index', compact('posts', 'filters'));
    }
}
