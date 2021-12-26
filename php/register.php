<?php

    $usuario = $contra1 = $contra2 = "";
    $errorUsuario = $errorContra = $errorContra2 = "";

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        if(empty(trim($_REQUEST["usuario"]))) {
            $errorUsuario = "Por favor, introduce un usuario.";
        } else if(!preg_match('/^[a-zA-Z0-9_]+$/', trim($_REQUEST["usuario"]))) {
            $errorUsuario = "El nombre de usuario solo puede contener letras, números y barras bajas.";
        } else if(strlen(trim($_REQUEST["usuario"])) > 16) {
            $errorUsuario = "El nombre de usuarios solo puede contener 16 caracteres.";
        } else {
            $sql = "SELECT BD_USN FROM Usuarios WHERE BD_USN = ?";
            if($stmt = mysqli_prepare($link, $sql)) {
                mysqli_stmt_bind_param($stmt, "s", $parametroUsuario);
                $parametroUsuario = trim($_REQUEST["usuario"]);
                if(mysqli_stmt_execute($stmt)) {
                    mysqli_stmt_store_result($stmt);
                    if(mysqli_stmt_num_rows($stmt) == 1) {
                        $errorUsuario = "Ese nombre de usuario ya existe.";
                    } else {
                        $usuario = trim($_REQUEST["usuario"]);
                    }
                }
            } else {
                echo "ERROR CRÍTICO: Algo fue mal, por favor, inténtalo de nuevo más tarde.";
            }
            mysqli_stmt_close($stmt);
        } 
    }

    if(empty(trim($_REQUEST["contra1"]))) {
        $errorContra = "Por favor introduzca una contraseña.";
    } else if(strlen(trim($_REQUEST["contra1"])) < 6) {
        $errorContra = "La contraseña debe tener como mínimo 6 caracteres.";
    } else {
        $contra1 = trim($_REQUEST["contra1"]);
    }

    if(empty(trim($_REQUEST["contra2"]))) {
        $errorContra = "Por favor confirme la contraseña.";
    } else {
        $contra2 = trim($_REQUEST["contra2"]);
        if(empty($errorContra) && ($contra1 != $contra2)) {
            $errorContra2 = "Las contraseñas no coinciden.";
        }
    }
    
    if(empty($errorUsuario) && empty($errorContra1) && empty($errorContra2)) {
        $sql = "INSERT INTO ";
        //AAAAAAA
        
    }
?>