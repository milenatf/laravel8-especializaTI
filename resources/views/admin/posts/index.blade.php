@extends('admin.layouts.app')

@section('title', 'Listagem de Posts')
@section('content')
    <a href="{{ route('posts.create') }}">Criar post</a>

    <hr>

    @if(session('message'))
        <div class="message">{{ session('message') }}</div>
    @endif

    <form action="{{ route('posts.search') }}" method="POST">
        @csrf

        <input type="text" name="search" placeholder="Pesquisar:">
        <button type="submit">Pesquisar</button>
    </form>

    <h1>Posts</h1>

    @foreach($posts as  $post)
        <h2>{{ $post->title }}</h2>
        <p>{{ $post->content }}</p>
        <a href="{{route('posts.show', $post->id)}}">Detalhes</a> |
        <a href="{{route('posts.edit', $post->id)}}">Editar</a>
        <hr>
    @endforeach

    @if( isset($filters) )
        {{ $posts->appends($filters)->links() }}
    @else
        {{ $posts->links() }}
    @endif
@endsection