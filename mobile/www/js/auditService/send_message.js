function send_message(index, origem){
    
    cordova.plugin.pDialog.init({ 
        theme : 'DEVICE_LIGHT',                        
        progressStyle : 'SPINNER',                           
        cancelable : false, 
        title : 'Por favor, aguarde...', 
        message : 'Carregando informações...' });
    		
	if(internet()){
        
        var list_pendente = JSON.parse(localStorage.getItem("pendente"));
        
        if (list_pendente[index-1]["formulario"]["formulario_id"] > 0){
            // requisição para formulário de visitas
            var resposta_request = webservice("resposta", {"array_requisicao": JSON.stringify(list_pendente[index-1])});
        } else {
            // requisição para formulário de feedback
            var resposta_request = webservice("feedback", {"array_requisicao": JSON.stringify(list_pendente[index-1])});
        }
        
//        navigator.notification.alert(JSON.stringify(list_pendente[index-1]));
//        navigator.notification.alert(JSON.stringify(resposta_request));

		if (resposta_request=="true"){
            
            deleteIndex("pendente", index);

            if (localStorage.getItem("pendente")=="[]"){
                $("#btn_pendente").addClass("hidden");
                activate_page("#mainpage");
            } else {
                $("#btn_pendente").removeClass("hidden");
                pending_list();
            }
            
            cordova.plugin.pDialog.dismiss();
            navigator.notification.alert("Formulário enviado.","","Sucesso!","OK");
            
        } else {
            $("#btn_pendente").removeClass("hidden");
            cordova.plugin.pDialog.dismiss();
            
            if (origem == "pendente"){
                navigator.notification.alert("Não foi possível enviar o formulário.","","Falha na conexão com o servidor","OK");
            } else{
                navigator.notification.alert("Formulário salvo em pendentes.","","Falha na conexão com o servidor","OK");
            }
        }
        
    } else {
        $("#btn_pendente").removeClass("hidden");
        cordova.plugin.pDialog.dismiss();
        
        if (origem == "pendente"){
            navigator.notification.alert("Não foi possível enviar o formulário.","","Falha na conexão com o servidor","OK");
        } else{
            navigator.notification.alert("Formulário salvo em pendentes.","","Sem conexão com a Internet","OK");
        }
    }

}