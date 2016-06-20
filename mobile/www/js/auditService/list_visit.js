$(document).on("click", "#btn_refresh", function(evt){
    $("#input_date_select").datepicker().datepicker("setDate", new Date());
    downloader_list();
});

function downloader_list(starting){
    if(!localStorage.getItem("list") || starting!="starting"){
        
        cordova.plugin.pDialog.init({cancelable:false,title:"Audit Supervisor",message:"Sincronizando informações..."});
        
        if(internet()){
            
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

function list_generator(){
    
    var list = JSON.parse(localStorage.getItem("list"));
    
//    navigator.notification.alert(localStorage.getItem("list"));
    navigator.notification.alert(list[1][0]["data_inicial"]);
    
    
    
}