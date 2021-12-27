<!DOCTYPE html>
<html lang="en" onload="cargarIconos()">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/estilosRegister.css">
    <link rel="icon" href="imgs/nail-circled.png" type="image/x-icon" />
    <script src="js/iconos.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <script src="js/scriptContraBasico.js"></script>
    <title>Regístrate</title>
</head>

<body>
    <?php 
        require('php/config.php');
    
        function sanitizar($bd, $datos) {
            return mysqli_real_escape_string($bd, $datos);
        }

        function estanOk($contra1, $contra2) {
            $resultado = false;
            if($contra1 == $contra2) {
                $resultado = true;
            } else if(!strlen($contra1) > 6 || !strlen($contra2)) {
                $resultado = false;
            }
        }

        if(isset($_REQUEST['usuario']) and estanOk($_REQUEST["contra"], $_REQUEST["contra2"])) {
            $usuario = stripslashes($_REQUEST["usuario"]);
            $usuario = sanitizar($link, $usuario);
            $email = stripslashes($_REQUEST["email"]);
            $email = sanitizar($link, $email);
            $contra = stripslashes($_REQUEST["contra"]);
            $contra = sanitizar($link, $contra);
            $fechaCrea = date("Y-m-d H:i:s");
            $sql = "INSERT INTO `Usuarios` (Nombre, Apellidos, Email, Contra, FechaCrea) 
                    VALUES ('$usuario', '" . md5($contra) . "', '$email', '$fechaCrea')";
            $resultado = mysqli_query($link, $sql);
            if($resultado) {
                echo "SUUUU";
            } else {
                echo "NOOOO";
            }
        } else {
    ?>
    <a href="index.html" class="alogo"><img src="imgs/nail.jpg" id="logo"></a>
    <div id="loginPanel">
        <form id="login" action="" method="post" onsubmit="validarContraBasico()">
            <h2>Crea tu cuenta</h2>
            <div id="elemento" class="nya">
                <div class="nombre">
                    <label for="nombre">Nombre <i class="bi bi-person-circle"></i></label>
                    <input type="text" id="nombre" name="nombre" required="true" placeholder="Introduzca su usuario"
                        class="nombre">
                </div>
                <div class="apellidos">
                    <label for="apellidos">Apellidos <i class="bi bi-person-circle"></i></label>
                    <input type="text" id="apellidos" name="apellidos" placeholder="Introduzca su(s) apellido(s)"
                        required="true" class="apellidos">
                </div>
            </div>
            <div id="elemento" class="demail">
                <label for="email">Correo electrónico <i class="bi bi-envelope"></i></label>
                <input type="email" id="email" name="email" placeholder="Introduzca su correo electrónico"
                    required="true" class="email">
            </div>
            <div id="elemento">
                <label for="contra">Contraseña <i class="bi bi-lock"></i></label>
                <input type="password" id="contra" name="contra" placeholder="Introduzca su contraseña" required="true">
            </div>
            <div id="elemento">
                <label for="contra2">Repite la contraseña <i class="bi bi-lock"></i></label>
                <input type="password" id="contra2" placeholder="Introduzca su contraseña" name="contra2"
                    required="true">
            </div>
            <div id="elemento">
                <input type="submit" value="enviar"></input>
            </div>
            <p>¿Ya tienes una cuena con nosotros? <a href="login.html">Inicia sesión aquí</a></p>
        </div>
    </form>
    <?php 
        }
    ?>
</body>
</html>