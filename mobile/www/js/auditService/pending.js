function pending_list(){
    
    var list_pendente = JSON.parse(localStorage.getItem("pendente"));
    var list_pendente_html = document.getElementById("lista_pendente");
    var lista_razao_social = JSON.parse(localStorage.getItem("RazaoSocial"));
    list_pendente_html.innerHTML = "";
//    navigator.notification.alert(list_pendente[0]["formulario"]["visita_id"]);
    
    for (var i=0; i<list_pendente.length; i++){
        
        var data = formatDate(list_pendente[i]["formulario"]["data_fim"])+" - "+hour(list_pendente[i]["formulario"]["data_fim"]);
        
        list_pendente_html.innerHTML  +=   
            '<div class="card">'+
            '   <div class="item item-divider">'+
            '   <div class="title_pendente_margin">Data visita: '+data+'</div>'+
            '</div>'+
            '<div class="row item item-text-wrap">'+
            '   <div class="col col-75 center_vertical">'+lista_razao_social[i]+'</div> '+
            '       <div class="col col-25 position_btn_check">'+
            '           <button class="button button-small button-positive ion ion-android-send btn_check" onclick="send_message('+(i+1)+', \'pendente\')"></button>'+
            '       </div>'+
            '   </div>'+
            '</div>';
    }
    
    activate_page('#page_pendente');
}