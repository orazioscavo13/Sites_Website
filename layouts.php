<?php
include ("Funzioni/functions.php");
session_start();
check_logged();
$user=$_SESSION['user'];
$db=connect();
$cat = categoria($user,$db);
if(strcmp($cat,"Cliente")==0){
  header("Location: index.php");
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Siti Web | Gestione Layout</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="Template/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="Template/bootstrap/plugins/datatables/bootstrap.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="Template/dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="Template/dist/css/skins/_all-skins.min.css">
  <link rel="stylesheet" href="extra/extra.css">
</head>

<body style="background:url(images/pattern/pattern2.jpg)" class="hold-transition skin-blue layout-boxed sidebar-mini">
  <?php
  include ("includes/alert.php");
  include ("includes/popup_layout.php");
  if(strcmp($cat,"Sviluppatore")==0){
  include ("includes/layout_form.php");
  }
   ?>

<div class="wrapper">
  <?php include ("includes/header.php"); ?>
  <?php include ("includes/sidebar.php"); ?>

  <div class="content-wrapper">
    <section class="content-header">
      <h1>
       Area Impiegati - Gestione Layout
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-database"></i> Siti Web</a></li>
        <li class="active">Gestione Layout</li>
      </ol>
    </section>
    <section class="content">
      <div class="row">
        <div class="col-md-12">

          <div class="box box-primary">

            <div class="box-header">
              <h3 class="box-title">Tutti i Layouts</h3>
              <?php if(strcmp($cat,"Sviluppatore")==0) { ?>
              <button onclick="show_layout_form()"type="button" class="btn btn-md btn-warning pull-right ">Crea Layout</button>
              <?php } ?>
            </div>

            <div class="box-body">

              <table id="layouttable" class="table table-bordered table-striped" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>Codice</th>
                    <th>Sviluppatore</th>
                    <th>Costo</th>
                    <th>Numero moduli</th>
                    <th>Utilizzi</th>
                  </tr>
                </thead>
                <tbody>
                <?php fill_layout_table($db); ?>
                </tbody>
                <tfoot>
                  <tr>
                    <th>Codice</th>
                    <th>Sviluppatore</th>
                    <th>Costo</th>
                    <th>Numero moduli</th>
                    <th>Utilizzi</th>
                  </tr>
                </tfoot>
              </table>

            </div><!-- fine box-body -->
          </div><!-- fine box -->
        </div>
      </div><!--fine row-->
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
<script src="Template/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="Template/plugins/datatables/dataTables.bootstrap.min.js"></script>

<!--manca script per ajax-->
<script src="extra/extra.js"></script>
<script src="layouts.js"></script>

</body>
</html>

<?php
  include("includes/backend_layouts.php");
?>
