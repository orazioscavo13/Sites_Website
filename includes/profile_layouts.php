<div class="row">
	<div class="col-md-12">
		<div class="box box-primary">
      <div class="box-header">
        <h3 class="box-title">Layout sviluppati</h3>
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
            <?php	fill_developer_layout_table($db,id_sviluppatore($id,$db)); ?>
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
