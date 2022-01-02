<?php 

    error_reporting(0); 

    session_start();

    if($_SESSION['logueado'] != false) {
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
        <link rel="stylesheet" href="css/estilosLogin.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
        <title>Login</title>
    </head>
    <body>
        <div id="ErrorLogin" class="col s12 card-panel center-align hoverable" style="border: 1px solid red; margin: 15px 15px;">
            <p>
                ¡Ya has iniciado sesión!
            </p>
            <button type="submit" class="btn waves-effect" id="errorBtn" onclick="window.location.href='./index.php'" style="width: 25%; background-color: #e6967b !important; color: black; text-transform: uppercase;">Volver <i class="bi bi-box-arrow-in-left"></i></button>
        </div>
        <div id="divAbajo" class="col s6 card-panel hoverable" onclick="window.location.href='php/logout.php'">
            <p>
                Cerrar Sesión
            </p>
        </div>
    </body>
    </html>
    <?php
    } else {

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/estilosLogin.css">
    <link rel="icon" href="imgs/nail-circled.png" type="image/x-icon"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script src="js/scroll.js"></script>
    <title>Login</title>
</head>
<body>
    <a href="index.php" class="alogo"><img src="imgs/nail.jpg" id="logo"></a>
    <br>
    <div id="loginPanel" class="col s6 offset-s3 card-panel hoverable">
        <form id="login" action="php/login_auth.php" method="post" class="col s12" onsubmit="window.location.href='/php/login_auth.php'">
            <h2>Inicia Sesión</h2>
            <div class="row">
                <div class="input-field col s12">
                    <input id="iEmail" type="email" name="iEmail" required>
                    <label for="iEmail">Email <i class="bi bi-envelope"></i></label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <input type="password" id="iContra" name="iContra" required>
                    <label for="iContra">Contraseña <i class="bi bi-key-fill"></i></label>
                </div>
            </div>
            <div class="row">
                <button type="submit" class="btn waves-effect">INICIA SESIÓN <i class="bi bi-box-arrow-in-right"></i></button>
            </div>
            <div class="row">
                <span>¿No tienes cuenta con nosotros? <a href="register.php">Regístrate</a>.</span>
            </div>
        </form>
    </div>
</body>
</html>
<?php 
}
 ?>