<?php
    include_once "../../php/config.php";
    session_start();    
    $uid = htmlspecialchars($_SESSION['uid']);
    $sh_user = mysqli_fetch_assoc($link->query("SELECT * FROM bfp_users WHERE uid = '$uid'"));
?>