<?php
include("../Funzioni/functions.php");
session_start();
check_logged();
$user=$_SESSION['user'];
$db = connect();
$sito = $_POST['sito'];
if(strcmp(categoria($user,$db),"Cliente")==0){
  $link="";
}else{
  $link="on";
}

$query="SELECT s.*, c.*, l.costo_tot, l.sviluppatore from (Sito s join Cliente c on c.id = s.cliente) join Layout l on l.id = s.layout where s.codice = ".$sito.";";
$result = mysqli_query($db,$query);
$row1=mysqli_fetch_assoc($result); //
  $username = username($row1['id_utente'],$db);

  if($row1['pagato']){
    $stato="Pagato";
  }else{
    $stato="Non pagato";
  }

  $query= "SELECT id,username,immagine from Utente where id in (select id_utente from Sviluppatore where id = ".$row1['sviluppatore'].");";
  $sviluppatore=mysqli_fetch_assoc(mysqli_query($db,$query));
  $layouts=n_layout_sviluppati($sviluppatore['id'],$db);
  $query="select v.* from Visitatore v join Visita vis on v.id = vis.visitatore where vis.sito= '".$row1['codice']."';";
  $visite = mysqli_num_rows(mysqli_query($db,$query));
  $n_moduli=numero_moduli($row1['layout'],$db);

$res=array(
  'url' => $row1['url'],
  'layout' => $row1['layout'],
   'username' => $username,
   'cf' => $row1['cf'],
   'indirizzo' => $row1['indirizzo'],
   'telefono' => $row1['telefono'],
   'n_mod' => $n_moduli,
   'sviluppati' => $layouts,
   'img' => $sviluppatore['immagine'],
   'sviluppatore'=>$sviluppatore['username'],
   'dev'=>$sviluppatore['id'],
   'link' => $link,
   'stato' => $stato,
   'data' => $row1['data_pubblicazione'],
   'visite' => $visite,
   'costo' => $row1['costo_tot'],
);
$json = json_encode($res);
echo $json;
?>
