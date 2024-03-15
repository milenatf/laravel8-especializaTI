<h1>Alterar post <strong>{{ $post->title }}</strong></h1>

@if(session('message'))
    <div class="message">{{ session('message') }}</div>
@endif

@if($errors->any())
    <ul>
    @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
    @endforeach
    </ul>
@endif

<form action="{{ route('posts.update', $post->id) }}" method="POST">
    @method('PUT')

    @include('admin.posts._includes.form')

</form>