<?php
include("display_functions.php");
include("user_functions.php");

//effettua la connessione al database locale
function connect(){
$host="localhost";
$nome="root";
$password="pass";
$db="dbname";
$connessione = mysqli_connect($host, $nome,$password,$db);
  if (mysqli_connect_errno()) {
     echo "Failed to connect to MySQL: (" .mysqli_connect_error(). ") ";
  }
return $connessione;
}

//previene accessi da parte di utenti non loggati rieindirizzando alla pagina "login"
function check_logged(){
  if (!isset($_SESSION['user']))
    header("Location: login.php");
}

//controlli sui dati per la registrazione dell'utente
function check_registrazione($username,$password,$password2,$db){
  //username esistente
  if(esiste($username,$db)>0){?>
    <script type="text/javascript" language="javascript">
            show_alert_reload_on_close("Registrazione fallita!" ,"Username già esistente");
      </script> <?php
    return 0;
   }
   //l'username deve contenere solo lettere e numeri e deve essere al massimo di 20  caratteri
  $pattern = "/^[a-zA-Z0-9\s]+$/";
  if(!preg_match($pattern,$username) || strlen($username)>20){
    ?>
  <script type="text/javascript" language="javascript">
            show_alert_reload_on_close("Registrazione fallita!" ,"L'username deve contenere solo lettere e numeri e non deve essere più lungo di 20 caratteri...");
    </script>
    <?php
    return 0;
  }
  //le password non corrispondono
  if(strcmp($password,$password2)!=0){?>
    <script type="text/javascript" language="javascript">
            show_alert_reload_on_close("Registrazione fallita!" ,"Le due password non corrispondono");
      </script> <?php
    return 0;
  }

  return 1;
}

//controlli sui dati per la registrazione di uno sviluppatore
function check_reg_dev($nome,$cognome,$telefono,$iva){
  $pattern_lettere = "/^[a-zA-Z\s]+$/";
  $pattern_numero = "/^[0-9\s]+$/";
  if(!preg_match($pattern_lettere,$nome) || !preg_match($pattern_lettere,$cognome)){
    ?>
    <script type="text/javascript" language="javascript">
            show_alert_reload_on_close("Registrazione fallita!" ,"Nome e cognome possono contenere solo lettere...");
    </script>
    <?php
    return 0;
  }
  if(!preg_match($pattern_numero,$telefono)){
    ?>
    <script type="text/javascript" language="javascript">
            show_alert_reload_on_close("Registrazione fallita!" ,"Il numero di  telefono contiene caratteri non numerici...");
    </script>
    <?php
    return 0;
  }
  if(!preg_match($pattern_numero,$iva)){
    ?>
    <script type="text/javascript" language="javascript">
            show_alert_reload_on_close("Registrazione fallita!" ,"La partita Iva contiene caratteri non numerici...");
    </script>
    <?php
    return 0;
  }
  return 1;
}

//controlli sui dati per la registrazione di un cliente
function check_reg_cli($cf,$citta,$indirizzo,$telefono){
  $pattern_lettere_num = "/^[a-zA-Z0-9\s]+$/";
  $pattern_lettere = "/^[a-zA-Z\s]+$/";
  $pattern_numero = "/^[0-9\s]+$/";
  if(!preg_match($pattern_lettere_num,$cf)){
    ?>
    <script type="text/javascript" language="javascript">
            show_alert_reload_on_close("Registrazione fallita!" ,"Il codice fiscale contiene caratteri non validi...");
    </script>
    <?php
    return 0;
  }
  if(!preg_match($pattern_lettere_num,$indirizzo)){
    ?>
    <script type="text/javascript" language="javascript">
            show_alert_reload_on_close("Registrazione fallita!" ,"L'indirizzo contiene caratteri non validi...");
    </script>
    <?php
    return 0;
  }
  if(!preg_match($pattern_numero,$telefono)){
    ?>
    <script type="text/javascript" language="javascript">
            show_alert_reload_on_close("Registrazione fallita!" ,"Il numero di telefono contiene caratteri non numerici...");
    </script>
    <?php
    return 0;
  }
  if(!preg_match($pattern_lettere,$citta)){
    ?>
    <script type="text/javascript" language="javascript">
            show_alert_reload_on_close("Registrazione fallita!" ,"Il nome della città contiene caratteri non validi");
    </script>
    <?php
    return 0;
  }
  return 1;
}

