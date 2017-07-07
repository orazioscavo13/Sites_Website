<div class="nav-tabs-custom">
  <ul class="nav nav-tabs">
    <li class="active"><a href="#persona" data-toggle="tab">Persone</a></li>
    <li ><a href="#azienda" data-toggle="tab">Aziende</a></li>
  </ul>
  <div class="tab-content no-padding">
    <div class="chart tab-pane active" id="persona">
      <table id="perstable" class="table table-bordered table-striped chart tab-pane active" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>Utente</th>
            <th>Codice Fiscale</th>
            <th>Indirizzo</th>
            <th>Telefono</th>
            <th>Siti Commissionati</th>
            <th>Costo Siti</th>
          </tr>
        </thead>
        <tbody>
          <?php fill_customer_table($db,0); ?>
        </tbody>
        <tfoot>
          <tr>
            <th>Utente</th>
            <th>Codice Fiscale</th>
            <th>Indirizzo</th>
            <th>Telefono</th>
            <th>Siti Commissionati</th>
            <th>Costo Siti</th>
          </tr>
        </tfoot>
      </table>
    </div>
    <div class="chart tab-pane" id="azienda">
      <table id="aztable" class="table table-bordered table-striped chart tab-pane" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>Utente</th>
              <th>Codice Fiscale</th>
              <th>Sede</th>
              <th>Indirizzo</th>
              <th>Telefono</th>
              <th>Siti Commissionati</th>
              <th>Costo Siti</th>
          </tr>
        </thead>
        <tbody>
          <?php fill_customer_table($db,1);  ?>
        </tbody>
        <tfoot>
          <tr>
            <th>Utente</th>
            <th>Codice Fiscale</th>
            <th>Sede</th>
            <th>Indirizzo</th>
            <th>Telefono</th>
            <th>Siti Commissionati</th>
            <th>Costo Siti</th>
          </tr>
        </tfoot>
      </table>
    </div> <!--fine blocco della tabella azienda-->
  </div><!-- fine tab content-->
</div><!--fine nav-tabs-->