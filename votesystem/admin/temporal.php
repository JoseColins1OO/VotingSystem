<?php
// Include the database configuration file
include 'includes/session.php';

// Handle status messages
if (!empty($_GET['status'])) {
    switch ($_GET['status']) {
        case 'succ':
            $statusType = 'alert-success';
            $statusMsg = 'Datos importados correctamente.';
            break;
        case 'err':
            $statusType = 'alert-danger';
            $statusMsg = 'Ocurrió un error. Por favor, intenta de nuevo.';
            break;
        case 'invalid_file':
            $statusType = 'alert-danger';
            $statusMsg = 'Por favor, sube un archivo CSV válido.';
            break;
        default:
            $statusType = '';
            $statusMsg = '';
    }
}
?>
<?php include 'includes/header.php'; ?>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <?php include 'includes/navbar.php'; ?>
  <?php include 'includes/menubar.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="background-color:#F1E9D2">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1><b>Lista de Votantes</b></h1>
      <ol class="breadcrumb" style="color:black; font-size: 17px; font-family:Times">
        <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active" style="color:black; font-size: 17px; font-family:Times">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <?php if (!empty($statusMsg)) { ?>
        <div class="alert <?= $statusType ?> alert-dismissible fade show" role="alert" style="font-size: 14px; font-family: Times;">
          <?= $statusMsg ?>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      <?php } ?>
      
      <div class="row">
        <div class="col-xs-12">
          <div class="box" style="background-color: #d8d1bd; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
            <div class="box-header with-border" style="background-color: #d8d1bd">
              <h3 class="box-title" style="font-size: 18px; font-family: Times; color: #333;">Sube el archivo CSV con los votantes</h3>
            </div>

            <!-- Import Form -->
            <div class="box-body" style="background-color: #F1E9D2; padding: 20px; border-radius: 8px;">
              <form action="process_upload.php" method="post" enctype="multipart/form-data" style="display: flex; flex-direction: column; align-items: center;">
                <div class="form-group" style="margin-bottom: 15px; width: 80%;">
                  <label for="file" style="font-size: 16px; font-family: Times; color: #333;">Selecciona un archivo CSV</label>
                  <input type="file" name="file" id="file" class="form-control" style="font-size: 14px; padding: 8px; border-radius: 5px;" required/>
                </div>
                <input type="submit" class="btn btn-primary btn-sm" name="importSubmit" value="IMPORTAR" style="background-color: #4682B4; color:white; font-size: 14px; font-family: Times; padding: 8px 20px; border-radius: 5px;" />
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>   
  </div>
    
  <?php include 'includes/footer.php'; ?>
</div>
<?php include 'includes/scripts.php'; ?>
</body>
</html>
