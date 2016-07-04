document.addEventListener("deviceready", backbutton, false);

window.addEventListener('native.keyboardhide', function () {    
    $('input').each(function() {
        $(this).blur();
    });
    $('textarea').each(function() {
        $(this).blur();
    });
    $('.login-footer').each(function() {
        $(this).removeClass('hidden');
    });
});

window.addEventListener('native.keyboardshow', function () {    
    $('.login-footer').each(function() {
        $(this).addClass('hidden');
    });
});

function backbutton() {
    
    document.addEventListener("backbutton", function () {
        
        if ($('#mainpage').hasClass('hidden')){

            if (!($('#page_formulario').hasClass('hidden')) || !($('#page_pendente').hasClass('hidden'))) {
                activate_page("#mainpage");
            }
            
            $ionicPlatform.registerBackButtonAction(function (event) {
                    event.preventDefault();
            }, 100);
        }    
        
    }, false);
}