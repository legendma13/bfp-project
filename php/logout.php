<?php
    include_once "config.php";
    // Initialize the session
    session_start();
    $uid = htmlspecialchars($_SESSION['uid']);
    $link->query("UPDATE bfp_users SET active='offline',date_created=date_created WHERE uid = '$uid'");
    // Unset all of the session variables
    $_SESSION = array();

    // Destroy the session.
    session_destroy();

    // Redirect to login page
    header("location: ../");
    exit;
?>