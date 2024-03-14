<a href="{{ route('posts.create') }}">Criar post</a>
<hr>
<h1>Posts</h1>

@foreach($posts as  $post)
    <h2>{{ $post->title }}</h2>
    <p>{{ $post->content }}</p>
@endforeach