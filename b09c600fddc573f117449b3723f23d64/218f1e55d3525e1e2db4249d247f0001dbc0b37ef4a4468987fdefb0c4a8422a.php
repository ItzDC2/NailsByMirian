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
        die();
    }
} else {
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
        <title>Document</title>
    </head>
    <body>
        <style>
            #tituloAlertas {
                color: #e6967b;
                font-size: 2em;
            }
            p {
                font-size: 1.2em;
                text-align: center;
            }
        </style>
        <div class="alertasInfo" style="margin-left: 15px; text-align: center;">
            <h1 id="tituloAlertas"><i class="bi bi-exclamation-triangle-fill"></i> Alertas de Seguridad <i class="bi bi-exclamation-triangle-fill"></i></h1>
        </div>
        <?php 
            $queryIntrusos = "SELECT * FROM Intrusos";
            $resultado = $bd->query($queryIntrusos);
            $lineasResultado = $resultado->num_rows;
            if($lineasResultado == 0) {
                $alertaSeguridadN = "¡No hay ninguna alerta de seguridad!";
            } else {
        ?>
        <div class="cuerpo">
        <p>
            <?php 
                if($lineasResultado == 0) {
                    echo $alertaSeguridadN;
                } else {
                    while($linea = $resultado->fetch_assoc()) {
                    $email = $linea['Email'];
                    $ip = $linea['IP'];
                    ?>
                    <div class="container">
                        <div class="card-panel hoverable col s6 offset-s3 center-align">
                        <?php 
                        echo "<i class='bi bi-exclamation-triangle-fill'></i> " . "¡Alertas encontradas!" . " <i class='bi bi-exclamation-triangle-fill'></i>";
                        ?>
                        <ul type="none" style="text-align: center;">
                            <?php 
                                echo "<li>Email: " . $email . "</li>";
                                echo "<li>IP: " . $ip . "</li>"
                            ?>  
                        </ul>
                        </div>
                    </div>
                    <?php 
                    }
                }

            }
            ?>
        </p>
        </div>
    </body>

    </html>
<?php
    mysqli_close($bd);
}
?>