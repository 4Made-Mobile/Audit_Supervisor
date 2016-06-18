function onAppReady() {
    
    $("#input_date_select").change(function() {
//        navigator.notification.alert("Handler for .change() called.");
    });
    $("#icon_date_select").change(function() {
        $("#input_date_select").val($("#icon_date_select").val());
//        navigator.notification.alert("Handler for .change() called.");
    });

    expandTextarea();
    
    login_manager();
    $("#input_date_select").datepicker().datepicker("setDate", new Date());
    $("#icon_date_select").datepicker();
    
//	moment.locale('pt-br');
//	$("#input_date_select").val(moment().format("LL"));
//	$("#aba-dia2").html(moment().add(1, 'day').format("L"));
//	$("#aba-dia3").html(moment().add(2, 'day').format("L"));
}
document.addEventListener("app.Ready", onAppReady, false);

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