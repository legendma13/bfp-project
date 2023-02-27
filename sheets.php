<?php
include_once "php/config.php";
session_start();
$uid = htmlspecialchars($_SESSION['uid']);

$municipal = mysqli_fetch_assoc($link->query("SELECT * FROM bfp_users WHERE uid = '$uid'"));

if (!$_SESSION['login']) {
  header("location: ./");
}
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use PhpOffice\PhpSpreadsheet\Writer\Csv;

$reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader("Xlsx");
$spreadsheet = $reader->load('documents/Municipal.xlsx');
$sheet = $spreadsheet->getSheetByName('form1');
$sheet2 = $spreadsheet->getSheetByName('form2');
$sheet3 = $spreadsheet->getSheetByName('form3');
$sheet4 = $spreadsheet->getSheetByName('form4');
$startdate = $_GET['start'];
$enddate = $_GET['end'];
$startdate_l = date('Y-m-d', strtotime($startdate . '- 1 month'));
$enddate_l = date('Y-m-d', strtotime($enddate . '- 1 month'));
$startdate_lastyear = date('Y-m-d', strtotime($startdate . '- 1 year'));
$enddate_lastyear = date('Y-m-d', strtotime($enddate . '- 1 year'));
$startdate1 = date("Y-M", strtotime($startdate));
$enddate1 = date("Y-M", strtotime($enddate));
// Form 1
$sheet->setCellValue('A2', $startdate1 . ' To ' . $enddate1);
$brgy = $link->query("SELECT * FROM brgy 
WHERE municipal = '" . $municipal['location'] . "'
ORDER BY barangay ASC");
$rowStart = 8;
$f1previous = 85;
$Government = 87;
$f1previousgob = 164;
$fsect = 0;
$fsectgb = 0;
$nodt = 0;
$nodtgb = 0;
$structuretotalNC = 0;
$structuretotalgobNC = 0;
$structuretotalRN = 0;
$structuretotalgobRN=0;
$issuance1 = 0;
$issuance2 = 0;
$issuance3 = 0;
$issuance1gob = 0;
$issuance2gob = 0;
$issuance3gob = 0;
while ($row = $brgy->fetch_assoc()) {
  // Show Barangay
  $sheet->setCellValue('B' . $rowStart, $row['barangay']);
  $sheet->setCellValue('B' . $Government, $row['barangay']);
  $query = mysqli_fetch_assoc($link->query("SELECT COUNT(form1_id), 
  COUNT(CASE WHEN fsec='Issued FSEC' THEN 1 END),
  COUNT(CASE WHEN fsec='Issued Notice of Disapproval (NOD)' THEN 1 END),
  COUNT(CASE WHEN inspection='NC' THEN 1 END),
  COUNT(CASE WHEN inspection='RN' THEN 1 END),
  COUNT(CASE WHEN issuance='Issued FSIC for Occupancy' THEN 1 END),
  COUNT(CASE WHEN issuance='Issued With NOD for NOT OCCUPIED buildings/establishments' THEN 1 END),
  COUNT(CASE WHEN issuance='Issued With NTC for OCCUPIED buildings/establishments' THEN 1 END)
  FROM bfp_form1
  WHERE form1_date_added BETWEEN '$startdate' AND '$enddate' 
  AND uid = '$uid' AND brgy = '" . $row['barangay'] . "'
  AND type='New Establishments Buildings' AND form1_status='1'"));
  $query_l = mysqli_fetch_assoc($link->query("SELECT COUNT(form1_id), 
  COUNT(CASE WHEN fsec='Issued FSEC' THEN 1 END), 
  COUNT(CASE WHEN fsec='Issued Notice of Disapproval (NOD)' THEN 1 END),
  COUNT(CASE WHEN inspection='NC' THEN 1 END),
  COUNT(CASE WHEN inspection='RN' THEN 1 END),
  COUNT(CASE WHEN issuance='Issued FSIC for Occupancy' THEN 1 END),
  COUNT(CASE WHEN issuance='Issued With NOD for NOT OCCUPIED buildings/establishments' THEN 1 END),
  COUNT(CASE WHEN issuance='Issued With NTC for OCCUPIED buildings/establishments' THEN 1 END)
  FROM bfp_form1
  WHERE form1_date_added BETWEEN '$startdate_l' AND '$enddate_l' 
  AND uid = '$uid' AND brgy = '" . $row['barangay'] . "'
  AND type='New Establishments Buildings' AND form1_status='1'"));
  $fsect = $fsect + $query_l["COUNT(CASE WHEN fsec='Issued FSEC' THEN 1 END)"];
  $nodt = $nodt + $query_l["COUNT(CASE WHEN fsec='Issued Notice of Disapproval (NOD)' THEN 1 END)"];
  $issuance1 = $issuance1 +  $query_l["COUNT(CASE WHEN issuance='Issued FSIC for Occupancy' THEN 1 END)"];
  $issuance2 = $issuance2 +  $query_l["COUNT(CASE WHEN issuance='Issued With NOD for NOT OCCUPIED buildings/establishments' THEN 1 END)"];
  $issuance3 = $issuance3 +  $query_l["COUNT(CASE WHEN issuance='Issued With NTC for OCCUPIED buildings/establishments' THEN 1 END)"];
  $query_GB = mysqli_fetch_assoc($link->query("SELECT COUNT(form1_id), 
  COUNT(CASE WHEN fsec='Issued FSEC' THEN 1 END),
  COUNT(CASE WHEN fsec='Issued Notice of Disapproval (NOD)' THEN 1 END),
  COUNT(CASE WHEN inspection='NC' THEN 1 END),
  COUNT(CASE WHEN inspection='RN' THEN 1 END),
  COUNT(CASE WHEN issuance='Issued FSIC for Occupancy' THEN 1 END),
  COUNT(CASE WHEN issuance='Issued With NOD for NOT OCCUPIED buildings/establishments' THEN 1 END),
  COUNT(CASE WHEN issuance='Issued With NTC for OCCUPIED buildings/establishments' THEN 1 END)
  FROM bfp_form1
  WHERE form1_date_added BETWEEN '$startdate' AND '$enddate' 
  AND uid = '$uid' AND brgy = '" . $row['barangay'] . "'
  AND type='New Government Buildings' AND form1_status='1'"));
  $query_GB_l = mysqli_fetch_assoc($link->query("SELECT COUNT(form1_id), 
  COUNT(CASE WHEN fsec='Issued FSEC' THEN 1 END), 
  COUNT(CASE WHEN fsec='Issued Notice of Disapproval (NOD)' THEN 1 END),
  COUNT(CASE WHEN inspection='NC' THEN 1 END),
  COUNT(CASE WHEN inspection='RN' THEN 1 END),
  COUNT(CASE WHEN issuance='Issued FSIC for Occupancy' THEN 1 END),
  COUNT(CASE WHEN issuance='Issued With NOD for NOT OCCUPIED buildings/establishments' THEN 1 END),
  COUNT(CASE WHEN issuance='Issued With NTC for OCCUPIED buildings/establishments' THEN 1 END)
  FROM bfp_form1
  WHERE form1_date_added BETWEEN '$startdate_l' AND '$enddate_l' 
  AND uid = '$uid' AND brgy = '" . $row['barangay'] . "'
  AND type='New Government Buildings' AND form1_status='1'"));
  $fsectgb = $fsectgb + $query_GB_l["COUNT(CASE WHEN fsec='Issued FSEC' THEN 1 END)"];
  $nodtgb = $nodtgb + $query_GB_l["COUNT(CASE WHEN fsec='Issued Notice of Disapproval (NOD)' THEN 1 END)"];
  $issuance1gob = $issuance1gob +  $query_GB_l["COUNT(CASE WHEN issuance='Issued FSIC for Occupancy' THEN 1 END)"];
  $issuance2gob = $issuance2gob +  $query_GB_l["COUNT(CASE WHEN issuance='Issued With NOD for NOT OCCUPIED buildings/establishments' THEN 1 END)"];
  $issuance3gob = $issuance3gob +  $query_GB_l["COUNT(CASE WHEN issuance='Issued With NTC for OCCUPIED buildings/establishments' THEN 1 END)"];
  // Structure
  $NC = array(
    array("Assembly","J"),
    array("Educational","L"),
    array("Day Care","N"),
    array("Health Care","P"),
    array("Residential Board & Care","R"),
    array("Detention & Correctional","T"),
    array("Hotel","V"),
    array("Dormitories","X"),
    array("Apartment Building","Z"),
    array("Lodging and Rooming house","AB"),
    array("Single and Two Family Dwelling Unit","AD"),
    array("Mercantile","AF"),
    array("Business","AH"),
    array("Industrial","AJ"),
    array("Storage","AL"),
    array("Special Structures","AN")
  );
  $RN = array(
    array("Assembly","K"),
    array("Educational","M"),
    array("Day Care","O"),
    array("Health Care","Q"),
    array("Residential Board & Care","S"),
    array("Detention & Correctional","U"),
    array("Hotel","W"),
    array("Dormitories","Y"),
    array("Apartment Building","AA"),
    array("Lodging and Rooming house","AC"),
    array("Single and Two Family Dwelling Unit","AE"),
    array("Mercantile","AG"),
    array("Business","AI"),
    array("Industrial","AK"),
    array("Storage","AM"),
    array("Special Structures","AO")
  );
  foreach ($NC as $NC) {
    $structure = mysqli_fetch_assoc($link->query("SELECT COUNT(bfp_form1.uid) FROM bfp_form1
    LEFT JOIN structure ON structure.structure_id = bfp_form1.structure
    WHERE bfp_form1.form1_date_added BETWEEN '$startdate' AND '$enddate' 
    AND uid = '$uid' AND structure.lbl = '".$NC[0]."' AND type='New Establishments Buildings'
    AND bfp_form1.brgy = '" . $row['barangay'] . "' AND bfp_form1.nc_or_rn = 'NC' AND form1_status = '1'"));
    $structure_GB = mysqli_fetch_assoc($link->query("SELECT COUNT(bfp_form1.uid) FROM bfp_form1
    LEFT JOIN structure ON structure.structure_id = bfp_form1.structure
    WHERE bfp_form1.form1_date_added BETWEEN '$startdate' AND '$enddate' 
    AND uid = '$uid' AND structure.lbl = '".$NC[0]."' AND type='New Government Buildings'
    AND bfp_form1.brgy = '" . $row['barangay'] . "' AND bfp_form1.nc_or_rn = 'NC' AND form1_status = '1'"));
    $lastyear_structureNC = mysqli_fetch_assoc($link->query("SELECT COUNT(bfp_form1.uid) FROM bfp_form1
    LEFT JOIN structure ON structure.structure_id = bfp_form1.structure
    WHERE bfp_form1.form1_date_added BETWEEN '$startdate_lastyear' AND '$enddate_lastyear' 
    AND uid = '$uid' AND structure.lbl = '".$NC[0]."' AND type='New Establishments Buildings' AND bfp_form1.nc_or_rn = 'NC' AND form1_status = '1'"));
    $lastyear_structuregobNC = mysqli_fetch_assoc($link->query("SELECT COUNT(bfp_form1.uid) FROM bfp_form1
    LEFT JOIN structure ON structure.structure_id = bfp_form1.structure
    WHERE bfp_form1.form1_date_added BETWEEN '$startdate_lastyear' AND '$enddate_lastyear' 
    AND uid = '$uid' AND structure.lbl = '".$NC[0]."' AND type='New Government Buildings' AND bfp_form1.nc_or_rn = 'NC' AND form1_status = '1'"));
    $structuretotalNC = $structuretotalNC + $lastyear_structureNC['COUNT(bfp_form1.uid)'];
    $structuretotalgobNC = $structuretotalgobNC + $lastyear_structuregobNC['COUNT(bfp_form1.uid)'];
    $sheet->setCellValue($NC[1] . $rowStart, $structure['COUNT(bfp_form1.uid)']);
    $sheet->setCellValue($NC[1] . $Government, $structure_GB['COUNT(bfp_form1.uid)']);
    $sheet->setCellValue($NC[1] . $f1previous, $lastyear_structureNC['COUNT(bfp_form1.uid)']);
    $sheet->setCellValue($NC[1] . $f1previousgob, $lastyear_structuregobNC['COUNT(bfp_form1.uid)']);
  }
  foreach ($RN as $RN) {
    $structure = mysqli_fetch_assoc($link->query("SELECT COUNT(bfp_form1.uid) FROM bfp_form1
    LEFT JOIN structure ON structure.structure_id = bfp_form1.structure
    WHERE bfp_form1.form1_date_added BETWEEN '$startdate' AND '$enddate' 
    AND uid = '$uid' AND structure.lbl = '".$RN[0]."' AND type='New Establishments Buildings'
    AND bfp_form1.brgy = '" . $row['barangay'] . "' AND bfp_form1.nc_or_rn = 'RN' AND form1_status = '1'"));
    $structure_GB = mysqli_fetch_assoc($link->query("SELECT COUNT(bfp_form1.uid) FROM bfp_form1
    LEFT JOIN structure ON structure.structure_id = bfp_form1.structure
    WHERE bfp_form1.form1_date_added BETWEEN '$startdate' AND '$enddate' 
    AND uid = '$uid' AND structure.lbl = '".$RN[0]."' AND type='New Government Buildings'
    AND bfp_form1.brgy = '" . $row['barangay'] . "' AND bfp_form1.nc_or_rn = 'RN' AND form1_status = '1'"));
    $lastyear_structureRN = mysqli_fetch_assoc($link->query("SELECT COUNT(bfp_form1.uid) FROM bfp_form1
    LEFT JOIN structure ON structure.structure_id = bfp_form1.structure
    WHERE bfp_form1.form1_date_added BETWEEN '$startdate_lastyear' AND '$enddate_lastyear' 
    AND uid = '$uid' AND structure.lbl = '".$RN[0]."' AND type='New Establishments Buildings' AND bfp_form1.nc_or_rn = 'RN' AND form1_status = '1'"));
    $lastyear_structuregobRN = mysqli_fetch_assoc($link->query("SELECT COUNT(bfp_form1.uid) FROM bfp_form1
    LEFT JOIN structure ON structure.structure_id = bfp_form1.structure
    WHERE bfp_form1.form1_date_added BETWEEN '$startdate_lastyear' AND '$enddate_lastyear' 
    AND uid = '$uid' AND structure.lbl = '".$RN[0]."' AND type='New Government Buildings' AND bfp_form1.nc_or_rn = 'RN' AND form1_status = '1'"));
    $structuretotalRN = $structuretotalRN + $lastyear_structureRN['COUNT(bfp_form1.uid)'];
    $structuretotalgobRN = $structuretotalgobRN + $lastyear_structuregobRN['COUNT(bfp_form1.uid)'];
    $sheet->setCellValue($RN[1] . $rowStart, $structure['COUNT(bfp_form1.uid)']);
    $sheet->setCellValue($RN[1] . $Government, $structure_GB['COUNT(bfp_form1.uid)']);
    $sheet->setCellValue($RN[1] . $f1previous, $lastyear_structureRN['COUNT(bfp_form1.uid)']);
    $sheet->setCellValue($RN[1] . $f1previousgob, $lastyear_structuregobRN['COUNT(bfp_form1.uid)']);
  }
  // Print // NEW BUILDING
  $sheet->setCellValue('C' . $rowStart, $query['COUNT(form1_id)']);
  $sheet->setCellValue('D' . $rowStart, $query["COUNT(CASE WHEN fsec='Issued FSEC' THEN 1 END)"]);
  $sheet->setCellValue('E' . $rowStart, $query_l["COUNT(CASE WHEN fsec='Issued FSEC' THEN 1 END)"]);
  $sheet->setCellValue('G' . $rowStart, $query["COUNT(CASE WHEN fsec='Issued Notice of Disapproval (NOD)' THEN 1 END)"]);
  $sheet->setCellValue('H' . $rowStart, $query_l["COUNT(CASE WHEN fsec='Issued Notice of Disapproval (NOD)' THEN 1 END)"]);
  $sheet->setCellValue('AS' . $rowStart, $query["COUNT(CASE WHEN inspection='NC' THEN 1 END)"]);
  $sheet->setCellValue('AT' . $rowStart, $query["COUNT(CASE WHEN inspection='RN' THEN 1 END)"]);
  $sheet->setCellValue('AV' . $rowStart, $query["COUNT(CASE WHEN issuance='Issued FSIC for Occupancy' THEN 1 END)"]);
  $sheet->setCellValue('AW' . $rowStart, $query_l["COUNT(CASE WHEN issuance='Issued FSIC for Occupancy' THEN 1 END)"]);
  $sheet->setCellValue('AY' . $rowStart, $query["COUNT(CASE WHEN issuance='Issued With NOD for NOT OCCUPIED buildings/establishments' THEN 1 END)"]);
  $sheet->setCellValue('AZ' . $rowStart, $query_l["COUNT(CASE WHEN issuance='Issued With NOD for NOT OCCUPIED buildings/establishments' THEN 1 END)"]);
  $sheet->setCellValue('BB' . $rowStart, $query["COUNT(CASE WHEN issuance='Issued With NTC for OCCUPIED buildings/establishments' THEN 1 END)"]);
  $sheet->setCellValue('BC' . $rowStart, $query_l["COUNT(CASE WHEN issuance='Issued With NTC for OCCUPIED buildings/establishments' THEN 1 END)"]);
  // Print // GOV ESTAB
  $sheet->setCellValue('C' . $Government, $query_GB['COUNT(form1_id)']);
  $sheet->setCellValue('D' . $Government, $query_GB["COUNT(CASE WHEN fsec='Issued FSEC' THEN 1 END)"]);
  $sheet->setCellValue('E' . $Government, $query_GB_l["COUNT(CASE WHEN fsec='Issued FSEC' THEN 1 END)"]);
  $sheet->setCellValue('G' . $Government, $query_GB["COUNT(CASE WHEN fsec='Issued Notice of Disapproval (NOD)' THEN 1 END)"]);
  $sheet->setCellValue('H' . $Government, $query_GB_l["COUNT(CASE WHEN fsec='Issued Notice of Disapproval (NOD)' THEN 1 END)"]);
  $sheet->setCellValue('AS' . $Government, $query_GB["COUNT(CASE WHEN inspection='NC' THEN 1 END)"]);
  $sheet->setCellValue('AT' . $Government, $query_GB["COUNT(CASE WHEN inspection='RN' THEN 1 END)"]);
  $sheet->setCellValue('AV' . $Government, $query_GB["COUNT(CASE WHEN issuance='Issued FSIC for Occupancy' THEN 1 END)"]);
  $sheet->setCellValue('AW' . $Government, $query_GB_l["COUNT(CASE WHEN issuance='Issued FSIC for Occupancy' THEN 1 END)"]);
  $sheet->setCellValue('AY' . $Government, $query_GB["COUNT(CASE WHEN issuance='Issued With NOD for NOT OCCUPIED buildings/establishments' THEN 1 END)"]);
  $sheet->setCellValue('AZ' . $Government, $query_GB_l["COUNT(CASE WHEN issuance='Issued With NOD for NOT OCCUPIED buildings/establishments' THEN 1 END)"]);
  $sheet->setCellValue('BB' . $Government, $query_GB["COUNT(CASE WHEN issuance='Issued With NTC for OCCUPIED buildings/establishments' THEN 1 END)"]);
  $sheet->setCellValue('BC' . $Government, $query_GB_l["COUNT(CASE WHEN issuance='Issued With NTC for OCCUPIED buildings/establishments' THEN 1 END)"]);
  $rowStart++;
  $Government++;
}
  // $letter = array('C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W'.'X','Y','Z',
                  // 'AA','AB','AC','AD','AE','AF','AG','AH','AI','AJ','AK','AL','AM','AN','AO','AP','AQ','AR','AS','AT','AU','AV','AW','AX','AY','AZ',
                  // 'BA','BB');
  $newbuild = mysqli_fetch_assoc($link->query("SELECT COUNT(form1_id), 
  COUNT(CASE WHEN fsec='Issued FSEC' THEN 1 END),
  COUNT(CASE WHEN fsec='Issued Notice of Disapproval (NOD)' THEN 1 END),
  COUNT(CASE WHEN inspection='NC' THEN 1 END),
  COUNT(CASE WHEN inspection='RN' THEN 1 END),
  COUNT(CASE WHEN issuance='Issued FSIC for Occupancy' THEN 1 END),
  COUNT(CASE WHEN issuance='Issued With NOD for NOT OCCUPIED buildings/establishments' THEN 1 END),
  COUNT(CASE WHEN issuance='Issued With NTC for OCCUPIED buildings/establishments' THEN 1 END)
  FROM bfp_form1
  WHERE form1_date_added BETWEEN '$startdate_lastyear' AND '$enddate_lastyear' 
  AND uid = '$uid' AND type='New Establishments Buildings' AND form1_status='1'"));
  $govestab = mysqli_fetch_assoc($link->query("SELECT COUNT(form1_id), 
  COUNT(CASE WHEN fsec='Issued FSEC' THEN 1 END),
  COUNT(CASE WHEN fsec='Issued Notice of Disapproval (NOD)' THEN 1 END),
  COUNT(CASE WHEN inspection='NC' THEN 1 END),
  COUNT(CASE WHEN inspection='RN' THEN 1 END),
  COUNT(CASE WHEN issuance='Issued FSIC for Occupancy' THEN 1 END),
  COUNT(CASE WHEN issuance='Issued With NOD for NOT OCCUPIED buildings/establishments' THEN 1 END),
  COUNT(CASE WHEN issuance='Issued With NTC for OCCUPIED buildings/establishments' THEN 1 END)
  FROM bfp_form1
  WHERE form1_date_added BETWEEN '$startdate_lastyear' AND '$enddate_lastyear' 
  AND uid = '$uid' AND type='New Government Buildings' AND form1_status='1'"));
  // ToTAL 
  $sheet->setCellValue('C' . $f1previous, $newbuild['COUNT(form1_id)']);
  $sheet->setCellValue('C' . $f1previousgob, $govestab['COUNT(form1_id)']);
  $sheet->setCellValue('D' . $f1previous, $newbuild["COUNT(CASE WHEN fsec='Issued FSEC' THEN 1 END)"]);
  $sheet->setCellValue('D' . $f1previousgob, $govestab["COUNT(CASE WHEN fsec='Issued FSEC' THEN 1 END)"]);
  $sheet->setCellValue('E' . $f1previous, $fsect);
  $sheet->setCellValue('E' . $f1previousgob, $fsectgb);
  $sheet->setCellValue('F' . $f1previous, $fsect+$newbuild["COUNT(CASE WHEN fsec='Issued FSEC' THEN 1 END)"]);
  $sheet->setCellValue('F' . $f1previousgob, $fsectgb+$govestab["COUNT(CASE WHEN fsec='Issued FSEC' THEN 1 END)"]);
  $sheet->setCellValue('G' . $f1previous, $newbuild["COUNT(CASE WHEN fsec='Issued Notice of Disapproval (NOD)' THEN 1 END)"]);
  $sheet->setCellValue('G' . $f1previousgob, $govestab["COUNT(CASE WHEN fsec='Issued Notice of Disapproval (NOD)' THEN 1 END)"]);
  $sheet->setCellValue('H' . $f1previous, $nodt);
  $sheet->setCellValue('H' . $f1previousgob, $nodtgb);
  $sheet->setCellValue('I' . $f1previous, $nodt+$newbuild["COUNT(CASE WHEN fsec='Issued Notice of Disapproval (NOD)' THEN 1 END)"]);
  $sheet->setCellValue('I' . $f1previousgob, $nodtgb+$govestab["COUNT(CASE WHEN fsec='Issued Notice of Disapproval (NOD)' THEN 1 END)"]);
  $sheet->setCellValue('AP' . $f1previous, $structuretotalNC);
  $sheet->setCellValue('AQ' . $f1previous, $structuretotalRN);
  $sheet->setCellValue('AR' . $f1previous, $structuretotalNC+$structuretotalRN);
  $sheet->setCellValue('AS' . $f1previous, $newbuild["COUNT(CASE WHEN inspection='NC' THEN 1 END)"]);
  $sheet->setCellValue('AT' . $f1previous, $newbuild["COUNT(CASE WHEN inspection='RN' THEN 1 END)"]);
  $sheet->setCellValue('AU' . $f1previous, $newbuild["COUNT(CASE WHEN inspection='NC' THEN 1 END)"]+$newbuild["COUNT(CASE WHEN inspection='RN' THEN 1 END)"]);
  $sheet->setCellValue('AV' . $f1previous, $newbuild["COUNT(CASE WHEN issuance='Issued FSIC for Occupancy' THEN 1 END)"]);
  $sheet->setCellValue('AY' . $f1previous, $newbuild["COUNT(CASE WHEN issuance='Issued With NOD for NOT OCCUPIED buildings/establishments' THEN 1 END)"]);
  $sheet->setCellValue('BB' . $f1previous, $newbuild["COUNT(CASE WHEN issuance='Issued With NTC for OCCUPIED buildings/establishments' THEN 1 END)"]);
  $sheet->setCellValue('AW' . $f1previous, $issuance1);
  $sheet->setCellValue('AZ' . $f1previous, $issuance2);
  $sheet->setCellValue('BC' . $f1previous, $issuance3);
  $sheet->setCellValue('AX' . $f1previous, $issuance1+$newbuild["COUNT(CASE WHEN issuance='Issued FSIC for Occupancy' THEN 1 END)"]);
  $sheet->setCellValue('BA' . $f1previous, $issuance2+$newbuild["COUNT(CASE WHEN issuance='Issued With NOD for NOT OCCUPIED buildings/establishments' THEN 1 END)"]);
  $sheet->setCellValue('BD' . $f1previous, $issuance3+$newbuild["COUNT(CASE WHEN issuance='Issued With NTC for OCCUPIED buildings/establishments' THEN 1 END)"]);
  $sheet->setCellValue('AP' . $f1previousgob, $structuretotalgobNC);
  $sheet->setCellValue('AQ' . $f1previousgob, $structuretotalgobRN);
  $sheet->setCellValue('AR' . $f1previousgob, $structuretotalgobNC+$structuretotalgobRN);
  $sheet->setCellValue('AS' . $f1previousgob, $govestab["COUNT(CASE WHEN inspection='NC' THEN 1 END)"]);
  $sheet->setCellValue('AT' . $f1previousgob, $govestab["COUNT(CASE WHEN inspection='RN' THEN 1 END)"]);
  $sheet->setCellValue('AU' . $f1previousgob, $govestab["COUNT(CASE WHEN inspection='NC' THEN 1 END)"]+$govestab["COUNT(CASE WHEN inspection='RN' THEN 1 END)"]);
  $sheet->setCellValue('AV' . $f1previousgob, $govestab["COUNT(CASE WHEN issuance='Issued FSIC for Occupancy' THEN 1 END)"]);
  $sheet->setCellValue('AY' . $f1previousgob, $govestab["COUNT(CASE WHEN issuance='Issued With NOD for NOT OCCUPIED buildings/establishments' THEN 1 END)"]);
  $sheet->setCellValue('BB' . $f1previousgob, $govestab["COUNT(CASE WHEN issuance='Issued With NTC for OCCUPIED buildings/establishments' THEN 1 END)"]);
  $sheet->setCellValue('AW' . $f1previousgob, $issuance1gob);
  $sheet->setCellValue('AZ' . $f1previousgob, $issuance2gob);
  $sheet->setCellValue('BC' . $f1previousgob, $issuance3gob);
  $sheet->setCellValue('AX' . $f1previousgob, $issuance1gob+$govestab["COUNT(CASE WHEN issuance='Issued FSIC for Occupancy' THEN 1 END)"]);
  $sheet->setCellValue('BA' . $f1previousgob, $issuance2gob+$govestab["COUNT(CASE WHEN issuance='Issued With NOD for NOT OCCUPIED buildings/establishments' THEN 1 END)"]);
  $sheet->setCellValue('BD' . $f1previousgob, $issuance3gob+$govestab["COUNT(CASE WHEN issuance='Issued With NTC for OCCUPIED buildings/establishments' THEN 1 END)"]);
// END FORM 1

// FORM 2 
  $f2row = 11;
  $brgy2 = $link->query("SELECT * FROM brgy 
  WHERE municipal = '" . $municipal['location'] . "'
  ORDER BY barangay ASC");
  while($shbrgy = $brgy2->fetch_assoc()){
    $sheet2->setCellValue('A' . $f2row, $shbrgy['barangay']);
    $data = mysqli_fetch_assoc($link->query("SELECT COUNT(CASE WHEN type='New' THEN 1 END),
    COUNT(CASE WHEN type='Renew' THEN 1 END),
    COUNT(CASE WHEN fsic='New' AND with_or_not='FSIC Issued WITHIN Prescribed Period' THEN 1 END),
    COUNT(CASE WHEN fsic='New' AND with_or_not='FSIC Issued NOT WITHIN Prescribed Period' THEN 1 END),
    COUNT(CASE WHEN fsic='Renew' AND with_or_not='FSIC Issued WITHIN Prescribed Period' THEN 1 END),
    COUNT(CASE WHEN fsic='Renew' AND with_or_not='FSIC Issued NOT WITHIN Prescribed Period' THEN 1 END),
    COUNT(CASE WHEN reinspection_1='NOTICE TO COMPLY' AND reinspection_2='Non-Compliant' AND reinspection_3='Issued NTC' THEN 1 END),
    COUNT(CASE WHEN reinspection_1='NOTICE TO COMPLY' AND reinspection_2='Compliant' AND reinspection_3='Issued FSIC for Business Operation' THEN 1 END),
    COUNT(CASE WHEN reinspection_1='NOTICE TO CORRECT VIOLATION' AND reinspection_2='Non-Compliant' AND reinspection_3='Issued NTCV' THEN 1 END),
    COUNT(CASE WHEN reinspection_1='NOTICE TO CORRECT VIOLATION' AND reinspection_2='Compliant' AND reinspection_3='Issued FSIC for Business Operation' THEN 1 END),
    COUNT(CASE WHEN reinspection_1='ABATEMENT' AND reinspection_2='Non-Compliant' AND reinspection_3='Issued Abatement Order' THEN 1 END),
    COUNT(CASE WHEN reinspection_1='ABATEMENT' AND reinspection_2='Compliant' AND reinspection_3='Total Issued FSIC for Business/ Operation' THEN 1 END),
    COUNT(CASE WHEN closure='Closure Order for Failure to Comply the Abatement order' THEN 1 END),
    COUNT(CASE WHEN closure='Closure For Failure To Pay Fine' THEN 1 END)
    FROM bfp_form2
    WHERE form2_date_added BETWEEN '$startdate' AND '$enddate' 
    AND uid = '$uid' AND brgy = '".$shbrgy['barangay']."' AND form2_status='1';"));

    $letter = array(
      array("1","E"),
      array("2","F"),
      array("3","G"),
      array("4","H"),
      array("5","I"),
      array("6","J"),
      array("7","K"),
      array("8","L"),
      array("9","M"),
      array("10","N"),
      array("11","O"),
      array("12","P"),
      array("13","Q"),
      array("14","R"),
      array("15","S"),
      array("16","T"),
      array("0","U")
    );
    foreach ($letter as $letter){
      $f2structure = mysqli_fetch_assoc($link->query("SELECT COUNT(CASE WHEN structure = '".$letter[0]."' THEN 1 END) FROM bfp_form2 
      WHERE form2_date_added BETWEEN '$startdate' AND '$enddate' 
      AND uid = '$uid' AND brgy = '".$shbrgy['barangay']."' AND form2_status='1';"));
      $sheet2->setCellValue($letter[1] . $f2row, $f2structure["COUNT(CASE WHEN structure = '".$letter[0]."' THEN 1 END)"]);
    }
    $sheet2->setCellValue('B' . $f2row, $data["COUNT(CASE WHEN type='New' THEN 1 END)"]);
    $sheet2->setCellValue('C' . $f2row, $data["COUNT(CASE WHEN type='Renew' THEN 1 END)"]);
    $sheet2->setCellValue('W' . $f2row, $data["COUNT(CASE WHEN fsic='New' AND with_or_not='FSIC Issued WITHIN Prescribed Period' THEN 1 END)"]);
    $sheet2->setCellValue('X' . $f2row, $data["COUNT(CASE WHEN fsic='New' AND with_or_not='FSIC Issued NOT WITHIN Prescribed Period' THEN 1 END)"]);
    $sheet2->setCellValue('Y' . $f2row, $data["COUNT(CASE WHEN fsic='Renew' AND with_or_not='FSIC Issued WITHIN Prescribed Period' THEN 1 END)"]);
    $sheet2->setCellValue('Z' . $f2row, $data["COUNT(CASE WHEN fsic='Renew' AND with_or_not='FSIC Issued NOT WITHIN Prescribed Period' THEN 1 END)"]);
    $sheet2->setCellValue('AB' . $f2row, $data["COUNT(CASE WHEN reinspection_1='NOTICE TO COMPLY' AND reinspection_2='Non-Compliant' AND reinspection_3='Issued NTC' THEN 1 END)"]);
    $sheet2->setCellValue('AC' . $f2row, $data["COUNT(CASE WHEN reinspection_1='NOTICE TO COMPLY' AND reinspection_2='Compliant' AND reinspection_3='Issued FSIC for Business Operation' THEN 1 END)"]);
    $sheet2->setCellValue('AD' . $f2row, $data["COUNT(CASE WHEN reinspection_1='NOTICE TO CORRECT VIOLATION' AND reinspection_2='Non-Compliant' AND reinspection_3='Issued NTCV' THEN 1 END)"]);
    $sheet2->setCellValue('AE' . $f2row, $data["COUNT(CASE WHEN reinspection_1='NOTICE TO CORRECT VIOLATION' AND reinspection_2='Compliant' AND reinspection_3='Issued FSIC for Business Operation' THEN 1 END)"]);
    $sheet2->setCellValue('AF' . $f2row, $data["COUNT(CASE WHEN reinspection_1='ABATEMENT' AND reinspection_2='Non-Compliant' AND reinspection_3='Issued Abatement Order' THEN 1 END)"]);
    $sheet2->setCellValue('AG' . $f2row, $data["COUNT(CASE WHEN reinspection_1='ABATEMENT' AND reinspection_2='Compliant' AND reinspection_3='Total Issued FSIC for Business/ Operation' THEN 1 END)"]);
    $sheet2->setCellValue('AI' . $f2row, $data["COUNT(CASE WHEN closure='Closure Order for Failure to Comply the Abatement order' THEN 1 END)"]);
    $sheet2->setCellValue('AJ' . $f2row, $data["COUNT(CASE WHEN closure='Closure For Failure To Pay Fine' THEN 1 END)"]);
    $f2row++; 
  }
// END FORM 2
// FORM 3
$f311 = 11;
$brgy3 = $link->query("SELECT * FROM brgy 
WHERE municipal = '" . $municipal['location'] . "'
ORDER BY barangay ASC");

while($shbrgy = $brgy3->fetch_assoc()){
  $sheet3->setCellValue('A' . $f311, $shbrgy['barangay']);

  $data = mysqli_fetch_assoc($link->query("SELECT COUNT(CASE WHEN type='New' THEN 1 END),
  COUNT(CASE WHEN type='Renew' THEN 1 END),
  COUNT(CASE WHEN new_renew='New' AND with_or_not='FSIC Issued WITHIN Prescribed Period' THEN 1 END),
  COUNT(CASE WHEN new_renew='New' AND with_or_not='FSIC Issued NOT WITHIN Prescribed Period' THEN 1 END),
  COUNT(CASE WHEN new_renew='Renew' AND with_or_not='FSIC Issued WITHIN Prescribed Period' THEN 1 END),
  COUNT(CASE WHEN new_renew='Renew' AND with_or_not='FSIC Issued NOT WITHIN Prescribed Period' THEN 1 END),
  COUNT(CASE WHEN reinspection_1='NOTICE TO COMPLY' AND reinspection_2='Non-Compliant' AND reinspection_3='Issued NTC' THEN 1 END),
  COUNT(CASE WHEN reinspection_1='NOTICE TO COMPLY' AND reinspection_2='Compliant' AND reinspection_3='Issued FSIC for Business Operation' THEN 1 END),
  COUNT(CASE WHEN reinspection_1='NOTICE TO CORRECT VIOLATION' AND reinspection_2='Non-Compliant' AND reinspection_3='Issued NTCV' THEN 1 END),
  COUNT(CASE WHEN reinspection_1='NOTICE TO CORRECT VIOLATION' AND reinspection_2='Compliant' AND reinspection_3='Issued FSIC for Business Operation' THEN 1 END),
  COUNT(CASE WHEN reinspection_1='ABATEMENT' AND reinspection_2='Non-Compliant' AND reinspection_3='Issued Abatement Order' THEN 1 END),
  COUNT(CASE WHEN reinspection_1='ABATEMENT' AND reinspection_2='Compliant' AND reinspection_3='Total Issued FSIC for Business/ Operation' THEN 1 END),
  COUNT(CASE WHEN closure='Closure Order for Failure to Comply the Abatement order' THEN 1 END),
  COUNT(CASE WHEN closure='Closure For Failure To Pay Fine' THEN 1 END)
  FROM bfp_form3
  WHERE form3_date_added BETWEEN '$startdate' AND '$enddate'
  AND uid = '$uid' AND brgy = '".$shbrgy['barangay']."' AND form3_status='1';"));
  $letter = array(
    array("1","E"),
    array("2","F"),
    array("3","G"),
    array("4","H"),
    array("5","I"),
    array("6","J"),
    array("7","K"),
    array("8","L"),
    array("9","M"),
    array("10","N"),
    array("11","O"),
    array("12","P"),
    array("13","Q"),
    array("14","R"),
    array("15","S"),
    array("16","T")
  );
  foreach ($letter as $letter) {
    $f3structure = mysqli_fetch_assoc($link->query("SELECT COUNT(CASE WHEN structure = '".$letter[0]."' THEN 1 END) FROM bfp_form3 
    WHERE form3_date_added BETWEEN '$startdate' AND '$enddate' 
    AND uid = '$uid' AND brgy = '".$shbrgy['barangay']."' AND form3_status='1';"));
    $sheet3->setCellValue($letter[1] . $f311, $f3structure["COUNT(CASE WHEN structure = '".$letter[0]."' THEN 1 END)"]);
  }
  $sheet3->setCellValue('B' . $f311, $data["COUNT(CASE WHEN type='New' THEN 1 END)"]);
  $sheet3->setCellValue('C' . $f311, $data["COUNT(CASE WHEN type='Renew' THEN 1 END)"]);
  $sheet3->setCellValue('V' . $f311, $data["COUNT(CASE WHEN new_renew='New' AND with_or_not='FSIC Issued WITHIN Prescribed Period' THEN 1 END)"]);
  
  $sheet3->setCellValue('W' . $f311, $data["COUNT(CASE WHEN new_renew='New' AND with_or_not='FSIC Issued WITHIN Prescribed Period' THEN 1 END)"]);
  $sheet3->setCellValue('X' . $f311, $data["COUNT(CASE WHEN new_renew='New' AND with_or_not='FSIC Issued NOT WITHIN Prescribed Period' THEN 1 END)"]);
  $sheet3->setCellValue('Y' . $f311, $data["COUNT(CASE WHEN new_renew='Renew' AND with_or_not='FSIC Issued WITHIN Prescribed Period' THEN 1 END)"]);
  $sheet3->setCellValue('V' . $f311, $data["COUNT(CASE WHEN new_renew='Renew' AND with_or_not='FSIC Issued NOT WITHIN Prescribed Period' THEN 1 END)"]);
  $sheet3->setCellValue('AA' . $f311, $data["COUNT(CASE WHEN reinspection_1='NOTICE TO COMPLY' AND reinspection_2='Non-Compliant' AND reinspection_3='Issued NTC' THEN 1 END)"]);
  $sheet3->setCellValue('AB' . $f311, $data["COUNT(CASE WHEN reinspection_1='NOTICE TO COMPLY' AND reinspection_2='Compliant' AND reinspection_3='Issued FSIC for Business Operation' THEN 1 END)"]);
  $sheet3->setCellValue('AC' . $f311, $data["COUNT(CASE WHEN reinspection_1='NOTICE TO CORRECT VIOLATION' AND reinspection_2='Non-Compliant' AND reinspection_3='Issued NTCV' THEN 1 END)"]);
  $sheet3->setCellValue('AD' . $f311, $data["COUNT(CASE WHEN reinspection_1='NOTICE TO CORRECT VIOLATION' AND reinspection_2='Compliant' AND reinspection_3='Issued FSIC for Business Operation' THEN 1 END)"]);
  $sheet3->setCellValue('AE' . $f311, $data["COUNT(CASE WHEN reinspection_1='ABATEMENT' AND reinspection_2='Non-Compliant' AND reinspection_3='Issued Abatement Order' THEN 1 END)"]);
  $sheet3->setCellValue('AF' . $f311, $data["COUNT(CASE WHEN reinspection_1='ABATEMENT' AND reinspection_2='Compliant' AND reinspection_3='Total Issued FSIC for Business/ Operation' THEN 1 END)"]);
  $sheet3->setCellValue('AH' . $f311, $data["COUNT(CASE WHEN closure='Closure Order for Failure to Comply the Abatement order' THEN 1 END)"]);
  $sheet3->setCellValue('AI' . $f311, $data["COUNT(CASE WHEN closure='Closure For Failure To Pay Fine' THEN 1 END)"]);

  $f311++;
}

// END FORM 3
// FORM 4
$f4start = 8;
$f4start1 = 70;

$brgy4 = $link->query("SELECT * FROM brgy 
WHERE municipal = '" . $municipal['location'] . "'
ORDER BY barangay ASC");

$array = array(
  array("Fire Code Construction",'C'),
  array("Fire Code Realty",'D'),
  array("Fire Code Premuim",'E'),
  array("Fire Code Sales",'F'),
  array("Fire Code Proceeds Tax",'G'),
  array("Fire Code Fees for Occupancy",'H'),
  array("Fire Code Fees for Business",'I'),
  array("Storage Clearance Fee",'J'),
  array("Conveyance Cleance Fee",'K'),
  array("Installation of Building Service Equipment",'L'),
  array("Installation of AFSS",'M'),
  array("Installation of FDAS",'N'),
  array("Installation of KHSS",'O'),
  array("Installation of Flammable and Combustible Liquids Storage Tanks",'P'),
  array("Installation of LPGAS System",'Q'),
  array("Other Installation Clearances",'R'),
  array("Fire Code Administrative Fines",'S'),
  array("Fireworks Display",'T'),
  array("Electrical Installation",'U'),
  array("Filing Fees for FSEC",'V'),
  array("Certified True Copy of FSEC/FSIC/ Other Clearances",'W'),
  array("Fumigation/Fogging",'X'),
  array("Fire Incident Clearance",'Y'),
  array("Protest Fee",'Z'),
  array("Fire Drill",'AA'),
  array("Appeal Fee",'AB'),
  array("Open Flame",'AC'),
  array("Fire Prevention and Safety Seminar",'AD'),
  array("Soundstage and Approved Production Facilities and Locations",'AE'),
  array("Welding, Cutting and Other Hotworks",'AF'),
  array("Others",'AG'),
  array("Certificate of Competency (COC) Fees",'AH'));

while($shbrgy = $brgy4->fetch_assoc()){
  $sheet4->setCellValue('B' . $f4start, $shbrgy['barangay']);
  $sheet4->setCellValue('B' . $f4start1, $shbrgy['barangay']);

  foreach ($array as $fees){
    $count = mysqli_fetch_assoc($link->query("SELECT SUM(fees) FROM bfp_form4
    WHERE form4_date_added BETWEEN '$startdate' AND '$enddate' AND type = 'Business Establishments' 
    AND fire_code_fees = '".$fees[0]."' AND uid = '$uid' AND brgy = '".$shbrgy['barangay']."' AND form4_status='1';"));

    $count_l = mysqli_fetch_assoc($link->query("SELECT SUM(fees) FROM bfp_form4
    WHERE form4_date_added BETWEEN '$startdate_lastyear' AND '$enddate_lastyear' AND type = 'Business Establishments' 
    AND fire_code_fees = '".$fees[0]."' AND uid = '$uid' AND brgy = '".$shbrgy['barangay']."' AND form4_status='1';"));

    $sheet4->setCellValue($fees[1] . $f4start, $count['SUM(fees)']);
    $sheet4->setCellValue($fees[1] . '68', $count_l['SUM(fees)']);
  } 
  foreach ($array as $fees1){
    $count1 = mysqli_fetch_assoc($link->query("SELECT SUM(fees) FROM bfp_form4
    WHERE form4_date_added BETWEEN '$startdate' AND '$enddate' AND type = 'Government Buildings' 
    AND fire_code_fees = '".$fees1[0]."' AND uid = '$uid' AND brgy = '".$shbrgy['barangay']."' AND form4_status='1';"));
    $count_l = mysqli_fetch_assoc($link->query("SELECT SUM(fees) FROM bfp_form4
    WHERE form4_date_added BETWEEN '$startdate_lastyear' AND '$enddate_lastyear' AND type = 'Government Buildings' 
    AND fire_code_fees = '".$fees[0]."' AND uid = '$uid' AND brgy = '".$shbrgy['barangay']."' AND form4_status='1';"));
    $sheet4->setCellValue($fees1[1] . $f4start1, $count1['SUM(fees)']);
    $sheet4->setCellValue($fees1[1] . "130", $count_l['SUM(fees)']);
  }
  $f4start++;
  $f4start1++;
}
// END FORM 4




// Export
$newname = date('Y-m-d h-i-s');
$writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, "Xlsx");
$writer->save('files/BPF-REPORT ' . $newname . '.xlsx');

header("location: files/BPF-REPORT " . $newname . '.xlsx');
