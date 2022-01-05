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
    <script src="js/cogerFechayHora.js"></script>
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
            <form action="php/cita_auth.php" id="formCita" class="col s12" method="post" onsubmit="window.location.href='php/cita_auth.php'">
                <div class="row">
                    <div class="col s6">
                        <label for="citaFecha">Escoja la fecha de su cita <i class="bi bi-calendar-date-fill"></i></label>
                        <input type="text" name="citaFecha" id="citaFechaI" class="datepicker" placeholder="Haga click aquí">
                    </div>
                    <div class="col s6">
                        <label for="citaFecha">Escoja la hora de su cita <i class="bi bi-clock-fill"></i></label>
                        <input type="text" name="citaFecha" id="citaFechaI" class="timepicker" placeholder="Haga click aquí">
                    </div>
                </div>
            </form>
        </div>
    <?php
    } else {
        header('Location: login.php');
    }

    ?>
</body>

</html>