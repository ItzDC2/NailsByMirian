<?php 

    require_once ("config.php");

    session_start();

    $email = $_REQUEST["email"];
    $contra = $_REQUEST["contra"];

    if(isset($email) && isset($contra)) {
        $email = sanitizar($bd, $email);
        $email = stripslashes($email);
        $contra = sanitizar($bd, $contra);
        $contra = stripslashes($contra);
        $sql = "SELECT * FROM Usuarios WHERE email='$email' AND contra = '$contra'";
        $resultado = mysqli_query($bd, $sql) or die(mysqli_error($bd));
        $lineas = mysqli_num_rows($resultado);
        if($lineas == 1) {
            $_SESSION["logueado"] = true;
        } else {
            $comentario = "<p>Email o Contraseña Incorrectos</p>";
        }
    } else {
        $comentario = "<p>¡Todos los valores son necesarios!";
        die();
    }

?>