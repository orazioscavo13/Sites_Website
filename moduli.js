
//Controllo sui campi della form per la creazione di un modulo, viene verificato che non ci siano campi vuoti
function check_new_module(){
  if(document.modform.nome.value=="" || document.modform.funzionalita.value=="" || document.modform.costo.value=="" || document.registerform.phone.value==""){
    show_alert("Errore", "Alcuni campi sono vuoti...");
    return false;
  }
  return true;
}

//attivazione Datatable
$(document).ready(function() {
  $('#sitetable').DataTable();
});
