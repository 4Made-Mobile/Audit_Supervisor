$(document).on("click", "#btn_entrar_login", function(evt){
	login();
});

function login_manager(){
	if(!localStorage.getItem("key")){
        activate_page("#page_login");
        setTimeout(function(){app.hideSplashScreen();}, 2000);
	} else {
        app.hideSplashScreen();
        activate_page("#mainpage");
        downloader_list("starting");
//        navigator.notification.alert("Para melhor experiência com o sistema, garanta que seu GPS esteja ativo!","","Audit Supervisor","OK");
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
        
//        var data = {'login':'berg', 'senha':'e10adc3949ba59abbe56e057f20f883e', 'imei':imei};
        var data = {'login':login, 'senha':senha_md5, 'imei':imei};
		var login_request = webservice("login", data);

		if (login_request["login"]=="true"){

            localStorage.setItem("login",login);
            localStorage.setItem("key",login_request["chave"]);
            localStorage.setItem("id",login_request["id"]);

            cordova.plugin.pDialog.dismiss();
            //repeat login_manager()
            activate_page("#mainpage");
            downloader_list();
            navigator.notification.alert("Para melhor experiência com o sistema, garanta que seu GPS esteja ativo!","","Audit Supervisor","OK");
            //////////////////////////
            
        } else if (login_request["login"]=="false"){
            cordova.plugin.pDialog.dismiss();
            navigator.notification.alert("Não foi possível entrar no sistema.","","Login e/ou senha incorreto(s)","OK");
            
        } else{
			cordova.plugin.pDialog.dismiss();		
			navigator.notification.alert("Não foi possível entrar no sistema.","","Falha ao se conectar com o servidor","OK");
		}
        
	} else{
		cordova.plugin.pDialog.dismiss();	
        
        if(!net){
            navigator.notification.alert("Não foi possível acessar o servidor.","","Falha na conexão","OK");
        } else if(!validate){
            navigator.notification.alert("Verifique seu login e/ou senha.","","Erro no formulário","OK");
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