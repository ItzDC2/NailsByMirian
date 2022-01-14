<?php 

    $patron9 = '{09:\d\d\sPM}';
    $fechaCita = date('2022-01-14');
    $hora = "09:45 PM";
    if(preg_match($patron9, $hora)) {
        $resultado = true;
        $mins = date('i', strtotime($hora));
        $hora = date('H:' . $mins . ':s', strtotime($hora));
        echo $hora;
        echo var_dump($resultado);
    }

    $hora = date('H:i:s', strtotime($hora));
    echo $hora;
    if($hora >= date('09:00:00') && $hora <= date('14:00:00')) {
        echo '<br>'. "Furula";
    } else if($hora > date('H:i:s') && date('Y-m-d') > $fechaCita) {
        echo '<br>'."Cita enviada";
    } else {
        echo '<br>'."Cagaste reina";
    }

?>