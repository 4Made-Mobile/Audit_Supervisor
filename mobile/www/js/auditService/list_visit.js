$(document).on("click", "#btn_refresh", function(evt){
    $("#input_date_select").datepicker().datepicker("setDate", new Date());
    downloader_list();
});

$(document).on("change", "#input_date_select", function(evt){
    list_generator();
});

$(document).on("change", "#icon_date_select", function(evt){
    $("#input_date_select").val($("#icon_date_select").val());
    list_generator();
});

// Função para baixar a lista de visitas dos próximos dias
function downloader_list(starting){
    if(!localStorage.getItem("list") || starting!="starting"){
        
        cordova.plugin.pDialog.init({cancelable:false,title:"Audit Supervisor",message:"Sincronizando informações..."});
        
        if(internet()){
            // requisição
            var data = {'supervisor_id':localStorage.getItem("id"), 'chave':localStorage.getItem("key")};
            var list_request = webservice("lista-visita", data);
            
//            navigator.notification.alert(list_request[0]);
            if (list_request[0]=="true"){
                
                localStorage.setItem("list", "");
                localStorage.setItem("list", JSON.stringify(list_request));
                cordova.plugin.pDialog.dismiss();
                list_generator();
            
            } else if (list_request[0]=="false"){
                cordova.plugin.pDialog.dismiss();
                navigator.notification.alert("Não foi possível sincronizar com o sistema.","","Ops!","OK");

            } else{
                cordova.plugin.pDialog.dismiss();		
                navigator.notification.alert("Não foi possível entrar no sistema.","","Falha ao se conectar com o servidor","OK");
            }
            
        } else{
            cordova.plugin.pDialog.dismiss();	
            navigator.notification.alert("Não foi possível acessar o servidor.","","Falha na conexão","OK");            
        }
        
    } else {
        list_generator();
    }
}

// função para montar a lista de visitas no menu do app
function list_generator(){
    
    var lista = JSON.parse(localStorage.getItem("list"));
    var lista_hoje = lista[1][formatDate("yy-mm-dd 00:00:00", "#input_date_select")];
    var lista_html = document.getElementById("list");
//    navigator.notification.alert(lista_hoje);
    
    // listagem do dia que consta no input
    // Se a lista tiver 'vazio' (colocado pela função de delete): mostra o botão de feedback
    if (lista_hoje){
        
        if (lista_hoje!="vazio"){
        
            lista_html.innerHTML = '<div class="item-divider b"><center>'+cidades(lista_hoje)+'</center></div>';
            for (var i=0; i<lista_hoje.length; i++){
  
                // id visita, id formulario, id vendedor, nome vendedor, data_ultima
                var aux = [lista_hoje[i][1], lista_hoje[i][5], lista_hoje[i][3], lista_hoje[i][4], formatDate(lista_hoje[i][6])];
                lista_html.innerHTML += '<a id="'+aux+'" class="item" href="#" onclick="form_maker(this.id)">'+lista_hoje[i][2]+'</a>';
            }
        
        } else{
            var aux = [0, 0];
            lista_html.innerHTML =  '<div class="row responsive-sm">'+
                                    '<button id="'+aux+'" class="col button button-positive" onclick="form_maker(this.id)">'+
				                    '   Deseja realizar o feedback do dia?'+
				                    '</button></div>';
        }
        
    } else{
//       navigator.notification.alert("Não há visitas marcadas para esta data.");
       lista_html.innerHTML = '<div class="empty_list center">Não há visitas marcadas para esta data.</div>';
    }
}