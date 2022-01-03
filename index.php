<?php
require_once "php/config.php";
// include "php/register_auth.php";
// error_reporting(0);
session_start();
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/estilosIndex.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <link rel="icon" href="imgs/nail-circled.png" type="image/x-icon" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script src="js/show.js"></script>
    <title>MirianNails</title>
</head>

<body>
    <img src="imgs/nail.jpg" id="logo">
    <div class="navegacion">
        <ul type="none">
            <li><a href="#">Pide Cita</a></li>
            <li><a href="#">Contáctanos</a></li>
            <li><a href="#">Conócenos</a></li>
            <?php
            // session_start();
            $doc = "login.php";
            if (!$_SESSION['logueado']) {
                echo "<li><a href='$doc'>Inicia Sesión</a></li>";
            } else {
                echo "</ul>";
            ?>
            <div class="container">
                <div class="card-panel col s6 m6 center-align hoverable" id="comentarioNombre">
                    <p>
                        <?php
                        echo "¡Bienvenid@ " . $_SESSION['nombre'] . "!";
                        ?>
                    </p>
                </div>
            </div>
                <div id="divCS">
                    <i class="bi bi-gear" id="opciones" onclick="show()"></i>
                    <ul type="none" id="listaShow" style="visibility: hidden;">
                        <li onclick="window.location.href='php/logout.php'">Cerrar Sesión</li>
                    </ul>
                </div>
            <?php
            }
            ?>
        </ul>
        <div class="container">
            <div class="row">
                <div class="card-panel col s12 m6 hoverable" id="col1">
                    <p>
                        Lorem ipsum dolor sit amet consectetur adipisicing elit.
                        Omnis ut iure, ea, nisi sapiente dolorem facilis neque itaque
                        ad tempora earum ex quidem. Dignissimos perspiciatis modi asperiores, suscipit minima maiores iure
                        tempora esse. Animi, possimus mollitia labore dolor impedit temporibus ipsum hic neque cumque nesciunt
                        debitis
                        ea! Numquam, dolorum fugiat. 1
                    </p>
                </div>
                <div class="card-panel col s12 m6 hoverable" id="col2">
                    <p>
                        Lorem ipsum, dolor sit amet consectetur adipisicing elit.
                        Nihil eligendi laudantium deleniti minima et quia ab reprehenderit
                        vel maxime quibusdam voluptates dolorem amet culpa quos dolor quisquam,
                        cum ex fugit repellendus autem maiores, iure molestias!
                        Voluptates odio culpa illo at praesentium harum
                        rerum blanditiis ipsam, porro omnis, quos doloremque inventore. 2
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="card-panel col s12 m6 hoverable" id="col3">
                    <p>
                        Lorem ipsum dolor sit amet consectetur adipisicing elit.
                        Omnis ut iure, ea, nisi sapiente dolorem facilis neque itaque
                        ad tempora earum ex quidem. Dignissimos perspiciatis modi asperiores, suscipit minima maiores iure
                        tempora esse. Animi, possimus mollitia labore dolor impedit temporibu ipsum hic neque cumque nesciunt
                        debitis
                        ea! Numquam, dolorum fugiat. 3
                    </p>
                </div>
                <div class="card-panel col s12 m6 hoverable" id="col4">
                    <p>
                        Lorem ipsum, dolor sit amet consectetur adipisicing elit.
                        Nihil eligendi laudantium deleniti minima et quia ab reprehenderit
                        vel maxime quibusdam voluptates dolorem amet culpa quos dolor quisquam,
                        cum ex fugit repellendus autem maiores, iure molestias!
                        Voluptates odio culpa illo at praesentium harum
                        rerum blanditiis ipsam, porro omnis, quos doloremque inventore. 4
                    </p>
                </div>
            </div>
        </div>
    </div>
</body>

</html>