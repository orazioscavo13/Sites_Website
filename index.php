<?php
include ("Funzioni/functions.php");
session_start();
check_logged();
$user=$_SESSION['user'];
$db=connect();
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Siti Web | Home</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="Template/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="Template/dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="Template/dist/css/skins/_all-skins.min.css">
  <link rel="stylesheet" href="extra/extra.css">
</head>

<body style="background:url(images/pattern/pattern2.jpg)" class="hold-transition skin-blue layout-boxed sidebar-mini">
  <?php include ("includes/alert.php"); ?>
<div class="wrapper">
  <?php include ("includes/header.php"); ?>
  <?php include ("includes/sidebar.php"); ?>

  <div class="content-wrapper">
    <section class="content-header">
      <h1>
       Benvenuto <b class="text-blue"><?php echo " ".username($user,$db);?></b>!
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-database"></i> Siti Web</a></li>
        <li class="active">Home</li>
      </ol>
    </section>

    <section class="content">
      <div class="row">
        <h3 style="margin-left:20px;">I moduli più scelti:</h3>
        <?php display_moduli_top($db); ?>
      </div>

      <div class="row">
        <div class="col-md-12">

          <div class="box box-danger">

            <div class="box-header with-border">
              <h2 class="box-title">Il team di sviluppatori</h2>
            </div>
            <div class="box-body no-padding">
                  <ul class="users-list clearfix">
                    <?php show_developers($db,$user); ?>
                  </ul>
            </div><!-- fine box-body -->

          </div><!--fine box -->

        </div>
      </div><!-- fine row -->

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
<script src="extra/extra.js"></script>
</body>
</html>
