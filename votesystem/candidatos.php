<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>
<body class="hold-transition skin-green layout-top-nav">
<div class="wrapper">

    <?php include 'includes/navbar.php'; ?>

    <div class="content-wrapper" style="background-color: #F1E9D2">
        <div class="container" style="background-color: #F1E9D2">
        <div class="text-center">
    <!-- Botón con color verde -->
    <a href="home.php" class="btn btn-success btn-lg" style="margin-top: 20px;">Ver Candidatos</a>
</div>

            <!-- Main content -->
            <section class="content">
                <?php
                    $parse = parse_ini_file('admin/config.ini', FALSE, INI_SCANNER_RAW);
                    $title = $parse['election_title'];
                ?>
                <!-- Centrado del título -->
                <h1 class="page-header text-center title" style="font-size: 2.5em; color: #3C763D; font-family: 'Arial', sans-serif; font-weight: bold;">
                    <b><?php echo strtoupper($title); ?></b>
                </h1>

                <div class="row">
                    <div class="col-sm-10 col-sm-offset-1">
                        <?php
                        // Mostrar errores o éxitos si los hay
                        if(isset($_SESSION['error'])){
                            ?>
                            <div class="alert alert-danger alert-dismissible" style="text-align: center; background-color: #F8D7DA; color: #721C24; font-size: 1.2em;">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <ul>
                                    <?php
                                    foreach($_SESSION['error'] as $error){
                                        echo "<li>".$error."</li>";
                                    }
                                    ?>
                                </ul>
                            </div>
                            <?php
                            unset($_SESSION['error']);
                        }
                        if(isset($_SESSION['success'])){
                            ?>
                            <div class="alert alert-success alert-dismissible" style="text-align: center; font-size: 1.5em; font-weight: bold; background-color: #DFF0D8; color: #3C763D;">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <i class="icon fa fa-check"></i>
                                <?php echo $_SESSION['success']; ?>
                            </div>
                            <?php
                            unset($_SESSION['success']);
                        }
                        ?>

                        <?php
                        // Obtener los puestos
                        $sql = "SELECT * FROM positions ORDER BY priority ASC";
                        $query = $conn->query($sql);
                        while($row = $query->fetch_assoc()){
                            // Obtener candidatos para cada puesto
                            $sql = "SELECT * FROM candidates WHERE position_id='".$row['id']."'";
                            $cquery = $conn->query($sql);
                            
                            if ($cquery->num_rows > 0) { // Si hay candidatos para este puesto
                                ?>
                                
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="box box-solid">
                                            <div class="box-header with-border">
                                                <h3 class="box-title text-center" style="font-size: 2em; color: #3C763D; font-weight: bold;"><?php echo $row['description']; ?></h3>
                                            </div>
                                            
                                            <div class="box-body">
                                                <div class="row">
                                                    <?php
                                                    while($crow = $cquery->fetch_assoc()){
                                                        $image = (!empty($crow['photo'])) ? 'images/'.$crow['photo'] : 'images/profile.jpg';
                                                        ?>
                                                        <div class="col-md-4" style="margin-bottom: 20px;">
                                                            <!-- Tarjeta de candidato -->
                                                            <div class="box box-widget" style="border: 2px solid #3C763D; border-radius: 10px; box-shadow: 0 4px 8px rgba(0,0,0,0.1);">
                                                                <div class="box-body text-center" style="padding: 20px; background-color: #FFFFFF; border-radius: 10px;">
                                                                    <!-- Foto del candidato -->
                                                                    <img src="<?php echo $image; ?>" height="150px" width="150px" class="img-circle" style="border: 3px solid #3C763D;">
                                                                    <h4 class="candidate-name" style="font-size: 1.4em; margin-top: 10px; color: #3C763D; font-weight: bold;"><?php echo $crow['firstname'].' '.$crow['lastname']; ?></h4>
                                                                    <p><strong style="color: #3C763D;">Propuestas:</strong></p>
                                                                    <p style="font-size: 1.2em; color: #555555; text-align: justify;"><?php echo $crow['platform']; ?></p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <?php
                                                    }
                                                    ?>
                                                </div> <!-- End row for candidates -->
                                            </div> <!-- End box-body -->
                                        </div> <!-- End box -->
                                    </div>
                                </div> <!-- End row for this position -->
                                <?php
                            }
                        }
                        ?>
                    </div>
                </div>
            </section>
        </div>
    </div>

    <?php include 'includes/footer.php'; ?>
</div>

<?php include 'includes/scripts.php'; ?>
</body>
</html>
