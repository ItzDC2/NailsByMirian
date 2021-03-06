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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/js/materialize.min.js"></script>
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
    <div id="logoDiv">
        <a href="index"><img src="imgs/nail.jpg" id="logo"></a>
    </div>
        <form action="php/cita_auth" id="formCita" class="col s12" method="post" onsubmit="window.location.href='php/cita_auth'">
            <div class="container">
                <div class="card-panel col s12 center-align hoverable">
                    <h3>Pide Cita Aquí <?php echo ucfirst($_SESSION['nombre']) ?></h3>
                    <h5><u>Nuestro horario laboral es de 09:00 a 14:00 y de 17:00 a 20:00</u></h5>
                </div>
                <div class="row">
                    <div class="col s6">
                        <label for="citaFechaI">Escoja la fecha de su cita <i class="bi bi-calendar-date-fill"></i></label>
                        <input type="text" name="citaFechaI" id="citaFechaI" class="datepicker" placeholder="Haga click aquí" required>
                    </div>
                    <div class="col s6">
                        <label for="citaHoraI">Escoja la hora de su cita <i class="bi bi-clock-fill"></i></label>
                        <input type="text" name="citaHoraI" id="citaHoraI" class="timepicker" placeholder="Haga click aquí" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col s12 input-field">
                        <label for="descripcionI">Breve descripción del set a realizar.</label>
                        <input type="text" name="descripcionI" id="descripcionI" required> 
                    </div>
                </div>
            </div>
            <div class="row">
                <div id="enviarCitaDiv">
                    <button type="submit" id="enviarCita" class="waves-effect waves-light btn">¡Pide Cita! <i class="bi bi-box-arrow-in-right"></i></button>
                </div>
            </div>
        </form>
    <?php
    } else {
        header('Location: login');
    }
    ?>
</body>

</html>