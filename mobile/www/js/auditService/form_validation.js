function form_validation(){

    var campos = true;
    
    $('div [name=pergunta_descritiva]').each(function() {
        if ($(this).hasClass("obrigatoria") && $(this).find("textarea").eq(1).val()==""){
            $(this).find("span").removeClass("hidden");
            campos=false;
        } else{
            $(this).find("span").addClass("hidden");
        }
    });
    
    if (campos){
     
        cordova.plugin.pDialog.init({ 
        theme : 'DEVICE_LIGHT',                        
        progressStyle : 'SPINNER',                           
        cancelable : false, 
        title : 'Por favor, aguarde...', 
        message : 'Carregando informações...' });
        
        navigator.geolocation.getCurrentPosition(geolocationSuccess, geolocationError, {maximumAge:3000, timeout: 10000, enableHighAccuracy: true});
        
    } else {
        navigator.notification.alert("Campo(s) obrigatório(s) em branco.","","Audit Supervisor","OK");
    }
}

function geolocationSuccess(position){
    
    var gps_inicial, gps_final;
    var data_inicial, data_final;
    var resposta, pergunta_id;
    var array_resposta = [];
    var array_formulario = [];
    var array_requisicao = [];
    var aux;
    
    gps_inicial = localStorage.getItem("gps_inicial");
    if (position!=""){
        gps_final = position.coords.latitude+","+position.coords.longitude;
    }
    
    data_inicial = localStorage.getItem("data_inicial");
    data_final = moment().format("YYYY-MM-DD HH:mm:ss");
    
    aux = $("div[name=asks_form]").attr("id");
    aux = aux.split(",");
    
    var msg = "";
    var jquery_respostas = $("div[name=asks_form]").find("div.item");
    
    for (var i=0; i<jquery_respostas.length; i++){
        
        var resp=[];
        
        if (jquery_respostas.eq(i).hasClass("item-toggle")){
            pergunta_id = jquery_respostas.eq(i).find("input").attr("id");
            resposta = jquery_respostas.eq(i).find("input").is(':checked') ? "S" : "N";
        } else {
            pergunta_id = jquery_respostas.eq(i).find("textarea").eq(1).attr("id");
            resposta = jquery_respostas.eq(i).find("textarea").eq(1).val();
        }
        
        msg += "Pergunta: " + jquery_respostas.eq(i).find("textarea").eq(0).val() + "\n";
        msg += "Resposta: " + resposta + "\n\n";
        
        resp = {"descricao": resposta, "pergunta_id": pergunta_id};
        array_resposta.push(resp);
    }
    
    array_formulario = {"visita_id": aux[0], "formulario_id": aux[1], "gps_inicial": gps_inicial, "gps_final": gps_final, "data_inicio": data_inicial, "data_fim": data_final, "respostas": array_resposta};
    
    array_requisicao = {"supervisor_id": localStorage.getItem("id"), "chave": localStorage.getItem("key"), "formulario": array_formulario};
    
    cordova.plugin.pDialog.dismiss();
    
    navigator.notification.confirm(msg, function(buttonIndex){
        
        if (buttonIndex==1){
            if (localStorage.getItem("pendente")){
                var list_pendente = JSON.parse(localStorage.getItem("pendente"));
                list_pendente.push(JSON.stringify(array_requisicao));
                localStorage.setItem("pendente", JSON.stringify(list_pendente));
//                navigator.notification.alert(list_pendente);
                
            } else{
                var list_pendente = [JSON.stringify(array_requisicao)];
                localStorage.setItem("pendente", JSON.stringify(list_pendente));
            }
            
            activate_page("#mainpage");
            send_message();
        }
        
    }, "Confirma os seguintes dados?", ['Confirmar','Voltar']);

}

function geolocationError(){
    geolocationSuccess("");
}