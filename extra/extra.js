//funzione che visualizza un popup di errore (includes/alert.php) con bordo superiore rosso contenente il messaggio indicato
function show_alert(titolo,messaggio){
	$("#alert").removeClass("box-primary");
	$("#alert").addClass("box-danger");
	$("#alertitle").text(titolo);
	$("#alertext").text(messaggio);
	$("#alert").css("display", "block");
	$("#veil").css("display", "block");
	$("#veil").css("height", $(document).height());
	$("#close-alert").click(function(){
		$(".veil").css("display", "none");
  });
}

//funzione che visualizza un popup di errore (includes/alert.php) con bordo superiore rosso contenente il messaggio indicato che
//effettua un refresh della pagina quando chiuso in modo da non reinviare i dati inseriri nella form con un refresh della pagina
function show_alert_reload_on_close(titolo,messaggio){
	show_alert(titolo,messaggio);
	$("#close-alert").click(function(){
		 window.location.href = window.location.href;
  });
}

//funzione che mostra un popup di conferma (alert.php) con bordo superiore azzurro contenente il messaggio indicato
//avviene un refresh della pagina quando il popup viene chiuso in modo da non reinviare i dati inseriri nella form con un refresh della pagina
function show_blue_alert(titolo,messaggio){
	show_alert(titolo,messaggio);
	$("#alert").removeClass("box-danger");
	$("#alert").addClass("box-primary");
	$("#close-alert").click(function(){
		 window.location.href = window.location.href;
  });
}

//Funzione che appende un elemento al carosello presente nel popup per ogni Modulo che compone il layout di cui si vuole visualizzare il dettaglio
//usata da show_slim_layout_popup, nel profilo del cliente e nella creazione di un nuovo sito
//usata da show_modules_popup nella pagina di gestione dei layouts
function fill_layout_popup(moduli){
	document.getElementById("car-items").innerHTML = "";
	var active = 'active';
	var string;
	for(i = 0; i < moduli.length; i++){
		if(i!=0) active= '';
		string = '<div class="item ' + active + '"><h4 class="text-center"><b class="modname text-primary">' + moduli[i]['nome'] + '</b></h4><p class="text-center">' + moduli[i]['funzionalita'] + '</p><small style="position:relative; left:48%;" class="text-center text-info cont">' + (i+1) + '/' + moduli.length + '</small></div>';
		$("#car-items").append(string);
	}
}

//Funzione per la visualizzazione del dettaglio (includes/slim_layout_popup.php) sul layout
//usata nella creazione di un nuovo sito e nella visualizzazione di un layout nel profilo di un cliente o di uno sviluppatore
//Al click esterno al blocco il popup scompare
function show_slim_layout_popup(lay){
	//i dati relativi al layout vengono richiesti in maniera asincrona al server
	$.ajax({
        type: "POST",
        url: "Ajax/risposta_layout_popup.php",
        data: { 'layout': lay  },
        success: function(data){
          var opts = $.parseJSON(data);
						fill_layout_popup(opts['moduli']);
						$("#img-2").attr('src','images/profile_images/' + opts['immagine']);
						if(opts['link']!=""){
							$("#link-2").attr("href", "profilo.php?id=" + opts['dev']);
						}
						$("#link-2").text(opts['dev_username']);
					}
        });

				$("#popup2").css("display", "block");
				$("#veil-2").css("display", "block");
				$("#veil-2").css("height", $(document).height());
				$("#close2").click(function(){
					$("#veil-2").css("display", "none");
				});
				$("#veil-2").click(function(){
					$("#veil-2").css("display", "none");
					$("#popup2").css("display", "none");
				});
				$("#popup-title2").text("Dettaglio: Layout " + lay);
}

//Funzione per il blink del popup quando avviene un click al di fuori di esso
//usata nel profilo cliente per il popup sul dettaglio del sito (popup azzurro)
function popup1_blink() {
  var audio = new Audio("Audio/ping.mp3");
  audio.play();
  setTimeout(blink1, 150)
  setTimeout(blink0, 200)
  setTimeout(blink1, 250)
  setTimeout(blink1, 300)
  setTimeout(blink1, 350)
  setTimeout(blink0, 400)
  setTimeout(blink1, 450)
  setTimeout(blink1, 500)
  setTimeout(blink1, 550)
  setTimeout(blink0, 600)
}
//funzioni per il blink del popup azzurro
function blink1(){
	$("#popup1").removeClass("box-primary");
	$("#popup1").addClass("box-info");
}
function blink0(){
	$("#popup1").removeClass("box-info");
	$("#popup1").addClass("box-primary");
}

//Funzione per il blink del popup quando avviene un click al di fuori di esso
//Usata nella pagina di gestione dei layout per il popup contenente la form di creazione dei layout (popup giallo)
function popupform_blink() {
  var audio = new Audio("Audio/ping.mp3");
  audio.play();
  setTimeout(blink2, 50)
  setTimeout(blink3, 100)
  setTimeout(blink2, 150)
  setTimeout(blink3, 200)
  setTimeout(blink2, 250)
  setTimeout(blink3, 300)
  setTimeout(blink2, 350)
  setTimeout(blink3, 400)
  setTimeout(blink2, 450)
  setTimeout(blink3, 500)
}
//funzioni per il blink del popup rosso
function blink2(){
	$("#formheader").css("background-color","#FFFF33");
}
function blink3(){
	$("#formheader").css("background-color","#F39C12");
}

//Funzione per il blink del popup quando avviene un click al di fuori di esso
//Usata nella pagina di gestione dei layout per il popup contenente il dettaglio sul layout (popup rosso)
function popup2_blink() {
  var audio = new Audio("Audio/ping.mp3");
  audio.play();
  setTimeout(blink4, 50)
  setTimeout(blink5, 100)
  setTimeout(blink4, 150)
  setTimeout(blink5, 200)
  setTimeout(blink4, 250)
  setTimeout(blink5, 300)
  setTimeout(blink4, 350)
  setTimeout(blink5, 400)
  setTimeout(blink4, 450)
  setTimeout(blink5, 500)
}
//funzioni per il blink del popup rosso
function blink4(){
	$("#layoutheader").css("background-color","#DD4B39");
}
function blink5(){
	$("#layoutheader").css("background-color","#FF5555");
}
