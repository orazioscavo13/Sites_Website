//funzione che rende visibile il popup (includes/popup_layout.php) per mostrare il dettaglio del layout nella pagina di gestione dei layout
//Al click esterno al blocco avviene la funzione blink per il popup
function show_modules_popup(lay){
		$("#popup1").css("display", "block");
		$("#popup1").css("width", "40%");
		$("#popup1").css("left", "30%");
		$("#veil-1").css("display", "block");
		$("#title-mod").text('Dettaglio: Layout ' + lay);
		$("#veil-1").css("height", $(document).height());
		$("#close1").click(function(){
			$("#veil-1").css("display", "none");
    });
    $("#veil-1").click(function(){
    	popup2_blink();
    });
    $("#closebutton1").click(function(){
			$("#veil-1").css("display", "none");
			$("#popup1").css("display", "none");
    });
  	$("#layoutheader").css("background-color","#FF5555");
  	$("#popup1").css("border-color", "#FF5555");
  	$(".modname").css("color","#FF5555");
  	$(".cont").css("color","#FF5555");

		//i dati relativi al layout vengono richiesti in maniera asincrona al server
		$.ajax({
	        type: "POST",
	        url: "Ajax/risposta_layout_popup.php",
	        data: { 'layout': lay  },
	        success: function(data){
	          var opts = $.parseJSON(data);
							fill_layout_popup(opts['moduli']);
						}
	        });
}

//Funzione per la verifica dei dati immessi nella form di creazione del layout
function layform_ons(){
	if($(".modchoose:checkbox:checked").length==0){
		show_alert("Creazione non riuscita!", "Nessun modulo è stato selezionato...");
    return false;
	}
	return true
}

//funzione che rende visibile il popup (includes/layout_form.php) contenente la form per la creazione di un nuovo layout
function show_layout_form(){
  $("#popupform").css("display", "block");
	$("#veil-1").css("display", "block");
	$("#veil-1").css("height", $(document).height());
	$("#closeform").click(function(){
		$("#veil-1").css("display", "none");
  });
  $("#veil-1").click(function(){
    popupform_blink();
  });
}

//attivazione datatable
$(document).ready(function() {
  $('#layouttable').DataTable();
});
