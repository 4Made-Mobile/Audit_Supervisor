document.addEventListener("deviceready", backbutton, false);

window.addEventListener('native.keyboardhide', function () {    
    $('input').each(function() {
        $(this).blur();
    });
    $('textarea').each(function() {
        $(this).blur();
    });
});

function backbutton() {
    
    document.addEventListener("backbutton", function () {
        
        if ($('#mainpage').hasClass('hidden')){

            if (!($('#page_formulario').hasClass('hidden')) || !($('#page_pendente').hasClass('hidden')) || !($('#page_feedback').hasClass('hidden'))) {
                activate_page("#mainpage");
            }
            
            $ionicPlatform.registerBackButtonAction(function (event) {
                    event.preventDefault();
            }, 100);
        }    
        
    }, false);
}