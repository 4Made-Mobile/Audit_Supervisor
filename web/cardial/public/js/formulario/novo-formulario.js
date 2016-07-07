var finalizaFormulario = function(event){
	event.preventDefault();
	var descricaoDoFormulario = $("#nome-formulario").val();
	var pode_finalizar = descricaoDoFormulario == "";
	if(pode_finalizar){
		swal("Oops...", "O formulário está vazio!", "error");
	}else{
		var id_formulario = $("#id-formulario").val();
		var nao_existe = id_formulario == '';
		var descricaoDoFormulario = $("#nome-formulario").val();
		if(nao_existe){

			$.ajax({
				url : 'http://supervisor.cardealdistribuidora.com.br/formulario/cria-formulario/',
				contentType: "application/json",
				data: {nome_formulario : descricaoDoFormulario},
				processdata: true,
				dataType : 'JSON',
				success : function(data){
					$("#id-formulario").val(data);
					swal("Formulário criado com sucesso");
				},
				error : function(){
					swal("Erro ao criar o formulário");
				}

			});

			id_formulario = $("#id-formulario").val();
		}else{
			$.ajax({
				url : 'http://supervisor.cardealdistribuidora.com.br/formulario/altera-formulario/',
				contentType: "application/json",
				data: {
					   nome_formulario : descricaoDoFormulario,
					   id : id_formulario
					  },
				processdata: true,
				dataType : 'JSON',
				success : function(data){
					window.location.href = "/formulario/lista-geral/";
				},
				error : function(){
					window.location.href = "/formulario/lista-geral/";
				}
			});
		}
	}
}


var cancelarFormulario = function(event){
	event.preventDefault();
	window.location.href = "/formulario/lista-geral/";
}

var adicionaPergunta = function(event){
	event.preventDefault();

	// Variaveis globais
	var data = [];
	var validacao = true;

	var $input = $(this).parent().parent().find('input');
	var $select = $(this).parent().parent().find('select');
	
	// Verifica qual a posição, guarda em um array e limpa o campo

	$($input).each(function(){
		var texto = $(this).val();
		if(this.id == "pergunta-descricao" && ( texto == null || texto == "")){
			validacao = false;
		}else if(this.id== "pergunta-visivel" && !this.checked){
			data.push('N');
		}else if(this.id== "pergunta-visivel" && this.checked){
			data.push('S');
		}else if(this.id == "pergunta-ordem" && (texto == null || texto == "")){
			data.push(0);
			$(this).val('');
		}else{
			$(this).val('');
			data.push(texto);
		}
	});

	data.push($($select[0]).val());

	if(validacao){
		var id_formulario = $("#id-formulario").val();
		var nao_existe = id_formulario == '';
		var descricaoDoFormulario = $("#nome-formulario").val();
		if(nao_existe){

			$.ajax({
				url : 'http://supervisor.cardealdistribuidora.com.br/formulario/cria-formulario/',
				contentType: "application/json",
				data: {nome_formulario : descricaoDoFormulario},
				processdata: true,
				dataType : 'JSON',
				success : function(data){
					$("#id-formulario").val(data);
					swal("Formulário criado com sucesso");
				},
				error : function(){
					swal("Erro ao criar o formulário");
				}

			});

			id_formulario = $("#id-formulario").val();
		}

		data.push(id_formulario);
		
		cadastraPergunta(data);
		atualizaLista(id_formulario);

	}else{
		swal('Pergunta vazia');
	}
}

var cadastraPergunta = function(data){
	$.ajax({
				url : 'http://supervisor.cardealdistribuidora.com.br/formulario/cria-pergunta/',
				data : {dados : data},
				contentType: "application/json",
				processdata: true,
				dataType : 'JSON',
				success : function(data){
					swal("sucesso");
				},
				error: function(){
					swal('Erro');
				}
			});
}

var removePergunta = function(){
	$(".pergunta-id").each(function(){
		$(this).click(function(){
			var pergunta_id = $(this).find('> a').attr('id');
			$.ajax({
				url : 'http://supervisor.cardealdistribuidora.com.br/formulario/remove-pergunta/',
				data : {id : pergunta_id},
				contentType: "application/json",
				processdata: true,
				dataType : 'JSON',
				success : function(data){
						swal("removido com sucesso!");					
				}
			});
		$(this).parent().remove();
		});
	});	
}

var constroiTabelaPerguntas = function(data){

	$(data).each(function(){
		if(this.visivel == "S"){
			this.visivel = "SIM";
		}else{
			this.visivel = "NÃO";
		}

		$("#lista-body-pergunta").append("<tr id='data-" + this.pergunta_id + "'>");
		var $tr = $("#data-" + this.pergunta_id);
		$($tr).append("<td> " + this.descricao +"</td>");
		$($tr).append("<td> " + this.tipo +"</td>");
		$($tr).append("<td> " + this.visivel +"</td>");
		$($tr).append("<td> " + this.ordem +"</td>");
		$($tr).append("<td class='pergunta-id'>" + "<a id='" + this.pergunta_id + "' href='#'><i class='fa fa-times' aria-hidden='true'></i></a>" + "</td>");
	});
}

var atualizaLista = function(id_formulario){
	// 1 - Limpa a tabela 
	var tds = $("#lista-body-pergunta").find("> tr");

	$(tds).each(function(){
		$(this).remove();
	});

	// requisição ajax para construir a página o_o"
	$.ajax(
			{
				url : 'http://supervisor.cardealdistribuidora.com.br/formulario/lista-pergunta/',
				data : {id : id_formulario},
				contentType: "application/json",
				processdata: true,
				dataType : 'JSON',
				success : function(data){
					constroiTabelaPerguntas(data);
					$(removePergunta());
				}
			});
}