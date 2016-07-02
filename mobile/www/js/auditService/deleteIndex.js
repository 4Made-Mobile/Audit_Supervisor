function deleteIndex(string){
        
    var lista = JSON.parse(localStorage.getItem("list"));
    
    if (string == "yesterday"){
        
        navigator.notification.alert(Object.keys(lista[1]).length);
        var ontem = moment().add(-1, 'days').format("YYYY-MM-DD 00:00:00");
        
        for (var i=0; i<Object.keys(lista[1]).length; i++){
            if (ontem == Object.keys(lista[1])[i]){
                delete lista[1][Object.keys(lista[1])[i]];
                localStorage.setItem("list", JSON.stringify(lista));
                break;
            }    
        }
        
        if (Object.keys(lista[1]).length==0){
            downloader_list();
        }
        
    } else {
     
        
        
        
    }
}