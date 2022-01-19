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
        <link rel="icon" href="../imgs/nail-circled.png" type="image/x-icon" />
        <title>Document</title>
    </head>

    <body>
        <script>
            $(document).ready(function() {
                $('.datepicker').datepicker({
                    firstDay: 0,
                    format: 'dd-mm-yyyy',
                    selectYears: 1,
                    selectMonths: true,
                    labelMonthNext: 'Siguiente mes',
                    labelMonthPrev: 'Mes anterior',
                    labelMonthSelect: 'Selecciona un mes',
                    labelYearSelect: 'Selecciona un año',
                    autoClose: true,
                    i18n: {
                        months: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre",
                            "Noviembre", "Diciembre"
                        ],
                        monthsShort: ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"],
                        weekdays: ["Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado"],
                        weekdaysShort: ["Dom", "Lun", "Mar", "Mie", "Jue", "Vie", "Sab"],
                        weekdaysAbbrev: ["D", "L", "M", "X", "J", "V", "S"],
                        cancel: 'Cancelar',
                        today: 'Hoy',
                        clear: 'Limpiar',
                        close: 'Ok'
                    }
                });
            })

            $(document).ready(function() {
                $('.timepicker').timepicker({
                    defaultTime: 'now',
                    showClearBtn: true,
                    twelveHour: true,
                    autoClose: false,
                    vibrate: true,
                    i18n: {
                        cancel: 'Cancelar',
                        today: 'Hoy',
                        clear: 'Limpiar',
                        done: 'Ok'
                    }
                })
            })
        </script>
        <style>
            #tituloCitas {
                color: #e6967b;
                font-size: 2em;
            }

            input:hover {
                border-bottom: 1px solid #e6967b !important;
                box-shadow: 0 0 0 0 !important;
            }

            input:focus+label {
                color: #e6967b !important;
            }

            label::before {
                content: "* ";
                color: red;
            }

            input:focus {
                border-bottom: 1px solid #e6967b !important;
                box-shadow: 0 0 0 0 !important;
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

            .is-today {
                color: #e6967b !important;
                text-decoration: underline;
            }

            .is-selected[aria-selected="true"] {
                color: white !important;
                background: #e6967b !important;
            }

            .datepicker-day-button:hover {
                color: white !important;
                background-color: rgba(230, 150, 123, 0.2) !important;
            }

            .datepicker-date-display {
                background-color: #e6967b !important;
            }

            .datepicker-day-button[aria-selected="true"] {
                background-color: #e6967b !important;
            }

            .datepicker-cancel {
                background-color: #e6967b;
                color: white;
            }

            .month-prev:focus {
                background-color: #e6967b !important;
            }

            .month-next:focus {
                background-color: #e6967b !important;
            }

            .timepicker-display-column {
                background-color: #e6967b !important;
            }

            .timepicker-digital-display {
                background-color: #e6967b !important;
            }

            .timepicker-tick {
                color: white;
            }

            .timepicker-tick:hover {
                background-color: rgba(230, 150, 123, 0.2) !important;
            }

            .timepicker-canvas-bg {
                fill: #e6967b !important;
            }

            .timepicker-canvas-bearing {
                fill: #e6967b !important;
            }

            .timepicker-canvas line {
                stroke: #e6967b !important;
            }
            .timepicker-plate {
                background-color: lightgray;
            }
            h1 {
                color: #e6967b;
                font-size: 2em;
                text-align: center;
            }
            #citasDivM {
                position: absolute;
                display: none;
                top: 0;
                left: 0;
                right: 0;
                width: 75%;
                margin-right: auto;
                margin-left: auto;
                border: 1px solid black;
            }
            .blur {
                filter: blur(5px);
            }
        </style>
        <script>
            function abrirModificar() {
                var citasM = document.getElementById("citasDivM")
                var citasInfo = document.getElementById("citasInfo")
                citasM.style.display = 'block'
                citasM.style.zIndex = 4;
                citasInfo.className = "blur"
            }

            function abrirCancelar() {

            }
        </script>
        <div id="citasInfo" style="margin-left: 15px; text-align: center;">
            <h1 id="tituloCitas"><i class="bi bi-calendar"></i> Citas</h1>
            <?php
            $queryCitas = "SELECT * FROM Citas";
            $resultado = $bd->query($queryCitas);
            $lineasResultadoCitas = $resultado->num_rows;
            if ($lineasResultadoCitas == 0) {
                echo "No hay citas pendientes.";
            } else {
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
                        $concepto = "SELECT Descripcion FROM Citas WHERE Email = " . "'" . $linea['Email'] . "'";
                        $fecha = date('d-m-Y', strtotime($linea['FechaCita']));
                        $hora = date('H:i:s', strtotime($linea['HoraCita']));
                        $email = $linea['Email'];
                        $resultadoN = $bd->query($nombreQuery);
                        if ($lineas = $resultado->num_rows != 0) {
                            while ($linea = $resultadoN->fetch_assoc()) {
                                $nombre = $linea['Nombre'];
                            }
                            $resultadoA = $bd->query($apellidosQuery);
                            $lineasA = $resultadoA->num_rows;
                            if ($lineasA != 0) {
                                while ($lineaA = $resultadoA->fetch_assoc()) {
                                    $apellidos = $lineaA['Apellidos'];
                                }
                            }
                            $resultadoT = $bd->query($telefonoQuery);
                            $lineasT = $resultadoT->num_rows;
                            if ($lineasT != 0) {
                                while ($lineaT = $resultadoT->fetch_assoc()) {
                                    $telefono = $lineaT['Telefono'];
                                }
                            }
                            $resultadoC = $bd->query($concepto);
                            $lineasC = $resultado->num_rows;
                            if ($lineasC != 0) {
                                while ($lineaC = $resultadoC->fetch_assoc()) {
                                    $concepto = $lineaC['Descripcion'];
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
                                echo "</li></ul>";
                                echo "<li><i class='bi bi-card-text'></i> " . $concepto . "</li>";
                                ?>
                                <br>
                                <button class="btn waves-effect" onclick="abrirModificar()">Modificar</button>
                                <button class="btn waves-effect" onclick="abrirCancelar()">Cancelar</button>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                </ul>
            </div>
            <div id="citasDivM" class="card-panel col s10">
                <style>
                    i.bi-box-arrow-in-left {
                        position: absolute;
                        top: 50;
                        right: 25;
                        font-size: 1.5em;
                    }

                    i.bi-box-arrow-in-left:hover {
                        cursor: pointer;
                        color: #e6967b;
                    }
                </style>
                <script>
                    function modificarFecha() {
                        var fechaCitaM = document.getElementById("fechaCitaM")
                        var horaCitaM = document.getElementById("horaCitaM")
                        fechaCitaM.style.display = 'block'
                        horaCitaM.style.display = 'none'
                    }

                    function modificarHora() {
                        var fechaCitaM = document.getElementById("fechaCitaM")
                        var horaCitaM = document.getElementById("horaCitaM")
                        fechaCitaM.style.display = 'none'
                        horaCitaM.style.display = 'block'
                    }

                    function modificarAmbos() {
                        var fechaCitaM = document.getElementById("fechaCitaM")
                        var horaCitaM = document.getElementById("horaCitaM")
                        fechaCitaM.style.display = 'block'
                        horaCitaM.style.display = 'block'
                    }

                    function cerrarDiv() {
                        var div = document.getElementById("citasDivM")
                        div.style.display = 'none'
                        var citasInfo = document.getElementById("citasInfo")
                        citasInfo.className = "";
                    }

                </script>
                <i class="bi bi-box-arrow-in-left" onclick="cerrarDiv()"></i>
                <h1>¿Qué quieres hacer?</h1>
                <div class="row center-align">
                    <button class="btn waves-effect" onclick="modificarFecha()">Modificar Fecha</button>
                    <button class="btn waves-effect" onclick="modificarHora()">Modificar Hora</button>
                    <button class="btn waves-effect" onclick="modificarAmbos()">Modificar Ambos</button>
                </div>
                <div id="fechaCitaM" class="col s8" style="display: none;">
                    <label for="citaFechaM">Escoja la fecha de la cita para <?php echo $nombre . " " . $apellidos; ?></label>
                    <input type="text" name="citaFechaM" id="citaFechaM" class="datepicker">
                    <div class="row center-align">
                        <button type="submit" class="btn waves-effect" style="display: none">Enviar</button>
                    </div>
                </div>
                <div id="horaCitaM" class="col s8" style="display: none;">
                    <label for="citaFechaM">Escoja la hora de la cita de <?php echo $nombre . " " . $apellidos; ?></label>
                    <input type="text" name="citaFechaM" id="citaFechaM" class="timepicker">
                    <div class="row center-align">
                        <button type="submit" class="btn waves-effect" style="display: none">Enviar</button>
                    </div>
                </div>
            </div>
            <?php
            }
            mysqli_close($bd);
        }
?>
    </body>

    </html>