<?php
if(isset($_POST['submit'])){
  if (check_module($_POST,$db)){
    inserisci_modulo($_POST,$db);
    ?>
    <script type="text/javascript" language="javascript">
            show_blue_alert("Creazione riuscita!" ,"Il nuovo modulo è stato inserito nel database");
    </script>
    <?php 
  }
}
?>