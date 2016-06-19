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

            if (list_request.length>0){
                localStorage.setItem("list", "");
                localStorage.setItem("list", list_request);
                cordova.plugin.pDialog.dismiss();

            } else{
                cordova.plugin.pDialog.dismiss();		
                navigator.notification.alert("Não foi possível carregar os dados.\nFalha ao se conectar com o servidor.","","Audit Supervisor","OK");
            }
            
        } else{
            cordova.plugin.pDialog.dismiss();	
            navigator.notification.alert("Não foi possível acessar o servidor.\nVerifique sua conexão com a internet.","","Audit Supervisor","OK");            
        }
    }
}