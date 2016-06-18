$(document).on("click", "#btn_refresh", function(evt){
    $("#input_date_select").datepicker().datepicker("setDate", new Date());
	localStorage.setItem("list","");
    downloader_list();
});

function downloader_list(){
    if(!localStorage.getItem("list")){
        
        cordova.plugin.pDialog.init({cancelable:false,title:"Audit Supervisor",message:"Sincronizando informações..."});
        
        if(internet()){
            
            var data = {'supervisor_id':localStorage.getItem("id"), 'chave':localStorage.getItem("key")};
            var list_request = webservice("lista-visita", data);
            
            if (list_request.length!=""){
                localStorage.setItem("list", list_request);
                cordova.plugin.pDialog.dismiss();

            } else{
                cordova.plugin.pDialog.dismiss();		
                navigator.notification.alert("Não foi possível entrar no sistema.\nFalha ao se conectar com o servidor.","","Audit Supervisor","OK");
            }
            
        } else{
            cordova.plugin.pDialog.dismiss();	
            navigator.notification.alert("Não foi possível entrar no sistema.\nVerifique sua conexão com a internet.","","Audit Supervisor","OK");            
        }
    }
}