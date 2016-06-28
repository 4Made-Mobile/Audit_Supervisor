(function(){
 "use strict";
 function register_event_handlers(){
     
     $(document).on("click", "#limparform", function(evt){
         limpar_campos();
     });
     
     $(document).on("click", "#limparfeedback", function(evt){
         limpar_campos();
     });
  }
 document.addEventListener("app.Ready", register_event_handlers, false);
})();

///////////////////////////////////////////////////////////////////////////////////////////

function expandTextarea() {
    
    var $element = $('.autosize');  
    
    $('.expand').each(function() {
        $(this).attr('rows', Math.ceil($(this).val().length / ($(this).width()/5)) * 0.69);
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

function formatDate(string){
    var data = $(string).datepicker("getDate");
    return $.datepicker.formatDate("yy-mm-dd 00:00:00", data);
}