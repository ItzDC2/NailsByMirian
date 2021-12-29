<?php 
    
    session_start();
    if(!isset($_SESSION['iNombre'])) {
        header('Location: ../register.php');
        exit();
    }

?>