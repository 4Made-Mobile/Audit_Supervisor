$(document).on("click", "#btn_entrar_login", function(evt){
	login();
});

function login_manager(){
	if(localStorage.getItem("key")){
		$("#mainpage").show(); 
		$("#page_login").hide();
	}
}

function login(){
	
	cordova.plugin.pDialog.init({cancelable:false,title:"Audit Supervisor",message:"Carregando informações..."});
		
	if(internet()){
//		var login = webservice(data);
		var login = true;
		if (login){

			localStorage.setItem("login","login");
			localStorage.setItem("id","id");
			localStorage.setItem("key","key");

			cordova.plugin.pDialog.dismiss();
			$("#mainpage").show(); 
			$("#page_login").hide();

		} else{
			cordova.plugin.pDialog.dismiss();		
			navigator.notification.alert("Não foi possível entrar no sistema. Login ou senha incorreto.","","Audit Supervisor","OK");
		}
	} else{
		cordova.plugin.pDialog.dismiss();		
		navigator.notification.alert("Não foi possível entrar no sistema. Verifique sua conexão com a internet.","","Audit Supervisor","OK");
	}
}

function logout(){
	cordova.plugin.pDialog.init({cancelable:false,title:"Audit Supervisor",message:"Carregando informações..."});
		localStorage.setItem("login","");
		localStorage.setItem("id","");
		localStorage.setItem("key","");
		$(".upage").hide();
		$("#page_login").show();
	cordova.plugin.pDialog.dismiss();	
}