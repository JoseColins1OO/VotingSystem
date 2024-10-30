<?php
session_start();
if (isset($_SESSION['admin'])) {
    header('location: admin/home.php');
}
if (isset($_SESSION['voter'])) {
    header('location: home.php');
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesión - Sistema de Votación en Línea</title>
    <style>
        /* Reseteo básico y fuente */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Times New Roman', Times, serif;
            background-color: #F1E9D2;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        .login-box {
            width: 350px;
            padding: 20px;
            background-color: #A69F8B;
            color: white;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
            text-align: center;
            border-top: 5px solid #006341;
        }

        .login-logo {
            font-size: 24px;
            font-weight: bold;
            color: white;
            margin-bottom: 20px;
        }

        .login-box-body {
            padding: 20px 0;
            font-size: 22px;
            color: white;
        }

        .login-box-msg {
            color: #2E4D3A;
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
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.2s;
        }

        .btn-submit:hover {
            background-color: #004d29;
            transform: scale(1.05);
        }

        /* Mensaje de error */
        .error-message {
            margin-top: 20px;
            padding: 10px;
            background-color: #D9534F;
            color: white;
            border-radius: 5px;
            font-size: 14px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="login-box">
        <div class="login-logo">
            <b>Sistema de Votación en Línea</b>
        </div>
        
        <div class="login-box-body">
            <p class="login-box-msg">Inicie sesión como administrador</p>
            <form action="login.php" method="POST">
                <div class="form-group">
                    <input type="text" class="form-control" name="voter" placeholder="No de cuenta" required>
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" name="password" placeholder="Contraseña" required>
                </div>
                <button type="submit" class="btn-submit" name="login"><i class="fa fa-sign-in"></i> Iniciar sesión</button>
            </form>
        </div>

        <?php
        if (isset($_SESSION['error'])) {
            echo "<div class='error-message'>".$_SESSION['error']."</div>";
            unset($_SESSION['error']);
        }
        ?>
    </div>
</body>
</html>
