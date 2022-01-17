<?php

$exito = false;
$comentarioCita = "";

require("./config.php");

session_start();

$_SESSION['fechaCita'] = $_REQUEST['citaFechaI'];
$_SESSION['horaCita'] = $_REQUEST['citaHoraI'];

function escribirComentarioCita($errorCita) {
    $ruta = "./json/errorCita.json";
    file_put_contents($ruta, json_encode($errorCita), true);
}

function sanitizar($bd, $datos) {
    return mysqli_real_escape_string($bd, $datos);
}

function sanitizar2($datos) {
    return htmlspecialchars($datos);
}

function entrecomillar($datos) {
    return "'" . $datos . "'";
}

function formatearSQLFecha($fecha) {
    $fecha = date('Y-m-d', strtotime($fecha));
    return $fecha;
}

function formatearSQLHora($hora) {
    $hora = date('H:i:s', strtotime($hora));
    return $hora;
}

function estaOkFecha($fecha) {
    date_default_timezone_set('Atlantic/Canary');
    $fecha = strtotime($fecha);
    $fecha = date('Y-m-d', $fecha);
    $fechaHoy = date('Y-m-d');
    if ($fecha >= $fechaHoy) {
        $resultado = true;
    } else {
        $resultado = false;
        $comentarioCita = "<p>La fecha de la cita debe ser mayor que hoy.</p>";
        escribirComentarioCita($comentarioCita);
    }
    return $resultado;
}

function insertarCita($bd, $email, $fechaCita, $horaCita) {
    $query = "INSERT INTO Citas (Email, FechaCita, HoraCita) VALUES ('" . $email . "', '" . $fechaCita . "', '" . $horaCita . "')";
    $resultado = $bd->query($query);
    if(!$resultado) {
        $comentarioCita = "<p>Ha habido un error ejecutando la consulta, por favor, inténtelo más tarde.</p>";
        escribirComentarioCita($comentarioCita);
    }
}

function comprobarCita($bd, $sql) {
    if($resultadoC = mysqli_query($bd, $sql)) {
        $lineas = mysqli_num_rows($resultadoC);
        if($lineas == 0) {
            $resultado = true;
        } else {
            $resultado = false;
        }
        return $resultado;
    }
}

function estaOkHora($hora) {
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
    if(preg_match($patron1, $hora) || preg_match($patron2, $hora) || preg_match($patron9, $hora) || preg_match($patron10, $hora) || preg_match($patron11, $hora) || preg_match($patron12, $hora))  {
        if(preg_match($patron1, $hora)) {
            $mins = date('i', strtotime($hora));
            $hora = "01:$mins PM";
            $_SESSION['horaCita'] = $hora;
        } else if(preg_match($patron2, $hora)) {
            $mins = date('i', strtotime($hora));
            $hora = "02:$mins PM";
            $_SESSION['horaCita'] = $hora;
        } else if(preg_match($patron12, $hora)) {
            $mins = date('i', strtotime($hora));
            $hora = "12:$mins PM";
            $_SESSION['horaCita'] = $hora;
        } else if(preg_match($patron9, $hora)) {
            $mins = date('i', strtotime($hora));
            $hora = "09:$mins AM";
            $_SESSION['horaCita'] = $hora;
        } else if(preg_match($patron10, $hora)) {
            $mins = date('i', strtotime($hora));
            $hora = "10:$mins AM";
            $_SESSION['horaCita'] = $hora;
        } else if(preg_match($patron11, $hora)) {
            $mins = date('i', strtotime($hora));
            $hora = "11:$mins AM";
            $_SESSION['horaCita'] = $hora;
        } else if(preg_match($patron5, $hora)) {
            $mins = date('i', strtotime($hora));
            $hora = "05:$mins PM";
            $_SESSION['horaCita'] = $hora;
        } else if(preg_match($patron6, $hora)) {
            $mins = date('i', strtotime($hora));
            $hora = "06:$mins PM";
            $_SESSION['horaCita'] = $hora;
        } else if(preg_match($patron7, $hora)) {
            $mins = date('i', strtotime($hora));
            $hora = "07:$mins PM";
            $_SESSION['horaCita'] = $hora;
        } else if(preg_match($patron8, $hora)) {
            $mins = date('i', strtotime($hora));
            $hora = "08:$mins PM";
            $_SESSION['horaCita'] = $hora;
        }
    }
    $hora = date('H:i:s', strtotime($hora));
    $hoy = date('Y-m-d');
    if ($hora >= date('09:00:00') && $hora <= date('14:00:00') && ($hoy <= formatearSQLFecha($_SESSION['fechaCita']))) {
        $resultado = true;
    } else if($hora >= date('17:00:00') && $hora <= date('20:00:00') && $hoy <= formatearSQLFecha($_SESSION['fechaCita'])) {
        $resultado = true;
    } else if($hora > date('H:i:s') && $hoy <= formatearSQLFecha($_SESSION['fechaCita'])) {
        $resultado = false;
        $comentarioCita = "<p>La hora de la cita debe ser mayor a la hora actual.</p>";
        escribirComentarioCita($comentarioCita);
    } else if($hoy >= formatearSQLFecha($_SESSION['fechaCita'])) {
        $resultado = false;
        $comentarioCita = "<p>La fecha de la cita debe ser mayor a la fecha actual";
        escribirComentarioCita($comentarioCita);
    } else {
        $resultado = false;
        $comentarioCita = "<p>La hora de la cita debe estar dentro de nuestros horarios laborales.</p>09:00 - 14:00";
        escribirComentarioCita($comentarioCita);
    }
    return $resultado;
}

