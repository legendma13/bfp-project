<?php
  include_once "../../php/config.php";
  session_start();
  $to=htmlspecialchars($_SESSION['chatuid']);
  $uid=htmlspecialchars($_SESSION['uid']);
  if(isset($_POST['send_message'])){

    $message = $link->real_escape_string($_POST['msg']);

    $query = "INSERT INTO `chat`(`chat_to`, `chat_uid`, `message`)
    VALUES ('$to','$uid','$message')";
    
    if($link->query($query)){
      $res = [
        'status' => 200
      ];
      echo json_encode($res);
      return;
    }
  }
