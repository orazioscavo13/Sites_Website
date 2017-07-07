<?php
  if (isset($_POST['creasito'])){
    if(esiste_sito($db,$_POST['url'])){ ?>
      <script type="text/javascript" language="javascript">show_alert_reload_on_close("Errore","L'url indicato appartiene già ad un altro sito web!");</script>
      <?php
    }
    else if(!check_formato_data($_POST['data'])){ ?>
      <script type="text/javascript" language="javascript">show_alert_reload_on_close("Errore","Esprimere la data di pubblicazione nel formato: YYYY-MM-DD");</script>
      <?php
    }
    else{
    $customer = htmlspecialchars($_GET["id"]);
    if($_POST['pagato'])$pagato = 1;
    else $pagato = 0;
    //accetta solo date con formato yyyy-mm-dd
    $query="INSERT INTO Sito (data_pubblicazione, url, cliente, layout, pagato) VALUES ('".$_POST['data']."','".$_POST['url']."','".$customer."','".$_POST['layout']."',".$pagato.");";
    mysqli_query($db,$query);
    ?>
      <script type="text/javascript" language="javascript">show_blue_alert("Creazione riuscita","Il nuovo sito è stato assegnato al cliente!");</script>
    <?php
    }
  }
?>
