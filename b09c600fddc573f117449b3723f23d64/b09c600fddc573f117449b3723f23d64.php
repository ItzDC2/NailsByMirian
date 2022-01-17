<?php

require_once("../php/config.php");

session_start();
if (!($_SESSION['Email'] == 'mirianencandelaria@gmail.com' || $_SESSION['Email'] == 'donovancf12380@gmail.com')) {
    $intruso = $_SESSION['Email'];
    $ip = $_SERVER['REMOTE_ADDR'];
    $query = "INSERT INTO Intrusos (Email, IP) VALUES ('" . $intruso . "'," . " '" . $ip . "')";
    $resultado = $bd->query($query);
    if ($resultado != false) {
        echo "Eres un poquillo espabilado, pero aquí gano yo.<br>";
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
        <div id="cuerpo" class="card-panel hoverable col s10" style="margin: 0 auto; overflow: auto; display: block;">
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
                <div id="citasDiv" style="height: 1000px;">
                    <script>
                        document.getElementById("citasDiv").innerHTML = '<object type="text/html" data="dfd61b4eaef54a0b47549ada11776024c86f6f20bad0f57f6f8e288c20568bf2.php" style="min-width: 100%; min-height: 100%;"></object>'
                    </script>
                </div>
                <div id="usuariosDiv" style="height: 1000px;  display: none;">
                    <script>
                        document.getElementById("usuariosDiv").innerHTML = '<object type="text/html" data="1f4ade47160c389903c1a9e19d2a6739681fa8955f1c7353084e638675297b5d.php" style="min-width: 100%; min-height: 100%;"></object>'
                    </script>
                </div>
                <div id="alertasDiv" style="height: 1000px; display: none;">
                    <script>
                        document.getElementById("alertasDiv").innerHTML = '<object type="text/html" data="218f1e55d3525e1e2db4249d247f0001dbc0b37ef4a4468987fdefb0c4a8422a.php" style="min-width: 100%; min-height: 100%;"></object>'
                    </script>
                </div>
            </div>
        </div>
        <ul id="nav" class="sidenav sidenav-close">
            <li>
                <div class="user-view">
                    <img src="../imgs/nail.jpg" width="200px" height="200px">
                </div>
                <p class="nombre"><?php echo $nombre ?></p>
                <p class="email"><?php echo $_SESSION['Email'] ?></p>
            </li>
            <li>
                <div class="divider"></div>
            </li>
            <li class="citas" onclick="mostrarCitas()"><i class="bi bi-calendar-date"></i> Citas</li>
            <li class="usuarios" onclick="mostrarUsuarios()"><i class="bi bi-people"></i> Usuarios</li>
            <li class="alertas" onclick="mostrarAlertas()"><i class="bi bi-exclamation-triangle"></i> Alertas de seguridad</li>
            <li class="volver" onclick="window.location.href='../index.php'"><i class="bi bi-box-arrow-in-left"></i> Volver</li>
            <li>
                <div class="divider"></div>
            </li>

        </ul>
        </div>
        <?php
        ?>
    </body>
<?php
    mysqli_close($bd);
}
?>

    </html>