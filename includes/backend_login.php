<?php
if (isset($_POST['login'])){
  if(check_login($_POST['username'],md5($_POST['password']),$db)==0){ ?>
    <script type="text/javascript" language="javascript">
      show_alert_reload_on_close("Accesso fallito!" ,"Username o password errati...");
    </script>
    <?php
    }else{
      $username=$_POST['username'];
      $password=md5($_POST['password']);
      $query="SELECT id from Utente where username = '".$username."' and password = '".$password."';";
      $result=mysqli_query($db,$query);
      $row=mysqli_fetch_assoc($result);
      $id=$row['id'];
      $_SESSION['user']=$id;
      ?>
      <script type="text/javascript" language="javascript">
        window.location.href = "index.php";
      </script>
      <?php
    }
}


if (isset($_POST['registra'])){
  if(isset($_POST['sviluppatore'])){
    $sviluppatore=1;
    $check=check_reg_dev($_POST['nome'],$_POST['cognome'],$_POST['telefono'],$_POST['iva']);
  }else {
    $sviluppatore=0;
    $check=check_reg_cli($_POST['cf'],$_POST['citta'],$_POST['indirizzo'],$_POST['phone']);
  }

  if(check_registrazione($_POST['username'],$_POST['password'],$_POST['password2'],$db) && $check){
    registra($_POST['username'],md5($_POST['password']),$sviluppatore,$db);
    $query="SELECT id from Utente where username = '".$_POST['username']."' and password = '".md5($_POST['password'])."';";
    $result=mysqli_query($db,$query);
    $row=mysqli_fetch_assoc($result);
    $id=$row['id'];
    $_SESSION['user']=$id;
    if($sviluppatore){
      registra_sviluppatore($_POST,$db,$id);
    }
    else {
      if(isset($_POST['azienda'])){
         $azienda=1;
      }else $azienda=0;
      registra_cliente($_POST,$db,$id,$azienda);
    }
  ?>
    <script type="text/javascript" language="javascript">
            show_blue_alert("Registrazione effettuata!", "Sarai reindirizzato alla home tra: 3 secondi");
            countdown();
    </script> <?php
  }
}
?>
