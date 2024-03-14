<a href="{{ route('posts.create') }}">Criar post</a>
<hr>

@if(session('message'))
    <div class="message">{{ session('message') }}</div>
@endif

<h1>Posts</h1>

@foreach($posts as  $post)
    <h2>{{ $post->title }}</h2>
    <p>{{ $post->content }}</p>
    <a href="{{route('posts.show', $post->id)}}">Detalhes</a>
    <hr>
@endforeach