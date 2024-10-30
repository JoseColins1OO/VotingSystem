
<?php
session_start();
if (isset($_SESSION['admin'])) {
    header('location:home.php');
}
?>
<?php include 'includes/header.php'; ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesión - UAEMEX</title>
    <link rel="stylesheet" href="estilo.css">
</head>
<body class="login-page">
    <div class="login-box">
        <div class="login-logo">
            <b>Sistema de Votación en Línea</b>
        </div>
        
        <div class="login-box-body">
            <p class="login-box-msg">Inicie sesión como administrador</p>
            <form action="login.php" method="POST">
                <div class="form-group">
                    <input type="text" class="form-control" name="username" placeholder="Usuario" required>
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" name="password" placeholder="Contraseña" required>
                </div>
                <button type="submit" class="btn-submit" name="login">Iniciar sesión</button>
            </form>
        </div>

        <?php
        if (isset($_SESSION['error'])) {
            echo "<div class='error-message'>".$_SESSION['error']."</div>";
            unset($_SESSION['error']);
        }
        ?>
    </div>

<?php include 'includes/scripts.php' ?>
</body>
<style>
        /* Reseteo básico y fuente */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            background-color: #F1E9D2;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        .login-box {
            width: 350px;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
            text-align: center;
            border-top: 5px solid #FDB813;
        }

        .login-logo {
            font-size: 24px;
            color: #006341;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .login-box-body {
            padding: 20px 0;
        }

        .login-box-msg {
            color: #FDB813;
            font-size: 16px;
            margin-bottom: 20px;
        }

        /* Estilo de inputs */
        .form-group {
            margin-bottom: 20px;
        }

        .form-control {
            width: 100%;
            padding: 12px;
            border-radius: 8px;
            border: 1px solid #ddd;
            font-size: 16px;
            transition: 0.3s;
        }

        .form-control:focus {
            border-color: #006341;
            outline: none;
            box-shadow: 0 0 8px rgba(0, 99, 65, 0.3);
        }

        /* Botón de envío */
        .btn-submit {
            width: 100%;
            padding: 12px;
            background-color: #006341;
            color: #FDB813;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.2s;
        }

        .btn-submit:hover {
            background-color: #004d29;
            color: #ffffff;
            transform: scale(1.05);
        }

        /* Mensaje de error */
        .error-message {
            margin-top: 20px;
            padding: 10px;
            background-color: #FFD2D2;
            color: #A80000;
            border-radius: 5px;
            font-size: 14px;
            text-align: center;
        }
    </style>
</html>


