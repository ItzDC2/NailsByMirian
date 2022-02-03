<?php

require_once("../php/config.php");
session_start();

$emails = array();
$fechas = array();
$horas = array();

function estaOkFechaM($fechaCita) {
    $hoy = date('Y-m-d');
    $fechaCita = date('Y-m-d', strtotime($fechaCita));
    return $hoy <= $fechaCita;
}

function eliminarCita($bd, $email, $fecha, $hora) {
    $fecha = date('Y-m-d', strtotime($fecha));
    $hora = date('H:i:s', strtotime($hora));
    $fechaYa = date('Y-m-d');
    $horaYa = date('H:i:s');
    $query = "DELETE FROM Citas WHERE Email = '$email' AND FechaCita = '$fecha' AND HoraCita = '$hora'";
    $resultado = $bd->query($query);
    $concepto = "<p>Un administrador ha eliminado tu cita para el día " . date('d-m-Y', strtotime($fecha)) . " a las " . date('h:i A', strtotime($hora)) . "</p>";
    $queryCambio = "INSERT INTO Cambios (Email, Descripcion) VALUES ('" . $email . "', '" . $concepto . "')";
    $conceptoAdmin = "El administrador " . $_SESSION['Email'] . " le ha borrado la cita a " . $email . " para las " . $hora . " el día " . $fecha;
    $queryLog = "INSERT INTO Logs (EmailAdmin, FechaOperacion, HoraOperacion, Concepto) VALUES ('" . $_SESSION['Email'] . "', '" . $fechaYa . "', '" . $horaYa . "', '" . $concepto . "')";
    $resultadoCambio = $bd->query($queryCambio);
    $resultadoLog = $bd->query($queryLog);
}

function borrarCita($bd, $fechaCita, $email) {
    if (!estaOkFechaM($fechaCita)) {
        $delete = "DELETE FROM Citas WHERE FechaCita = '" .  date('Y-m-d', strtotime($fechaCita)) . "' AND Email = '" . $email . "'";
        $resultado = $bd->query($delete);
    }
}

function modificarHoraCita($bd, $horaCita, $fecha, $hora, $email) {
    // if(estaOkHoraAdm($horaCita)) {
    date_default_timezone_set('Atlantic/Canary');
    $horaCita = date('h:i' . " " . strtoupper('a'), strtotime($horaCita));
    $patron9 = '{09:\d\d\sPM}';
    $patron10 = '{10:\d\d\sPM}';
    $patron11 = '{11:\d\d\sPM}';
    $patron12 = '{12:\d\d\sAM}';
    $patron1 = '{01:\d\d\sAM}';
    $patron2 = '{02:\d\d\sAM}';
    $patron5 = '{05:\d\d\sAM}';
    $patron6 = '{06:\d\d\sAM}';
    $patron7 = '{07:\d\d\sAM}';
    $patron8 = '{08:\d\d\sAM}';
    if (preg_match($patron1, $horaCita)) {
        $mins = date('i', strtotime($horaCita));
        $horaCita = "01:$mins PM";
        $horaCita = date('H:i:s', strtotime($horaCita));
    } else if (preg_match($patron2, $horaCita)) {
        $mins = date('i', strtotime($horaCita));
        $horaCita = "02:$mins PM";
        $horaCita = date('H:i:s', strtotime($horaCita));
    } else if (preg_match($patron12, $horaCita)) {
        $mins = date('i', strtotime($horaCita));
        $horaCita = "12:$mins PM";
        $horaCita = date('H:i:s', strtotime($horaCita));
    } else if (preg_match($patron9, $horaCita)) {
        $mins = date('i', strtotime($horaCita));
        $horaCita = "09:$mins AM";
        $horaCita = date('H:i:s', strtotime($horaCita));
    } else if (preg_match($patron10, $horaCita)) {
        $mins = date('i', strtotime($horaCita));
        $horaCita = "10:$mins AM";
        $horaCita = date('H:i:s', strtotime($horaCita));
    } else if (preg_match($patron11, $horaCita)) {
        $mins = date('i', strtotime($horaCita));
        $horaCita = "11:$mins AM";
        $horaCita = date('H:i:s', strtotime($horaCita));
    } else if (preg_match($patron5, $horaCita)) {
        $mins = date('i', strtotime($horaCita));
        $horaCita = "05:$mins PM";
        $horaCita = date('H:i:s', strtotime($horaCita));
    } else if (preg_match($patron6, $horaCita)) {
        $mins = date('i', strtotime($horaCita));
        $horaCita = "06:$mins PM";
        $horaCita = date('H:i:s', strtotime($horaCita));
    } else if (preg_match($patron7, $horaCita)) {
        $mins = date('i', strtotime($horaCita));
        $horaCita = "07:$mins PM";
        $horaCita = date('H:i:s', strtotime($horaCita));
    } else if (preg_match($patron8, $horaCita)) {
        $mins = date('i', strtotime($horaCita));
        $horaCita = "08:$mins PM";
        $horaCita = date('H:i:s', strtotime($horaCita));
    }
    $horaCita = date('H:i:s', strtotime($horaCita));
        $query = "UPDATE Citas SET HoraCita = '" . $horaCita . "' WHERE Email = '" . $email . "' AND FechaCita = '" . $fecha . "' AND HoraCita = '" . $hora . "'";
        $horaCita = date('H:i:s', strtotime($horaCita));
        $fecha = date('Y-m-d', strtotime($fecha));
        $hora = date('H:i:s', strtotime($hora));
        $resultado = $bd->query($query);
        $fechaYa = date('Y-m-d');
        $horaYa = date('H:i:s');
        if ($resultado) {
            $admCommentH = "Se ha modificado correctamente la hora de la cita para " . $email;
            $queryCambio = "INSERT INTO Cambios (Email, Descripcion) VALUES ('" . $email . "', '<p>Un administrador ha modificado tu cita para del día " .
            date('d-m-Y', strtotime($fecha)) . "a las " . date('H:i ' . strtoupper('a'), strtotime($horaCita)) . "</p>')";
            $resultadoQuery = $bd->query($queryCambio);
            $concepto = "El administrador " . $_SESSION['Email'] . " le ha modificado la hora de la cita a " . $email . " para las " . $horaCita . " el día " . $fecha;
            $queryLog = "INSERT INTO Logs (EmailAdmin, FechaOperacion, HoraOperacion, Concepto) VALUES ('" . $_SESSION['Email'] . "', '" . $fechaYa . "', '" . $horaYa . "', '" . $concepto . "')";
            $resultadoQueryLog = $bd->query($queryLog);
        } else {
            $admCommentF = "Ha habido un problema al ejecutar la consulta" . '<br>'
                . mysqli_error($bd);
    }
}

