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

    return result;
}

function url_option(option){
    
    if(option=="login"){
        return "http://supervisor.cardealdistribuidora.com.br/webservice/login";
    } else if(option=="lista-visita"){
        return "http://supervisor.cardealdistribuidora.com.br/webservice/lista-visita";
    } else if(option=="resposta"){
        return "http://supervisor.cardealdistribuidora.com.br/webservice/respostas";
    }
}