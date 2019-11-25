<?php

    include('conexionBBDD.php');
    session_start();
   
    $user_check = $_SESSION["login_user"];
   
    $ses_sql = mysqli_query($conx, "SELECT nombre FROM usuarios WHERE nif = '$user_check' ");
   
    $row = mysqli_fetch_array($ses_sql, MYSQLI_ASSOC);
   
    $login_session = $row['nif'];
   
    if(!isset($_SESSION["login_user"]))
    {
        header("location:login.php");
        die();
    }
?>