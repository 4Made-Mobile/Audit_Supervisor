function deleteIndex(string, index){
        
    var lista = JSON.parse(localStorage.getItem("list"));
    
    if (string == "yesterday"){
        
//        navigator.notification.alert(Object.keys(lista[1]).length);
        var ontem = [];
        
        for (var y=0; y<Object.keys(lista[1]).length; y++){
            ontem[y] = moment().add(-y-1, 'days').format("YYYY-MM-DD 00:00:00");
        }
                
        for (var i=0; i<Object.keys(lista[1]).length; i++){
            for (var y=0; y<ontem.length; y++){
                if (ontem[y] == Object.keys(lista[1])[i]){
                    delete lista[1][Object.keys(lista[1])[i]];
                    localStorage.setItem("list", JSON.stringify(lista));
                }    
            }
        }
        
        if (Object.keys(lista[1]).length==0){
            downloader_list();
        }
        
    } else if (string == "pendente") {
     
        var list_pendente = JSON.parse(localStorage.getItem("pendente"));
        var lista_razao_social = JSON.parse(localStorage.getItem("RazaoSocial"));
        
        list_pendente.splice(index-1, 1);
        lista_razao_social.splice(index-1, 1);
        
        localStorage.setItem("pendente", JSON.stringify(list_pendente));
        localStorage.setItem("RazaoSocial", JSON.stringify(lista_razao_social));
        
//        navigator.notification.alert(list_pendente.length + "  " + lista_razao_social.length);      
        
    } else if (string == "visita"){
            
        var lista = JSON.parse(localStorage.getItem("list"));
        var lista_hoje = lista[1][formatDate("yy-mm-dd 00:00:00", "#input_date_select")];
                
        for (var i=0; i<lista_hoje.length; i++){
            if (lista_hoje[i][1] == index){
                lista_hoje.splice(i, 1);                
                lista[1][formatDate("yy-mm-dd 00:00:00", "#input_date_select")] = lista_hoje;
                localStorage.setItem("list", JSON.stringify(lista));
                break;
            }
        }
    }
}