<?php
    session_start();

    include_once "php/config.php";

    if(isset($_SESSION['login'])===true){
        $position = htmlspecialchars($_SESSION['position']);

        $uid = htmlspecialchars($_SESSION['uid']);
        if($position == 'Admin'){
            header('location: bfp-administrator');
        } elseif ($position == "Municipal"){
            header('location: bfp-municipal');
        } elseif ($position == "Provincial") {
            header('location: bfp-provincial');
        } elseif ($position == "Regional") {
            header('location: bfp-regional');
        }
    }
?>