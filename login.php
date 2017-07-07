<?php
session_start();
include ("Funzioni/functions.php");
$db = connect();
?>
<!DOCTYPE html>
<html>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Siti Web | Login</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="Template/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="Template/dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="Template/dist/css/skins/skin-blue.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="extra/extra.css">
</head>
<style>
	html{height:100%;} 
</style>
<body id="corpo" class="hold-transition login-body">
<?php include ("includes/alert.php"); ?>
<div style="overflow-y: visible;" class="wrapper">

    <section class="content">
        <div class="row"> 
          <div class="col-md-12">
            <h1 class="azzurro" style="text-align: center;"><b>BENVENUTO</b></h1>
          </div>
        </div>
        
          <div class="col-md-3"></div><!--spazio vuoto per centrare la form-->
        <div id="container"  class="col-md-6">
          <div id="logform"class="box box-info">

            <div class="box-header with-border">
              <h3 class="azzurro box-title text-primary">EFFETTUA L'ACCESSO</h3>
            </div>

            <form onsubmit="return login_ons();"name="loginform" action="<?php echo $_SERVER["REQUEST_URI"]; ?>" class="form-horizontal" method="post">
              <div class="box-body">

                <div class="form-group">
                  <label for="username" class="col-sm-2 control-label">Username</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="username" placeholder="Username">
                  </div>
                </div>

                <div class="form-group">
                  <label for="password" class="col-sm-2 control-label">Password</label>

                  <div class="col-sm-10">
                    <input type="password" class="form-control" name="password" placeholder="Password">
                  </div>
                </div>
                <!-- per una eventuale implementazione di cookies: 
                <div class="form-group">
                  <div class="col-sm-offset-2 col-sm-10">
                    <div class="checkbox">
                      <label>
                        <input type="checkbox"> Remember me
                      </label>
                    </div>
                  </div>
                </div>-->
              </div><!-- fine box-body -->

              <div class="box-footer">
                <span class="pull-left"><small>Non hai un account? </small><a href="#" id="registrati" style="color:#00C0EF">Registrati!</a></span>
                <button type="submit" name="login" class="btn btn-info pull-right">ACCEDI</button>
              </div>

            </form>
          </div><!-- fine box "logform" -->

          <div id="regform" class="box box-info" style="display: none;">
            <div class="box-header with-border">
              <h3 class="azzurro box-title">REGISTRAZIONE</h3>
            </div>

            <form onsubmit="return register_ons();" name="registerform"  action="<?php echo $_SERVER["REQUEST_URI"]; ?>" class="form-horizontal" method="post">
              <div class="box-body">

                <div class="form-group">
                  <label class="col-sm-2 control-label">Username</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="username" placeholder="Username">
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-2 control-label">Password</label>
                  <div class="col-sm-10">
                    <input type="password" class="form-control" name="password" placeholder="Password">
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-2 control-label">Conferma Password</label>
                  <div class="col-sm-10">
                    <input type="password" class="form-control" name="password2" placeholder="Conferma Password">
                  </div>
                </div>

                <!-- campi cliente -->
                <div class="form-group campo-cli">
                  <label class="col-sm-2 control-label">Codice Fiscale</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="cf" placeholder="Codice Fiscale">
                  </div>
                </div>

                <div class="form-group campo-cli">
                  <label class="col-sm-2 control-label">Città</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="citta" placeholder="Città">
                  </div>
                </div>

                <div class="form-group campo-cli">
                  <label class="col-sm-2 control-label">Indirizzo</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="indirizzo" placeholder="Indirizzo">
                  </div>
                </div>

                <div class="form-group campo-cli">
                  <label class="col-sm-2 control-label">Telefono</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="phone" placeholder="Telefono">
                  </div>
                </div>

                <div class="form-group campo-cli">
                  <div class="col-sm-offset-2 col-sm-10">
                    <div class="checkbox">
                      <label>
                        <input id="azcheck" type="checkbox" name="azienda" > Sei a capo di un'azienda?
                      </label>
                      <span  class="col-sm-8 pull-right">
                        <input id="field-sede" type="text" class="form-control" name="sede" placeholder="Sede" disabled>
                      </span>
                    </div>
                  </div>
                </div>

                <!-- campi sviluppatore-->
                <div class="form-group campo-svil">
                  <label class="col-sm-2 control-label">Nome</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="nome" placeholder="Nome">
                  </div>
                </div>

                <div class="form-group campo-svil">
                  <label class="col-sm-2 control-label">Cognome</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="cognome" placeholder="Cognome">
                  </div>
                </div>

                <div class="form-group campo-svil">
                  <label class="col-sm-2 control-label">Partita_Iva</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="iva" placeholder="Partita Iva">
                  </div>
                </div>

                <div class="form-group campo-svil">
                  <label class="col-sm-2 control-label">Telefono</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="telefono" placeholder="Telefono">
                  </div>
                </div>

                <!--checkbox per sviluppatore-->
                <div class="form-group">
                  <div class="col-sm-offset-2 col-sm-10">
                    <div class="checkbox">
                      <label>
                        <input id="devcheck" type="checkbox" name="sviluppatore" style="color: #00C0EF"> Sei uno sviluppatore?
                      </label>
                    </div>
                  </div>
                </div>

              </div><!-- fine box-body -->

              <div class="box-footer">
                <span class="pull-left"><small>Sei già registrato? </small><a class="azzurro" href="#" id="accedi">Accedi!</a></span>
                <button type="submit" name="registra" class="btn btn-info pull-right">REGISTRATI</button>
              </div>

            </form>
          </div><!-- fine box "regform"-->
        </div><!--fine div "container"-->
    </section>

</div><!-- fine wrapper -->


<script src="Template/plugins/jQuery/jquery-2.2.3.min.js"></script>
<script src="Template/bootstrap/js/bootstrap.min.js"></script>
<script src="Template/dist/js/app.min.js"></script>
<script src="extra/extra.js"></script>
<script src="login.js"></script>
</body>
</html>

<?php include("includes/backend_login.php");