@extends('admin.layouts.app')

@section('title', 'Alterar Post')

@section('content')
    <h1>Alterar post <strong>{{ $post->title }}</strong></h1>

    <form action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
        @method('PUT')

        @include('admin.posts._includes.form')
    </form>

@endsection