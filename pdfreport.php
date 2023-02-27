<?php
session_start();
$uid = htmlspecialchars($_SESSION['uid']);
$position = htmlspecialchars($_SESSION['position']);

# Copyright (c) Bouncing Ltd 2003-2016
# Author Philip Clarke nod@bouncing.org
# Released under the CC Attribution 4.0 licence https://creativecommons.org/licenses/by/4.0/
# You may do with it as you please just keep the credits. If you change something note it down for your own good
# This Version released 12/11/2016 (keep in as helps with bug fixes)

# mysql_report is now mysqli_report PHP 5+ compatible
# General Principle for setting up.
# Get the mysql_report and fpdf libraries loaded
# Set the page side (although pdf's tend to scale well)
# add database connection details
# add report title
# Add SQL statement (it is sanitized in mysql_report but take precautions with any user input)
# Output PDF (lots of people forget this and then wonder why the page is blank).

// you may need to change mysql_report.php to find the fpdf libraries
require('mysql_report.php');

// the PDF is defined as normal, in this case a Landscape, measurements in points, A3 page.
$pdf = new PDF('L','pt','A3');
$pdf->SetFont('Arial','',10);


// change the below to establish the database connection.
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'bfp';

// should not need changing, change above instead.
$pdf->connect($host, $username, $password, $database);


$start = $_GET['start'];
$end = $_GET['end'];
$office = $_GET['office'];
# Example SQL Statements
# 
# Normally one would have 1 SQL statement and generate the report, e.g. a weekly sales breakdown
# mysql_report can now produce more than one SQL statement in the report, so one could do a 
# more complex set of tables like monthly reports using differing SQL
# Examples are from the mysql table. The tables are generated and then outputted.

/* Multiple SQL tables will merge into 1 numbered PDF */

