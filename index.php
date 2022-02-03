<?php
require_once "php/config.php";
session_start();

function estaOkFechaI($fechaCita) {
    $hoy = date('Y-m-d');
    $fechaCita = date('Y-m-d', strtotime($fechaCita));
    return $hoy <= $fechaCita;
}

function borrarCitaI($bd, $fechaCita, $email) {
    if(!estaOkFechaI($fechaCita)) {
        $delete = "DELETE * FROM Citas WHERE FechaCita = '" .  date('Y-m-d', strtotime($fechaCita)) . "' AND Email = '" . $email . "'";
        $resultado = $bd->query($delete);
    }
}

function sqlComprobarCita($bd, $fechaCita, $horaCita, $email, $nLinea) { 
    $query = "SELECT * FROM Citas WHERE FechaCita = '" . $fechaCita . "'" . " AND HoraCita = '" . $horaCita . "'";
    $resultado = $bd->query($query);
    $lineas = $resultado->num_rows;
    if($lineas != 0) {
        $hoy = date('Y-m-d');
        if($hoy > $fechaCita) {
            $queryDelete = "DELETE FROM Citas WHERE FechaCita = '" . $fechaCita . "'" . " AND HoraCita = '" . $horaCita . "'" . " AND Email = '" . $email . "'";
            $resultadoDelete = $bd->query($queryDelete);
            if($resultadoDelete) {
                unset($_SESSION['notifi'][$nLinea]);
            }
        } else if($fechaCita <= $hoy) {
            $queryComprobar = "SELECT * FROM Citas WHERE Email = '" . $_SESSION['Email'] . "'";
            $resultado = $bd->query($queryComprobar);
            $lineas = $resultado->num_rows;
            if($lineas != 0) {
                while($linea = mysqli_fetch_assoc($resultado)) {
                    $fechaCitaL = $linea['FechaCita'];
                    $horaCitaL = $linea['HoraCita'];
                }
                $_SESSION['notifi'][$nLinea] = "<p>Recordatorio: Tienes una cita el día " . date('d-m-Y',  strtotime($fechaCita)) . " a las " . date('h:i ' . strtoupper('a'),  strtotime($horaCita)) ."</p>";               
             }
        }
    }
}
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
    <link href="https://fonts.googleapis.com/css2?family=Material+Icons" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="js/show.js"></script>
    <script defer src="js/temas.js"></script>
    <title>MirianNails</title>
</head>

