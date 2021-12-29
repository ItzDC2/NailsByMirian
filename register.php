<?php

require_once("php/config.php");

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/estilosRegister.css">
    <link rel="icon" href="imgs/nail-circled.png" type="image/x-icon" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script src="js/scroll.js"></script>
    <script src="js/redireccion.js"></script>
    <title>Regístrate</title>
</head>

<body onload="scroll()">
    <a href="index.php" class="alogo"><img src="imgs/nail.jpg" id="logo"></a>
    <br>
    <div id="loginPanel" class="col s6 offset-s3 card-panel hoverable">
        <form id="login" method="post" class="col s12" action="php/register_auth.php">
            <h2>Crea tu cuenta</h2>
            <div class="row">
                <div class="input-field col s6">
                    <input id="iNombre" type="text" name="iNombre">
                    <label for="iNombre">Nombre <i class="bi bi-person-circle"></i></label>
                </div>
                <div class="input-field col s6">
                    <input id="iApellidos" type="text" name="iApellidos">
                    <label for="iApellidos">Apellidos <i class="bi bi-person-circle"></i></label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <input id="iEmail" type="email" name="iEmail">
                    <label for="iEmail">Email <i class="bi bi-envelope"></i></label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <input type="password" id="iContra" name="iContra">
                    <label for="iContra">Contraseña <i class="bi bi-key-fill"></i></label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <input type="password" id="iContra2" name="iContra2">
                    <label for="iContra2">Repita su contraseña <i class="bi bi-key-fill"></i></label>
                </div>
            </div>
            <div class="row">
                <button type="submit" class="btn waves-effect" name="regButton">REGÍSTRATE <i class="bi bi-box-arrow-in-right"></i></button>
            </div>
            <div class="row">
                <span>¿Ya tienes una cuenta con nosotros? <a href="login.php">Inicia sesión</a>.</span>
            </div>
        </form>
    </div>
</body>

</html>