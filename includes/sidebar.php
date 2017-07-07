<aside  class="main-sidebar" >
  <section  class="sidebar">

    <div class="user-panel">
      <div class="pull-left image">
        <img src="images/profile_images/<?php echo user_image($user,$db);?>"class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <h5><?php echo username($user,$db);?></h5>
        <small class="text-green"><?php echo "(". categoria($user,$db).")"; ?></small>
      </div>
    </div>

    /*  <!-- Ricerca utenti (Da implementare eventualmente solo per  aministratori e sviluppatori) -->
      <!--<?php /*if (strcmp(categoria($user,$db),"Cliente")!=0){
        ?>
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Cerca utenti...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <?php } */?>-->

    <ul style="margin-top:10px;" class="sidebar-menu">
      <li class="header">NAVIGAZIONE</li>
      <li><a href="/Sito_DB/index.php"><i class="fa fa-home"></i> <span>Home</span></a></li>
      <li><a href="/Sito_DB/profilo.php?id=<?php echo $user;?>"><i class="fa fa-user"></i> <span>Profilo</span></a></li>
      <?php  if(strcmp(categoria($user,$db),"Cliente")!=0){ ?>
      <li class="treeview">
        <a href="#"><i class="fa fa-cogs"></i> <span>Area Impiegati</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <?php if(strcmp(categoria($user,$db),"Amministratore")==0){ ?>
          <li><span><i class="fa fa-minus text-success"></i><a href="clienti.php"> Gestione Clienti</a></span></li>
          <li><span><i class="fa fa-minus text-danger"></i><a href="moduli.php"> Gestione Moduli</a></span></li>
          <?php } ?>
          <li><span><i class="fa fa-minus text-warning"></i><a href="layouts.php"> Gestione Layouts</a></span></li>
        </ul>
      </li>
      <?php } ?>
    </ul>

  </section>
</aside>
