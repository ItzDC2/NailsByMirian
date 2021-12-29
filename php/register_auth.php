<?php

require("./config.php");

$nombre = "";
$apellidos = "";
$email = "";
$contra = "";
$contra2 = "";

$nombre = "Test";
$apellidos = "Test";
$email = "Test";
$contra = "Test";
$contra2 = "Test";

// if (isset($_POST['regButton'])) {
//     $nombre = $_REQUEST["iNombre"];
//     $apellidos = $_REQUEST["iApellidos"];
//     $email = $_REQUEST["iEmail"];
//     $contra = $_REQUEST["iContra"];
//     $contra2 = $_REQUEST["iContra2"];
// } else {
//     $comentario = "¡Todos los apartados son obligatorios!";
//     $exito = false;
// }

function sanitizar($bd, $datos)
{
    return mysqli_real_escape_string($bd, $datos);
}

function estanOk($contra1, $contra2)
{
    $resultado = false;
    if ($contra1 == $contra2) {
        $resultado = true;
        $comentario = "";
    } else {
        $resultado = false;
        $comentario = "<p>Las contraseñas deben ser iguales</p>";
    }
    if (!strlen($contra1) >= 6 || !strlen($contra2) >= 6) {
        $resultado = true;
        $comentario = "";
    } else {
        $resultado = false;
        $comentario = "<p>La longitud de la contraseña debe ser mayor que 6</p>";
    }
}

$exito = false;

if (isset($nombre) && isset($apellidos) && isset($email) && isset($contra) && isset($contra2)) {
    if (estanOk($contra, $contra2)) {
        $nombre = stripslashes($nombre);
        $nombre = sanitizar($bd, $nombre);
        $apellidos = stripslashes($apellidos);
        $apellidos = sanitizar($bd, $apellidos);
        $email = stripslashes($email);
        $email = sanitizar($bd, $email);
        $contra = md5($contra);
        $contra2 = md5($contra2);

        $fechaCrea = date("Y-m-d");

        $sql = "INSERT INTO Usuarios (Nombre, Apellidos, Email, Contra, FechaCrea) VALUES" . " ('" . $nombre . "', '" .
            $apellidos . "'" . ", '" . $email . "', '" . $contra . "', " . $fechaCrea . ");";

        $resultado = mysqli_query($bd, $sql) or die(mysqli_error($bd));

        if ($resultado) {
            $exito = true;
            $comentario = "<p>¡Te has registrado correctamente!</p>";
        } else {
            $exito = false;
            echo "Error:" . $bd->connect_error;
            die();
        }
    } else {
        $comentario = "<p>Las contraseñas no coinciden</p>";
        $exito = false;
    }
} else {
    $exito = false;
    $comentario = "<p>Todos los apartados son obligatorios, por favor rellénelos.</p>";
    die();
}
mysqli_close($bd); //substr($comentario, 3, -4)
// imprimirAConsola($comentario);

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
    <script src="js/aceptar.js"></script>
    <title>Registrándote...</title>
</head>

<body>
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
            if ($exito) {  ?>
                <script>
                    var tiempoRestante = 10;
                    var tiempoDescarga = setInterval(function() {
                        document.getElementById("tiempo").textContent = tiempoRestante;
                        document.getElementById("progreso").value = 10 - tiempoRestante;
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
                <progress value=0 max=10 id="progreso"></progress>
                <div class="row">
                    <br>
                    <div class="col s6 offset-s3">
                        <button type="submit" class="btn waves-effect" id="aceptarBtn" onclick="redireccion()">Aceptar <i class="bi bi-box-arrow-in-right"></i></button>
                    </div>
                </div>
        </div>
    <?php
            } else {
    ?>
        <div id="errorPHP" class="col s6 offset-s3 card-panel center-align">
            <script>
                document.getElementById("errorPHP").style.visibility = 'visible';
                document.getElementById("comentarioPHP").style.visibility = 'hidden';
            </script>
            <p>
                Error <?php echo $comentario ?>
            </p>
            <button type="submit" class="btn waves-effect" id="errorBtn" onclick="window.location.href='./register_auth.php'">Volver <i class="bi bi-box-arrow-in-left"></i></button>
        </div>
    <?php
            }
    ?>
    </div>
</body>

</html>