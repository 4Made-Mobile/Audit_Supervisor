function onAppReady() {
    
    $("#input_date_select").datepicker({dateFormat: 'dd M, yy'}).datepicker("setDate", new Date());
    $("#icon_date_select").datepicker({dateFormat: 'dd M, yy'});
    
    expandTextarea();
    login_manager();

}
document.addEventListener("app.Ready", onAppReady, false);