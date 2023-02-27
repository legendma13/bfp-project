<?php
include_once "check.php";
$form_id = uniqid();
if (isset($_POST['form1_submitthis'])) {
  //profile
  $fname = $link->real_escape_string($_POST['fname']);
  $mname = $link->real_escape_string($_POST['mname']);
  $lname = $link->real_escape_string($_POST['lname']);
  $gender = $link->real_escape_string($_POST['gender']);
  $bday = $link->real_escape_string($_POST['bday']);
  $brgy = $link->real_escape_string($_POST['brgy']);
  //FSEC
  $type = $link->real_escape_string($_POST['type']);
  $fsec = $link->real_escape_string($_POST['fsec']);

  //structure
  $structure = $link->real_escape_string($_POST['structure']);
  $ncrn = $link->real_escape_string($_POST['ncrn']);

  //inspection
  $inspection = $link->real_escape_string($_POST['inspection']);
  $issuances = $link->real_escape_string($_POST['issuances']);

  $query = "INSERT INTO `bfp_form1`(`uid`, `fname`,`mname`,`lname`, `gender`, 
  `bday`, `brgy`, `type`, `fsec`, `structure`, `nc_or_rn`, `inspection`, 
  `issuance`, `form1_status`) 
  VALUES ('$uid','$lname', '$fname' ,'$mname', '$gender', '$bday', '$brgy',
  '$type','$fsec','$structure','$ncrn','$inspection','$issuances','0')";
  if ($link->query($query)) {
    $res = [
      'status' => 200,
    ];
    echo json_encode($res);
    return;
  } else {
    $res = [
      'status' => 500,
    ];
    echo json_encode($res);
    return;
  }
} elseif (isset($_POST['form1_editthis'])) {
  $id = $link->real_escape_string($_POST['id']);
  //profile
  $fname = $link->real_escape_string($_POST['fname']);
  $mname = $link->real_escape_string($_POST['mname']);
  $lname = $link->real_escape_string($_POST['lname']);
  $gender = $link->real_escape_string($_POST['gender']);
  $bday = $link->real_escape_string($_POST['bday']);
  $brgy = $link->real_escape_string($_POST['brgy']);
  $type = $link->real_escape_string($_POST['type']);
  //structure
  $structure = $link->real_escape_string($_POST['structure']);
  $ncrn = $link->real_escape_string($_POST['ncrn']);

  //inspection
  $inspection = $link->real_escape_string($_POST['inspection']);
  $issuances = $link->real_escape_string($_POST['issuances']);

  $query = "UPDATE bfp_form1 SET fname='$fname',mname='$mname',
  lname='$lname',bday='$bday',brgy='$brgy',type='$type',
  structure='$structure',nc_or_rn='$ncrn',inspection='$inspection',
  issuance='$issuances' WHERE form1_id = '$id'";

  if ($link->query($query)) {
    $res = [
      'status' => 200,
    ];
    echo json_encode($res);
    return;
  } else {
    $res = [
      'status' => 500,
    ];
    echo json_encode($res);
    return;
  }

} elseif (isset($_POST['delete_report'])) {
  $form_id = $link->real_escape_string($_POST['request_id']);
  $query = "DELETE FROM bfp_form1 WHERE form1_id = '$form_id'";
  if ($link->query($query)) {
    $res = [
      'status' => 200,
      'message' => 'Successfully Removed the data'
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
} elseif (isset($_POST['form2_submitthis'])) {
  //profile
  $fname = $link->real_escape_string($_POST['fname']);
  $mname = $link->real_escape_string($_POST['mname']);
  $lname = $link->real_escape_string($_POST['lname']);
  $gender = $link->real_escape_string($_POST['gender']);
  $bday = $link->real_escape_string($_POST['bday']);
  $brgy = $link->real_escape_string($_POST['brgy']);

  $type = $link->real_escape_string($_POST['type']);
  $structure = $link->real_escape_string($_POST['structure']);

  $fsic = $link->real_escape_string($_POST['fsic']);
  $with_or_not = $link->real_escape_string($_POST['with_or_not']);

  $reinspection_1 = $link->real_escape_string($_POST['reinspection_1']);
  $reinspection_2 = $link->real_escape_string($_POST['reinspection_2']);
  $reinspection_3 = $link->real_escape_string($_POST['reinspection_3']);

  $closure = $link->real_escape_string($_POST['closure']);

  $query = "INSERT INTO `bfp_form2`(`uid`, `fname`,`mname`,`lname`, `gender`, `bday`,
  `brgy`, `type`, `structure`, `fsic`, `with_or_not`, `reinspection_1`,
  `reinspection_2`, `reinspection_3`, `closure`, `form2_status`) 
  VALUES ('$uid','$lname', '$fname' ,'$mname','$gender', '$bday', '$brgy',
  '$type','$structure','$fsic','$with_or_not','$reinspection_1'
  ,'$reinspection_2','$reinspection_3','$closure','0')";
  if ($link->query($query)) {
    $res = [
      'status' => 200,
    ];
    echo json_encode($res);
    return;
  } else {
    $res = [
      'status' => 500,
    ];
    echo json_encode($res);
    return;
  }
} elseif (isset($_POST['form2_editthis'])) {
  $id = $link->real_escape_string($_POST['id']);
  //profile
  $fname = $link->real_escape_string($_POST['fname']);
  $mname = $link->real_escape_string($_POST['mname']);
  $lname = $link->real_escape_string($_POST['lname']);
  $gender = $link->real_escape_string($_POST['gender']);
  $bday = $link->real_escape_string($_POST['bday']);
  $brgy = $link->real_escape_string($_POST['brgy']);

  $type = $link->real_escape_string($_POST['type']);
  $structure = $link->real_escape_string($_POST['structure']);

  $fsic = $link->real_escape_string($_POST['fsic']);
  $with_or_not = $link->real_escape_string($_POST['with_or_not']);

  $reinspection_1 = $link->real_escape_string($_POST['reinspection_1']);
  $reinspection_2 = $link->real_escape_string($_POST['reinspection_2']);
  $reinspection_3 = $link->real_escape_string($_POST['reinspection_3']);

  $closure = $link->real_escape_string($_POST['closure']);

  $query = "UPDATE `bfp_form2` SET `fname`='$fname',`mname`='$mname',`lname`='$lname',
  `gender`='$gender',`bday`='$bday',`brgy`='$brgy',`type`='$type',`structure`='$structure',
  `fsic`='$fsic',`with_or_not`='$with_or_not',`reinspection_1`='$reinspection_1',`reinspection_2`='$reinspection_2',
  `reinspection_3`='$reinspection_3',`closure`='$closure' WHERE form2_id = '$id'";

  if ($link->query($query)) {
    $res = [
      'status' => 200,
      'message' => 'Successfully Edit Data'
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
} elseif (isset($_POST['form2_delete_report'])){
  $form_id = $link->real_escape_string($_POST['form2_id']);
  $query = "DELETE FROM bfp_form2 WHERE form2_id = '$form_id'";
  if ($link->query($query)) {
    $res = [
      'status' => 200,
      'message' => 'Successfully Removed the data'
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
} elseif (isset($_POST['form3_submitthis'])) {
  //profile
  $fname = $link->real_escape_string($_POST['fname']);
  $mname = $link->real_escape_string($_POST['mname']);
  $lname = $link->real_escape_string($_POST['lname']);
  $gender = $link->real_escape_string($_POST['gender']);
  $bday = $link->real_escape_string($_POST['bday']);
  $brgy = $link->real_escape_string($_POST['brgy']);
  $type = $link->real_escape_string($_POST['type']);
  $structure = $link->real_escape_string($_POST['structure']);
  $new_renew = $link->real_escape_string($_POST['new_renew']);
  $with_or_not = $link->real_escape_string($_POST['with_or_not']);
  $reinspection_1 = $link->real_escape_string($_POST['reinspection_1']);
  $reinspection_2 = $link->real_escape_string($_POST['reinspection_2']);
  $reinspection_3 = $link->real_escape_string($_POST['reinspection_3']);

  $closure = $link->real_escape_string($_POST['closure']);

  $query = "INSERT INTO `bfp_form3`(`uid`, `fname`,`mname`,`lname`, `gender`, `bday`,
  `brgy`, `type`, `structure`, `new_renew`, `with_or_not`, `reinspection_1`,
  `reinspection_2`, `reinspection_3`, `closure`, `form3_status`) 
  VALUES ('$uid','$lname', '$fname' ,'$mname','$gender', '$bday', '$brgy',
  '$type','$structure','$new_renew','$with_or_not','$reinspection_1'
  ,'$reinspection_2','$reinspection_3','$closure','0')";

  if ($link->query($query)) {
    $res = [
      'status' => 200,
    ];
    echo json_encode($res);
    return;
  } else {
    $res = [
      'status' => 500,
    ];
    echo json_encode($res);
    return;
  }
} elseif (isset($_POST['form3_editthis'])) {
  $id = $link->real_escape_string($_POST['id']);
  //profile
  $fname = $link->real_escape_string($_POST['fname']);
  $mname = $link->real_escape_string($_POST['mname']);
  $lname = $link->real_escape_string($_POST['lname']);
  $gender = $link->real_escape_string($_POST['gender']);
  $bday = $link->real_escape_string($_POST['bday']);
  $brgy = $link->real_escape_string($_POST['brgy']);
  $type = $link->real_escape_string($_POST['type']);
  $structure = $link->real_escape_string($_POST['structure']);
  $new_renew = $link->real_escape_string($_POST['new_renew']);
  $with_or_not = $link->real_escape_string($_POST['with_or_not']);
  $reinspection_1 = $link->real_escape_string($_POST['reinspection_1']);
  $reinspection_2 = $link->real_escape_string($_POST['reinspection_2']);
  $reinspection_3 = $link->real_escape_string($_POST['reinspection_3']);

  $closure = $link->real_escape_string($_POST['closure']);

  $query = "UPDATE `bfp_form3` SET `fname`='$fname',`mname`='$mname',`lname`='$lname',
  `gender`='$gender',`bday`='$bday',`brgy`='$brgy',`type`='$type',`structure`='$structure',
  `new_renew`='$new_renew',`with_or_not`='$with_or_not',`reinspection_1`='$reinspection_1',`reinspection_2`='$reinspection_2',
  `reinspection_3`='reinspection_3',`closure`='$closure' WHERE form3_id = '$id'";

  if ($link->query($query)) {
    $res = [
      'status' => 200,
    ];
    echo json_encode($res);
    return;
  } else {
    $res = [
      'status' => 500,
    ];
    echo json_encode($res);
    return;
  }
} elseif (isset($_POST['form3_delete_report'])) {
  $form_id = $link->real_escape_string($_POST['form3_id']);
  $query = "DELETE FROM bfp_form3 WHERE form3_id = '$form_id'";
  if ($link->query($query)) {
    $res = [
      'status' => 200,
      'message' => 'Successfully Removed the data'
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
} elseif (isset($_POST['form4_submitthis'])) {
  //profile
  $fname = $link->real_escape_string($_POST['fname']);
  $mname = $link->real_escape_string($_POST['mname']);
  $lname = $link->real_escape_string($_POST['lname']);
  $gender = $link->real_escape_string($_POST['gender']);
  $bday = $link->real_escape_string($_POST['bday']);
  $brgy = $link->real_escape_string($_POST['brgy']);
  $type = $link->real_escape_string($_POST['type']);
  $fire_code_fees = $link->real_escape_string($_POST['fire_code_fees']);
  $fees = $link->real_escape_string($_POST['fees']);

  $query = "INSERT INTO `bfp_form4`(`uid`, `fname`,`mname`,`lname`, `gender`, `bday`, 
  `brgy`, `type`, `fire_code_fees`, `fees`, `form4_status`) 
  VALUES ('$uid','$lname', '$fname' ,'$mname', '$gender', '$bday', '$brgy', '$type',
  '$fire_code_fees','$fees','0')";
  
  if ($link->query($query)) {
    $res = [
      'status' => 200,
    ];
    echo json_encode($res);
    return;
  } else {
    $res = [
      'status' => 500,
    ];
    echo json_encode($res);
    return;
  }
} elseif (isset($_POST['form4_editthis'])) {
  $id = $link->real_escape_string($_POST['id']);
  $fname = $link->real_escape_string($_POST['fname']);
  $mname = $link->real_escape_string($_POST['mname']);
  $lname = $link->real_escape_string($_POST['lname']);
  $gender = $link->real_escape_string($_POST['gender']);
  $bday = $link->real_escape_string($_POST['bday']);
  $brgy = $link->real_escape_string($_POST['brgy']);
  $type = $link->real_escape_string($_POST['type']);
  $fire_code_fees = $link->real_escape_string($_POST['fire_code_fees']);
  $fees = $link->real_escape_string($_POST['fees']);

  $query = "UPDATE `bfp_form4` SET `fname`='$fname',`mname`='$mname',`lname`='$lname',
  `gender`='$gender',`bday`='$bday',`brgy`='$brgy',`brgy`='$type',`fire_code_fees`='$fire_code_fees', `fees`='$fees'
   WHERE form4_id = '$id'";
  
  if ($link->query($query)) {
    $res = [
      'status' => 200,
    ];
    echo json_encode($res);
    return;
  } else {
    $res = [
      'status' => 500,
    ];
    echo json_encode($res);
    return;
  }
} elseif (isset($_POST['form4_delete_report'])) {
  $form_id = $link->real_escape_string($_POST['form4_id']);
  $query = "DELETE FROM bfp_form4 WHERE form4_id = '$form_id'";
  if ($link->query($query)) {
    $res = [
      'status' => 200,
      'message' => 'Successfully Removed the data'
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
} elseif (isset($_POST['send_report'])) {
  $name = $link->real_escape_string($_POST['reportname']);
  $start = $link->real_escape_string($_POST['start']);
  $end = $link->real_escape_string($_POST['end']);
  $reportdetails = $link->real_escape_string($_POST['reportdetails']);
  $checkprovince = mysqli_fetch_assoc($link->query("SELECT * FROM bfp_users 
  WHERE municipal = '".$sh_user['municipal']."' AND position = 'Provincial';"));
  $query = "INSERT INTO report (uid,report_name,details,start_report,end_report,report_status) 
  VALUES ('$uid','$name','$reportdetails','$start','$end','Requesting')";
  if($link->query($query)){
    $link->query("INSERT INTO `notification`(`uid`, `title`, `content`, `click`) 
    VALUES ('".$checkprovince['uid']."','Send Report','".$sh_user['location']." Send Report for $start','0')");
    $to = $checkprovince['email'];
    $subject = $sh_user['location']." Send Report for $start";
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
