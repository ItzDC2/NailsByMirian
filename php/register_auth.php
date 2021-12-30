<?php

require("./config.php");

$exito = false;

if (isset($_POST['regButton'])) {
    $nombre = $_REQUEST["iNombre"];
    $apellidos = $_REQUEST["iApellidos"];
    $email = $_REQUEST["iEmail"];
    $contra = ($_REQUEST["iContra"]);
    $contra2 = ($_REQUEST["iContra2"]);
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
            $contra = md5($contra);
            $contra2 = md5($contra2);
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                        $ruta = "../js/json/archivo.json";
                        $comentario = "Debes introducir un email válido.";
                        file_put_contents($ruta, json_encode($comentario), true);
                        $exito = false;
                        //Si no existe ya...
            // } else if()
            } else {
                    $fechaCrea = date("Y-m-d H:i:s");
                    $sql = "INSERT INTO Usuarios (Nombre, Apellidos, Email, Contra, FechaCrea) VALUES" . " ('" . $nombre . "', '" .
                        $apellidos . "'" . ", '" . $email . "', '" . $contra . "', '" . $fechaCrea . "');";
        
                    $resultado = mysqli_query($bd, $sql) or die(mysqli_error($bd));
        
                    if ($resultado) {
                        $exito = true;
                        $comentario = "<p>¡Te has registrado correctamente!</p>";
                        $_SESSION['iNombre'] = $nombre;
                    } else {
                        $exito = false;
                        echo "Error:" . $bd->connect_error;
                        die();
                    }
                } 
            
            // if ($contra == $contra2) {

            // } else {
            //     $comentario = "<p>Las contraseñas deben ser iguales</p>";
            // }
            // if (strlen($contra) >= 6 or strlen($contra2) >= 6) {
            // } else {
            //     $comentario = "<p>La longitud de la contraseña debe ser mayor de 6</p>";
            // }
        }
    } else {
        $exito = false;
        $comentario = "<p>Todos los apartados son obligatorios, por favor rellénelos.</p>";
        file_put_contents("../js/json/archivo.json", json_encode($comentario), true);
    }
}

mysqli_close($bd); 

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
    <link rel="icon" href="../imgs/nail-circled.png" type="image/x-icon"/>
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
                <div class="progress">
                    <div class="determinate" id="progreso" style="background-color: #0075ff;"></div>
                </div>
                <script>
                    function progress() {
                        var valor = 10;
                        var intervalo = setInterval(function() {
                            document.getElementById("progreso").css("width", valor + "%").attr("aria-valuenow", valor).text(valor + "%");
                            if (valor >= 100) {
                                clearInterval(intervalo);
                            }
                        }, 1000)
                    }
                </script>
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
                    if(empty($comentarioLocal)) {
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
        }
        $ruta = '../js/json/archivo.json';
        if(is_file($ruta)) {
            exec(sprintf('rd /s /q %s', $ruta));
        }
    ?>
    </div>
</body>

</html>