<?php 

    $exito = false;
    $comentarioCita = "";

    require_once ("./config.php");

    session_start();

    $_SESSION['fechaCita'] = $_REQUEST['citaFechaI'];
    $_SESSION['horaCita'] = $_REQURST['citaHoraI'];

    function escribirComentarioCita($error) {
        $ruta = "./json/errorCita.json";
        file_put_contents($ruta, json_encode($error), true);
    }

    function decodificarError($error) {
        $ruta = "./json/errorCita.json";
        file_get_contents($ruta, json_decode($error), true);
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

    if(!empty($_SESSION['fechaCita']) && !empty($_SESSION['horaCita'])) {
        $_SESSION['fechaCita'] = sanitizar($bd, $_SESSION['fechaCita']);
        $_SESSION['fechaCita'] = sanitizar2($_SESSION['fechaCita']);
        $_SESSION['fechaCita'] = stripslashes($_SESSION['fechaCita']);
        $_SESSION['horaCita'] = sanitizar($bd, $_SESSION['horaCita']);
        $_SESSION['horaCita'] = sanitizar2($_SESSION['horaCita']);
        $_SESSION['horaCita'] = stripslashes($_SESSION['horaCita']);

        $fechaCita = $_SESSION['fechaCita'];
        $horaCita = $_SESSION['horaCita'];

        $sqlComprobar = "SELECT * FROM Citas WHERE FechaCita = " . entrecomillar($fechaCita) . "AND HoraCita = " . entrecomillar($horaCita);
        $resultadoComprobar = mysqli_query($bd, $sqlComprobar) or die(mysqli_error($bd));
        $lineas = mysqli_num_rows($resultadoComprobar);

        if($lineas != 0) {
            $exito = true;
        } else {
            $comentarioCita = "<p>Ya existe una cita a esa hora y ese día, por favor, elija otro.</p>";
            escribirComentarioCita($comentarioCita);
            $exito = false;
        }
    } else {
        $comentarioCita = "<p>Se debe elegir fecha y hora para poder tramitar la cita.</p>";
        escribirComentarioCita($comentarioCita);
        $exito = false;
    }