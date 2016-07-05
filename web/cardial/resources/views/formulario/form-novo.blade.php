@extends('layout.app')
@section('content')

<form>
	<div class="row">
		<h2 class="centered">
			<p>Cadastro de formulário</p>
		</h2>
	</div>
<br/>
	<div class="row">
			<input type="hidden" value="" id="id-formulario" /> 
			<div class="col-lg-2">
				<label for="nome-formulario"><p class="center">Nome do Formulário</p></label>
			</div>
			<div class="col-lg-8">
				<input class="form-control" id="nome-formulario" name="nome-formulario" type="text"/>
			</div>
	</div>

	<div class="row">
		<hr style="width: 100%; color: black; height: 1px; background-color:black;" />
	</div>
	
	<h3 class="centered">
		<p>Perguntas</p>
	</h3>

	<div class="row">
		<table id="lista-pergunta" class="table">
			<thead id="lista-head-pergunta">
				<tr>
					<td>Descrição</td>
					<td>Tipo</td>
					<td>Vísivel</td>
					<td>Ordem</td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
			</thead>
			<tbody id="lista-body-pergunta">

			</tbody>
		</table>
	</div>
	<div class="row">
		<hr style="width: 100%; color: black; height: 1px; background-color:black;" />
	</div>

	<div class="row">
			<h3><p>Adicionar Pergunta</p></h3>
	</div>

	<br/>

	<div class="row" id="cadastro-pergunta">
		<div class="col-lg-1">
			Descrição
		</div>
		<div class="col-lg-2">
			<input id="pergunta-descricao" name="pergunta-descricao" class="form-control" type="text"/>
		</div>

		<div class="col-lg-1">
			Tipo
		</div>

		<div class="col-lg-2">
			<select id="pergunta-tipo" name="pergunta-tipo" class="form-control">
				<option value="DESCRITIVA">Descritiva</option>
				<option value="OBJETIVA">Objetiva</option>
			</select>
		</div>

		<div class="col-lg-1">
			Vísivel
		</div>
		<div class="col-lg-1">
			<input id="pergunta-visivel" value="S" name="pergunta-visivel" class="form-control" type="checkbox"/>
		</div>

		<div class="col-lg-1">
			Ordem
		</div>
		<div class="col-lg-1">
			<input id="pergunta-ordem" name="pergunta-ordem" class="form-control" type="text"/>
		</div>

		<div class="col-lg-1">
			<button id="adiciona-pergunta" class="btn btn-primary"><i class="fa fa-check"></i></button>
		</div>
	</div>

	<div class="row">
		<hr style="width: 100%; color: black; height: 1px; background-color:black;" />
	</div>

	<div class="row">
		<div class="col-lg-2">
			<button id="finalizar" class="btn btn-default">Finalizar</button>
		</div>

		<div class="col-lg-2">
			<button id="cancelar" class="btn btn-danger">Cancelar</button>
		</div>
	</div>
</form>
@include('layout.scripts')
<script src="/js/formulario/novo-formulario.js"></script>

<script>
	
	// coisas que tenho que fazer

	/* Comportamentos dos botões
		1 - Finalizar ( rediciona para outra página )
		2 - Cancelar ( destroi tudas as perguntas )
		3 - remover-pergunta ( destroi a pergunta )
		4 - edita-pergunta ( primeiro click => permite alterar pergunta, segundo click => salva as alterações)
		5 - adiciona-pergunta ( cadastra a pergunta preenchida )
	*/

	// 1 - Finalizar
	$("#finalizar").click(finalizaFormulario);

	// 2 - Cancelar
	$('#cancelar').click(cancelarFormulario);

	// 5 - adiciona-pergunta
	$('#adiciona-pergunta').click(adicionaPergunta);
</script>

@endsection