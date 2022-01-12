<?php
require_once ("./config.php");
error_reporting(0);
session_start();

function sanitizar($bd, $datos) {
    return mysqli_real_escape_string($bd, $datos);
}

function sanitizar2($datos) {
    return htmlspecialchars($datos);
}

function estanOk($contra1, $contra2) {
    $ruta = "../js/json/archivo.json";
    $resultado = false;
    if($contra1 != $contra2) {
        $exito = false;
        $resultado = false;
        $comentario = "<p>Las contraseñas deben ser iguales</p>";
        file_put_contents($ruta, json_encode($comentario), true);
    } else if(strlen($contra1) < 6 || strlen($contra2) < 6) {
        $resultado = false;
        $exito = false;
        $comentario = "<p>La longitud de la contraseña debe ser mayor que 6.</p>";
        file_put_contents($ruta, json_encode($comentario), true);
    } else {
        $resultado = true;
        $exito = true;
        $comentario = "";
    }   
    return $resultado;
}

function escribirComentario($comentario) {
    $ruta = "../js/json/archivo.json";
    file_put_contents($ruta, json_encode($comentario), true);
}

    $exito = false;

    if(!$_SESSION['logueado']) {
        if (isset($_POST['regButton'])) {
            $nombre = $_REQUEST["iNombre"];
            $apellidos = $_REQUEST["iApellidos"];
            $email = $_REQUEST["iEmail"];
            $contra = md5($_REQUEST["iContra"]);
            $contra2 = md5($_REQUEST["iContra2"]);
            if (!empty($nombre) && !empty($apellidos) && !empty($email) && !empty($contra) && !empty($contra2)) {
                if (estanOk($contra, $contra2)) {
                    $nombre = stripslashes($nombre);
                    $nombre = sanitizar($bd, $nombre);
                    $nombre = sanitizar2($nombre);
                    $apellidos = stripslashes($apellidos);
                    $apellidos = sanitizar($bd, $apellidos);
                    $apellidos = sanitizar2($apellidos);
                    $email = stripslashes($email);
                    $email = sanitizar($bd, $email);
                    $email = sanitizar2($email);
                    $sqlEmail = mysqli_query($bd, "SELECT * FROM Usuarios WHERE (Email ='$email')");
                    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                                $ruta = "../js/json/archivo.json";
                                $comentario = "<p>Debes introducir un email válido.</p>";
                                escribirComentario($comentario);
                                //Si no existe ya...
                    } else if(mysqli_num_rows($sqlEmail) != 0) {
                        $ruta = "../js/json/archivo.json";
                        $comentario = "<p>Ese correo ya está asignado a otro usuario.</p>";
                        escribirComentario($comentario);
                    } else {
                            $fechaCrea = date("Y-m-d H:i:s");
                            $sql = "INSERT INTO Usuarios (Nombre, Apellidos, Email, Contra, FechaCrea) VALUES" . " ('" . $nombre . "', '" .
                                $apellidos . "'" . ", '" . $email . "', '" . $contra . "', '" . $fechaCrea . "');";
                
                            $resultado = mysqli_query($bd, $sql) or die(mysqli_error($bd));
                
                            if ($resultado) {
                                $exito = true;
                                $_SESSION['logueado'] = true;
                                $_SESSION['email'] = $email;
                                $comentario = "<p>¡Te has registrado correctamente!</p>";
                                escribirComentario($comentario);
                            } else {
                                $exito = false;
                                echo "Error:" . $bd->connect_error;
                                die();
                            }
                        } 
                }
            } else {
                $exito = false;
                $comentario = "<p>Todos los apartados son obligatorios, por favor rellénelos.</p>";
                escribirComentario($comentario);
            }
        }
    } else {
        header('Location: ../index.php');
    }
    
    mysqli_close($bd); 
?> 
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <link rel="stylesheet" href="../css/estilosAuthRegister.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <link rel="icon" href="../imgs/nail-circled.png" type="image/x-icon" />
    <script src="../js/aceptar.js"></script>
    <script src="../js/progress.js"></script>
    <title>Registrándote...</title>
</head>

<body onload="progress()">
    <a href="../index.php" class="alogo"><img src="../imgs/nail.jpg" id="logo"></a>
    <script>

    </script>
    <div class="row">
        <div id="comentarioPHP" class="col s6 offset-s3 card-panel center-align">
            <p>
                <span id="texto">¡Te has registrado correctamente!<br>
                    Serás redireccionad@ a la página principal en <span id="tiempo"></span> <span id="secs">segundos</span>...</span>
            </p>
            <?php

            //if ($exito)...
            if ($exito) {
                $_SESSION['nombre'] = $nombre;
                $_SESSION['logueado'] = true;
                $_SESSION['notifi'][0] = "<p>¡Te has registrado correctamente!</p>";
            ?>
                <script>
                    var tiempoRestante = 10;
                    var tiempoDescarga = setInterval(function() {
                        document.getElementById("tiempo").textContent = tiempoRestante;
                        // document.getElementById("progreso").value = 10 - tiempoRestante;
                        if (tiempoRestante == 1) {
                            document.getElementById("secs").textContent = "segundo";
                        }
                        if (tiempoRestante == 0) {
                            document.getElementById("texto").textContent = "Redireccionando..."
                            window.location.href = "../index.php"
                            clearInterval(tiempoDescarga)
                        }
                        tiempoRestante--;
                    }, 1000);
                </script>
                <div class="progress col s6 offset-s3" style="width: 50%">
                        <div class="determinate" id="progreso" style="background-color: #0075ff;"></div>
                </div>
                <!-- <progress value=0 max=10 id="progreso" onload="progress()"></progress> -->
                <div class="row">
                    <br>
                    <div class="col s6 offset-s3">
                        <button type="submit" class="btn waves-effect" id="aceptarBtn" onclick="window.location.href='../index.php'">Aceptar <i class="bi bi-box-arrow-in-right"></i></button>
                    </div>
                </div>
        </div>
    <?php
            } else {
    ?>
        <div id="errorPHP" class="col s6 offset-s3 card-panel center-align hoverable" style="padding: 10px; border: 1px solid red;">
            <script>
                document.getElementById("errorPHP").style.visibility = 'visible';
                document.getElementById("comentarioPHP").style.visibility = 'hidden';
            </script>
            <p>
                Error: <br>
                <?php
                $comentarioLocal = json_decode(file_get_contents("../js/json/archivo.json"), true);
                if (empty($comentarioLocal)) {
                    //nada pasa...
                } else {
                    $comentarioError = $comentarioLocal;
                    echo $comentarioError;
                }


                ?>
            </p>
            <button type="submit" class="btn waves-effect" id="errorBtn" onclick="window.location.href='../register.php'">Volver <i class="bi bi-box-arrow-in-left"></i></button>
        </div>
    <?php
            mysqli_close($bd);
            }
    ?>
    </div>
</body>

</html>