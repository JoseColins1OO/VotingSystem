<?php
session_start();
if(isset($_SESSION['admin'])){
    header('location: admin/home.php');
}

if(isset($_SESSION['voter'])){
    header('location: home.php');
}
?>
<?php include 'includes/header.php'; ?>
<body class="hold-transition login-page" style="background-color: #F1E9D2;"> 
<div class="login-box" style="background-color: #A69F8B; color: white; font-size: 22px; font-family: 'Times New Roman', Times, serif;">
    <div class="login-logo" style="background-color: #A69F8B; color: white; font-size: 24px; font-family: 'Times New Roman', Times, serif;">
        <b>Online Voting System</b>
    </div>

    <div class="login-box-body" style="background-color: #A69F8B; color: white; font-size: 22px; font-family: 'Times New Roman', Times, serif;">
        <p class="login-box-msg" style="color: #2E4D3A; font-size: 16px; font-family: 'Times New Roman', Times, serif;">Sign in to start your voting session</p>

        <form action="login.php" method="POST">
            <div class="form-group has-feedback">
                <input type="text" class="form-control" name="voter" placeholder="Voter's ID" required>
                <span class="glyphicon glyphicon-user form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input type="password" class="form-control" name="password" placeholder="Password" required>
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <button type="submit" class="btn btn-primary btn-block" style="background-color: #006341; color: white; font-size: 16px; font-family: 'Times New Roman', Times, serif;" name="login"><i class="fa fa-sign-in"></i> Sign In</button>
                </div>
            </div>
        </form>
    </div>

    <?php
    if(isset($_SESSION['error'])){
        echo "
            <div class='callout callout-danger text-center mt20' style='background-color: #D9534F; color: white;'>
                <p>".$_SESSION['error']."</p> 
            </div>
        ";
        unset($_SESSION['error']);
    }
    ?>
</div>

<?php include 'includes/scripts.php'; ?>
</body>
</html>
