<?php
  include_once "../../php/config.php";
  if(isset($_POST['approvereport'])){
    $id = $link->real_escape_string($_POST['id']);
    $reporter = mysqli_fetch_assoc($link->query("SELECT * FROM bfp_users 
    LEFT JOIN report ON report.uid = bfp_users.uid WHERE report.report_id='$id' LIMIT 1"));
    $approvecomment = $link->real_escape_string($_POST['approvecomment']);
    $query = "UPDATE report SET report_comment='$approvecomment', report_status='Approved' 
    WHERE report_id='$id'";

    if($link->query($query)){
      // Email
      $to = $reporter['email'];
      $subject = "Your Report is Approved";
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
      $link->query("UPDATE bfp_form1 SET form1_status='1' 
      WHERE uid = '".$reporter['uid']."' AND form1_date_added BETWEEN '".$reporter['start_report']."' AND '".$reporter['end_report']."'");
      $link->query("UPDATE bfp_form2 SET form1_status='1' 
      WHERE uid = '".$reporter['uid']."' AND form2_date_added BETWEEN '".$reporter['start_report']."' AND '".$reporter['end_report']."'");
      $link->query("UPDATE bfp_form3 SET form1_status='1' 
      WHERE uid = '".$reporter['uid']."' AND form3_date_added BETWEEN '".$reporter['start_report']."' AND '".$reporter['end_report']."'");
      $link->query("UPDATE bfp_form4 SET form1_status='1' 
      WHERE uid = '".$reporter['uid']."' AND form4_date_added BETWEEN '".$reporter['start_report']."' AND '".$reporter['end_report']."'");

      $link->query("INSERT INTO `notification`(`uid`, `title`, `content`, `click`) 
      VALUES ('" . $reporter['uid'] . "','Your Report was accepted.','Your Report for'".$reporter['start_report']." to ".$reporter['end_report'].",'0')");
      
      $res = [
        'status' => 200,
        'message' => 'Successfully Approve this Report'
      ];
    echo json_encode($res);
    return;
    }
  } elseif(isset($_POST['editreport'])){
      $id = $link->real_escape_string($_POST['id']);
      $reporter = mysqli_fetch_assoc($link->query("SELECT * FROM bfp_users 
      LEFT JOIN report ON report.uid = bfp_users.uid WHERE report.report_id='$id' LIMIT 1"));
      $editcomment = $link->real_escape_string($_POST['editcomment']);
      $reason = implode(", ",$_POST['reason']);
      $query = "UPDATE report SET reason='$reason', report_comment='$editcomment', report_status='Need Edit' 
      WHERE report_id='$id'";
  
      if($link->query($query)){

        // Email
        $to = $reporter['email'];
        $subject = "Your Report is Need to be Edit";
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
        
        $link->query("INSERT INTO `notification`(`uid`, `title`, `content`, `click`) 
        VALUES ('" . $reporter['uid'] . "','Your Report Need To Edit','Your Report for'".$reporter['start_report']." to ".$reporter['end_report'].",'0')");
  
        $res = [
          'status' => 200,
          'message' => 'Successfully Response to the Report'
        ];
      echo json_encode($res);
      return;
      }
  }


?>