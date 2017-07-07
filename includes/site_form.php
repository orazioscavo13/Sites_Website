<div class="veil veil-l1" id="veil-1"></div>
<div id="popupform" class="box box-warning box-solid popup-1">

  <div id="formheader"  class="box-header with-border">
    <h2 class="box-title">Crea un nuovo Sito</h2>
    <div class="box-tools pull-right">
      <button id="closeform" type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
    </div>
  </div>
  <div class="box-body">

    <div class="row">
      <div class="col-md-6">
        <p>
          <span style="font-size: 20px;">
            <i class="fa fa-user"></i> Dati cliente:
          </span>
          </br>
          <b id="p1-username">username</b><span id="p1-cf">(cf)</span>
          </br>
          <span id="p1-indirizzo">indirizzo</span>
          </br>
          <span id="p1-telefono">telefono</span>
        </p>
      </div>
    </div>

    <form onsubmit="return siteform_ons();" name="siteform"  action="#" method="post">
      <div class="col-sm-8">

        <div class="form-group">
          <label class="col-sm-2 control-label">URL</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="url" placeholder="URL">
          </div>
        </div>

        <div class="form-group">
          <label class="col-sm-2 control-label">Data di Pubblicazione</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="data" placeholder="Data di Pubblicazione (yyyy-mm-dd)">
          </div>
        </div>

        <div class="form-group">
          <div class="col-sm-offset-2 col-sm-10">
            <div class="checkbox">
              <label>
                <input type="checkbox" name="pagato" > Pagato
              </label>
              <span id="costo" class="col-sm-8 pull-right">Costo totale: 0,00 €</span>
            </div>
          </div>
        </div>

      </div>

      <div class="col-sm-4">
        <label class="control-label">Seleziona il layout</label>
        <div style="max-height:150px; overflow-y:scroll;" class="form-group">
          <?php layout_options($db); ?>
        </div>
      </div>
      <input type="submit" name="creasito" class="btn btn-success pull-right" value="CREA"></input>
    </form>
  </div>
</div>
