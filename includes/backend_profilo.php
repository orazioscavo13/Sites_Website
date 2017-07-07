<?php
  if(strcmp($categoria,"Amministratore")==0){
    ?>
    <script type="text/javascript" language="javascript">
      nascondi_info();
      </script>
    <?php
  }

  if(isset($_POST['pass'])){
    $old=md5($_POST['pass1']);
    $new1=$_POST['pass2'];
    $new2=$_POST['pass3'];
    $query = "select password from Utente where id = '".$user."';";
    $password=mysqli_fetch_assoc(mysqli_query($db,$query))['password'];
    if(strcmp($old,$password)!=0){ ?>
      <script type="text/javascript" language="javascript">
      show_alert_reload_on_close("Aggiornamento non riuscito", "Password errata...");
      </script>
    <?php
    }
    else if(strcmp($new1,$new2)!=0){ ?>
      <script type="text/javascript" language="javascript">
       show_alert_reload_on_close("Aggiornamento non riuscito", "Le due password non corrispondono...");
      </script>
    <?php
    }else{
        $query = "UPDATE Utente set password = '".md5($new1)."' where id = ".$user.";";
        mysqli_query($db,$query);
    ?>
      <script type="text/javascript" language="javascript">
       show_blue_alert("Aggiornamento password riuscito!", "La nuova password è stata inserita nel database");
      </script>
    <?php
    }
  }

if(isset($_POST['submit'])){
  $target_dir = "images/profile_images/";
  $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
  $uploadOk=1;
  $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
  $messaggio="";
  if(!$check){
    $messaggio=$messaggio."Il file non è un'immagine...; ";
    $uploadOk=0;
  }
  if ($_FILES["fileToUpload"]["size"] > 500000) {
    $messaggio= $messaggio."La dimensione dell'immagine non deve superare i 500Kb;  ";
    $uploadOk = 0;
  }
  if(strcmp($imageFileType,"jpg")!=0 && strcmp($imageFileType,"png")!=0 && strcmp($imageFileType,"jpeg")!=0 && strcmp($imageFileType,"gif")!=0 ) {
    $messaggio= $messaggio."Formato file non valido(Sono ammessi JPEG, png, gif); ";
    $uploadOk = 0;
  }
  if($uploadOk==0){
    ?>
      <script type="text/javascript" language="javascript">
       show_alert_reload_on_close("Aggiornamento non riuscito!", "<?php echo $messaggio; ?>");
      </script>
    <?php
  }else{
    $image=user_image($user,$db);
    $path="images/profile_images/" .$image;
    if(strcmp($image,"Default.png")!=0){
      unlink($path);
    }
    $temp = explode(".", $_FILES["fileToUpload"]["name"]);
    $newfilename = $user . '.' . end($temp);
    $target_file= $target_dir . basename($newfilename);
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)){
      $query = "Update Utente set immagine = '".$newfilename."' where id = ".$user.";";
      mysqli_query($db,$query);
      taglia($target_file);
      ?>
      <script type="text/javascript" language="javascript">
       show_blue_alert("Aggiornamento riuscito!", "Elaborazione della nuova immagine in corso");
       elaborazione();
      </script>
      <?php
    }else{ ?>
      <script type="text/javascript" language="javascript">
       show_alert_reload_on_close("Aggiornamento non riuscito!", "Qualcosa è andato storto...");
      </script>
      <?php
    }
  }
}
?>
