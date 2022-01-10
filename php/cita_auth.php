<?php

$exito = false;
$comentarioCita = "";

require_once("./config.php");

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
    $resultado = false;
    $fecha = strtotime($fecha);
    $fecha = date('d-m-Y', $fecha);
    $fechaHoy = date('d-m-Y');
    if ($fecha >= $fechaHoy) {
        $resultado = true;
    } else {
        $resultado = false;
        $comentarioCita = "<p>La fecha de la cita debe ser mayor que hoy.</p>";
        escribirComentarioCita($comentarioCita);
    }
    return $resultado;
}

function estaOkHora($hora) {
    date_default_timezone_set('Atlantic/Canary');
    $resultado = false;
    $hora = date('H:i:s', strtotime($hora));
    // $patronAM = '{12:\d\d\sAM}';
    // if(preg_match($patronAM, $hora)) {
    //     $horaC = new DateTime($hora);
    //     $mins = $horaC->format('i');
    //     $hora = date('12:$mins:s', $hora);
    // } else {
    //     $hora = date("H:i:s", strtotime($hora));
    // }
    if ($hora >= date('09:00') && $hora <= date('14:00')) {
        $resultado = true;
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
            $fechaCita = formatearSQLFecha($_SESSION['fechaCita']);
            $horaCita = formatearSQLHora($_SESSION['horaCita']);
    
            $sqlComprobar = "SELECT * FROM Citas WHERE FechaCita = " . entrecomillar($fechaCita) . "AND HoraCita = " . entrecomillar($horaCita);
            $resultadoComprobar = $bd->query($sqlComprobar);
            $lineas = mysqli_num_rows($resultadoComprobar);
    
            if ($lineas <= 0) {
                $sqlCitaInsert = "INSERT INTO Citas (Email, FechaCita, HoraCita) VALUES ('" . $email . "', '" . $fechaCita . "', '" . $horaCita . "')";
                $resultadoCita = $bd->query($sqlCitaInsert) or die(mysqli_error($bd));
                $lineasCitaInsert = mysqli_num_rows($resultadoCita);
                if($lineasCitaInsert != 0) {
                    $exito = true;
                } else {
                    $comentarioCita = "<p>Ha habido un error ejecutando la sentencia</p><p>". $sqlCitaInsert . "</p><p>Error: " . mysqli_error($bd) ."</p>";
                    escribirComentarioCita($comentarioCita);
                    $exito = false;
                }
            } else {
                $comentarioCita = "<p>Ya existe una cita a esa hora y ese día, por favor, elija otra hora o día.</p>";
                escribirComentarioCita($comentarioCita);
                $exito = false;
        }
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
        <div id="comentarioOk" class="col s6 card-panel center-align" style="margin-top: 25px;">
            <span id="texto">¡Todo ha ido bien <?php echo $_SESSION['nombre'] ?>!<br>
                Tu cita para el día <b><?php echo $_SESSION['fechaCita'] . " a las " . $_SESSION['horaCita']?></b> <?php echo "se ha registrado correctamente!" ?>
                <br>
                Serás redirigido a la pantalla inicial en <span id="tiempo"></span> <span id="secs">segundos...</span>
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
                        // window.location.href = "../index.php"
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
                        echo $comentarioCita;
                        echo mysqli_error($bd);
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
        ?>
</body>
</html>