<?php
  if(isset($_POST['crea'])){
    $dev=id_sviluppatore($user,$db);
    $query="INSERT INTO Layout (sviluppatore) VALUES (". $dev .");";
    mysqli_query($db,$query);
    $layout = mysqli_insert_id($db);
    $query = "INSERT INTO Composizione (modulo, layout) VALUES ";
    foreach ($_POST['moduli'] as $value) {
      $query.="('".$value."','".$layout."'),";
    }
    $query = substr($query,0,(strlen($query)-1));//rimuove la virgola
    $query.=";";
    mysqli_query($db,$query);
    ?>
      <script type="text/javascript" language="javascript">show_blue_alert("Creazione riuscita","Il nuovo Layout è stato inserito nel database!");</script>
    <?php
  }
?>
