<header class="main-header">
  <a href="index.php" class="logo">
    <span class="logo-mini"><b>S</b>W</span>
    <span class="logo-lg"><b>Siti</b>WEB</span>
  </a>
  
  <nav  class="navbar navbar-static-top" role="navigation">
    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
      <span class="sr-only">Toggle navigation</span>
    </a>
    
    <div class="navbar-custom-menu">
      <ul class="nav navbar-nav">
        <li class="dropdown user user-menu">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <img src="images/profile_images/<?php echo user_image($user,$db);?>" class="user-image" alt="User Image">
            <span class="hidden-xs"><?php echo username($user,$db); ?></span>
          </a>
          <ul class="dropdown-menu">
            <li class="user-header">
              <p>
                <?php echo username($user,$db)." - ".categoria($user,$db); ?>
                <small>Iscritto dal <?php echo data_registrazione($user,$db);?></small>
              </p>
              <img src="images/profile_images/<?php echo user_image($user,$db);?>" class="img-circle" alt="User Image">
            </li>
            
            <li style="background-color: #D2D2D2;"class="user-footer">
              <div class="pull-left">
                <a href="profilo.php?id=<?php echo $user;?>" class="btn btn-success btn-flat">Profilo</a>
              </div>

              <div class="pull-right">
                <a href="login.php" class="btn btn-danger btn-flat">Log out</a>
              </div>
            </li><!--fine footer-->
            
          </ul>
        </li>
      </ul>
    </div><!--fine navbar-->
  </nav>
</header>