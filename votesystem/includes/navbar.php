<header class="main-header" style="background-color:#006341;">
  <nav class="navbar navbar-static-top" style="background-color:#006341;">
    <div class="container" style="background-color:#006341;">
      <div class="navbar-header" style="background-color:#006341;">
        <a href="#" class="navbar-brand" style="background-color:#006341; color:white; font-size: 22px; font-family:Times;"><b>Sistema<b> Votacion</b> UAEMEX</a>
        <button type="button" class="navbar-toggle collapsed" style="background-color:#006341;" data-toggle="collapse" data-target="#navbar-collapse">
          <i class="fa fa-bars" style="color:white;"></i>
        </button>
      </div>

      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
        <ul class="nav navbar-nav">
          <?php
            if(isset($_SESSION['student'])){
              echo "
                <li><a href='index.php' style='color:white;'>HOME</a></li>
                <li><a href='transaction.php' style='color:white;'>TRANSACTION</a></li>
              ";
            } 
          ?>
        </ul>
      </div>
      <!-- /.navbar-collapse -->
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <li class="user user-menu">
            <a href="">
              <img src="<?php echo (!empty($voter['photo'])) ? 'images/'.$voter['photo'] : 'images/profile.jpg' ?>" class="user-image" alt="User Image">
              <span class="hidden-xs" style="color:white; font-size: 22px; font-family:Times;"><?php echo $voter['firstname'].' '.$voter['lastname']; ?></span>
            </a>
          </li>
          <li><a href="logout.php"><b style="color:white; font-size: 22px;"><i class="fa fa-sign-out"></i></b> <b style="color:white; font-size: 22px; font-family:Times;"> Cerrar Sesión </b></a></li>  
        </ul>
      </div>
      <!-- /.navbar-custom-menu -->
    </div>
    <!-- /.container-fluid -->
  </nav>
</header>
