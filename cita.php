<?php

session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="imgs/nail-circled.png" type="image/x-icon" />
    <link rel="stylesheet" href="css/estilosCita.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/css/materialize.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/js/materialize.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
<title>Pide Cita</title>
</head>

<body>
    <?php
    if ($_SESSION['logueado'] == true) {
    ?>
        <img src="imgs/nail.jpg" id="logo">
        <div class="container">
            <div class="card-panel col s12 center-align hoverable">
                <h3>Pide Cita Aquí</h3>
            </div>
            <form action="php/cita_auth.php" id="formCita" method="post" onsubmit="window.location.href='php/cita_auth.php'">
                <label for="citaFecha">Escoja la fecha de su cita <i class="bi bi-calendar-date-fill"></i></label>
                <input type="text" name="citaFecha" id="citaFechaI" class="datepicker" placeholder="Haga click aquí">
                <script>
                    $(document).ready(function() {
                        $('.datepicker').datepicker({
                            firstDay: 0,
                            format: 'dd-mm-yyyy',
                            today: 'hoy',
                            clear: 'Limpiar',
                            close: 'Ok',
                            cancel: 'Cancelar',
                            selectYears: 1,
                            selectMonths: true,
                            labelMonthNext: 'Siguiente mes',
                            labelMonthPrev: 'Mes anterior',
                            labelMonthSelect: 'Selecciona un mes',
                            labelYearSelect: 'Selecciona un año',
                            i18n: {
                                months: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre",
                                        "Noviembre", "Diciembre"],
                                monthsShort: ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"],
                                weekdays: ["Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado"],
                                weekdaysShort: ["Dom", "Lun", "Mar", "Mie", "Jue", "Vie", "Sab"],
                                weekdaysAbrrev: ["D", "L", "M", "X", "J", "V", "S"]
                            }
                        });
                    })
                </script>
            </form>
        </div>
    <?php
    } else {
        header('Location: login.php');
    }

    ?>
</body>

</html>