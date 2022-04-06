<?php 
    session_start();
    unset($_SESSION['dni']);
    unset($_SESSION['apellido']);
    session_destroy();
    header("Location: index.php");
?>