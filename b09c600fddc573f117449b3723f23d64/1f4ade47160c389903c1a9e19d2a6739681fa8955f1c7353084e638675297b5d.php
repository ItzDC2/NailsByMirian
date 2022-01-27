<?php
require("../php/config.php");
session_start();
if (!($_SESSION['Email'] == 'mirianencandelaria@gmail.com' || $_SESSION['Email'] == 'donovancf12380@gmail.com')) {
    $intruso = $_SESSION['Email'];
    $ip = $_SERVER['REMOTE_ADDR'];
    $query = "INSERT INTO Intrusos (Email, IP) VALUES ('" . $intruso . "'," . " '" . $ip . "')";
    $resultado = $bd->query($query);
    if ($resultado != false) {
        header("HTTP/1.0 404 Not Found");
        // echo "Eres un poquillo espabilado, pero aquí gano yo.<br>";
        // echo "Se ha guardado tu información.";
        die();
    }
} else {
    $queryUsuarios = "SELECT * FROM Usuarios";
    $resultado = $bd->query($queryUsuarios);

?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/js/materialize.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/css/materialize.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/js/materialize.min.js"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
        <link href="https://fonts.googleapis.com/css2?family=Material+Icons" rel="stylesheet">
        <script src="./b79a49cdbeb97932475598d35501b088820c20c6.js"></script>
        <title>Document</title>
    </head>

    <body>
        <style>
            h1 {
                color: #e6967b;
            }

            p {
                text-align: center;
            }
            ul {
                list-style-type: none;
            }
        </style>
        <div class="usuariosInfo" style="margin-left: 15px; text-align: center">
            <h1 id="tituloUsuarios"><i class="bi bi-person-fill"></i> Usuarios</h1>
        </div>
        <?php
        $queryUsuariosN = "SELECT * FROM Usuarios";
        $resultado = $bd->query($queryUsuariosN);
        $lineas = $resultado->num_rows;
        if ($lineas != 0) {
            if ($lineas == 1) {
                $usuarios = "Hay un total de " . $lineas . " usuario.";
            } else {
                $usuarios = "Hay un total de " . $lineas . " usuarios.";
            }
        ?>
            <p><?php echo $usuarios ?></p>
            <ul style="list-style: none;">
                <br>
                <?php
                while ($linea = $resultado->fetch_assoc()) {
                    $nombre = $linea['Nombre'];
                    $apellidos = $linea['Apellidos'];
                    $email = $linea['Email'];
                    $telefono = $linea['Telefono'];
                    $fechaCrea = $linea['FechaCrea'];
                ?>
                    <div class="container">
                        <div class="card-panel col s6 offset-s3 hoverable">
                            <?php
                            echo "<li><i class='bi bi-person-circle'></i> " . $nombre . " " . $apellidos . "</li>";
                            echo "<li><i class='bi bi-at'></i> " . $email . "</li>";
                            echo "<li><i class='bi bi-telephone-fill'></i> " . $telefono . "</li>";
                            echo "<li><i class='bi bi-calendar-date-fill'></i> " . date('d-m-Y H:i:s', strtotime($fechaCrea)) . "</li>"
                            ?>
                        </div>
                    </div>
                    <?php
                }
                ?>
                </ul>
                <?php 
            }
            mysqli_close($bd);
        }
        ?>
    </body>

    </html>