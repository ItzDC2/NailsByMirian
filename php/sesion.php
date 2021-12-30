<?php 
    
    session_start();
    if(!isset($_SESSION['iNombre'])) {
        header('Location: index.php');
        exit();
    }

?>