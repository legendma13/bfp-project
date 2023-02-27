<?php
date_default_timezone_set("Asia/Manila");
$link = mysqli_connect("localhost","root","","bfp");

if(!$link){
    die('Connection Failed'. mysqli_connect_error());
}


?>