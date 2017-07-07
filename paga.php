<?php
//settaggio dello stato di un sito a "pagato"
include ("Funzioni/functions.php");
session_start();
check_logged();
$user=$_SESSION['user'];
$db=connect();
if(strcmp(categoria($user,$db),"Amministratore")!=0){
  header("Location: index.php");
}
$cod=htmlspecialchars($_GET["cod"]);
$query="UPDATE Sito set pagato = 1 where codice = '".$cod."'";
mysqli_query($db,$query);
?>
<script type="text/javascript">history.go(-1)</script>
