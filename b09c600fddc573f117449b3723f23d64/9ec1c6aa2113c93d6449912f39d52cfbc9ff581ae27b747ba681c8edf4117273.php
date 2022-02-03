<?php
session_start();
require_once("../php/config.php");
if (!($_SESSION['Email'] == 'mirianencandelaria@gmail.com' || $_SESSION['Email'] == 'donovancf12380@gmail.com')) {
    $intruso = $_SESSION['Email'];
    $ip = $_SERVER['REMOTE_ADDR'];
    $query = "INSERT INTO Intrusos (Email, IP) VALUES ('" . $intruso . "'," . " '" . $ip . "')";
    $resultado = $bd->query($query);
    if ($resultado != false) {
        header("HTTP/1.0 404 Not found");
        die();
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
        <title>Document</title>
    </head>

    <body>
        <style>
            #tituloLogs {
                color: #e6967b;
                font-size: 2em;
            }

            p {
                font-size: 1.2em;
                text-align: center;
            }
        </style>
        <div class="logsInfo" style="margin-left: 15px; text-align: center">
            <h1 id="tituloLogs"><i class="bi bi-journal-bookmark-fill"></i> Registros de las Citas</h1>

            </h1>
            <?php
            $queryLogs = "SELECT * FROM CitasLog";
            $resultado = $bd->query($queryLogs);
            $lineas = $resultado->num_rows;
            if ($lineas == 0) {
                $logsN = "No hay registros de citas nuevos.";
            } else if ($lineas == 1) {
                $logsN = "Hay un registro de cita nuevo.";
            } else if ($lineas > 1) {
                $logsN = "Hay un total de $lineas nuevos registros de citas";
            }
            echo "<p>" . $logsN . "</p>";
            if ($resultado) {
                while ($linea = $resultado->fetch_assoc()) {
                    $email = $linea['Email'];
                    $fechaCita = date('d-m-Y', strtotime($linea['FechaCita']));
                    $horaCita = $linea['HoraCita'];
                    $concepto = $linea['Descripcion'];
            ?>
                    <div class="container">
                        <div class="card-panel col s6 offset-s3 hoverable center-align">
                            <ul type="none" style="text-align: center">
                                <?php
                                echo "<li <i class='bi bi-person-check'></i> $email</li>";
                                echo "<li <i class='bi bi-calendar-date'></i> $fechaCita</li>";
                                echo "<li <i class='bi bi-clock-history'></i> $horaCita</li>";
                                echo "<li <i class='bi bi-card-text'></i> $concepto</li>";
                                ?>
                            </ul>
                        </div>
                    </div>
                    <?php
                    ?>
            <?php
                }
            }
            ?>
        </div>
    <?php
} // Cierre else. 
    ?>
    </body>

    </html>