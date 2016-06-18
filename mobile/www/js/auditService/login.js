$(document).on("click", "#btn_entrar_login", function(evt){
	login();
});

function login_manager(){
	if(!localStorage.getItem("key")){
        activate_page("#page_login");
	} else {
        downloader_list();
        activate_page("#mainpage");
    }
}

function login(){
	
    $('#input_login_login').blur();
    $('#input_password_login').blur();
	cordova.plugin.pDialog.init({cancelable:false,title:"Audit Supervisor",message:"Carregando informações..."});
    
    var net = internet();
    var validate = login_validate();
		
	if(net && validate){
        
        var login = $("#input_login_login").val();
        var senha = $("#input_password_login").val();
        var senha_md5 = md5(senha);
        var imei = cordova.plugins.uid.IMEI;
        
//        var data = {'login':login, 'senha':senha_md5, 'imei':imei};
        var data = {'login':'berg', 'senha':'e10adc3949ba59abbe56e057f20f883e', 'imei':imei};
		var login_request = webservice("login", data);
        
		if (login_request["login"]!=""){

			localStorage.setItem("login",login);
			localStorage.setItem("key",login_request["chave"]);
			localStorage.setItem("id",login_request["id"]);
            
//            navigator.notification.alert("Bem vindo "+login+". Sua Chave: "+login_request["chave"]+" e ID: "+login_request["id"]);
			cordova.plugin.pDialog.dismiss();
            login_manager();
            
		} else{
			cordova.plugin.pDialog.dismiss();		
			navigator.notification.alert("Não foi possível entrar no sistema.\nFalha ao se conectar com o servidor.","","Audit Supervisor","OK");
		}
	} else{
		cordova.plugin.pDialog.dismiss();	
        
        if(!net){
            navigator.notification.alert("Não foi possível entrar no sistema.\nVerifique sua conexão com a internet.","","Audit Supervisor","OK");
        } else if(!validate){
            navigator.notification.alert("Não foi possível entrar no sistema.\nVerifique seu login e/ou senha.","","Audit Supervisor","OK");
        }
	}
}

function logout(){
	cordova.plugin.pDialog.init({cancelable:false,title:"Audit Supervisor",message:"Saindo do sistema..."});
//    localStorage.setItem("login","");
//    localStorage.setItem("id","");
//    localStorage.setItem("key","");
    localStorage.clear();
    activate_page("#page_login");
	cordova.plugin.pDialog.dismiss();	
}

function login_validate(){
    
    var check=false;
    
    if($("#input_login_login").val()==""){
        $("#input_login_branco").removeClass("hidden");
    } else{
        $("#input_login_branco").addClass("hidden");
    }
    
    if($("#input_password_login").val()==""){
        $("#input_password_branco").removeClass("hidden");
    } else{
        $("#input_password_branco").addClass("hidden");
    }
    
    if($("#input_login_login").val()=="" || $("#input_password_login").val()==""){
        check=false;
    } else {
        check=true;
    }
    
    return check;
}