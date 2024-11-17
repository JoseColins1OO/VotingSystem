<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>
<body class="hold-transition skin-green layout-top-nav">
<div class="wrapper">

    <?php include 'includes/navbar.php'; ?>

    <div class="content-wrapper" style="background-color: #F1E9D2">
        <div class="container" style="background-color: #F1E9D2">

        <div class="text-center">
    <!-- Botón con color verde -->
    <a href="candidatos.php" class="btn btn-success btn-lg" style="margin-top: 20px;">Ver Candidatos</a>
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

                        <!-- Alerta personalizada de error -->
                        <div class="alert alert-danger alert-dismissible" id="alert" style="display:none; text-align: center; font-size: 1.2em; font-weight: bold; background-color: #F2DEDE; color: #A94442;">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <span class="message"></span>
                        </div>

                        <?php
                        $sql = "SELECT * FROM votes WHERE voters_id = '".$voter['id']."'";
                        $vquery = $conn->query($sql);
                        if($vquery->num_rows > 0){
                            ?>
                            <div class="text-center" style="color:black; font-size: 35px; font-family: Times;">
                                <h3>Ya has votado en estas elecciones.</h3>
                                <a href="#view" data-toggle="modal" class="btn btn-curve btn-lg" style="background-color: #6A7F22; color: white; font-size: 22px; font-family: Times;">Ver Boleta</a>
                            </div>
                            <?php
                        } else {
                            ?>
                            <!-- Voting Ballot -->
                            <form method="POST" id="ballotForm" action="submit_ballot.php">
                                <?php
                                include 'includes/slugify.php';

                                $candidate = '';
                                $sql = "SELECT * FROM positions ORDER BY priority ASC";
                                $query = $conn->query($sql);
                                while($row = $query->fetch_assoc()){
                                    $sql = "SELECT * FROM candidates WHERE position_id='".$row['id']."'";
                                    $cquery = $conn->query($sql);
                                    while($crow = $cquery->fetch_assoc()){
                                        $slug = slugify($row['description']);
                                        $checked = '';
                                        if(isset($_SESSION['post'][$slug])){
                                            $value = $_SESSION['post'][$slug];

                                            if(is_array($value)){
                                                foreach($value as $val){
                                                    if($val == $crow['id']){
                                                        $checked = 'checked';
                                                    }
                                                }
                                            } else {
                                                if($value == $crow['id']){
                                                    $checked = 'checked';
                                                }
                                            }
                                        }
                                        $input = ($row['max_vote'] > 1) ? '<input type="checkbox" class="flat-red '.$slug.'" name="'.$slug."[]".'" value="'.$crow['id'].'" '.$checked.'>' : '<input type="radio" class="flat-red '.$slug.'" name="'.slugify($row['description']).'" value="'.$crow['id'].'" '.$checked.'>';
                                        $image = (!empty($crow['photo'])) ? 'images/'.$crow['photo'] : 'images/profile.jpg';
                                        $candidate .= '
                                            <li>
                                                '.$input.'<br>
                                                <button type="button" class="btn btn-info btn-sm btn-flat clist about" data-platform="'.$crow['platform'].'" data-fullname="'.$crow['firstname'].' '.$crow['lastname'].'">
                                                    <i class="fa fa-search"></i> Acerca de mí
                                                </button>
                                                <img src="'.$image.'" height="100px" width="100px" class="clist">
                                                <span class="cname clist">'.$crow['firstname'].' '.$crow['lastname'].'</span>
                                            </li>
                                        ';
                                    }

                                    $instruct = ($row['max_vote'] > 1) ? 'Puede seleccionar hasta '.$row['max_vote'].' candidatos' : 'Seleccione solo un candidato';

                                    echo '
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <div class="box box-solid" id="'.$row['id'].'">
                                                    <div class="box-header with-border">
                                                        <h3 class="box-title text-center" style="font-size: 1.8em; color: #3C763D; font-weight: bold;"><b>'.$row['description'].'</b></h3>
                                                    </div>
                                                    <div class="box-body">
                                                        <p>'.$instruct.'<br>
                                                            <span class="pull-right">
                                                                <button type="button" class="btn btn-success btn-sm btn-flat reset" data-desc="'.slugify($row['description']).'"><i class="fa fa-refresh"></i> Reset</button>
                                                            </span>
                                                        </p>
                                                        <div id="candidate_list">
                                                            <ul>
                                                                '.$candidate.'
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    ';

                                    $candidate = '';
                                }    
                                ?>
                                <div class="text-center">
                                    <button type="button" class="btn btn-primary btn-flat" id="preview"><i class="fa fa-file-text"></i> Preview</button>
                                    <button type="submit" class="btn btn-success btn-flat" name="vote"><i class="fa fa-check-square-o"></i> Submit</button>
                                </div>
                            </form>
                           
                            <?php
                        }
                        ?>

                    </div>
                </div>
            </section>
        </div>
    </div>

    <?php include 'includes/footer.php'; ?>
    <?php include 'includes/ballot_modal.php'; ?>
</div>

<?php include 'includes/scripts.php'; ?>
<script>
$(function(){
    $('.content').iCheck({
        checkboxClass: 'icheckbox_flat-green',
        radioClass: 'iradio_flat-green'
    });

    $(document).on('click', '.reset', function(e){
        e.preventDefault();
        var desc = $(this).data('desc');
        $('.'+desc).iCheck('uncheck');
    });

    $(document).on('click', '.about', function(e){
        e.preventDefault();
        $('#platform').modal('show');
        var platform = $(this).data('platform');
        var fullname = $(this).data('fullname');
        $('.candidate').html(fullname);
        $('#plat_view').html(platform);
    });

    $('#preview').click(function(e){
        e.preventDefault();
        var form = $('#ballotForm').serialize();
        if(form == ''){
            $('.message').html('Debes de votar por al menos un candidato');
            $('#alert').show();
        }
        else{
            $.ajax({
                type: 'POST',
                url: 'preview.php',
                data: form,
                dataType: 'json',
                success: function(response){
                    if(response.status == 'success'){
                        $('#view').html(response.content);
                        $('#view').modal('show');
                    }
                    else{
                        $('.message').html(response.message);
                        $('#alert').show();
                    }
                }
            });
        }
    });
});
</script>
</body>
</html>
