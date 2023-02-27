<?php
include_once "../../php/config.php";
session_start();
$uid = htmlspecialchars($_SESSION['uid']);
if (isset($_POST['approve_request'])) {
  $uid = $link->real_escape_string($_POST['request_id']);
  $user = $link->query("SELECT * FROM bfp_users WHERE uid = '$uid' LIMIT 1");
  $sh_user = $user->fetch_assoc();
  $query = "UPDATE bfp_users SET status='true', date_created='" . $sh_user['date_created'] . "' WHERE uid = '$uid'";
  if ($link->query($query)) {
    $link->query("INSERT INTO `notification`(`uid`, `title`, `content`, `click`) 
    VALUES ('$uid','Approve registration','Your registration is approved','0')");

    $to = $sh_user['email'];
    $subject = "Your registration has been accepted.";
    $txt = "<h1>BFP VISION AND MISSION</h1>
            <h6>VISION</h6>
            <p>A modern Fire Service Fully Capable of Ensuring a Fire Safety Nation By 2034</p>
            <h6>MISSION</h6>
            <p>We commit to prevent and suppress destructive fires, investigate its
            cause, enforce fire code and other related laws and respond to man made
            and natural disasters and other emergencies.</p>
            <br>
            PLEASE BE GUIDED TO DO NOT SHARE YOUR EMAIL OR PASSWORD AND ALWAYS CREATE A STONG PASSWORD MATCHING WITH UPPERCASE, NUMBER, AND SYMBOL";
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= "From: support@bfp-project.online" . "\r\n" .
    "CC: ";

    mail($to,$subject,$txt,$headers);

    $res = [
      'status' => 200,
      'message' => 'Successfully Approve the request of User'
    ];
    echo json_encode($res);
    return;
  } else {
    $res = [
      'status' => 500,
      'message' => 'Something Went Wrong unavailable to Approve the request'
    ];
    echo json_encode($res);
    return;
  }
} elseif (isset($_POST['drop_request'])) {
  $uid = $link->real_escape_string($_POST['request_id']);
  $user = $link->query("SELECT * FROM bfp_users WHERE uid = '$uid' LIMIT 1");
  $sh_user = $user->fetch_assoc();
  $query = "UPDATE bfp_users SET status='drop', date_created='" . $sh_user['date_created'] . "' WHERE uid = '$uid'";

  if ($link->query($query)) {
    $link->query("INSERT INTO `notification`(`uid`, `title`, `content`, `click`) 
    VALUES ('$uid','Drop registration','Your registration is Dropped','0')");
    $to = $sh_user['email'];
    $subject = "Your registration has been Rejected.";
    $txt = "<h1>BFP VISION AND MISSION</h1>
            <h6>VISION</h6>
            <p>A modern Fire Service Fully Capable of Ensuring a Fire Safety Nation By 2034</p>
            <h6>MISSION</h6>
            <p>If there is a mistake happened please Contact the Head of your office.</p>
            <br>
            PLEASE BE GUIDED TO DO NOT SHARE YOUR EMAIL OR PASSWORD AND ALWAYS CREATE A STONG PASSWORD MATCHING WITH UPPERCASE, NUMBER, AND SYMBOL";
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= "From: support@bfp-project.online" . "\r\n" .
    "CC: ";

    mail($to,$subject,$txt,$headers);
    $res = [
      'status' => 200,
      'message' => 'Successfully Dropped the request of User'
    ];
    echo json_encode($res);
    return;
  } else {
    $res = [
      'status' => 500,
      'message' => 'Something Went Wrong unavailable to Drop the request'
    ];
    echo json_encode($res);
    return;
  }
} elseif (isset($_POST['send_report'])) {
  $name = $link->real_escape_string($_POST['reportname']);
  $start = $link->real_escape_string($_POST['start']);
  $end = $link->real_escape_string($_POST['end']);
  $reportdetail = $link->real_escape_string($_POST['reportdetail']);
  $query = "INSERT INTO m_report (M_uid,M_report_name,M_details,M_start_report,M_end_report,M_report_status) 
            VALUES ('$uid','$name','$reportdetail','$start','$end','Requesting')";
  if ($link->query($query)) {
    $adminemail = mysqli_fetch_assoc($link->query("SELECT * FROM bfp_users WHERE position='Admin' LIMIT 1"));
    $sender = mysqli_fetch_assoc($link->query("SELECT * FROM bfp_users WHERE uid = '$uid' LIMIT 1"));
    $to = $adminemail['email'];
    $subject = $sender['location']." Send Report for ".date('Y-M', strtotime($_POST['start']));
    $txt = "<h1>BFP VISION AND MISSION</h1>
            <h6>VISION</h6>
            <p>A modern Fire Service Fully Capable of Ensuring a Fire Safety Nation By 2034</p>
            <h6>MISSION</h6>
            <p>We commit to prevent and suppress destructive fires, investigate its
            cause, enforce fire code and other related laws and respond to man made
            and natural disasters and other emergencies.</p>
            <br>
            PLEASE BE GUIDED TO DO NOT SHARE YOUR EMAIL OR PASSWORD AND ALWAYS CREATE A STONG PASSWORD MATCHING WITH UPPERCASE, NUMBER, AND SYMBOL";
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= "From: support@bfp-project.online" . "\r\n" .
    "CC: ";

    mail($to,$subject,$txt,$headers);
    $link->query("INSERT INTO `notification`(`uid`, `title`, `content`, `click`) 
    VALUES ('".$adminemail['uid']."','Send Report','".$sender['location']." Send Report for $start','0')");
    $res = [
      'status' => 200,
      'message' => 'Successfully Send Report'
    ];
    echo json_encode($res);
    return;
  } else {
    $res = [
      'status' => 500,
      'message' => 'Something Went Wrong'
    ];
    echo json_encode($res);
    return;
  }
} elseif (isset($_POST['delete_msg'])){
  $msgid = $link->real_escape_string($_POST['msgid']);
  $q = $link->query("DELETE FROM chat WHERE chat_id = '$msgid'");
  if($q){
    $res = [
      'status' => 200
    ];
    echo json_encode($res);
    return;
  }
}

