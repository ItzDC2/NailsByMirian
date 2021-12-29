<?php 
    require_once "php/config.php";
    // require_once "php/register_auth.php";
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/estilosIndex.css">
    <link rel="icon" href="imgs/nail-circled.png" type="image/x-icon"/>
    <title>MirianNails</title>
</head>
<body>
    <img src="imgs/nail.jpg" id="logo">
    <div class="navegacion">
        <nav>
            <a href="#">Pide Cita</a>
            <a href="#">Contáctanos</a>
            <a href="#">Conócenos</a>
            <?php 
                $doc = "login.php";
                if(!true) {
                    echo "¡Bienvenido " . $nombre . "!";
                } else {
                    echo "<a href=".$doc.">Inicia Sesión</a>";
                }
            ?>
        </nav>
        <div class="columna">
            <p class="pasidel">
                Lorem ipsum dolor sit amet consectetur adipisicing elit.
                Omnis ut iure, ea, nisi sapiente dolorem facilis neque itaque
                ad tempora earum ex quidem. Dignissimos perspiciatis modi asperiores, suscipit minima maiores iure
                tempora esse. Animi, possimus mollitia labore dolor impedit temporibus ipsum hic neque cumque nesciunt
                debitis
                ea! Numquam, dolorum fugiat. 1
            </p>
            <p class="pasidel">
                Lorem ipsum dolor sit amet consectetur adipisicing elit.
                Omnis ut iure, ea, nisi sapiente dolorem facilis neque itaque
                ad tempora earum ex quidem. Dignissimos perspiciatis modi asperiores, suscipit minima maiores iure
                tempora esse. Animi, possimus mollitia labore dolor impedit temporibu ipsum hic neque cumque nesciunt
                debitis
                ea! Numquam, dolorum fugiat. 2
            </p>
        </div>
        <div class="columna">
            <p class="pasider">
                Lorem ipsum, dolor sit amet consectetur adipisicing elit.
                Nihil eligendi laudantium deleniti minima et quia ab reprehenderit
                vel maxime quibusdam voluptates dolorem amet culpa quos dolor quisquam,
                cum ex fugit repellendus autem maiores, iure molestias!
                Voluptates odio culpa illo at praesentium harum
                rerum blanditiis ipsam, porro omnis, quos doloremque inventore. 3
            </p>
            <p class="pasider">
                Lorem ipsum, dolor sit amet consectetur adipisicing elit.
                Nihil eligendi laudantium deleniti minima et quia ab reprehenderit
                vel maxime quibusdam voluptates dolorem amet culpa quos dolor quisquam,
                cum ex fugit repellendus autem maiores, iure molestias!
                Voluptates odio culpa illo at praesentium harum
                rerum blanditiis ipsam, porro omnis, quos doloremque inventore. 4
            </p>
        </div>
    </div>
</body>
</html>