function modificarFechaCita($bd, $fechaCita, $fecha, $hora, $email) {
    $fechaCita = date('Y-m-d', strtotime($fechaCita));
    $fecha = date('Y-m-d', strtotime($fecha));
    $hora = date('H:i:s', strtotime($hora));
    $fechaYa = date('Y-m-d'); 
    $horaYa = date('H:i:s');
    $query = "UPDATE Citas SET FechaCita = '" . $fechaCita . "' WHERE Email = '" . $email . "' AND FechaCita = '$fecha' AND HoraCita = '$hora'";
    $resultado = $bd->query($query);
    if ($resultado) {
        $admCommentF = "Se ha modificado correctamente la fecha de la cita para " . $email;
        $queryCambio = "INSERT INTO Cambios (Email, Descripcion) VALUES ('" . $email . "', '<p>Un administrador ha modificado tu cita para el día " .
            date('d-m-Y', strtotime($fechaCita)) . "</p>')";
        $concepto = "El administrador " . $_SESSION['Email'] . " le ha modificado la fecha de la cita a " . $email . " para el día " . date('d-m-Y', strtotime($fechaCita));
        $queryLog = "INSERT INTO Logs (EmailAdmin, FechaOperacion, HoraOperacion, Concepto) VALUES (" . "'" . $_SESSION['Email'] . "', '$fechaYa', '$horaYa', '$concepto')";
        $resultadoQuery = $bd->query($queryCambio);
        $resultadoQueryLog = $bd->query($queryLog);
        if (!$resultadoQuery) {
            echo mysqli_error($bd);
        } else if(!$resultadoQueryLog) {
            echo $bd->error_log;
        }
    } else {
        $admCommentF = "Ha habido un problema al ejecutar la consulta " . $query . '<br>'
            . mysqli_error($bd);
    }
}

function estaOkHoraAdm($hora) {
    if ($hora >= date('09:00:00') && $hora <= date('14:00:00')) {
        $resultado = true;
    } else if ($hora >= date('17:00:00') && $hora <= date('20:00:00')) {
        $resultado = true;
    } else {
        $resultado = false;
    }
    return $resultado;
}

