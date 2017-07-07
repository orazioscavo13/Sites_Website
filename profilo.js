//Funzione che Immette i dati nel popup per la visualizzazione del dettaglio del sito nel profilo del cliente e usa show_site_popup per attivare il popup
function show_site(sito){
	//i dati relativi al sito vengono richiesti in maniera asincrona al server
	if($("#p1-stato").hasClass("label-warning")){
		$("#p1-stato").removeClass("label-warning");
	}
	if($("#p1-stato").hasClass("label-success")){
		$("#p1-stato").removeClass("label-success");
	}
	$.ajax({
				type: "POST",
				url: "Ajax/risposta_popup_sito.php",
				data: { 'sito': sito },
				success: function(data){

					var opts = $.parseJSON(data);
					$("#p1-username").text(opts['username']);
					$("#p1-cf").text(' (' + opts['cf'] + ')');
					$("#p1-indirizzo").text(opts['indirizzo']);
					$("#p1-telefono").text(opts['telefono']);
					$("#p1-stato").text(opts['stato']);
					var classe;
					if(opts['stato']=="Pagato"){
						classe = "label-success";
					}else classe = "label-warning";
					$("#p1-stato").addClass(classe);
					$("#popup-title1").text(opts['url']);
					$("#p1-img").attr('src','images/profile_images/' + opts['img']);
					$("#p1-dev").text(opts['sviluppatore']);
					$("#p1-sviluppati").text('Layout sviluppati: ' + opts['sviluppati']);
					$("#p1-nmod").text("(" + opts['n_mod'] + " Moduli)");
					if(opts['link']!=""){
						link = 'profilo.php?id=' + opts['dev'];
						$("#p1-dev").attr("href",link);
					}
					$("#p1-data").text(opts['data']);
					$("#p1-visite").text(opts['visite']);
					$("#p1-costo").text(opts['costo']);
					$("#p1-layout").text("Layout "+opts['layout']);
					show_site_popup(opts['layout']);
					}
				});
}

//funzione che rende visibile il popup (popup_l1.php), usato per la visualizzazione del dettaglio del sito nel profilo di un cliente
//imposta show_slim_layout_popup come funzione al click del bottone per mostrare il dettaglio del layout
function show_site_popup(layout){
	$("#popup1").css("display", "block");
	$("#veil-1").css("display", "block");
	$("#veil-1").css("height", $(document).height());
	$("#close1").click(function(){
	$("#veil-1").css("display", "none");
    });
    $("#veil-1").click(function(){
    	popup1_blink();
    });
    $("#closebutton1").click(function(){
	$("#veil-1").css("display", "none");
	$("#popup1").css("display", "none");
    });
    $("#p1-layout").click(function() {
    	show_slim_layout_popup(layout);
    });
}

//attesa introdotta una volta constatato che la pagina si aggiornava prima che l'immagine venisse ritagliata
function elaborazione(){
   $("#close-alert").css("display","none");
	setTimeout(myTimeout4, 600)
    setTimeout(myTimeout5, 1200)
    setTimeout(myTimeout6, 1800)
    setTimeout(reload, 2100)
}
function myTimeout4() {
    $("#alertext").text("Elaborazione della nuova immagine in corso.");
}
function myTimeout5() {
	$("#alertext").text("Elaborazione della nuova immagine in corso..");
}
function myTimeout6() {
	$("#alertext").text("Elaborazione della nuova immagine in corso...");
}
function reload() {
	//refresh della pagina senza reinviare i dati nel vettore $_POST
	 window.location.href = window.location.href;
}

//Verifica che siano stati inseriti i dati nella form di aggiornamento password prima dell'invio dei dati
function check_aggiorna_password(){
  if(document.passwordform.pass1.value=="" || document.passwordform.pass2.value=="" || document.passwordform.pass3.value==""){
    show_alert("Errore", "Alcuni campi sonno vuoti...");
    return false;
  }
  return true;
}

//Nasconde le informazioni personali del profilo, viene  usata se si tratta del profilo dell'amministratore
function nascondi_info(){
	$("#infoblock").css("display","none");
	$("#profilebox").removeClass("col-md-4");
	$("#profilebox").addClass("col-md-12");
}

//Abilita la datatable
$(document).ready(function() {
    $('#sitetable').DataTable();
		$('#layouttable').DataTable();
} );
