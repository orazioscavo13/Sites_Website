//Controlli sui dati inseriti nella form di registrazione, si verifica che non ci siano campi vuoti
function register_ons(){
  //dati in comune tra tutti i tipi di utenti
  if(document.registerform.username.value=="" || document.registerform.password.value=="" || document.registerform.password2.value==""){
    show_alert("Errore", "Alcuni campi sono vuoti...");
    return false;
  }
  //dati sviluppatore
  if($("#devcheck").is(":checked")){
    if(document.registerform.nome.value=="" || document.registerform.cognome.value=="" || document.registerform.iva.value=="" || document.registerform.telefono.value==""){
      show_alert("Errore", "Alcuni campi sono vuoti...");
      return false;
    }
  }else{
    //dati cliente
    if(document.registerform.cf.value=="" || document.registerform.citta.value=="" || document.registerform.indirizzo.value=="" || document.registerform.phone.value==""){
      show_alert("Errore", "Alcuni campi sono vuoti...");
      return false;
    }
    //azienda
    if($("#azcheck").is(":checked")){
      if(document.registerform.sede.value==""){
        show_alert("Errore", "Alcuni campi sono vuoti...");
        return false;
      }
    }
  }
  return true;
}

//controlli sui dati inseriti nella form di login, si verifica che non ci siano campi vuoti
function login_ons(){
  if(document.loginform.username.value=="" || document.loginform.password.value==""){
    show_alert("Errore", "Alcuni campi sono vuoti...");
    return false;
  }
  return true;
}

//viene mostrato un messaggio di conferma per l'avvenuta registrazione per poi eseguire in reindirizzamento alla home come utente loggato dopo 3 secondi
function countdown() {
    $("#close-alert").css("display","none");
    setTimeout(myTimeout1, 1000)
    setTimeout(myTimeout2, 2000)
    setTimeout(myTimeout3, 3000)
}
function myTimeout1() {
    $("#alertext").text("Sarai reindirizzato alla home tra: 2 secondi");
}
function myTimeout2() {
  $("#alertext").text("Sarai reindirizzato alla home tra: 1 secondi");
}
function myTimeout3() {
  window.location.href = "index.php";
}

//switch delle form di login e di registrazione
$("#registrati").click(function(){
  $("#logform").css("display", "none");
  $("#regform").css("display", "block");
});
$("#accedi").click(function(){
  $("#regform").css("display", "none");
  $("#logform").css("display", "block");
});

//switch dei campi della form (Dati cliente o sviluppatore)
$("#devcheck").click(function(){
  if($("#devcheck").is(":checked")){
   $(".campo-svil").css("display","block");
   $(".campo-cli").css("display","none");
  }else{
    $(".campo-svil").css("display","none");
    $(".campo-cli").css("display","block");
  }
});

//Abilita/disabilita il campo "sede" della form in caso di registrazione di cliente come persona fisica o come azienda
$("#azcheck").click(function(){
  if($("#azcheck").is(":checked")){
    $("#field-sede").prop('disabled', false);
  }else{
    $("#field-sede").prop('disabled', true);
  }
});
