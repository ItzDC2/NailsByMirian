<?php

require_once("../php/config.php");

session_start();
if (!($_SESSION['Email'] == 'mirianencandelaria@gmail.com' || $_SESSION['Email'] == 'donovancf12380@gmail.com')) {
    $intruso = $_SESSION['Email'];
    $ip = $_SERVER['REMOTE_ADDR'];
    $query = "INSERT INTO Intrusos (Email, IP) VALUES ('" . $intruso . "'," . " '" . $ip . "')";
    $resultado = $bd->query($query);
    if ($resultado != false) {
        echo "Eres un poquillo espabilado, pero aquí gano yo.";
        echo "Se ha guardado tu información.";
    }
} else {
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="../imgs/nail-circled.png" type="image/x-icon" />
        <link rel="stylesheet" href="./86f65e28a754e1a71b2df9403615a6c436c32c42a75a10d02813961b86f1e428.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/js/materialize.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/css/materialize.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/js/materialize.min.js"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
        <link href="https://fonts.googleapis.com/css2?family=Material+Icons" rel="stylesheet">
        <script src="./b79a49cdbeb97932475598d35501b088820c20c6.js"></script>
        <title>Panel de administración de Nails By Mirián</title>
    </head>

    <body>
        <?php
        if ($_SESSION['Email'] == 'mirianencandelaria@gmail.com') {
            $nombre = "Mirián";
            $frase = "¡Bienvenida de nuevo Mirián!";
        } else if ($_SESSION['Email'] == 'donovancf12380@gmail.com') {
            $nombre = "Dónovan";
            $frase = "¡Bienvenido de nuevo Dónovan!";
        }
        ?>
        <div id="cuerpo" class="card-panel hoverable col s10" style="margin: 0 auto;">
            <a href="" class="sidenav-trigger" data-target="nav"><i class="material-icons" id="menuIcon">menu</i></a>
            <div class="row center-align">
                <div class="title col s6 offset-s3">
                    <h1>Panel de Administración</h1>
                    <div class="col s6 offset-s3 center-align" id="bienvenida" style="font-size: 1.2em; color: black;">
                        <?php echo $frase ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div id="citasDiv" style="height: 850px;">
                    <script> 
                        document.getElementById("citasDiv").innerHTML = '<object type="text/html" data="citasAdm.php" style="min-width: 100%; min-height: 100%;"></object>'
                    </script>
                </div>
            </div>
            <div id="usuariosDiv" class="col s3">
            </div>
            <div id="alertasDiv">
            </div>
            <ul id="nav" class="sidenav">
                <li>
                    <div class="user-view">
                        <img src="../imgs/nail.jpg" width="200px" height="200px">
                    </div>
                    <p class="nombre"><?php echo $nombre ?></p>
                    <p class="email"><?php echo $_SESSION['Email'] ?></p>
                </li>
                <li class="citas"><i class="bi bi-calendar-date"></i> Citas</li>
                <li class="usuarios"><i class="bi bi-people"></i> Usuarios</li>
                <li class="alertas"><i class="bi bi-exclamation-triangle"></i> Alertas de seguridad</li>
                <li class="volver" onclick="window.location.href='../index.php'"><i class="bi bi-box-arrow-in-left"></i> Volver</li>
            </ul>
        </div>
        <?php
        ?>
    </body>
<?php
}
?>

    </html>