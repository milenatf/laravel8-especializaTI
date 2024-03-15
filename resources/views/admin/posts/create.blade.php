@extends('admin.layouts.app')

@section('title', 'Cadastrar Posts')

@section('content')
    <h1>Cadastrar novo post</h1>

    <form action="{{ route('posts.store') }}" method="POST">
        @include('admin.posts._includes.form')
    </form>
@endsection