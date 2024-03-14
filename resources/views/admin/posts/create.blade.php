<h1>Cadastrar novo post</h1>

<form action="{{ route('posts.store') }}" method="POST">
    @csrf

    <input type="text" name="title" id="title">
    <textarea name="content" id="content" cols="30" rows="4"></textarea>
    
    <button type="submit">Enviar</button>

</form>