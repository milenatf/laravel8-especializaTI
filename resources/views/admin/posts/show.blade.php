@extends('admin.layouts.app')

@section('title', 'Detalhes do post')
@section('content')
    <h1>Detalhes do post</h1>

    <ul>
        <li>{{ $post->title }}</li>
        <li>{{ $post->content }}</li>
    </ul>

    <form action="{{ route('posts.destroy', $post->id) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit">Deletar post {{ $post->title }}</button>
    </form>
@endsection