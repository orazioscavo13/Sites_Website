//funzione per la verifica dei dati immessi nella form di creazione del sito
function siteform_ons(){
	if(document.siteform.url.value=="" || document.siteform.data.value==""){
    show_alert("Errore", "Alcuni campi sono vuoti...");
    return false;
  }
  if($(".lay:checked").length==0){
    show_alert("Errore", "Seleziona un layout per il nuovo sito...");
    return false;
  }
  return true;
}

//funzione che rende visibile il popup (includes/site_form.php) contenente la form per la creazione di un nuovo sito
function show_site_form(customer){
  //i dati relativi al cliente vengono richiesti in maniera asincrona al server
	$.ajax({
        type: "POST",
        url: "Ajax/risposta_form_sito.php",
        data: { 'customer': customer  },
        success: function(data){
          var opts = $.parseJSON(data);
          $("#p1-username").text(opts['username']);
          $("#p1-cf").text(' (' + opts['cf'] + ')');
          $("#p1-indirizzo").text(opts['indirizzo'] + ', ' + opts['citta']);
          $("#p1-telefono").text(opts['telefono']);
					}
        });

	//Inserisce nell'intestazione i dati del cliente associato al bottone cliccato dall'amministratore nella tabella clienti
	$("#popupform").css("display", "block");
	$("#veil-1").css("display", "block");
	$("#veil-1").css("height", $(document).height());
	$("#popupform").css("top","15%");
	$("#popupform").css("width","65%");
	$("#closeform").click(function(){
		$("#veil-1").css("display", "none");
  });
  $("#veil-1").click(function(){
  	popup1_blink();
  });
  $("#closeform1").click(function(){
    $("#veil-1").css("display", "none");
		$("#popup1").css("display", "none");
  });
  $("#veil-1").click(function(){
    popupform_blink();
  });
	//specifica alla pagina che riceverà i dati della form (la pagina stessa) l'id del cliente a cui assegnare il nuovo sito tramite parametro GET
  document.siteform.action = 'clienti.php?id=' + customer;
	//aggiornamento dinamico del costo cin base al layout selezionato
  $(".lay").click(function(){
  	$("#costo").text("Costo totale: " + this.dataset.costo+ " €");
  });
}

//attivazione datatables
$(document).ready(function() {
  $('#aztable').DataTable();
  $('#perstable').DataTable();
});
