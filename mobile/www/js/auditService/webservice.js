function webservice(option, data){
    
    var url = url_option(option);
    var result="";
    
	$.ajax({ 
		cache: false, 
		type: "GET", 
		url: url,
        async: false,
    	data: data,
		contentType: "application/json", 		
        dataType: "json", 
		processdata: true,
		success: function(resp){result = resp;}, 
		error: function(resp){result = resp;}
	});

//	navigator.notification.alert(result["login"]);
    return result;
}

function url_option(option){
    
    if(option=="login"){
        return "http://cardeal.beanteam.com.br/webservice/login";
    } else if(option=="lista-visita"){
        return "http://cardeal.beanteam.com.br/webservice/lista-visita";
    } else if(option=="resposta"){
        return "";
    }
}