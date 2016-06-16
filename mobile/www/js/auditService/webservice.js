function webservice(){
	
	$.ajax({ 
		cache: false, 
		type: "GET", 
		url: "",
    	data: "",
		contentType: "application/json", 
		dataType: "json", 
		processdata: true, 
		success: function(resp){return resp;}, 
		error: function(resp){return resp;}
	});
	
}