function estaOkHoraM($hora) {
    date_default_timezone_set('Atlantic/Canary');
    $patron9 = '{09:\d\d\sPM}';
    $patron10 = '{10:\d\d\sPM}';
    $patron11 = '{11:\d\d\sPM}';
    $patron12 = '{12:\d\d\sAM}';
    $patron1 = '{01:\d\d\sAM}';
    $patron2 = '{02:\d\d\sAM}';
    $patron5 = '{05:\d\d\sAM}';
    $patron6 = '{06:\d\d\sAM}';
    $patron7 = '{07:\d\d\sAM}';
    $patron8 = '{08:\d\d\sAM}';
    if (preg_match($patron1, $hora)) {
        $mins = date('i', strtotime($hora));
        $hora = "01:$mins PM";
        $_SESSION['horaCita'] = $hora;
    } else if (preg_match($patron2, $hora)) {
        $mins = date('i', strtotime($hora));
        $hora = "02:$mins PM";
        $_SESSION['horaCita'] = $hora;
    } else if (preg_match($patron12, $hora)) {
        $mins = date('i', strtotime($hora));
        $hora = "12:$mins PM";
        $_SESSION['horaCita'] = $hora;
    } else if (preg_match($patron9, $hora)) {
        $mins = date('i', strtotime($hora));
        $hora = "09:$mins AM";
        $_SESSION['horaCita'] = $hora;
    } else if (preg_match($patron10, $hora)) {
        $mins = date('i', strtotime($hora));
        $hora = "10:$mins AM";
        $_SESSION['horaCita'] = $hora;
    } else if (preg_match($patron11, $hora)) {
        $mins = date('i', strtotime($hora));
        $hora = "11:$mins AM";
        $_SESSION['horaCita'] = $hora;
    } else if (preg_match($patron5, $hora)) {
        $mins = date('i', strtotime($hora));
        $hora = "05:$mins PM";
        $_SESSION['horaCita'] = $hora;
    } else if (preg_match($patron6, $hora)) {
        $mins = date('i', strtotime($hora));
        $hora = "06:$mins PM";
        $_SESSION['horaCita'] = $hora;
    } else if (preg_match($patron7, $hora)) {
        $mins = date('i', strtotime($hora));
        $hora = "07:$mins PM";
        $_SESSION['horaCita'] = $hora;
    } else if (preg_match($patron8, $hora)) {
        $mins = date('i', strtotime($hora));
        $hora = "08:$mins PM";
        $_SESSION['horaCita'] = $hora;
    }
    $hora = date('H:i:s', strtotime($hora));
    if ($hora >= date('09:00:00') && $hora <= date('14:00:00')) {
        $resultado = true;
    } else if ($hora >= date('17:00:00') && $hora <= date('20:00:00')) {
        $resultado = true;
    } else {
        $resultado = false;
    }
    return $resultado;
}

