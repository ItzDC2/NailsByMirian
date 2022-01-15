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
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/js/materialize.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/css/materialize.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/js/materialize.min.js"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
        <link href="https://fonts.googleapis.com/css2?family=Material+Icons" rel="stylesheet">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="../imgs/nail-circled.png" type="image/x-icon" />
        <title>Document</title>
    </head>

    <body>
        <style>
            #tituloCitas {
                color: #e6967b;
                font-size: 1.5em;
            }
        </style>
        <div class="citasInfo" style="margin-left: 15px;">
            <h1 id="tituloCitas"><i class="bi bi-calendar"></i> Citas</h1>
        <?php
            $queryCitas = "SELECT * FROM Citas";
            $resultado = $bd->query($queryCitas);
                if ($lineasResultadoCitas = $resultado->num_rows != 0) {
                    if ($lineasResultadoCitas == 1) {
                        $citas = "Hay un total de " . $lineasResultadoCitas . " cita.";
                } else {
                    $citas = "Hay un total de " . $lineasResultadoCitas . " citas.";
                }
                ?>
                <p><?php echo $citas ?></p>
                <ul>
    
                <?php
                while ($linea = mysqli_fetch_assoc($resultado)) {
                    echo "<li>" . $linea['Email'] . "</li>";
                    echo "<li><li>" . $linea['FechaCita'] . "</li></li>";
                    echo "<li><li>" . $linea['HoraCita'] . "</li></li>";
                }?>
                </ul>
        </div>
            <?php
        }
    }
    ?>
    </body>

    </html>