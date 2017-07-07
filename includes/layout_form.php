<div class="veil veil-l1" id="veil-1"></div>
<div id="popupform" class="box box-warning box-solid popup-1">
  <div id="formheader"  class="box-header with-border">
    <h2 class="box-title">Crea un nuovo Layout</h2>
    <div class="box-tools pull-right">
      <button id="closeform" type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
    </div>
  </div>
  <div class="box-body">
    <form onsubmit="return layform_ons();" name="layform"  action="<?php echo $_SERVER["REQUEST_URI"]; ?>" method="post">
      <h2>Seleziona i moduli da includere nel Layout:</h2>
      <div style="max-height:180px; overflow-y:scroll;" class="form-group">
          <?php fill_layout_form($db); ?>
      </div>
      <input type="submit" name="crea" class="btn btn-success pull-right" value="CREA"></input>
    </form>
  </div>
</div>
