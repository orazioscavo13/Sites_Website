<div class="row">
	<div class="col-md-12">
		<div class="box box-primary">
      <div class="box-header">
        <h3 class="box-title">Siti commissionati</h3>
      </div>
        
      <div class="box-body">

        <table id="sitetable" class="table table-bordered table-striped" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>URL</th>
              <th>Data pubblicazione</th>
              <th>Stato</th>
            </tr>
          </thead>
          <tbody>
            <?php	fill_sites_table($id,$db,$user); ?>
          </tbody>
          <tfoot>
            <tr>
              <th>URL</th>
              <th>Data pubblicazione</th>
              <th>Stato</th>
            </tr>
          </tfoot>
        </table>

      </div><!-- fine box-body -->
    </div><!-- fine box -->
	</div>
</div><!--fine row-->

