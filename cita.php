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
            <div id="fecha-cita" class="md-form md-outline input-with-post-icon datepicker">
                <input type="text" name="fecha-citaI" id="fecha-citaI" placeholder="Selecciona la fecha" class="form-control">
                <label for="fecha-citaI">Fechas</label>
            </div>
            <label for="FechaCita">Fecha de la Cita <i class="bi bi-calendar-date"></i></label>
        </div>
    <?php
    } else {
        header('Location: login.php');
    }

    ?>
</body>

</html>