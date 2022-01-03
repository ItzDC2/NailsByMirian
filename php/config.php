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

    function imprimirAConsola($salida, $con_tags_de_scripts = true) {
        $js_code = 'console.log(' . json_encode($salida, JSON_HEX_TAG) . ');';
        if($con_tags_de_scripts) {
            $js_code = '<script>' . $js_code . '</script>';
        }       
        echo $js_code; 
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