function form_maker(info){
    
    localStorage.setItem("RazaoSocialAtual", document.getElementById(info).innerText);
    // id_visita, id_formulario, id_vendedor, nome_vendedor, data_ultima
    var array_info = info.split(",");
    var lista = JSON.parse(localStorage.getItem("list"));

    // GPS INICIAL
    navigator.geolocation.getCurrentPosition(function(position){
        localStorage.setItem("gps_inicial", position.coords.latitude+","+position.coords.longitude);
    });
    // DATA COMPLETA INICIAL
    localStorage.setItem("data_inicial", moment().format("YYYY-MM-DD HH:mm:ss"));
    
    activate_page("#page_formulario");
    
    // Pegando div de formulario e atribuindo id igual ao id da visita e id do formulario (uso posterior)
    var perguntas_html = document.getElementsByName("asks_form");
    perguntas_html[0].innerHTML = "";
    $("div[name=asks_form]").attr("id", array_info[0]+","+array_info[1]);

    // Pegando as perguntas e colocando em um array
    var perguntas = lista[2][array_info[1]];
        
    if (perguntas){
        perguntas.sort(compare); // ordenando a ordem das perguntas
    }
        
    // ID = 0 : formulário de feedback
    if (array_info[1] > 0) {
        $("#cabecalho_form").removeClass("hidden");
        $("#title_form").html("Formulário");
        $("#nome_vendedor").html(array_info[3]);
        $("#data_ultima").html(array_info[4]);
        
    } else{
        $("#title_form").html("Feedback");
        $("#cabecalho_form").addClass("hidden");
    }
    
    // montando perguntas, dividido em toggle (O) e textarea (D)
    for (var i=0; i<perguntas.length; i++){

        if (perguntas[i][4] == "OBJETIVA"){

            perguntas_html[0].innerHTML += 
                '<div id=pergunta'+i+' class="item item-toggle">'+
                    '<textarea class="expand" readonly="">'+perguntas[i][1]+'</textarea>'+
                    '<label class="toggle toggle-balanced objetiva_position">'+
                        '<input type="checkbox" id="'+perguntas[i][0]+'">'+
                        '<div class="track">'+
                            '<div class="handle"></div>'+
                        '</div>'+
                    '</label>'+
                '</div>';

        } else if (perguntas[i][4] == "DESCRITIVA") {

            perguntas_html[0].innerHTML += 
                '<div id=pergunta'+i+' name="pergunta_descritiva" class="item">'+
                    '<textarea class="expand" readonly="">'+perguntas[i][1]+'</textarea>'+
                    '<textarea id="'+perguntas[i][0]+'" class="autosize d-margins-textarea-descritiva" rows="2" placeholder="Descrição"></textarea>'+
                    '<span class="hidden text-error">Campo obrigatório.</span>'+
                '</div>';

            if (perguntas[i][2]=="S"){
                $("#pergunta"+i).addClass("obrigatoria");
                $("#pergunta"+i).find("textarea").eq(0).append("*");
            }
        }
    }
    expandTextarea();
}

function compare(a,b) {
  if (a[3] < b[3])
     return -1;
  if (a[3] > b[3])
    return 1;
  return 0;
}