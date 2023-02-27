<?php 
  include_once "check.php";
  if(isset($_POST['showform1'])){
    $year = $link->real_escape_string($_POST['year']);
    $month = $link->real_escape_string($_POST['month']);
    
    header("location: ../form1-report.php?year=".$year."&month=".$month);
  } elseif (isset($_POST['showform2'])){
    $year = $link->real_escape_string($_POST['year']);
    $month = $link->real_escape_string($_POST['month']);
    
    header("location: ../form2-report.php?year=".$year."&month=".$month);
  } elseif (isset($_POST['showform3'])){
    $year = $link->real_escape_string($_POST['year']);
    $month = $link->real_escape_string($_POST['month']);
    
    header("location: ../form3-report.php?year=".$year."&month=".$month);
  } elseif (isset($_POST['showform4'])){
    $year = $link->real_escape_string($_POST['year']);
    $month = $link->real_escape_string($_POST['month']);
    
    header("location: ../form4-report.php?year=".$year."&month=".$month);
  }
?>