<body class="oscuro">
    <img src="imgs/nail.jpg" id="logo">
    
    <div class="navegacion col s12 m6">
        <ul type="none" id="enlaces">
            <li class="cita"><a href="cita">Pide Cita</a></li>
            <li class="contacto"><a href="#">Contáctanos</a></li>
            <li class="conocenos"><a href="#">Conócenos</a></li>
            <?php
            $doc = "login";
            if (!$_SESSION['logueado']) {
                echo "<li class='iniciaSesion'><a href='$doc'>Inicia Sesión</a></li>";
            } else {
                echo "</ul>";
            ?>
                <?php
                if ($_SESSION['Email'] == 'mirianencandelaria@gmail.com' || $_SESSION['Email'] == 'donovancf12380@gmail.com') {
                ?> 
                    <div class="card-panel hoverable valign-wrapper" id="panel">
                        <i class="bi bi-shield-check" id="iconoAdmin" style="padding: 10px 5px; text-decoration: none; font-style: normal;"> Panel de Administración</i> 
                    </div>
                    <script>
                        var intervalo = setInterval(() => {
                            if(window.innerWidth <= 460) {
                            $("#iconoAdmin").text("")
                            } else {
                                $("#iconoAdmin").text(" Panel de Administración")
                            }
                        }, 1)
                        var panel = document.getElementById("panel");
                        panel.onclick = function() {
                            window.open("b09c600fddc573f117449b3723f23d64/b09c600fddc573f117449b3723f23d64", '_blank')
                        }
                    </script>
                <?php
                }
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
                    <i class="bi bi-bell" id="notificaciones" onclick="showNotificaciones()"></i>
                    <span class="punto" id="puntoNotificaciones" onclick="showNotificaciones()"></span>
                    <script type="text/javascript">
                        var clicks = 0;
                        var clickeado;

                        function showNotificaciones() {
                            var punto = document.getElementById("puntoNotificaciones")
                            var listaNotificaciones = document.getElementById("listaNot");
                            var campana = document.getElementById("notificaciones");
                            if (clicks == 0) {
                                if (clickeado == true) {
                                    punto.style.visibility = 'hidden'
                                } else {
                                    punto.style.visibility = 'visible'
                                }
                                punto.style.visibility = 'hidden'
                                listaNotificaciones.style.visibility = 'visible';
                                campana.className = "bi bi-bell-fill seleccionado"
                                clickeado = true
                                clicks++;
                            } else {
                                listaNotificaciones.style.visibility = 'hidden';
                                campana.className = "bi bi-bell"
                                clicks = 0;
                            }

                        }

                    </script>
                </div>
                <ul class="collection with-header hoverable" id="listaNot">
                    <li class="collection-header">
                        <h4>Notificaciones</h4>
                    </li>
                    <?php 
                    $email = $_SESSION['Email'];
                    $queryCambios = "SELECT Descripcion FROM Cambios WHERE Email = '" . $email . "'";
                    $resultado = $bd->query($queryCambios);
                    $lineas = $resultado->num_rows;
                    if($lineas != 0) {
                        while($linea = $resultado->fetch_assoc()) {
                            $_SESSION['notifi'][200] = $linea['Descripcion'];
                        }
                    } else {
                        unset($_SESSION['notifi'][200]);
                    }
                    if(!empty($_SESSION['notifi'][200])) {
                        ?>
                        <li class="collection-item">
                            <?php 
                            echo $_SESSION['notifi'][200];
                            $queryDelete = "DELETE FROM Cambios WHERE Email = '" . $email . "'";
                            $bd->query($queryDelete);
                            unset($_SESSION['notifi'][200]);
                            ?>
                        </li>
                    <?php 
                    }
                    if(!empty($_SESSION['notifi'][201])) {
                        ?>
                        <li class="collection-item">
                            <?php 
                            echo $_SESSION['notifi'][201];
                            unset($_SESSION['notifi'][201]);
                            ?>
                        </li>
                    <?php 
                    }
                    if(!empty($_SESSION['notifi'][103])) {
                        ?>
                        <li class="collection-item">
                                <?php echo $_SESSION['notifi'][103]; 
                                    unset($_SESSION['notifi'][103]);
                                ?>
                            </li>
                        <?php 
                    }
                    if(!empty($_SESSION['notifi'][102])) {
                        ?>
                        <li class="collection-item">
                                <?php echo $_SESSION['notifi'][102]; ?>
                            </li>
                        <?php 
                    }
                    ?>
                    <?php
                    $numerosCitaQuery = "SELECT NumeroCitas FROM Citas Where Email = '" . $_SESSION['Email'] . "'";
                    $resultadoQueryNCita = $bd->query($numerosCitaQuery);
                    $lineasNC = $resultadoQueryNCita->num_rows;
                    if($lineasNC != 0) { 
                        while($linea = $resultadoQueryNCita->fetch_assoc()) {
                            $nCitas = (int) $linea['NumeroCitas'];
                        }
                        $i = 0;
                        while ($i < $nCitas) {
                            $query = "SELECT * FROM Citas WHERE Email = '" . $_SESSION['Email'] . "'";
                            $resultado = $bd->query($query);
                            $lineas = $resultado->num_rows;
                            if ($lineas != 0) { 
                                while($linea = $resultado->fetch_assoc()) {
                                    $fechaCita = $linea['FechaCita'];
                                    $horaCita = $linea['HoraCita'];
                                    $email = $linea['Email'];
                                    borrarCitaI($bd, $fechaCita, $email);
                                    sqlComprobarCita($bd, $fechaCita, $horaCita, $_SESSION['Email'], $i);
                                    $_SESSION['notifi'][$i] = "<p>Recordatorio: Tienes una cita el día " . date('d-m-Y', strtotime($fechaCita)) . " a las " . date('h:i ' . strtoupper('a'), strtotime($horaCita)) . "</p>";
                                    ?>
                                <li class="collection-item">
                                    <?php 
                                    echo $_SESSION['notifi'][$i];
                                    ?>
                                </li>
                                <?php
                                $i++;
                                }
                            }
                        }
                    } else {
                    ?>
                    <li class="collection-item">
                        <?php echo "No tienes notificaciones nuevas."; ?>
                    </li>
                    <?php 
                    }
                    ?>
                </ul>
                <ul class="collection" id="listaShow" style="visibility: hidden;">
                    <li class="collection-item" onclick="window.location.href='php/logout'">Cerrar sesión</li>
                </ul>
                <?php 
            } //ciere del ELSE 
                 ?>
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