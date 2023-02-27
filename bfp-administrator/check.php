<?php
    session_start();
    include_once "../php/config.php";

    if(isset($_SESSION['login'])===true){
        $position = htmlspecialchars($_SESSION['position']);
        $uid = htmlspecialchars($_SESSION['uid']);
        $user=$link->query("SELECT * FROM bfp_users WHERE uid='$uid' LIMIT 1");
        $sh_user=$user->fetch_assoc();
        if($position != 'Admin'){
            header('location: ../');
        }
    } else {
        header('location: ../');
    }

?>