<aside class="main-sidebar" style="background-color: #006341;">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar" style="background-color: #006341;">
    <!-- Sidebar user panel -->
    <div class="user-panel" style="height: 60px">
      <div class="pull-left image">
        <img src="<?php echo (!empty($user['photo'])) ? '../images/'.$user['photo'] : '../images/profile.jpg'; ?>" class="img-square" alt="User Image">
      </div>
      <div class="pull-left info">
        <p style="color: white; font-size: 15px; font-family: Times;"><?php echo $user['firstname'].' '.$user['lastname']; ?></p>
        <a><i class="fa fa-circle text-success"></i> <b style="color: white; font-size: 15px; font-family: Times;"> En linea </b></a>
      </div>
    </div>
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu" data-widget="tree" style="background-color: #005a31; color: white; font-size: 15px; font-family: Times;">
      <li class="header" style="background-color: #00381f; color: white; font-size: 12px; font-family: Times;">RESUMEN DE VOTOS</li>
      <li><a href="home.php" style="color: white;"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
      <li><a href="votes.php" style="color: white;"><span class="glyphicon glyphicon-lock"></span> <span>VOTOS</span></a></li>
      <li class="header" style="background-color: #00381f; color: white; font-size: 12px; font-family: Times;">CONTROL</li>
      <li><a href="voters.php" style="color: white;"><i class="fa fa-users"></i> <span>VOTANTES</span></a></li>
      <li><a href="positions.php" style="color: white;"><i class="fa fa-tasks"></i> <span>PUESTO ELECTORAL</span></a></li>
      <li><a href="candidates.php" style="color: white;"><i class="fa fa-black-tie"></i> <span>CANDIDATO</span></a></li>
      <li class="header" style="background-color: #00381f; color: white; font-size: 12px; font-family: Times;">CONFIGURACION</li>
      <li><a href="ballot.php" style="color: white;"><i class="fa fa-file-text"></i> <span>BOLETA ELECTORAL</span></a></li>
      <li><a href="#config" data-toggle="modal" style="color: white;"><i class="fa fa-cogs"></i> <span>NOMBRE ELECCIONES</span></a></li>
    </ul>
  </section>
  <!-- /.sidebar -->
</aside>
<?php include 'config_modal.php'; ?>
