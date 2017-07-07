<?php
include("../Funzioni/functions.php");
session_start();
check_logged();
$user=$_SESSION['user'];
$db = connect();
$cliente = $_POST['customer'];

//customer,username,cf,indirizzo,citta,telefono
$query="SELECT * FROM Cliente where id = '".$cliente."'";
$result  = mysqli_fetch_assoc(mysqli_query($db,$query));
$res=array(
  'username' => username($result['id_utente'],$db),
   'cf' => $result['cf'],
   'indirizzo' => $result['indirizzo'],
   'citta' => $result['citta'],
   'telefono' => $result['telefono'],
);
$json = json_encode($res);
echo $json;
?>
