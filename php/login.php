<?php
  define('SERV_BD', 'localhost');
  define('BD_USN', 'root');
  define('BD_PASS', '');
  define('BD_NOM', 'nailsmirian');  

  $link = mysqli_connect(SERV_BD, BD_USN, BD_PASS, BD_NOM);

  if($link == false) {
      die("ERROR: No se pudo conectar con la base de datos " . mysqli_connect_error());      
  } else {
      
  }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/estilosLogin.css">
    <link rel="icon" href="imgs/nail-circled.png" type="image/x-icon" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="js/validarContraseñas.js"></script>
    <title>Regístrate</title>
</head>
<body>
    <a href="index.html"><img src="imgs/nail.jpg" id="logo"></a>
    <div id="loginPanel">
        <form id="login" action="php/register.php" method="post" onsubmit="validarContraseñas()">
            <h2>Crea tu cuenta</h2>
            <div id="elemento">
                <label for="usuario"><i class="bi bi-person-circle"></i>Usuario / Correo Electrónico</label>
                <input type="text" id="usuario" name="usuario" required="true">
            </div>
            <div id="elemento">
                <label for="contra">Contraseña</label>
                <input type="password" id="contra" name="contra" placeholder="" required="true">
            </div>
            <div id="elemento">
                <label for="contra2">Repite la contraseña</label>
                <input type="password" id="contra2" name="contra2" required="true">
            </div>
            <div id="elemento">
                <input type="submit" value="Regístrate">
            </div>
    </div>
    </form>
</body>

</html>