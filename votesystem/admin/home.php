<?php include 'includes/session.php'; ?>
<?php include 'includes/slugify.php'; ?>
<?php include 'includes/header.php'; ?>

<link rel="stylesheet" href="path/to/your/custom.css"> <!-- Cambia esta ruta al archivo CSS -->

<style>
/* Estilos CSS personalizados */
body {
    font-family: 'Arial', sans-serif;
    background-color: #F5F5F5; /* Color de fondo suave */
}

h1, h3 {
    color: #7B5B3A; /* Marrón */
}

.small-box {
    border-radius: 5px;
    padding: 10px;
}

.alert {
    border-radius: 5px;
}

.box {
    border-radius: 5px;
}

.box-header {
    background-color: #D6B35C; /* Dorado */
    color: #FFFFFF; /* Color del texto en el encabezado */
}

.chart {
    position: relative;
    height: 200px;
    width: 100%;
}

.bg-green {
    background-color: #A3C2A0 !important; /* Verde UAEMEX */
}
.bg-yellow {
    background-color: #D6B35C !important; /* Dorado */
}
.bg-red {
    background-color: #C61C2A !important; /* Rojo más oscuro */
}
.bg-custom {
    background-color: #E0E0E0 !important; /* Color de fondo personalizado */
}
.small-box-footer {
    background-color: #A3C2A0; /* Verde UAEMEX */
    color: black;
}
</style>

<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <?php include 'includes/navbar.php'; ?>
  <?php include 'includes/menubar.php'; ?>

  <div class="content-wrapper" style="background-color: #F1E9D2;">
    <section class="content-header">
      <h1 class="text-center"><b>📜 Dashboard 📜</b></h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <section class="content">
      <?php
        if(isset($_SESSION['error'])){
          echo "
            <div class='alert alert-danger alert-dismissible fade show' role='alert'>
              <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
              <strong>Error!</strong> ".$_SESSION['error']."
            </div>
          ";
          unset($_SESSION['error']);
        }
        if(isset($_SESSION['success'])){
          echo "
            <div class='alert alert-success alert-dismissible fade show' role='alert'>
              <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
              <strong>OK!</strong> ".$_SESSION['success']."
            </div>
          ";
          unset($_SESSION['success']);
        }
      ?>

      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <div class="small-box bg-yellow">
            <div class="inner">
              <?php
                $sql = "SELECT * FROM positions";
                $query = $conn->query($sql);
                echo "<h3>".$query->num_rows."</h3>";
              ?>
              <p><b>No. de Posiciones</b></p>
            </div>
            <div class="icon"><i class="fa fa-cog"></i></div>
            <a href="positions.php" class="small-box-footer">Más información <i class="fa fa-arrow-right"></i></a>
          </div>
        </div>
        
        <div class="col-lg-3 col-xs-6">
          <div class="small-box bg-green">
            <div class="inner">
              <?php
                $sql = "SELECT * FROM candidates";
                $query = $conn->query($sql);
                echo "<h3>".$query->num_rows."</h3>";
              ?>
              <p><b>No. de Candidatos</b></p>
            </div>
            <div class="icon"><i class="fa fa-black-tie"></i></div>
            <a href="candidates.php" class="small-box-footer">Más información <i class="fa fa-arrow-right"></i></a>
          </div>
        </div>
        
        <div class="col-lg-3 col-xs-6">
          <div class="small-box bg-red">
            <div class="inner">
              <?php
                $sql = "SELECT * FROM voters";
                $query = $conn->query($sql);
                echo "<h3>".$query->num_rows."</h3>";
              ?>
              <p><b>Total de Votantes</b></p>
            </div>
            <div class="icon"><i class="fa fa-users"></i></div>
            <a href="voters.php" class="small-box-footer">Más información <i class="fa fa-arrow-right"></i></a>
          </div>
        </div>
        
        <div class="col-lg-3 col-xs-6">
          <div class="small-box bg-custom">
            <div class="inner">
              <?php
                $sql = "SELECT * FROM votes GROUP BY voters_id";
                $query = $conn->query($sql);
                echo "<h3>".$query->num_rows."</h3>";
              ?>
              <p><b>Votantes que Votaron</b></p>
            </div>
            <div class="icon"><i class="fa fa-edit"></i></div>
            <a href="votes.php" class="small-box-footer">Más información <i class="fa fa-arrow-right"></i></a>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-xs-12">
          <h3 class="text-center"><b>CONTEO DE VOTOS
           
          </b></h3>
        </div>
      </div>

      <?php
        $sql = "SELECT * FROM positions ORDER BY priority ASC";
        $query = $conn->query($sql);
        $inc = 2;
        while($row = $query->fetch_assoc()){
          $inc = ($inc == 2) ? 1 : $inc+1; 
          if($inc == 1) echo "<div class='row'>";
          echo "
           <div class='col-sm-6'> 
              <div class='box box-solid bg-custom'>
                <div class='box-header with-border'>
                  <h4 class='box-title'><b>".$row['description']."</b></h4>
                </div>
                <div class='box-body'>
                  <div class='chart'>
                    <canvas id='".slugify($row['description'])."' style='height:200px;'></canvas>
                  </div>
                </div>
              </div>
            </div>
          ";
          if($inc == 2) echo "</div>";  
        }
        if($inc == 1) echo "<div class='col-sm-6'></div></div>";
      ?>
      
    </section>
  </div>

  <?php include 'includes/footer.php'; ?>
</div>

<?php include 'includes/scripts.php'; ?>
<?php
  $sql = "SELECT * FROM positions ORDER BY priority ASC";
  $query = $conn->query($sql);
  while($row = $query->fetch_assoc()){
    $sql = "SELECT * FROM candidates WHERE position_id = '".$row['id']."'";
    $cquery = $conn->query($sql);
    $carray = array();
    $varray = array();
    while($crow = $cquery->fetch_assoc()){
      array_push($carray, $crow['lastname']);
      $sql = "SELECT * FROM votes WHERE candidate_id = '".$crow['id']."'";
      $vquery = $conn->query($sql);
      array_push($varray, $vquery->num_rows);
    }
    $carray = json_encode($carray);
    $varray = json_encode($varray);
    ?>
    <script>
    $(function(){
      var rowid = '<?php echo $row['id']; ?>';
      var description = '<?php echo slugify($row['description']); ?>';
      var barChartCanvas = $('#'+description).get(0).getContext('2d')
      var barChart = new Chart(barChartCanvas)
      
      var barChartData = {
        labels  : <?php echo $carray; ?>,
        
        datasets: [{
          label               : 'Votos',
          backgroundColor     : '#A3C2A0',
          borderColor         : '#7B5B3A',
          borderWidth         : 1,
          data                : <?php echo $varray; ?>
        }]
      }
      var barChartOptions = {
        responsive              : true,
        maintainAspectRatio     : false,
        datasetFill             : true,
        scales: {
          yAxes: [{
            ticks: {
              beginAtZero: true
            }
          }]
        }
      }
      barChart.Bar(barChartData, barChartOptions);
    })
    </script>
    <?php
  }
?>
</body>
</html>
