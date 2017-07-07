<div class="row">
  <div id="profilebox" class="col-md-4">

    <div class="box box-primary">
      <div class="box-body box-profile">
        <img class="profile-user-img img-responsive img-circle" src="images/profile_images/<?php echo user_image($id,$db);?>" alt="User profile picture">

        <h3 class="profile-username text-center"><?php echo username($id,$db);?></h3>

        <p id="cat" class="text-muted text-center">
          <?php
          $categoria=categoria($id,$db);
          if(strcmp($categoria,"Cliente")==0){
            $query = "SELECT azienda from Cliente where id_utente = '".$id."';";
            $tipo = mysqli_fetch_assoc(mysqli_query($db,$query))['azienda'];
            if($tipo) echo $categoria." (Azienda)";
            else echo $categoria;
          }else echo $categoria;
          ?>
        </p>

        <ul class="list-group list-group-unbordered">
          <li class="list-group-item">
            <b>Data iscrizione</b> <p class="pull-right"><?php echo data_registrazione($id,$db); ?></p>
          </li>
          <?php
          if(strcmp($categoria,"Sviluppatore")==0){
            $query = "select * from Sviluppatore where id_utente = '".$id."';";
            $result = mysqli_fetch_assoc(mysqli_query($db,$query));
            ?>
            <li class="list-group-item">
              <b>Layout Sviluppati</b> <p class="pull-right"><?php echo n_layout_sviluppati($id,$db); ?></p>
            </li>
            <?php
          }else if (strcmp($categoria,"Cliente")==0){
            $query = "select * from Cliente where id_utente = '".$id."';";
            $result = mysqli_fetch_assoc(mysqli_query($db,$query));
            if($result["azienda"]){
              ?>
              <li class="list-group-item">
                <b>Sede</b> <p class="pull-right"><?php echo $result['sede']; ?></p>
              </li>
              <?php
            } ?>
            <li class="list-group-item">
              <b>Siti commissionati</b> <p class="pull-right"><?php echo siti_commissionati($id,$db); ?></p>
            </li>
            <li class="list-group-item">
              <b>Costo totale dei Siti commissionati</b> <p class="pull-right"><?php echo costo_siti_commissionati($id,$db); ?> €</p>
            </li>
            <?php
          }
          ?>
        </ul>

      </div><!-- fine box-body -->
    </div><!-- fine box -->
  </div>

  <div id="infoblock"class="col-md-8">
    <div class="box box-warning">
      <div class="box-header with-border">
        <h3 class="box-title">Informazioni</h3>
      </div>

      <div class="box-body">
      <?php
      if(strcmp($categoria,"Cliente")==0){
      ?>
        <strong><i class="fa fa-credit-card-alt margin-r-5"></i>Codice Fiscale</strong>
        <p class="text-muted">
        <?php
          echo $result['cf'];
        ?>
        </p>

        <hr>

        <strong><i class="fa fa-map-marker margin-r-5"></i>Indirizzo</strong>
        <p class="text-muted">
        <?php
          echo $result['indirizzo'].", ".$result['citta'];
        ?>
        </p>

        <hr>

        <strong><i class="fa fa-phone margin-r-5"></i>Telefono</strong>
        <p class="text-muted">
          <?php
            echo $result['telefono'];
          ?>
        </p>
        <?php
      }else if (strcmp($categoria,"Sviluppatore")==0){
        ?>
        <strong><i class="fa fa-user margin-r-5"></i>Nome</strong>
        <p class="text-muted">
          <?php
            echo $result['nome']." ".$result['cognome'];
          ?>
        </p>

        <hr>

        <strong><i class="fa fa-credit-card-alt margin-r-5"></i>Partita Iva</strong>
        <p class="text-muted">
          <?php
            echo $result['p_iva'];
          ?>
        </p>

        <hr>

        <strong><i class="fa fa-phone margin-r-5"></i>Telefono</strong>
        <p class="text-muted">
          <?php
            echo $result['telefono'];
          ?>
        </p>
        <?php
      }
      ?>

      </div><!-- fine box-body -->
    </div><!-- fine box -->
  </div>

</div><!--fine row-->
