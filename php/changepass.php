<?php
  include_once "config.php";
  session_start();
  $uid = htmlspecialchars($_SESSION['uid']);
  if(isset($_POST['changepasswordsubmit'])){
    $newpass = $link->real_escape_string($_POST['newpassword']);
    $compass = $link->real_escape_string($_POST['confirmpassword']);
    $enc = md5($newpass);
    $query = "UPDATE bfp_users SET password = '$enc', active='offline', date_created=date_created
    WHERE uid = '$uid'";
    if($newpass == $compass){
      if($link->query($query)){
        $res = [
          'status' => 200,
          'message' => "Successfully Change Password"
        ];
        echo json_encode($res);
        return;
      } else {
        $res = [
          'status' => 500,
          'message' => "Something Went Wrong"
        ];
        echo json_encode($res);
        return;
      }
    } else {
      $res = [
        'status' => 500,
        'message' => "Password Not Match"
      ];
      echo json_encode($res);
      return;
    }
  } elseif(isset($_POST['reddot'])){
    $link->query("UPDATE notification SET click='1' WHERE uid = '$uid'");
    $res = [
      'status' => 200,
    ];
    echo json_encode($res);
    return;
  } else {
    $res = [
      'status' => 500,
      'message' => "Something Went Wrong"
    ];
    echo json_encode($res);
    return;
  }
?>