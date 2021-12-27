<?php 
    
    session_start();
    if(!isset($_SESSION['usuario'])) {
        header('Location: registrer.php');
        exit();
    }

?>