<?php

    error_reporting(0);

    $nombre;
    $apellidos;
    $email;
    $contra;
    $contra2;

    $errorUsuario = "";
    $errorPass = "";
    $comentario = "";

    $_SESSION['notifi'] = array();

    function imprimirAConsola($salida, $con_tags_de_scripts = true) {
        $js_code = 'console.log(' . json_encode($salida, JSON_HEX_TAG) . ');';
        if($con_tags_de_scripts) {
            $js_code = '<script>' . $js_code . '</script>';
        }       
        echo $js_code; 
    }

    function sqlComprobarCita($bd, $fechaCita, $horaCita, $email) { 
        $query = "SELECT * FROM Citas WHERE FechaCita = '" . $fechaCita . "'" . " AND HoraCita = '" . $horaCita . "'";
        $resultado = $bd->query($query);
        $lineas = $resultado->num_rows;
        if($lineas != 0) {
            $hoy = date('Y-m-d');
            $horaFin = strtotime("02:00 pm");
            if($fechaCita == $hoy && $horaCita >= $horaFin) {
                $queryDelete = "DELETE FROM Citas WHERE FechaCita = '" . $fechaCita . "'" . " AND HoraCita = '" . $horaCita . "'" . " AND Email = '" . $email . "'";
                $resultadoDelete = $bd->query($queryDelete);
                if($resultadoDelete) {
                    unset($_SESSION['notifi'][1]);
                }
            } else if($fechaCita == $hoy && $horaCita < $horaFin) {
                $queryComprobar = "SELECT * FROM Citas WHERE Email = "  . entrecomillar($email) . "";
                $resultado = $bd->query($queryComprobar);
                $lineas = $resultado->num_rows;
                $fechaCitaL = "";
                $horaCitaL = "";
                if($lineas != 0) {
                    while($linea = mysqli_fetch_assoc($resultado)) {
                        $fechaCitaL = $linea['FechaCita'];
                        $horaCitaL = $linea['HoraCita'];
                    }
                    $_SESSION['notifi'][1] = "<p>Recordatorio: Tienes una cita el día " . $fechaCitaL . " a las " . $horaCitaL."</p>";
                }
            }
        }
    }

    define('BD_SRV', 'localhost');
    define('BD_USR', 'root');
    define('BD_CNT', '');
    define('BD_NMBR', 'nailsmirian');

    $bd = mysqli_connect(BD_SRV, BD_USR, BD_CNT, BD_NMBR);

    if($bd == false) {
        die("ERROR: No se ha podido conectar con la base de datos.");
    } else {
        // imprimirAConsola("Conectado correctamente");
    }

?>