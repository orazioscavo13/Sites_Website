<?php
include("../Funzioni/functions.php");
session_start();
check_logged();
$user=$_SESSION['user'];
$db = connect();
$layout = $_POST['layout'];
$query = "SELECT * from Modulo where nome in (select modulo from Composizione where layout = ".$layout.");";
$result=mysqli_query($db,$query);
$modres = array();
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
{
   $modres[] = array(
	  'nome'=> $row['nome'],
      'funzionalita' => $row['funzionalita'],
   );
}



$query2 = "SELECT l.id, s.id_utente, u.username, u.immagine FROM
(Layout l join Sviluppatore s on s.id = l.sviluppatore) join Utente u on u.id = s.id_utente
 where l.id = " .$layout.";";
$dati_layout = mysqli_fetch_assoc(mysqli_query($db,$query2));

if(strcmp(categoria($user,$db),"Cliente")==0){
  $link="";
}else{
  $link="on";
}

$res=array(
   'moduli' => $modres,
   'dev_username'=>$dati_layout['username'],
   'layout'=>$layout,
   'dev' => $dati_layout['id_utente'],
   'link' => $link,
   'immagine' => $dati_layout['immagine'],
);
$json = json_encode($res);
echo $json;
?>
