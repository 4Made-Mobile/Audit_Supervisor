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