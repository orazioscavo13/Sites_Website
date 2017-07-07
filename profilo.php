<?php
include("Funzioni/functions.php");
session_start();
check_logged();
$user=$_SESSION['user'];
$db=connect();
$id=htmlspecialchars($_GET["id"]);
$cat=categoria($user,$db);
//I Clienti non hanno la possibilità di vedere i profili altrui
if((strcmp($cat,"Cliente")==0) && $id!=$user){
  header("Location: index.php");
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Siti Web | <?php echo username($id,$db); ?></title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="Template/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="Template/bootstrap/plugins/datatables/bootstrap.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="Template/dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="Template/dist/css/skins/_all-skins.min.css">
  <!-- IL seguente documento viene incluso per il funzionamento del plugin per l'upload dell'immagine del profilo che visualizza l'anteprima del file da inviare -->
  <link href="Template/fileinput_plugin/kartik-v-bootstrap-fileinput-4da2a42/css/fileinput.min.css" media="all" rel="stylesheet" type="text/css" />
  <link rel="stylesheet" href="extra/extra.css">
</head>


<body id="bod" style="background:url(images/pattern/pattern2.jpg)" class="hold-transition skin-blue layout-boxed sidebar-mini">
  <?php include ("includes/alert.php");
  include ("includes/popup_l1.php");
  include ("includes/slim_layout_popup.php");
   ?>
<div class="wrapper">
  <?php include ("includes/header.php"); ?>
  <?php include ("includes/sidebar.php"); ?>

  <div class="content-wrapper">

    <section class="content-header">
      <h1>
       <b class="text-blue"><?php echo " ".username($id,$db);?></b> - Profilo
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-database"></i> Siti Web</a></li>
        <li class="active">Profilo</li>
      </ol>
    </section>


    <section class="content">
<?php
      if($id==$user){
        include("includes/personal_profile.php");
      }
      include("includes/public_profile.php");
      if(strcmp($categoria,"Cliente")==0){
        include("includes/profile_sites.php");
      }else if(strcmp($categoria,"Sviluppatore")==0){
        include("includes/profile_layouts.php");
      }
?>
    </section>
  </div><!-- fine content-wrapper -->


  <footer class="main-footer">
    <strong>Corso di Basi di dati e Sistemi informativi  2017 - <a>Orazio Scavo</a>.</strong>
  </footer>


</div><!-- fine wrapper -->

<script src="Template/plugins/jQuery/jquery-2.2.3.min.js"></script>
<script src="Template/bootstrap/js/bootstrap.min.js"></script>
<script src="Template/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<script src="Template/plugins/fastclick/fastclick.js"></script>
<script src="Template/dist/js/app.min.js"></script>
<script src="Template/dist/js/demo.js"></script>
<script src="Template/fileinput_plugin/kartik-v-bootstrap-fileinput-4da2a42/js/plugins/piexif.min.js" type="text/javascript"></script>
<script src="Template/fileinput_plugin/kartik-v-bootstrap-fileinput-4da2a42/js/fileinput.min.js"></script>
<script src="Template/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="Template/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script src="extra/extra.js"></script>
<script src="profilo.js"></script>

</body>
</html>
<?php include("includes/backend_profilo.php");
