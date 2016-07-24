@extends('layout.app')
@section('content')
<div class="row">
    <h1 class="center-block"> Editando Usuário </h1>

    <form method="POST" action="/usuario/altera" autocomplete="off">
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        <input type="hidden" name="id" value="{{$usuario->id}}">

        <div class="form-group">
            <label for="login">Login</label>
            <input type="text" name="login" class="form-control" id="login"
                   required pattern="[\w]+" value="{{$usuario->login}}">
        </div>

        <div class="btn-group" data-toggle="buttons">
        
        <label class="btn btn-primary active">
                <input type="checkbox" id="test">Alterar Senha</label>
        </div>
        <input type="text" name="senha" disabled="disabled" class="prueba" />

        <br>

        <div class="from-group">
            <button type="submit" class="btn btn-clean">Alterar</button>
            <a href="/usuario/lista-geral/">
                <button class="btn btn-primary">
                    Voltar
                </button>
            </a>
        </div>
        <br>
    </form>
</div>
@include('layout.scripts')
<script>
    $('#test').click(function () {
    var checked = this.checked;
    $('.prueba').each(function () {
        $(this).prop('disabled', !checked);
    });
});
</script>
@endsection