if (!empty($_SESSION['fechaCita']) && !empty($_SESSION['horaCita'])) {
    if(estaOkFecha($_SESSION['fechaCita']) && estaOkHora($_SESSION['horaCita'])) {
        $_SESSION['fechaCita'] = sanitizar($bd, $_SESSION['fechaCita']);
        $_SESSION['fechaCita'] = sanitizar2($_SESSION['fechaCita']);
        $_SESSION['fechaCita'] = stripslashes($_SESSION['fechaCita']);
        $_SESSION['horaCita'] = sanitizar($bd, $_SESSION['horaCita']);
        $_SESSION['horaCita'] = sanitizar2($_SESSION['horaCita']);
        $_SESSION['horaCita'] = stripslashes($_SESSION['horaCita']);
    
        $email = $_SESSION['Email'];
        $fechaCitaF = formatearSQLFecha($_SESSION['fechaCita']);
        $horaCitaF = formatearSQLHora($_SESSION['horaCita']);

        $sqlComprobar = "SELECT * FROM Citas WHERE FechaCita = " . entrecomillar($fechaCitaF) . " AND HoraCita = " . entrecomillar($horaCitaF);
        $citaComprobada = false;
        if(comprobarCita($bd, $sqlComprobar)) {
            $lineasComprobar = mysqli_num_rows(mysqli_query($bd, $sqlComprobar));
            $citaComprobada = true;
        }
        if($citaComprobada) {
            insertarCita($bd, $email, $fechaCitaF, $horaCitaF);
            $exito = true;
        } else {
            $comentarioCita = "<p>Ya existe una cita en ese día, por favor, elija otro día o consulte a su manicurista por una prolongación de tiempo para su cita.</p>";
            escribirComentarioCita($comentarioCita);
            $exito = false;
        }
    // } else {
    //     $comentarioCita = "<p>Hubo un error con la fecha y hora de la cita, vuelva a intentarlo más tarde. " . $_SESSION['fechaCita'] . " " . $_SESSION['horaCita'] . "</p>";
    //     escribirComentarioCita($comentarioCita);
    //     $exito = false;
    }
} else {
    $comentarioCita = "<p>Se debe elegir fecha y hora para poder tramitar la cita.</p>";
    escribirComentarioCita($comentarioCita);
    $exito = false;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../imgs/nail-circled.png" type="image/x-icon" />
    <link rel="stylesheet" href="../css/estilosAuthRegister.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <script src="../js/progress.js"></script>
    <title>Pidiendo tu cita...</title>
</head>

<body onload="progress()">
    <?php
    if ($exito) {
    ?>
    <div class="container">
        <div id="comentarioOk" class="col s6 card-panel center-align" style="margin-top: 25px;">
            <span id="texto">¡Todo ha ido bien <?php echo $_SESSION['nombre'] ?>!<br>
                Tu cita para el día <b><?php echo $_SESSION['fechaCita'] . " a las " . $_SESSION['horaCita']?></b> <?php echo "se ha registrado correctamente!";
                $_SESSION['notifi'][1] = "<p>Recordatorio: Tienes una cita el día " . $_SESSION['fechaCita'] . " a las " . $_SESSION['horaCita']."</p>";

                ?>
                <br>
                Serás redirigid@ a la pantalla inicial en <span id="tiempo"></span> <span id="secs">segundos...</span>
            </span>
            <script>
                var tiempoRestante = 10;
                var tiempoDescarga = setInterval(function() {
                    document.getElementById("tiempo").textContent = tiempoRestante;
                    if (tiempoRestante == 1) {
                        document.getElementById("secs").textContent = "segundo";
                    }
                    if (tiempoRestante == 0) {
                        document.getElementById("texto").textContent = "Redireccionando..."
                        window.location.href = "../index.php"
                        clearInterval(tiempoDescarga)
                    }
                    tiempoRestante--;
                }, 1000);
            </script>
            <div class="row">
                <div class="progress col s6 offset-s3" style="width: 50%">
                    <div class="determinate" id="progreso" style="background-color: #0075ff;"></div>
                </div>
            </div>
            <div class="row">
                <div class="col s6 offset-s3">
                    <button type="submit" class="btn waves-effect" id="aceptarBtn" onclick="window.location.href='../index.php'">Aceptar <i class="bi bi-box-arrow-in-right"></i></button>
                </div>
            </div>
            <!-- </div> -->
            </div>
        <?php
    } else {
        ?>
            <div class="container">
                <div id="errorPHP" class="col s6 card-panel center-align hoverable" style="margin-top: 25px; padding: 10px; border: 1px solid red;">
                    <?php
                    echo "Error:<br>";
                    $ruta = "./json/errorCita.json";
                    $comentarioCitaLocal = json_decode(file_get_contents($ruta), true);
                    if(!empty($comentarioCitaLocal)) {
                        $comentarioCita = $comentarioCitaLocal;
                        echo $comentarioCita . '<br>';
                        echo "Has escogido una cita a las " . $_SESSION['horaCita'] . " el día " . $_SESSION['fechaCita'];
                    }
                    // echo decodificarError($comentarioCita);
                    ?>
                    <div class="row">
                        <div class="col s6 offset-s3">
                            <button type="submit" class="btn waves-effect" id="aceptarBtn" style="margin-top: 15px;" onclick="window.location.href='../cita.php'">Volver <i class="bi bi-box-arrow-in-left"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        <?php
    }
    mysqli_close($bd);
        ?>
</body>
</html>