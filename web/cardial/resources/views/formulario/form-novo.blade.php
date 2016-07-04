@extends('layout.app')
@section('content')

<h2 class="centered">
	<p>Cadastro de formulário</p>
</h2>
<br/>
<div class="row">
	<div class="col-lg-1">
		<label for="nome-formulario"><p class="center">Nome do Formulário</p></label>
	</div>
	<div class="col-lg-11">
		<input class="form-control" id="nome-formulario" name="nome-formulario" type="text" />
	</div>
</div>

@endsection