/* Example 2: single page small non-full width table, mysql_report chooses not to spread table out */
// SQL statement
// attributes for the page titles
if ($position == "Municipal") {
  $attr = array('titleFontSize' => 18, 'titleText' => 'NEW BUILDING REPORT (' . $office . ')');

  $sql_statement = "SELECT fname as `First Name`, mname as `Middle Name`, lname as `Last Name`, 
  gender as `Gender`, bday as `Birth Day`, brgy as `Barangay`, type as `Application Type`,lbl as `Structure`, 
  fsec as `FSEC`, inspection as `Inspection during Under Construction`, issuance as `Issuance`, 
  if(form1_status = '1', 'Approved', 'Requesting') as `Status`, form1_date_added as `Date` 
  FROM bfp_form1 LEFT JOIN structure ON structure.structure_id = bfp_form1.structure
  WHERE form1_date_added BETWEEN '$start' AND '$end' AND bfp_form1.uid = '$uid' ORDER BY form1_date_added DESC";
  // Generate report
  $pdf->mysql_report($sql_statement, false, $attr);

  $attr = array('titleFontSize' => 18, 'titleText' => 'Business Operation (' . $office . ')');
  $sql_statement = "SELECT fname as `First Name`, mname as `Middle Name`, lname as `Last Name`, 
  gender as `Gender`, bday as `Birth Day`, brgy as `Barangay`, type as `Application Type`,lbl as `Structure`,
  with_or_not as `FSIC Issued`, fsic as `New or Renewal`, reinspection_1 as `Re-inspection Type`, reinspection_2 as `Compliant/Non-Compliant`,
  reinspection_3 as `Issue`, closure as `Closure Order`,
  if(form2_status = '1', 'Approved', 'Requesting') as `Status`, form2_date_added as `Date` 
  FROM bfp_form2 LEFT JOIN structure ON structure.structure_id = bfp_form2.structure
  WHERE form2_date_added BETWEEN '$start' AND '$end' AND bfp_form2.uid = '$uid' ORDER BY form2_date_added DESC";
  // Generate report
  $pdf->mysql_report($sql_statement, false, $attr);

  $attr = array('titleFontSize' => 18, 'titleText' => 'Government Building (' . $office . ')');
  $sql_statement = "SELECT fname as `First Name`, mname as `Middle Name`, lname as `Last Name`, 
  gender as `Gender`, bday as `Birth Day`, brgy as `Barangay`, type as `Application Type`,lbl as `Structure`,
  with_or_not as `FSIC Issued`, new_renew as `New or Renewal`, reinspection_1 as `Re-inspection Type`, reinspection_2 as `Compliant/Non-Compliant`,
  reinspection_3 as `Issue`, closure as `Closure Order`,
  if(form3_status = '1', 'Approved', 'Requesting') as `Status`, form3_date_added as `Date` 
  FROM bfp_form3 LEFT JOIN structure ON structure.structure_id = bfp_form3.structure
  WHERE form3_date_added BETWEEN '$start' AND '$end' AND bfp_form3.uid = '$uid' ORDER BY form3_date_added DESC";
  // Generate report
  $pdf->mysql_report($sql_statement, false, $attr);

  $attr = array('titleFontSize' => 18, 'titleText' => 'FIRE CODE FEES COLLECTION (' . $office . ')');
  $sql_statement = "SELECT fname as `First Name`, mname as `Middle Name`, lname as `Last Name`, 
  gender as `Gender`, bday as `Birth Day`, brgy as `Barangay`, fire_code_fees as `Fire Code Fees`, fees as `Fees`, 
  if(form4_status = '1', 'Approved', 'Requesting') as `Status`, form4_date_added as `Date` 
  FROM bfp_form4 WHERE form4_date_added BETWEEN '$start' AND '$end' AND bfp_form4.uid = '$uid' ORDER BY form4_date_added DESC";
  // Generate report
  $pdf->mysql_report($sql_statement, false, $attr);
} elseif($position == "Admin") {
  // FORM 1
  $attr = array('titleFontSize' => 18, 'titleText' => 'NEW BUILDING REPORT');
  $sql_statement = "SELECT fname as `First Name`, mname as `Middle Name`, lname as `Last Name`, 
  gender as `Gender`, bday as `Birth Day`, brgy as `Barangay`, bfp_users.location as `Municipal`,bfp_users.municipal as `Province`, type as `Application Type`,lbl as `Structure`, 
  fsec as `FSEC`, inspection as `Inspection during Under Construction`, issuance as `Issuance`, 
  if(form1_status = '1', 'Approved', 'Requesting') as `Status`, form1_date_added as `Date` 
  FROM bfp_form1 LEFT JOIN structure ON structure.structure_id = bfp_form1.structure
  LEFT JOIN bfp_users ON bfp_form1.uid = bfp_users.uid
  WHERE form1_date_added BETWEEN '$start' AND '$end' ORDER BY form1_date_added DESC";
  $pdf->mysql_report($sql_statement, false, $attr);

  //  FORM 2
  $attr = array('titleFontSize' => 18, 'titleText' => 'Business Operation');
  $sql_statement = "SELECT fname as `First Name`, mname as `Middle Name`, lname as `Last Name`, 
  gender as `Gender`, bday as `Birth Day`, brgy as `Barangay`, bfp_users.location as `Municipal`,bfp_users.municipal as `Province`, type as `Application Type`,lbl as `Structure`,
  with_or_not as `FSIC Issued`, fsic as `New or Renewal`, reinspection_1 as `Re-inspection Type`, reinspection_2 as `Compliant/Non-Compliant`,
  reinspection_3 as `Issue`, closure as `Closure Order`,
  if(form2_status = '1', 'Approved', 'Requesting') as `Status`, form2_date_added as `Date` 
  FROM bfp_form2 LEFT JOIN structure ON structure.structure_id = bfp_form2.structure
  LEFT JOIN bfp_users ON bfp_form2.uid = bfp_users.uid
  WHERE form2_date_added BETWEEN '$start' AND '$end' ORDER BY form2_date_added DESC";
  // Generate report
  $pdf->mysql_report($sql_statement, false, $attr);

  $attr = array('titleFontSize' => 18, 'titleText' => 'Government Building');
  $sql_statement = "SELECT fname as `First Name`, mname as `Middle Name`, lname as `Last Name`, 
  gender as `Gender`, bday as `Birth Day`, brgy as `Barangay`, bfp_users.location as `Municipal`,bfp_users.municipal as `Province`, type as `Application Type`,lbl as `Structure`,
  with_or_not as `FSIC Issued`, new_renew as `New or Renewal`, reinspection_1 as `Re-inspection Type`, reinspection_2 as `Compliant/Non-Compliant`,
  reinspection_3 as `Issue`, closure as `Closure Order`,
  if(form3_status = '1', 'Approved', 'Requesting') as `Status`, form3_date_added as `Date` 
  FROM bfp_form3 LEFT JOIN structure ON structure.structure_id = bfp_form3.structure
  LEFT JOIN bfp_users ON bfp_form3.uid = bfp_users.uid
  WHERE form3_date_added BETWEEN '$start' AND '$end' ORDER BY form3_date_added DESC";
  // Generate report
  $pdf->mysql_report($sql_statement, false, $attr);

  $attr = array('titleFontSize' => 18, 'titleText' => 'FIRE CODE FEES COLLECTION');
  $sql_statement = "SELECT fname as `First Name`, mname as `Middle Name`, lname as `Last Name`, 
  gender as `Gender`, bday as `Birth Day`, brgy as `Barangay`, bfp_users.location as `Municipal`,bfp_users.municipal as `Province`,
  fire_code_fees as `Fire Code Fees`, fees as `Fees`, if(form4_status = '1', 'Approved', 'Requesting') as `Status`, form4_date_added as `Date` 
  FROM bfp_form4 LEFT JOIN bfp_users ON bfp_form4.uid = bfp_users.uid
  WHERE form4_date_added BETWEEN '$start' AND '$end' ORDER BY form4_date_added DESC";
  // Generate report
  $pdf->mysql_report($sql_statement, false, $attr);
} elseif(isset($_GET['province'])){
  $province = $_GET['province'];
  // FORM 1
  $attr = array('titleFontSize' => 18, 'titleText' => 'NEW BUILDING REPORT');
  $sql_statement = "SELECT fname as `First Name`, mname as `Middle Name`, lname as `Last Name`, 
  gender as `Gender`, bday as `Birth Day`, brgy as `Barangay`, bfp_users.location as `Municipal`, type as `Application Type`,lbl as `Structure`, 
  fsec as `FSEC`, inspection as `Inspection during Under Construction`, issuance as `Issuance`, 
  if(form1_status = '1', 'Approved', 'Requesting') as `Status`, form1_date_added as `Date` 
  FROM bfp_form1 LEFT JOIN structure ON structure.structure_id = bfp_form1.structure
  LEFT JOIN bfp_users ON bfp_users.uid = bfp_form1.uid
  WHERE form1_date_added BETWEEN '$start' AND '$end' AND bfp_users.municipal = '$province' ORDER BY form1_date_added DESC";
  $pdf->mysql_report($sql_statement, false, $attr);

  //  FORM 2
  $attr = array('titleFontSize' => 18, 'titleText' => 'Business Operation');
  $sql_statement = "SELECT fname as `First Name`, mname as `Middle Name`, lname as `Last Name`, 
  gender as `Gender`, bday as `Birth Day`, brgy as `Barangay`, bfp_users.location as `Municipal`, type as `Application Type`,lbl as `Structure`,
  with_or_not as `FSIC Issued`, fsic as `New or Renewal`, reinspection_1 as `Re-inspection Type`, reinspection_2 as `Compliant/Non-Compliant`,
  reinspection_3 as `Issue`, closure as `Closure Order`,
  if(form2_status = '1', 'Approved', 'Requesting') as `Status`, form2_date_added as `Date` 
  FROM bfp_form2 LEFT JOIN structure ON structure.structure_id = bfp_form2.structure
  LEFT JOIN bfp_users ON bfp_users.uid = bfp_form2.uid
  WHERE form2_date_added BETWEEN '$start' AND '$end' AND bfp_users.municipal = '$province' ORDER BY form2_date_added DESC";
  // Generate report
  $pdf->mysql_report($sql_statement, false, $attr);

  $attr = array('titleFontSize' => 18, 'titleText' => 'Government Building');
  $sql_statement = "SELECT fname as `First Name`, mname as `Middle Name`, lname as `Last Name`, 
  gender as `Gender`, bday as `Birth Day`, brgy as `Barangay`, bfp_users.location as `Municipal`, type as `Application Type`,lbl as `Structure`,
  with_or_not as `FSIC Issued`, new_renew as `New or Renewal`, reinspection_1 as `Re-inspection Type`, reinspection_2 as `Compliant/Non-Compliant`,
  reinspection_3 as `Issue`, closure as `Closure Order`,
  if(form3_status = '1', 'Approved', 'Requesting') as `Status`, form3_date_added as `Date` 
  FROM bfp_form3 LEFT JOIN structure ON structure.structure_id = bfp_form3.structure
  LEFT JOIN bfp_users ON bfp_users.uid = bfp_form3.uid
  WHERE form3_date_added BETWEEN '$start' AND '$end' AND bfp_users.municipal = '$province' ORDER BY form3_date_added DESC";
  // Generate report
  $pdf->mysql_report($sql_statement, false, $attr);

  $attr = array('titleFontSize' => 18, 'titleText' => 'FIRE CODE FEES COLLECTION');
  $sql_statement = "SELECT fname as `First Name`, mname as `Middle Name`, lname as `Last Name`, 
  gender as `Gender`, bday as `Birth Day`, brgy as `Barangay`, bfp_users.location as `Municipal`, fire_code_fees as `Fire Code Fees`,
  fees as `Fees`, if(form4_status = '1', 'Approved', 'Requesting') as `Status`, form4_date_added as `Date` 
  FROM bfp_form4 LEFT JOIN bfp_users ON bfp_users.uid = bfp_form4.uid
  WHERE form4_date_added BETWEEN '$start' AND bfp_users.municipal = '$province' AND '$end' ORDER BY form4_date_added DESC";
  // Generate report
  $pdf->mysql_report($sql_statement, false, $attr);
}
/*!!! Very Important: after having done all the work of 
  setting up the SQL don't forget to output the PDF else
  you just get a blank page !!!*/

$pdf->Output();


/* ADVICE do not use a PHP closing tag like  ?> */