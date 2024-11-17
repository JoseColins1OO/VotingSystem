<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <?php include 'includes/navbar.php'; ?>
  <?php include 'includes/menubar.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="background-color:#F1E9D2 ">
    <!-- Content Header (Page header) -->
    <section class="content-header">
   
      <ol class="breadcrumb" style="color:black ; font-size: 17px; font-family:Times">
        <li><a href="#"><i class="fa fa-dashboard" ></i> Inicio</a></li>
        <li class="active" style="color:black ; font-size: 17px; font-family:Times" >Importar Usuarios</li>
      </ol>
      <h1 class="text-center"><b>📁 Subir Archivo CSV 📁</b></h1>
    </section>
    <!-- Main content -->
    <section class="content">
      <?php
        if(isset($_SESSION['error'])){
          echo "
            <div class='alert alert-danger alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-warning'></i> Error!</h4>
              ".$_SESSION['error']."
            </div>
          ";
          unset($_SESSION['error']);
        }
        if(isset($_SESSION['success'])){
          echo "
            <div class='alert alert-success alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-check'></i> OK!</h4>
              ".$_SESSION['success']."
            </div>
          ";
          unset($_SESSION['success']);
        }
      ?>
    <!-- Import CSV --> 
    <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="box box-solid bg-custom">
                    <div class="box-header with-border">
                        <h4 class="box-title"><b>Subir Archivo CSV</b></h4>
                    </div>
                    <div class="box-body">
                        <form action="process_upload.php" method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="csvFile">Selecciona un archivo CSV:</label>
                                <input type="file" class="form-control" name="csvFile" id="csvFile" accept=".csv" required>
                            </div>
                            <div class="form-group text-center">
                                <button type="submit" class="btn btn-success">
                                    <i class="fa fa-upload"></i> Subir Archivo
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
     
    </section> 
    
        
  </div>
    
  <?php include 'includes/footer.php'; ?>
  <?php include 'includes/voters_modal.php'; ?>
</div>
<?php include 'includes/scripts.php'; ?>

</body>
</html>
