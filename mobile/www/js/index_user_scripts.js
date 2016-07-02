(function(){
 "use strict";
 function register_event_handlers(){
     
     $(document).on("click", "#limparform", function(evt){
         limpar_campos();
     });
     
     $(document).on("click", "#limparfeedback", function(evt){
         limpar_campos();
     });
     
     $(document).on("click", "#finalizarform", function(evt){
         form_validation();
     });
  }
 document.addEventListener("app.Ready", register_event_handlers, false);
})();

///////////////////////////////////////////////////////////////////////////////////////////

function expandTextarea() {
    
    var $element = $('.autosize');  
    
    $('.expand').each(function() {
        $(this).attr('rows', Math.ceil($(this).val().length / ($(this).width()/5)) * 1.5);
    });
    
    for (i=0; i<$element.length; i++){
        $element[i].addEventListener('keyup', function() {
            this.style.overflow = 'hidden';
            this.style.height = 0;
            this.style.height = this.scrollHeight + 'px';
        }, false);
    }
}

function limpar_campos(){
    
    cordova.plugins.Keyboard.close();
    
    $('textarea').each(function() {
        $(this).blur();
    });
    
    $('input').each(function() {
        $(this).blur();
    });
    
    $('textarea').each(function() {
        if($(this).hasClass('autosize')){
            $(this).val("");
        }
    });
    
    $('[type=checkbox]').each(function() {
        $(this).prop("checked", false);
    });
    
    $('span.text-error').each(function() {
        $(this).addClass('hidden');
    });
}

function MainCtrl($scope, $ionicScrollDelegate) {
    $scope.scrollMainToTop = function() {
        $ionicScrollDelegate.$getByHandle('mainScroll').scrollTop();
    };
}

function firstUp(string){
    var word = string.toLowerCase();
    word = word.charAt(0).toUpperCase() + word.substr(1,word.length);
    return word;
}

function formatDate(format, string){
    if (string){
        var data = $(string).datepicker("getDate");
        return $.datepicker.formatDate(format, data);
    } else {
        var day = format.substring(8,10);
        var month = format.substring(5,7);
        var year = format.substring(0,4);   
        return day + "/" + month + "/" + year;
    }
}

function cidades(array_cidades){
    var aux = $.extend(true, {}, array_cidades);
    var cid = [];
    var string = "";
    var i, y;
    
    for (i=0; i<aux.length; i++){
        for (y=0; y<aux.length; y++){
            if (aux[i][0] == aux[y][0]) aux.splice(i, 1);
        }        
    }
    
    string = firstUp(aux[0][0]);
    for (i=1; i<aux.length; i++){
        string += ", " + firstUp(aux[i][0]);
    }  
    
    return string;
}