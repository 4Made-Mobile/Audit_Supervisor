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
    $("#input_date_select").datepicker({dateFormat: 'dd M, yy'}).datepicker("setDate", new Date());
    $("#icon_date_select").datepicker({dateFormat: 'dd M, yy'});
    
//	moment.locale('pt-br');
//	$("#input_date_select").val(moment().format("LL"));
//	$("#aba-dia2").html(moment().add(1, 'day').format("L"));
//	$("#aba-dia3").html(moment().add(2, 'day').format("L"));
}
document.addEventListener("app.Ready", onAppReady, false);