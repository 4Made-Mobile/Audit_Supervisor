var finalizaFormulario = function(event){
	event.preventDefault();
	var id_formulario = $("#id-formulario").val();
	var pode_finalizar = id_formulario == 0;
	if(pode_finalizar){
		swal("Oops...", "O formulário está vazio!", "error");
	}else{
		$.ajax(
			{
				url : 'http://localhost:8000/formulario/finalizar/',
				data : {id_formulario : '0'},
				contentType: "application/json",
				processdata: true,
				dataType : 'JSON',
				success : function(data){
					console.log(data);
				}
			})
	}
}


var cancelarFormulario = function(event){
	event.preventDefault();
	
	swal({
		  title: "Você tem certeza?",
		  text: "Todos os dados serão perdidos!",
		  type: "warning",
		  showCancelButton: true,
		  confirmButtonColor: "#DD6B55",
		  confirmButtonText: "Sim",
		  cancelButtonText: "Não",
		  closeOnConfirm: false,
		  closeOnCancel: false
		},
		function(isConfirm){
		  if (isConfirm) {
		    swal("Cancelado com sucesso", "Você será redirecionado.", "success");
		    window.location.href = "/";
		  }else{
		  	swal("Cancelamento cancelado", "Very Good!!");
		  }
		});
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

		if(nao_existe){
			// cria um formulario novo
		}

		$(atualizaLista);

	}else{
		$($select).each(function(){
			swal("Essa pergunta não pode ser adicionada!");
		});
	}
}

var atualizaLista = function(id_formulario){
	// 1 - Limpa a tabela 
	var td = $(atualizaLista).find("td");
	$(td).each(function(){
		console.log("Hello World");
	});

	// requisição ajax para construir a página o_o"
	$.ajax(
			{
				url : 'http://localhost:8000/formulario/lista-pergunta/',
				data : {'id_formulario' : id_formulario},
				contentType: "application/json",
				processdata: true,
				dataType : 'JSON',
				success : function(data){
					console.log("Olá, mundo")
				}
			});

	// 2 - Pega lista dos dados
		// 3 - Preenche a tabela com os dados
}