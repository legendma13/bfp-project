<?php
include_once "check.php";
if(isset($_POST['editreport'])){
  $checkprovince = mysqli_fetch_assoc($link->query("SELECT * FROM bfp_users 
  WHERE municipal = '".$sh_user['municipal']."' AND position = 'Provincial';"));
  $id = $link->real_escape_string($_POST['id']);
  $editcomment = $link->real_escape_string($_POST['editcomment']);
  $query = "UPDATE report SET report_reply='$editcomment', report_status='Requesting' 
  WHERE report_id='$id'";

  if($link->query($query)){
    $link->query("INSERT INTO `notification`(`uid`, `title`, `content`, `click`) 
    VALUES ('".$checkprovince['uid']."','Edit Report','".$sh_user['location']." OFfice Edit their Report','0')");
    $to = $checkprovince['email'];
    $subject = $sh_user['location']." OFfice Edit their Report";
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
      'message' => 'Successfully Response to the Report'
    ];
  echo json_encode($res);
  return;
  }
}
?>