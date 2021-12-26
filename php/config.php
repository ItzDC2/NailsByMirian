<?php 

    define('BD_SRV', 'localhost');
    define('BD_USR', 'root');
    define('BD_CNT', '');
    define('BD_NMBR', 'nailsmirian');

    $link = mysqli_connect(BD_SRV, BD_USR, BD_CNT, BD_NMBR);

    if($link == false) {
        die("ERROR: No se ha podido conectar con la base de datos.");
    }

?>