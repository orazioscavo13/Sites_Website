<div class="row">
  <div class="col-md-6">
    <div class="box box-danger">

      <div class="box-header with-border">
        <h3 class="box-title">Modifica la tua immagine del profilo</h3>
      </div>

      <div class="box-body">
        <form action="<?php echo $_SERVER["REQUEST_URI"]; ?>" name="imgform" method="post" role="form" enctype="multipart/form-data">
          <div class="form-group">
            <label class="control-label">Seleziona immagine</label>
            <input id="fileToUpload" name="fileToUpload" type="file" class="file" multiple data-show-upload="false" data-show-caption="true">
          </div>
          
          <div class="box-footer">
            <button name="submit" id="sendimage" type="submit" class="btn btn-danger">Invia</button>
          </div>
          
        </form>
      </div><!--fine box-body-->
    </div><!-- fine box -->
  </div><!--fine col-md-6-->
  
  <div class="col-md-6">
    <div class="box box-success">
      <div class="box-header with-border">
        <h3 class="box-title">Modifica la tua password</h3>
      </div>
      <div class="box-body">
        <form onsubmit="return check_aggiorna_password();" action="<?php echo $_SERVER["REQUEST_URI"]; ?>" method="post" name="passwordform" role="form">
          <div class="form-group">
            <label class="control-label">Vecchia password</label>
            <input  name="pass1" type="password">
          </div>

          <div class="form-group">
            <label class="control-label">Nuova password</label>
            <input name="pass2" type="password">
          </div>

          <div class="form-group">
            <label class="control-label">Conferma password</label>
            <input name="pass3" type="password">
          </div>

          <div class="box-footer">
            <button name="pass" id="sendpass" type="submit" class="btn btn-success">Invia</button>
          </div>

        </form>
      </div><!--fine box-body-->
    </div><!--fine box-->
  </div><!--fine col-md-6-->
</div><!--fine row-->
