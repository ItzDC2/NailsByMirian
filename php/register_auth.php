<?php 

    require("./config.php");

    function sanitizar($bd, $datos) {
        return mysqli_real_escape_string($bd, $datos);
    }

    function estanOk($contra1, $contra2) {
        $resultado = false;
        if($contra1 == $contra2) {
            $resultado = true;
            $comentario = "";
        } else  {
            $resultado = false;
            $comentario = "<p>Las contraseñas deben ser iguales</p>";
        } 
        if(!strlen($contra1) >= 6 || !strlen($contra2) >= 6) {
            $resultado = true;
            $comentario = "";
        } else {
            $resultado = false;
            $comentario = "<p>La longitud de la contraseña debe ser mayor que 6</p>";
        }
    }

    // $nombre = $_REQUEST["iNombre"];
    // $apellidos = $_REQUEST["iApellidos"];
    // $email = $_REQUEST["iEmail"];
    // $contra = $_REQUEST["iContra"];

    $exito = false;

    $nombre = "Test";
    $apellidos = "Test";
    $email = "test@test.com";
    $contra = "1234";

    if(isset($nombre) && isset($apellidos) && isset($email) && isset($contra) && isset($contra2)) {
        $nombre = stripslashes($nombre);
        $nombre = sanitizar($bd, $nombre);
        $apellidos = stripslashes($apellidos);
        $apellidos = sanitizar($bd, $apellidos);
        $email = stripslashes($email);
        $email = sanitizar($bd, $email);
        $contra = md5($contra);
        $contra2 = md5($contra2);

        $fechaCrea = date("Y-m-d");

        $sql = "INSERT INTO Usuarios (Nombre, Apellidos, Email, Contra, FechaCrea) VALUES". " ('" . $nombre . "', '" .
        $apellidos. "'" . ", '" . $email . "', '" . $contra . "', " . $fechaCrea . ");";

        $resultado = mysqli_query($bd, $sql) or die(mysqli_error($bd));

        if ($resultado) {
            $exito = true;
            $comentario = "<p>¡Te has registrado correctamente!</p>";
            // sleep(7);
            // header('Location: ../register.php');
        } else {
            echo "Error:" . $bd -> connect_error;
                die();
        }
    } else {
        $comentario = "<p>Todos los apartados son obligatorios, por favor rellénelos.</p>";
        die();
    }
    mysqli_close($bd); //substr($comentario, 3, -4)
    imprimirAConsola($comentario);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <link rel="stylesheet" href="css/estilosAuthRegister.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <title>Registrándote...</title>
</head>
<body>
    <div id="comentarioPHP" class="col s6 offset-s3 card-panel hoverable" style="visibility: visible; position: fixed; width: 46%; height: auto; margin: 0 auto; z-index: 1">
        <?php 
            if($exito) {  
                echo $comentario; 
                for($i = 5; $i >= 0; $i--) {
                    echo "Serás redirigido en " . $i . " segundos.";
                    if($i == 1) {
                        echo "Serás redirigido en " . 1 . " segundo.";    
                    }
                    if($i == 0) {
                        $scriptWait = '<script>setTimeout(function() {
                            window.location.href="../index.php"}, 2 * 1000);
                            </script>';
                            echo $scriptWait;
                    }
                }
            ?>
            <form>
                <button type="submit" class="btn waves-effect blue">Aceptar <i class="bi bi-box-arrow-in-right"></i></button>
            </form>
        <?php
            }
        ?>
    </div>
</body>
</html>