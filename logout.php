<?php
    session_start();				
    unset($_SESSION["dni"]);
    session_destroy();					
    header("Location: index.php");
?>