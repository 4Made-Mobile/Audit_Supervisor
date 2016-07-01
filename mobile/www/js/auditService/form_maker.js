function form_maker(info){
    
    var array_info = info.split(",");
    navigator.notification.alert(array_info);
    
    var gps_inicial, gps_final;
    var data_inicial, data_final;
    var visita_id, formulario_id, supervisor_id, chave;
    var id_resposta, descricao, pergunta_id;
    var array_resposta = [];
    var array_formulario = [];
    var array_requisicao = [];
    
    // GPS INICIAL
    navigator.geolocation.getCurrentPosition(function(position){
        gps_inicial = position.coords.latitude+","+position.coords.longitude;
//        navigator.notification.alert("GPS: "+gps_inicial);
    });
    
    // DATA COMPLETA INICIAL
    data_inicial = moment().format("YYYY-MM-DD HH:mm:ss");
//    navigator.notification.alert("Data: "+data_inicial);
    
}