function onAppReady() {
	
    login_manager();
    $("#input_date_select").datepicker({showOn:"none"}).datepicker("setDate", new Date());
    
//	moment.locale('pt-br');
//	$("#input_date_select").val(moment().format("LL"));
//	$("#aba-dia2").html(moment().add(1, 'day').format("L"));
//	$("#aba-dia3").html(moment().add(2, 'day').format("L"));
//	$("#aba-dia4").html(moment().add(3, 'day').format("L"));
//	$("#aba-dia5").html(moment().add(4, 'day').format("L"));
//	$("#aba-dia6").html(moment().add(5, 'day').format("L"));
//	$("#aba-dia7").html(moment().add(6, 'day').format("L"));
}
document.addEventListener("app.Ready", onAppReady, false);
