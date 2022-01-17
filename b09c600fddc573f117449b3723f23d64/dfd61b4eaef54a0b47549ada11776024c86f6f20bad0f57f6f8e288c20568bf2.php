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
                font-size: 2em;
            }
            .waves-effect {
                background-color: #e6967b !important;
                color: white !important;
            }
            .waves-effect:hover {
                background-color: white !important;
                color: #e6967b !important;
            }
            .waves-effect:focus {
                background-color: white !important;
                color: #e6967b !important;
            }
        </style>
        <div class="citasInfo" style="margin-left: 15px; text-align: center;">
            <h1 id="tituloCitas"><i class="bi bi-calendar"></i> Citas</h1>
        <?php
            $queryCitas = "SELECT * FROM Citas";
            $resultado = $bd->query($queryCitas);
            $lineasResultadoCitas = $resultado->num_rows;
                if ($lineasResultadoCitas != 0) {
                    if ($lineasResultadoCitas == 1) {
                        $citas = "Hay un total de " . $lineasResultadoCitas . " cita.";
                    } else {
                        $citas = "Hay un total de " . $lineasResultadoCitas . " citas.";
                }
                ?>
                <p><?php echo $citas ?></p>
                <ul type="none">
                <br>
                <?php
                while ($linea = mysqli_fetch_assoc($resultado)) {
                    $nombreQuery = "SELECT Nombre FROM Usuarios WHERE Email = " . "'" . $linea['Email'] . "'";
                    $apellidosQuery = "SELECT Apellidos FROM Usuarios Where Email = " . "'" . $linea['Email'] . "'";
                    $telefonoQuery = "SELECT Telefono FROM Usuarios WHERE Email = " . "'" . $linea['Email'] . "'";
                    $fecha = date('d-m-Y', strtotime($linea['FechaCita']));
                    $hora = date('H:i:s', strtotime($linea['HoraCita']));
                    $email = $linea['Email'];
                    $resultadoN = $bd->query($nombreQuery);
                    if($lineas = $resultado->num_rows != 0) {
                        while($linea = $resultadoN->fetch_assoc()) {
                            $nombre = $linea['Nombre'];
                        }
                        $resultadoA = $bd->query($apellidosQuery);
                        $lineasA = $resultadoA->num_rows;
                        if($lineasA != 0) {
                            while($lineaA = $resultadoA->fetch_assoc()) {
                                $apellidos = $lineaA['Apellidos'];
                            } 
                        }
                        $resultadoT = $bd->query($telefonoQuery);
                        $lineasT = $resultadoT->num_rows;
                        if($lineasT != 0) {
                            while($lineaT = $resultadoT->fetch_assoc()) {
                                $telefono = $lineaT['Telefono'];
                            }
                        }
                    }
                    ?>
                    <div class="container">
                        <div class="card-panel col s6 offset-s3 hoverable">
                            <?php 
                            echo "<li><i class='bi bi-person-circle'></i> " . $nombre . " " . $apellidos . "</li>";
                            echo "<li><i class='bi bi-at'></i> " . $email . "</li>";
                            echo "<li><i class='bi bi-telephone-fill'></i> " . $telefono . "</li>";
                            echo "<li><ul>";
                            echo "<li><i class='bi bi-calendar-date-fill'></i> " . $fecha . "</li>";
                            echo "<li><i class='bi bi-clock-fill'></i> " . $hora . "</li>";
                            echo "</li></ul>"
                            ?>
                            <br>
                            <button class="btn waves-effect">Modificar</button>
                            <button class="btn waves-effect">Cancelar</button>
                        </div>
                    </div>
                <?php     
                }
                ?>
                </ul>
        </div>
            <?php
        }
        mysqli_close($bd);
    }
    ?>
    </body>

    </html>