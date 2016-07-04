function onAppReady() {
    
    $("#input_date_select").datepicker({dateFormat: 'dd M, yy'}).datepicker("setDate", new Date());
    $("#icon_date_select").datepicker({dateFormat: 'dd M, yy'});
    
    login_manager();  
    deleteIndex("yesterday");
    
    if (JSON.parse(localStorage.getItem("pendente")).length>0){
        $("#btn_pendente").removeClass("hidden");
    }
}
document.addEventListener("app.Ready", onAppReady, false);