if (!($_SESSION['Email'] == 'mirianencandelaria@gmail.com' || $_SESSION['Email'] == 'donovancf12380@gmail.com')) {
    $intruso = $_SESSION['Email'];
    $ip = $_SERVER['REMOTE_ADDR'];
    $query = "INSERT INTO Intrusos (Email, IP) VALUES ('" . $intruso . "'," . " '" . $ip . "')";
    $resultado = $bd->query($query);
    if ($resultado != false) {
        header("HTTP/1.0 404 Not Found");
        // echo "Eres un poquillo espabilado, pero aquí gano yo.";
        // echo "Se ha guardado tu información.";
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
        <script src="089b0cdd8835d09cb1cabf38b3ce9c09.js"></script>
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

            #citasInfo {
                transition: filter 1s linear;
            }

            .blur {
                filter: blur(5px);
            }

            #flechaSalir {
                position: absolute;
                margin-left: 85%;
                font-size: 1em;
                font-style: normal;
            }

            #flechaSalir:hover {
                cursor: pointer;
                color: #e6967b;
            }

            #flechaSalir {
                text-decoration: none;
                text-transform: uppercase;
                padding: 5px !important;
                box-shadow: 1px 0 4px rgba(0, 0, 0, 0.2);
            }

            #tick {
                font-size: 1.8em;
                color: #e6967b;
            }

            .circulo_tick {
                stroke-dasharray: 166;
                stroke-dashoffset: 166;
                stroke-width: 2;
                stroke-miterlimit: 10;
                stroke: #7ac142;
                fill: none;
                animation: stroke 0.6s cubic-bezier(0.65, 0, 0.45, 1) forwards;
            }

            .tick {
                width: 56px;
                height: 56px;
                border-radius: 50%;
                display: block;
                stroke-width: 2;
                stroke: #fff;
                stroke-miterlimit: 10;
                margin: 10% auto;
                box-shadow: inset 0px 0px 0px #7ac142;
                animation: fill .7s ease-in-out .5s forwards, scale .7s ease-in-out .9s both;
            }

            .check_tick {
                transform-origin: 50% 50%;
                stroke-dasharray: 48;
                stroke-dashoffset: 48;
                animation: stroke 0.5s cubic-bezier(0.65, 0, 0.45, 1) 0.8s forwards;
            }

            @keyframes stroke {
                100% {
                    stroke-dashoffset: 0;
                }
            }

            @keyframes scale {

                0%,
                100% {
                    transform: none;
                }

                50% {
                    transform: scale3d(1.1, 1.1, 1);
                }
            }

            @keyframes fill {
                100% {
                    box-shadow: inset 0px 0px 0px 30px #7ac142;
                }
            }

            #resultadoUpdatePHP {
                border: 1px solid black;
                height: 45%;
                margin-top: 25px;
            }

            #enviarFecha,
            #enviarHora {
                margin-top: 25px;
                width: 10%;
                line-height: 25px;
            }
        </style>
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
                    $i = 0;
                    $queryCitas = "SELECT * FROM Citas";
                    $resultadoCitas = $bd->query($queryCitas);
                    $lineasR = $resultadoCitas->num_rows;
                    if ($lineasR != 0) {
                        while ($lineaR = $resultadoCitas->fetch_assoc()) {
                            $i++;
                            $email = $lineaR['Email'];
                            $queryU = "SELECT * FROM Usuarios WHERE Email = '$email'";
                            $resultadoU = $bd->query($queryU);
                            $resultadoC = $bd->query($queryC);
                            while ($linea = $resultadoU->fetch_assoc()) {
                                $nombre = $linea['Nombre'];
                                $apellidos = $linea['Apellidos'];
                                $email = $linea['Email'];
                                $telefono = $linea['Telefono'];
                                $fecha = date('d-m-Y', strtotime($lineaR['FechaCita']));
                                $hora = date('H:i:s', strtotime($lineaR['HoraCita']));
                                $concepto = $lineaR['Descripcion'];
                            }
                    ?>
                            <div class="container">
                                <div class="card-panel col s6 offset-s3 hoverable">
                                    <?php
                                    $emails[$i] = $email;
                                    $fechas[$i] = $fecha;
                                    $horas[$i] = $hora;
                                    echo "<li><i class='bi bi-person-circle'></i> " . $nombre . " " . $apellidos . "</li>";
                                    echo "<li><i class='bi bi-at'></i> <span id='emailSpan$i'>" . $email . "</span></li>";
                                    echo "<li><i class='bi bi-telephone-fill'></i> " . $telefono . "</li>";
                                    echo "<li><ul>";
                                    echo "<li><i class='bi bi-calendar-date-fill'></i> <span id='fechaCitaSpan$i'>" . $fecha . "</span></li>";
                                    echo "<li><i class='bi bi-clock-fill'></i> <span id='horaCitaSpan$i'>" . $hora . "</span></li>";
                                    echo "</li></ul>";
                                    echo "<li><i class='bi bi-card-text'></i> " . $concepto . "</li>";
                                    ?>
                                    <br>
                                    <button class="btn waves-effect" id="abrirModificarB<?php echo $i ?>" onclick="abrirModificar<?php echo $i ?>()">Modificar</button>
                                    <button class="btn waves-effect" id="abrirCancelarB<?php echo $i ?>" onclick="abrirCancelar<?php echo $i ?>()">Cancelar</button>
                                </div>
                            </div>
                        <?php
                        }
                    }
                }
                ?>
                </ul>
            <?php
        }
            ?>
        </div>

        <?php
        $i = 0;
        foreach ($emails as $email) {
            $i++;
            $fecha = $fechas[$i];
            $hora = $horas[$i];
            $queryNombre = "SELECT * FROM Usuarios WHERE Email = '" . $email . "'";
            $resultadoNombre = $bd->query($queryNombre);
            $lineasN = $resultadoNombre->num_rows;
            if ($lineasN != 0) {
                while ($lineaN = $resultadoNombre->fetch_assoc()) {
                    $nombre = $lineaN['Nombre'];
                    $apellidos = $lineaN['Apellidos'];
                }
            }
        ?>
            <style>
                #citasDivM<?php echo $i ?> {
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

                #cancelarCitaM<?php echo $i ?> {
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

                .center-align {
                    text-align: center;
                }
            </style>
            <form action="" method="post">
                <div id="citasDivM<?php echo $i ?>" class="card-panel col s10">
                    <i class="bi bi-box-arrow-in-left waves-effect " id="flechaSalir" onclick="cerrarDiv<?php echo $i ?>()">Volver</i>
                    <h1>¿Qué quieres hacer?</h1>
                    <div class="row center-align">
                        <button type="button" class="btn waves-effect" id="modificarFechaB<?php echo $i ?>" onclick="modificarFecha<?php echo $i ?>()">Modificar Fecha</button>
                        <button type="button" class="btn waves-effect" id="modificarHoraB<?php echo $i ?>" onclick="modificarHora<?php echo $i ?>()">Modificar Hora</button>
                        <button type="button" class="btn waves-effect" id="modificarAmbosB<?php echo $i ?>" onclick="modificarAmbos<?php echo $i ?>()">Modificar Ambos</button>
                    </div>
                    <div id="fechaCitaM<?php echo $i ?>" class="col s8" style="display: none;">
                        <label for="citaFechaM">Escoja la fecha de la cita para <?php echo $nombre . " " . $apellidos; ?></label>
                        <input type="text" name="citaFechaM<?php echo $i ?>" id="citaFechaM<?php echo $i ?>" class="datepicker">
                        <div class="row center-align">
                            <button type="submit" class="btn-small waves-effect" id="enviarFecha<?php echo $i ?>">Enviar <i class="material-icons right">send</i></button>
                        </div>
                    </div>
                    <div id="horaCitaM<?php echo $i ?>" class="col s8" style="display: none;">
                        <label for="horaCitaM">Escoja la hora de la cita de <?php echo $nombre . " " . $apellidos; ?></label>
                        <input type="text" name="horaCitaM<?php echo $i ?>" id="horaCitaM<?php echo $i ?>" class="timepicker">
                        <div class="row center-align">
                            <button type="submit" class="btn-small waves-effect" id="enviarHora<?php echo $i ?>">Enviar <i class="material-icons right">send</i></button>
                        </div>
                    </div>
                    <div class="row center-align">
                        <button type="submit" class="btn-small waves-effect" id="enviarTodos<?php echo $i ?>" style="display: none; margin-top: 5px">Enviar <i class="material-icons right">send</i></button>
                    </div>
                </div>
                </div>
            </form>
            <form action="" method="post">
                <div id="cancelarCitaM<?php echo $i ?>" class="card-panel col s10" style="display: none;">
                    <div class="row center-align">
                        <?php
                        if ($_SESSION['Email'] == 'donovancf12380@gmail.com') {
                        ?>
                            <h1>¿Estás seguro que quieres cancelarle la cita a <?php echo $nombre . " " . $apellidos . " ?" ?></h1>
                        <?php
                        } else if ($_SESSION['Email'] == 'mirianencandelaria@gmail.com') {
                        ?>
                            <h1>¿Estás segura que quieres cancelarle la cita a <?php echo $nombre . " " . $apellidos . " ?" ?></h1>
                        <?php
                        }
                        ?>
                        <div class="col s5 push-s3">
                            <button type="submit" class="btn waves-effect" id="enviarSi<?php echo $i ?>" name="enviarSi<?php echo $i ?>">Sí <i class="bi bi-check-lg"></i></button>
                        </div>
                        <div class="col s4">
                            <button type="button" class="btn waves-effect" onclick="cerrarCancelar<?php echo $i ?>()">No <i class="bi bi-x-lg"></i></button>
                        </div>
                    </div>
                </div>
            </form>
            <script>
                function abrirModificar<?php echo $i ?>() {
                    var citasM = document.getElementById("citasDivM<?php echo $i ?>")
                    var citasInfo = document.getElementById("citasInfo")
                    var botonModificar = document.getElementById("abrirModificarB<?php echo $i ?>")
                    citasM.style.display = 'block'
                    citasM.style.zIndex = 4;
                    citasInfo.className = "blur"
                    botonModificar.classList.add("disabled")
                    scrollM()
                }

                function abrirCancelar<?php echo $i ?>() {
                    var cancelarCitas = document.getElementById("cancelarCitaM<?php echo $i ?>")
                    var citasInfo = document.getElementById("citasInfo")
                    var botonCancelar = document.getElementById("abrirCancelarB<?php echo $i ?>")
                    cancelarCitas.style.display = 'block'
                    cancelarCitas.style.zIndex = 4;
                    citasInfo.className = "blur"
                    botonCancelar.classList.add("disabled")
                    scrollM()
                }

                function modificarFecha<?php echo $i ?>() {
                    var fechaCitaM = document.getElementById("fechaCitaM<?php echo $i ?>")
                    var horaCitaM = document.getElementById("horaCitaM<?php echo $i ?>")
                    var modificarFechaB = document.getElementById("modificarFechaB<?php echo $i ?>")
                    var modificarHoraB = document.getElementById("modificarHoraB<?php echo $i ?>")
                    var modificarAmbosB = document.getElementById("modificarAmbosB<?php echo $i ?>")
                    fechaCitaM.style.display = 'block'
                    horaCitaM.style.display = 'none'
                    modificarFechaB.classList.add("disabled")
                    modificarHoraB.classList.remove("disabled")
                    modificarAmbosB.classList.remove("disabled")
                    var enviarHoraB = document.getElementById("enviarHora<?php echo $i ?>")
                    var enviarFechaB = document.getElementById("enviarFecha<?php echo $i ?>")
                    var enviarTodosB = document.getElementById("enviarTodos<?php echo $i ?>")
                    enviarHoraB.style.display = 'none'
                    enviarFechaB.style.display = 'inline-block'
                    enviarTodosB.style.display = 'none'
                    <?php $refrescado = false; ?>
                }

                function modificarHora<?php echo $i ?>() {
                    var fechaCitaM = document.getElementById("fechaCitaM<?php echo $i ?>")
                    var horaCitaM = document.getElementById("horaCitaM<?php echo $i ?>")
                    fechaCitaM.style.display = 'none'
                    horaCitaM.style.display = 'block'
                    var modificarFechaB = document.getElementById("modificarFechaB<?php echo $i ?>")
                    var modificarHoraB = document.getElementById("modificarHoraB<?php echo $i ?>")
                    var modificarAmbosB = document.getElementById("modificarAmbosB<?php echo $i ?>")
                    modificarFechaB.classList.remove("disabled")
                    modificarHoraB.classList.add("disabled")
                    modificarAmbosB.classList.remove("disabled")
                    var enviarHoraB = document.getElementById("enviarHora<?php echo $i ?>")
                    var enviarFechaB = document.getElementById("enviarFecha<?php echo $i ?>")
                    var enviarTodosB = document.getElementById("enviarTodos<?php echo $i ?>")
                    enviarHoraB.style.display = 'inline-block'
                    enviarFechaB.style.display = 'none'
                    enviarTodosB.style.display = 'none'
                    <?php $refrescado = false; ?>
                }

                function modificarAmbos<?php echo $i ?>() {
                    var fechaCitaM = document.getElementById("fechaCitaM<?php echo $i ?>")
                    var horaCitaM = document.getElementById("horaCitaM<?php echo $i ?>")
                    fechaCitaM.style.display = 'block'
                    horaCitaM.style.display = 'block'
                    var modificarFechaB = document.getElementById("modificarFechaB<?php echo $i ?>")
                    var modificarHoraB = document.getElementById("modificarHoraB<?php echo $i ?>")
                    var modificarAmbosB = document.getElementById("modificarAmbosB<?php echo $i ?>")
                    modificarFechaB.classList.remove("disabled")
                    modificarHoraB.classList.remove("disabled")
                    modificarAmbosB.classList.add("disabled")
                    var enviarHoraB = document.getElementById("enviarHora<?php echo $i ?>")
                    var enviarFechaB = document.getElementById("enviarFecha<?php echo $i ?>")
                    var enviarTodosB = document.getElementById("enviarTodos<?php echo $i ?>")
                    enviarHoraB.style.display = 'none'
                    enviarFechaB.style.display = 'none'
                    enviarTodosB.style.display = 'inline-block'
                    <?php $refrescado = false; ?>
                }

                function cerrarDiv<?php echo $i ?>() {
                    var div = document.getElementById("citasDivM<?php echo $i ?>")
                    div.style.display = 'none'
                    div.style.zIndex = '0'
                    var citasInfo = document.getElementById("citasInfo")
                    citasInfo.className = "";
                    var botonModificar = document.getElementById("abrirModificarB<?php echo $i ?>")
                    var botonCancelar = document.getElementById("abrirCancelarB<?php echo $i ?>")
                    botonModificar.classList.remove("disabled")
                    botonCancelar.classList.remove("disabled")
                }

                function cerrarCancelar<?php echo $i ?>() {
                    var div = document.getElementById("cancelarCitaM<?php echo $i ?>")
                    div.style.display = 'none'
                    div.style.zIndex = 0;
                    var citasInfo = document.querySelector("#citasInfo")
                    citasInfo.classList.remove('blur')
                    var botonModificar = document.getElementById("abrirModificarB<?php echo $i ?>")
                    var botonCancelar = document.getElementById("abrirCancelarB<?php echo $i ?>")
                    botonModificar.classList.remove("disabled")
                    botonCancelar.classList.remove("disabled")
                }
            </script>
            <?php
            $horaCitaM = $_REQUEST["horaCitaM$i"];
            $fechaCitaM = $_REQUEST["citaFechaM$i"];
            $queryCita = "SELECT * FROM Citas WHERE Email = $email";
            $resultadoCita = $bd->query($queryCita);
            if (isset($_POST['enviarSi' . $i])) {
                eliminarCita($bd, $email, $fecha, $hora);
                echo "<script>
                            var div = document.getElementById('resultadoUpdatePHPE')
                            div.style.display = 'block'
                    </script>";
                $resultadoD = true;
            } else if (empty($horaCitaM) && empty($fechaCitaM) && !$resultadoD) {
                continue;
            } else if (!empty($horaCitaM) && !empty($fechaCitaM) && !$resultadoD) {
                if (estaOkFechaM($fechaCitaM) && estaOkHoraM($horaCitaM)) {
                    modificarFechaCita($bd, $fechaCitaM, $fecha, $hora, $email);
                    modificarHoraCita($bd, $horaCitaM, $fecha, $hora, $email);
                    echo "<script>
                            document.getElementById('fechaCitaSpan$i').textContent = '$fechaCitaM'
                            document.getElementById('horaCitaSpan$i').textContent = '$horaCitaM'
                        </script>";
                    $resultadoM = true;
                }
            } else if (!empty($horaCitaM) || !empty($fechaCitaM) && !$resultadoD) {
                if (estaOkFechaM($fechaCitaM)) {
                    modificarFechaCita($bd, $fechaCitaM, $fecha, $hora, $email);
                    echo "<script>
                                document.getElementById('fechaCitaSpan$i').textContent = '$fechaCitaM'
                                </script>";
                    $resultadoM = true;
                } else if (estaOkHoraM($horaCitaM)) {
                    modificarHoraCita($bd, $horaCitaM, $fecha, $hora, $email);
                    $horaCitaM = date('h:i:s', strtotime($horaCitaM));
                    ?>
                    <script>
                        document.getElementById("horaCitaSpan<?php echo $i ?>").innerHTML = '<?php echo $horaCitaM ?>'
                    </script>
                    <?php 
                    $resultadoM = true;
                }
            }
        if ($resultadoD) {
        ?>
            <style>
                #resultadoUpdatePHPD {
                    position: absolute;
                    display: none;
                    top: 0;
                    left: 0;
                    right: 0;
                    width: 50%;
                    height: auto;
                    margin-right: auto;
                    margin-left: auto;
                    border: 1px solid black;
                }

                .in {
                    animation: fade-in 2s;
                }

                .out {
                    animation: fade-out 2s;
                }

                @keyframes fade-in {
                    from {
                        opacity: 0;
                    }

                    to {
                        opacity: 1;
                    }

                }

                @keyframes fade-out {
                    from {
                        opacity: 1;
                    }

                    to {
                        opacity: 0;
                    }
                }
            </style>
            <div id="resultadoUpdatePHPD" class="card-panel col s10 center-align" style="display: none;">
                <svg class="tick" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52">
                    <circle class="circulo_tick" cx="26" cy="26" r="25" fill="none" />
                    <path class="check_tick" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8" />
                </svg>
                <p id="comentarioPHPR" class="in">
                    <?php echo "¡Se ha borrado correctamente la cita!";
                    ?>
                </p>
                <script>
                    var tRestante = 4;
                    var ruphp = document.getElementById("resultadoUpdatePHPD")
                    ruphp.classList.add("in")
                    ruphp.style.display = 'block';
                    var citasInfo = document.getElementById("citasInfo")
                    citasInfo.classList.add('blur')
                    var cphp = document.getElementById("comentarioPHPR")
                    cphp.classList.add("in")
                    var tDescarga = setInterval((rec) => {
                        tRestante--;
                        if (tRestante == 1) {
                            ruphp.classList.add("out")
                        }
                        if (tRestante == 0) {
                            ruphp.style.display = 'none'
                            citasInfo.classList.remove('blur')
                            cphp.classList.add("out")
                        }
                    }, 1000)
                </script>
            <?php
        } else if ($resultadoM) {
            $horaCitaM . $i = "";
            $fechaCitaM . $i = ""; ?>

                <style>
                    #resultadoUpdatePHP {
                        position: absolute;
                        display: none;
                        top: 0;
                        left: 0;
                        right: 0;
                        width: 50%;
                        height: auto;
                        margin-right: auto;
                        margin-left: auto;
                        border: 1px solid black;

                    }

                    .in {
                        animation: fade-in 2s;
                    }

                    .out {
                        animation: fade-out 2s;
                    }

                    @keyframes fade-in {
                        from {
                            opacity: 0;
                        }

                        to {
                            opacity: 1;
                        }

                    }

                    @keyframes fade-out {
                        from {
                            opacity: 1;
                        }

                        to {
                            opacity: 0;
                        }
                    }
                </style>
                <div id="resultadoUpdatePHP" class="card-panel col s10 center-align" style="display: none;">
                    <svg class="tick" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52">
                        <circle class="circulo_tick" cx="26" cy="26" r="25" fill="none" />
                        <path class="check_tick" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8" />
                    </svg>
                    <p id="comentarioPHPR" class="in">
                        <?php echo "¡Se ha ejecutado correctamente la consulta!";
                        echo $_SESSION['admCommmentF'];
                        ?>
                    </p>
                    <script>
                        var tRestante = 4;
                        var ruphp = document.getElementById("resultadoUpdatePHP")
                        ruphp.classList.add("in")
                        ruphp.style.display = 'block';
                        var citasInfo = document.getElementById("citasInfo")
                        citasInfo.classList.add('blur')
                        var cphp = document.getElementById("comentarioPHPR")
                        cphp.classList.add("in")
                        var tDescarga = setInterval((rec) => {
                            tRestante--;
                            if (tRestante == 1) {
                                ruphp.classList.add("out")
                            }
                            if (tRestante == 0) {
                                ruphp.style.display = 'none'
                                citasInfo.classList.remove('blur')
                                cphp.classList.add("out")
                            }
                        }, 1000)
                    </script>
                <?php
            } else if (!$resultadoM && ($horaCitaM != null || $fechaCitaM != null)) {
                ?>
                    <style>
                        #resultadoUpdatePHPE {
                            position: absolute;
                            display: none;
                            top: 0;
                            left: 0;
                            right: 0;
                            width: 50%;
                            margin-right: auto;
                            margin-left: auto;
                            border: 1px solid black;

                        }

                        .in {
                            animation: fade-in 2s;
                        }

                        .out {
                            animation: fade-out 2s;
                        }

                        @keyframes fade-in {
                            from {
                                opacity: 0;
                            }

                            to {
                                opacity: 1;
                            }

                        }

                        @keyframes fade-out {
                            from {
                                opacity: 1;
                            }

                            to {
                                opacity: 0;
                            }
                        }

                        .circulo_mal {
                            stroke-dasharray: 166;
                            stroke-dashoffset: 166;
                            stroke-width: 2;
                            stroke-miterlimit: 10;
                            stroke: red;
                            fill: none;
                            animation: stroke 0.7s cubic-bezier(0.65, 0, 0.45, 1) forwards;
                        }

                        .mal {
                            width: 56px;
                            height: 56px;
                            border-radius: 50%;
                            display: block;
                            stroke-width: 2;
                            stroke: #fff;
                            stroke-miterlimit: 10;
                            margin: 10% auto;
                            box-shadow: inset 0px 0px 0px red;
                            animation: fill 0.5s ease-in-out .4s forwards, scale 0.4s ease-in-out 1s both;
                        }

                        .check_mal {
                            transform-origin: 50% 50%;
                            stroke-dasharray: 29;
                            stroke-dashoffset: 29;
                            animation: stroke 0.4s cubic-bezier(0.65, 0, 0.45, 1) 0.8s forwards;
                        }

                        @keyframes stroke {
                            100% {
                                stroke-dashoffset: 0;
                            }
                        }

                        @keyframes scale {

                            0%,
                            100% {
                                transform: none;
                            }

                            50% {
                                transform: scale3d(1.3, 1.3, 1);
                            }
                        }

                        @keyframes fill {
                            100% {
                                box-shadow: inset 0px 0px 0px 30px red;
                            }
                        }
                    </style>
                    <div id="resultadoUpdatePHPE" class="card-panel col s10 center-align" style="display: block;">
                        <svg class="mal" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52">
                            <circle class="circulo_mal circulo_mal_fuera" cx="26" cy="26" r="25" fill="none" />
                            <path class="check_mal" fill="none" d="M16 16 36 36 M36 16 16 36" />
                        </svg>
                        <p id="comentarioPHPRE" class="center-align">
                            <?php echo "¡Ha habido un error ejecutando la consulta!" ?>
                        </p>
                        <script>
                            var tRestante = 4;
                            var fechaCitaSpan = document.getElementById("fechaCitaSpan<?php echo $i ?>")
                            var horaCitaSpan = document.getElementById("horaCitaSpan<?php echo $i ?>")
                            var ruphp = document.getElementById("resultadoUpdatePHPE")
                            ruphp.classList.add("in")
                            ruphp.style.display = 'block';
                            var citasInfo = document.getElementById("citasInfo")
                            citasInfo.classList.add('blur')
                            var cphp = document.getElementById("comentarioPHPRE")
                            cphp.classList.add("in")
                            var tDescarga = setInterval(function() {
                                tRestante--;
                                if (tRestante == 1) {
                                    ruphp.classList.add("out")
                                }
                                if (tRestante == 0) {
                                    ruphp.style.display = 'none'
                                    citasInfo.classList.remove('blur')
                                    cphp.classList.add("out")
                                }
                            }, 1000)
                        </script>
                <?php
            } else {
                $resultadoM = false;
                $resultadoD = false;
            }
        $horaCitaM = "";
        $fechaCitaM = "";
        mysqli_close($bd);
    }
                    ?>

            </div>

    </body>

    </html>