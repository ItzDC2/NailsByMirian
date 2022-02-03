<?php

session_start();
if (session_destroy()) {
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <link rel="icon" href="../imgs/nail-circled.png" type="image/x-icon" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
        <link rel="stylesheet" href="../css/estilosLogin.css">
        <script src="../js/espera.js"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">

        <title>Cerrando Sesión</title>
    </head>

    <body onload="espera()">
        <div class="container">
            <div id="cerrarSesion" id="logout" class="col s6 offset-s3 card-panel center-align" style="margin: 25px 25px;">
                <p>
                    Has cerrado sesión correctamente.
                </p>
                <button type="submit" class="btn waves-effect" onclick="window.location.href='../index'">ACEPTAR <i class="bi bi-box-arrow-in-left"></i></i></button>
            </div>
        </div>
    </body>

    </html>
<?php
}

?>