//ritaglia un'immagine rendendola quadrata (per poter visualizzare correttamente l'immagine
// con la modalità circle offerta dal Template) e la sostituisce nel filesystem
function taglia($immagine){
    $dimensioni = getimagesize($immagine);
    $larghezza = $dimensioni[0];
    $altezza = $dimensioni[1];
    if($altezza==$larghezza){
        return;
    }
    if($altezza>$larghezza){
        $dst_h=$larghezza;
        $dst_w=$larghezza;
        $src_y=($altezza-$larghezza)/2;
        $src_x=0;
    }else{
        $dst_h=$altezza;
        $dst_w=$altezza;
        $src_x=($larghezza-$altezza)/2;
        $src_y=0;
    }
    $dst_x = 0; $dst_y = 0;
    $src_w = $src_x + $dst_w;
    $src_h = $src_y + $dst_h;
    $dst_image = imagecreatetruecolor($dst_w,$dst_h);
    $src_image = imagecreatefromjpeg($immagine);
    imagecopyresampled($dst_image, $src_image, $dst_x, $dst_y, $src_x, $src_y, $dst_w, $dst_h, $src_w, $src_h);
    imagejpeg($dst_image,$immagine);
}

//restituisce il numero di moduli che compongono il layout dato il suo id
function numero_moduli($layout,$db){
  $query = "SELECT * from Modulo where nome in (select modulo from Composizione where layout = ".$layout.");";
  return mysqli_num_rows(mysqli_query($db,$query));
}

//Genera il parametro per la funzione che verrà definita per il click sul nome del modulo
function genera_parametro_moduli($layout,$db){
  $corpo = "";
  $query = "SELECT * from Modulo where nome in (select modulo from Composizione where layout = ".$layout.");";
  $result=mysqli_query($db,$query);

  while ($row = mysqli_fetch_assoc($result)){
    $corpo.=$row['nome']."~";
    $corpo.=$row['funzionalita']."~";
  }
  return $corpo;
}

//controlli sui dati per la creazione di un nuovo modulo
function check_module($vet,$db){
  $pattern_lettere_num = "/^[a-zA-Z0-9\s]+$/";
  $pattern_lettere = "/^[a-zA-Z\s]+$/";
  $pattern_numero = "/^[0-9\s]+$/";
  if(!preg_match($pattern_numero,$vet['costo'])) {
    ?>
    <script type="text/javascript" language="javascript">
            show_alert_reload_on_close("Creazione fallita!" ,"Il costo deve essere un numero...");
    </script>
    <?php
    return 0;
  }
  if(esiste_modulo($vet['nome'],$db)){
    ?>
    <script type="text/javascript" language="javascript">
            show_alert_reload_on_close("Creazione fallita!" ,"Esiste già un modulo con il nome indicato...");
    </script>
    <?php
    return 0;
  }
  if(strlen($vet['funzionalita'])>50){
    ?>
    <script type="text/javascript" language="javascript">
            show_alert_reload_on_close("Creazione fallita!" ,"Il campo funzionalità non deve superare i 50 caratteri...");
    </script>
    <?php
    return 0;
  }
  if((strpos($vet['funzionalita'], "'" ) !== FALSE) || (strpos($vet['funzionalita'], "~" ) !== FALSE) || (strpos($vet['funzionalita'], '"' ) !== FALSE)) {
    ?>
    <script type="text/javascript" language="javascript">
            show_alert_reload_on_close("Creazione fallita!" ,"La funzionalità contiene caratteri non validi: '~', apici singoli o virgolette...");
    </script>
    <?php
    return 0;
  }
  return 1;
}

//controlla l'esistenza di un modulo con nome uguale a quello dato in input
function esiste_modulo($nome,$db){
  $query="SELECT * from Modulo where nome = '".$nome."';";
  $result=mysqli_num_rows(mysqli_query($db,$query));
  return $result;
}

//esegue la query per  inserire un nuovo modulo nel database
function inserisci_modulo($vet,$db){
  $query="INSERT INTO Modulo (nome,funzionalita,costo) VALUES ('".$vet['nome']."','".$vet['funzionalita']."',".$vet['costo'].".00);";
  mysqli_query($db,$query);
}

//verifica l'esistenza nel database di un sito con url uguale a quello indicato
function esiste_sito($db,$url){
  $query="SELECT * from Sito where url = '".$url."';";
  $result=mysqli_num_rows(mysqli_query($db,$query));
  return $result;
}

//verifica il formato della data inserita nella form di creazione dei siti
function check_formato_data($data){
  $pattern = "/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/";
  if(preg_match($pattern,$data)){
    return true;
  }else return false;
}

?>
