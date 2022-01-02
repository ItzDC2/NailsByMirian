<?php 

    error_reporting(0);

    require_once ("config.php");

    function escribirError($error) {
        $ruta = "../js/json/archivoErrorL.json";
        file_put_contents($ruta, json_encode($error), true); 
    }

    function sanitizar($bd, $datos) {
        return mysqli_real_escape_string($bd, $datos);
    }
    
    function sanitizar2($datos) {
        return htmlspecialchars($datos);
    }

    $email = $_REQUEST["iEmail"];
    $contra = md5($_REQUEST["iContra"]);

    if(!(empty($email) && !(empty($contra)))) {
        $email = sanitizar($bd, $email);
        $email = sanitizar2($email);
        $email = stripslashes($email);
        $contra = sanitizar($bd, $contra);
        $contra = sanitizar2($contra);
        $contra = stripslashes($contra);
        $sql = "SELECT * FROM Usuarios WHERE email='$email' AND contra = '$contra'";
        $resultado = mysqli_query($bd, $sql) or die(mysqli_error($bd));
        $lineas = mysqli_num_rows($resultado);

        if($lineas != 0) {
            $nombreSQL = "SELECT Nombre FROM Usuarios WHERE (Email='$email')";
            session_start();
            $logueado = true;
            $exito = true;
            $lineasNombre = mysqli_num_rows(mysqli_query($bd, $nombreSQL));
            if($lineasNombre != 0) {
                $nombre = $nombreSQL;
            }
        if($lineas == 1) {
            $_SESSION["logueado"] = true;
        } else {
            $comentario = "<p>Email o Contraseña Incorrectos</p>";
            escribirError($comentario);
            $exito = false;
        }
    } else {
        $comentario = "<p>¡Todos los valores son necesarios!";
        escribirError($comentario);
        $exito = false;
    }

mysqli_close($bd);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../imgs/nail-circled.png" type="image/x-icon"/>
    <link rel="stylesheet" href="../css/estilosAuthRegister.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script src="../js/progress.js"></script>
    <title>Iniciando Sesión...</title>
</head>
<body onload="progress()">
<a href="../index.php" class="alogo"><img src="../imgs/nail.jpg" id="logo"></a>
    <script>

    </script>
    <div class="row">
        <div id="comentarioPHP" class="col s6 offset-s3 card-panel center-align">
            <p>
                <span id="texto">¡Has iniciado sesión correctamente!<br>
                    Serás redireccionad@ a la página principal en <span id="tiempo"></span> <span id="secs">segundos</span>...</span>
            </p>
            <?php

            //if ($exito)...
            if ($exito) {
                session_start();
                $_SESSION['logueado'] = true;
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
                    $comentarioLocal = json_decode(file_get_contents("../js/json/archivoErrorL.json"), true);
                    if(empty($comentarioLocal)) {
                        //nada pasa...
                    } else {
                        $comentarioError = $comentarioLocal;
                        echo $comentarioError;
                    }
                    
                
                ?>
            </p>
            <button type="submit" class="btn waves-effect" id="errorBtn" onclick="window.location.href='../login.php'">Volver <i class="bi bi-box-arrow-in-left"></i></button>
        </div>
    <?php
        }
    ?>
    </div>
</body>
</html>