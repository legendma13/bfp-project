<?php
include_once "php/config.php";
session_start();
$uid = htmlspecialchars($_SESSION['uid']);

$start = $_GET['start'];
$end = $_GET['end'];
$start_l = date('Y-m-d', strtotime($start . '- 1 month'));
$end_l = date('Y-m-d', strtotime($end . '- 1 month'));
$start_lastyear = date('Y-m-d', strtotime($start . '- 1 year'));
$end_lastyear = date('Y-m-d', strtotime($end . '- 1 year'));
$start_lastyear_1 = date('Y-m-d', strtotime($start_lastyear . '- 1 month'));
$end_lastyear_1 = date('Y-m-d', strtotime($end_lastyear . '- 1 month'));
$cavite_array = array('Alfonso','Amadeo','Bacoor','Carmona','Cavite City','Dasmariñas',
'General Emilio Aguinaldo','General Mariano Alvarez','General Trias','Imus','Indang','Kawit',
'Magallanes','Maragondon','Mendez','Naic','Noveleta','Rosario',
'Silang','Tagaytay','Tanza','Ternate','Trece Martires');

$laguna_array = array('Alaminos','Bay','Biñan','Cabuyao','Calamba','Calauan',
'Cavinti','Famy','Kalayaan','Liliw','Los Baños','Luisiana',
'Lumban','Mabitac','Magdalena','Majayjay','Nagcarlan','Paete',
'Pagsanjan','Pakil','Pangil','Pila','Rizal','San Pablo','San Pedro',
'Santa Cruz','Santa Maria','Santa Rosa','Siniloan','Victoria');

$batangas_array = array('Agoncillo','Alitagtag','Balayan','Balete','Batangas City','Bauan',
'Calaca','Calatagan','Cuenca','Ibaan','Laurel','Lemery',
'Lian','Lipa','Lobo','Mabini', 'Malvar','Mataas na kahoy',
'Nasugbu','Padre Garcia','Rosario','San Jose','San Juan','San Luis',
'San Nicolas','San Pascual','Santa Teresita','Santo Tomas','Taal',
'Talisay','Tanauan','Taysan','Tingloy','Tuy');

$rizal_array = array('Angono','Antipolo','Baras','Binangonan','Cainta','Cardona',
'Jalajala','Morong','Pililla','Rodriguez','San Mateo','Tanay',
'Taytay','Teresa');

$quezon_array = array('Agdangan','Alabat','Atimonan','Buenavista','Burdeos','Calauag',
'Candelaria','Catanauan','Dolores','General Luna','General Nakar','Guinayangan',
'Gumaca','Infanta','Jomalig','Lopez','Lucban','Lucena',		
'Macalelon','Mauban','Mulanay','Padre Burgos','Pagbilao','Panukulan',
'Patnanungan','Perez','Pitogo','Plaridel','Polillo','Quezon',
'Real','Sampaloc','San Andres','San Antonio','San Francisco','San Narciso',	
'Sariaya','Tagkawayan','Tayabas','Tiaong','Unisan');
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
$f3letter = array(
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
$arrayfees = array(
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
  array("Certificate of Competency (COC) Fees",'AH')
);
if (!$_SESSION['login']) {
  header("location: ./");
}
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use PhpOffice\PhpSpreadsheet\Writer\Csv;

$reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader("Xlsx");
$spreadsheet = $reader->load('documents/Format.xlsx');
$sheet = $spreadsheet->getSheetByName('New Bldg_F1');
$sheet2 = $spreadsheet->getSheetByName('Bus Estab_F2');
$sheet3 = $spreadsheet->getSheetByName('Govt Bldg_F4');
$sheet4 = $spreadsheet->getSheetByName('FCF_F5');

// Start F1 VARIABLE
$cavite_start_eb = 19;
$cavite_start_gb = 45;
$cavite_last_eb = 43;
$cavite_last_gb = 69;
$f2cavite_start = 11;
$f3cavite_start = 11;

$f4cavite_start_be = 8;
$f4cavite_last_be = 32;
$f4cavite_start_gb = 34;
$f4cavite_end_gb = 58;

$laguna_start_eb = 98;
$laguna_start_gb = 131;
$laguna_last_eb = 129;
$laguna_last_gb = 162;
$f2laguna_start = 36;
$f3laguna_start = 36;

$f4laguna_start_be = 87;
$f4laguna_last_be = 118;
$f4laguna_start_gb = 120;
$f4laguna_end_gb = 151;

$batangas_start_eb = 172;
$batangas_start_gb = 209;
$batangas_end_eb = 207;
$batangas_end_gb = 244;
$f2batangas_start = 68;
$f3batangas_start = 68;

$f4batangas_start_be = 161;
$f4batangas_last_be = 196;
$f4batangas_start_gb = 198;
$f4batangas_end_gb = 233;

$rizal_start_eb = 259;
$rizal_start_gb = 276;
$rizal_end_eb = 274;
$rizal_end_gb = 291;
$f2rizal_start = 104;
$f3rizal_start = 104;

$f4rizal_start_be = 248;
$f4rizal_last_be = 263;
$f4rizal_start_gb = 265;
$f4rizal_end_gb = 280;

$quezon_start_eb = 294;
$quezon_start_gb = 338;
$quezon_end_eb = 336;
$quezon_end_gb = 380;
$f2quezon_start = 120;
$f3quezon_start = 120;

$f4quezon_start_be = 283;
$f4quezon_last_be = 325;
$f4quezon_start_gb = 327;
$f4quezon_end_gb = 369;

$f2las = 163;
$f3las = 163;
function f1query($link,$province,$start, $end, $start_lastyear, $end_lastyear, $start_l, $end_l,$start_lastyear_1, $end_lastyear_1,$v){
  global $data;
  // Current
  $data = mysqli_fetch_assoc($link->query("SELECT COUNT(CASE WHEN form1_date_added BETWEEN '$start' AND '$end' AND type = 'New Establishments Buildings' THEN 1 END) AS 'c',
  COUNT(CASE WHEN form1_date_added BETWEEN '$start_lastyear' AND '$end_lastyear' AND type = 'New Establishments Buildings' THEN 1 END) AS 'c_l',
  -- GB
  COUNT(CASE WHEN form1_date_added BETWEEN '$start' AND '$end' AND type = 'New Government Buildings' THEN 1 END) AS 'c_bg',
  COUNT(CASE WHEN form1_date_added BETWEEN '$start_lastyear' AND '$end_lastyear' AND type = 'New Government Buildings' THEN 1 END) AS 'c_l_bg',

  COUNT(CASE WHEN fsec = 'Issued FSEC' AND form1_date_added BETWEEN '$start' AND '$end' AND type = 'New Establishments Buildings' THEN 1 END) as 'd',
  COUNT(CASE WHEN fsec = 'Issued FSEC' AND form1_date_added BETWEEN '$start_l' AND '$end_l' AND type = 'New Establishments Buildings' THEN 1 END) as 'e',
  COUNT(CASE WHEN fsec = 'Issued FSEC' AND form1_date_added BETWEEN '$start_lastyear' AND '$end_lastyear' AND type = 'New Establishments Buildings' THEN 1 END) as 'd_l',
  COUNT(CASE WHEN fsec = 'Issued FSEC' AND form1_date_added BETWEEN '$start_lastyear_1' AND '$end_lastyear_1' AND type = 'New Establishments Buildings' THEN 1 END) as 'e_l',
  -- GB
  COUNT(CASE WHEN fsec = 'Issued FSEC' AND form1_date_added BETWEEN '$start' AND '$end' AND type = 'New Government Buildings' THEN 1 END) as 'd_bg',
  COUNT(CASE WHEN fsec = 'Issued FSEC' AND form1_date_added BETWEEN '$start_l' AND '$end_l' AND type = 'New Government Buildings' THEN 1 END) as 'e_bg',
  COUNT(CASE WHEN fsec = 'Issued FSEC' AND form1_date_added BETWEEN '$start_lastyear' AND '$end_lastyear' AND type = 'New Government Buildings' THEN 1 END) as 'd_l_bg',
  COUNT(CASE WHEN fsec = 'Issued FSEC' AND form1_date_added BETWEEN '$start_lastyear_1' AND '$end_lastyear_1' AND type = 'New Government Buildings' THEN 1 END) as 'e_l_bg',

  COUNT(CASE WHEN fsec = 'Issued Notice of Disapproval (NOD)' AND form1_date_added BETWEEN '$start' AND '$end' AND type = 'New Establishments Buildings' THEN 1 END) as 'g',
  COUNT(CASE WHEN fsec = 'Issued Notice of Disapproval (NOD)' AND form1_date_added BETWEEN '$start_l' AND '$end_l' AND type = 'New Establishments Buildings' THEN 1 END) as 'h',
  COUNT(CASE WHEN fsec = 'Issued Notice of Disapproval (NOD)' AND form1_date_added BETWEEN '$start_lastyear' AND '$end_lastyear' AND type = 'New Establishments Buildings' THEN 1 END) as 'g_l',
  COUNT(CASE WHEN fsec = 'Issued Notice of Disapproval (NOD)' AND form1_date_added BETWEEN '$start_lastyear_1' AND '$end_lastyear_1' AND type = 'New Establishments Buildings' THEN 1 END) as 'h_l',
  -- GB
  COUNT(CASE WHEN fsec = 'Issued Notice of Disapproval (NOD)' AND form1_date_added BETWEEN '$start' AND '$end' AND type = 'New Government Buildings' THEN 1 END) as 'g_bg',
  COUNT(CASE WHEN fsec = 'Issued Notice of Disapproval (NOD)' AND form1_date_added BETWEEN '$start_l' AND '$end_l' AND type = 'New Government Buildings' THEN 1 END) as 'h_bg',
  COUNT(CASE WHEN fsec = 'Issued Notice of Disapproval (NOD)' AND form1_date_added BETWEEN '$start_lastyear' AND '$end_lastyear' AND type = 'New Government Buildings' THEN 1 END) as 'g_l_bg',
  COUNT(CASE WHEN fsec = 'Issued Notice of Disapproval (NOD)' AND form1_date_added BETWEEN '$start_lastyear_1' AND '$end_lastyear_1' AND type = 'New Government Buildings' THEN 1 END) as 'h_l_bg',

  COUNT(CASE WHEN inspection = 'NC' AND form1_date_added BETWEEN '$start' AND '$end' AND type = 'New Establishments Buildings' THEN 1 END) as 'as',
  COUNT(CASE WHEN inspection = 'NC' AND form1_date_added BETWEEN '$start_lastyear' AND '$end_lastyear' AND type = 'New Establishments Buildings' THEN 1 END) as 'as_l',
  COUNT(CASE WHEN inspection = 'RN' AND form1_date_added BETWEEN '$start' AND '$end' AND type = 'New Establishments Buildings' THEN 1 END) as 'at',
  COUNT(CASE WHEN inspection = 'RN' AND form1_date_added BETWEEN '$start_lastyear' AND '$end_lastyear' AND type = 'New Establishments Buildings' THEN 1 END) as 'at_l',
  -- GB
  COUNT(CASE WHEN inspection = 'NC' AND form1_date_added BETWEEN '$start' AND '$end' AND type = 'New Government Buildings' THEN 1 END) as 'as_bg',
  COUNT(CASE WHEN inspection = 'NC' AND form1_date_added BETWEEN '$start_lastyear' AND '$end_lastyear' AND type = 'New Government Buildings' THEN 1 END) as 'as_l_bg',
  COUNT(CASE WHEN inspection = 'RN' AND form1_date_added BETWEEN '$start' AND '$end' AND type = 'New Government Buildings' THEN 1 END) as 'at_bg',
  COUNT(CASE WHEN inspection = 'RN' AND form1_date_added BETWEEN '$start_lastyear' AND '$end_lastyear' AND type = 'New Government Buildings' THEN 1 END) as 'at_l_bg',

  COUNT(CASE WHEN issuance='Issued FSIC for Occupancy' AND form1_date_added BETWEEN '$start' AND '$end' AND type = 'New Establishments Buildings' THEN 1 END) as 'av',
  COUNT(CASE WHEN issuance='Issued FSIC for Occupancy' AND form1_date_added BETWEEN '$start_l' AND '$end_l' AND type = 'New Establishments Buildings' THEN 1 END) as 'aw',
  COUNT(CASE WHEN issuance='Issued FSIC for Occupancy' AND form1_date_added BETWEEN '$start_lastyear' AND '$end_lastyear' AND type = 'New Establishments Buildings' THEN 1 END) as 'av_l',
  COUNT(CASE WHEN issuance='Issued FSIC for Occupancy' AND form1_date_added BETWEEN '$start_lastyear_1' AND '$end_lastyear_1' AND type = 'New Establishments Buildings' THEN 1 END) as 'aw_l',
  -- GB
  COUNT(CASE WHEN issuance='Issued FSIC for Occupancy' AND form1_date_added BETWEEN '$start' AND '$end' AND type = 'New Government Buildings' THEN 1 END) as 'av_bg',
  COUNT(CASE WHEN issuance='Issued FSIC for Occupancy' AND form1_date_added BETWEEN '$start_l' AND '$end_l' AND type = 'New Government Buildings' THEN 1 END) as 'aw_bg',
  COUNT(CASE WHEN issuance='Issued FSIC for Occupancy' AND form1_date_added BETWEEN '$start_lastyear' AND '$end_lastyear' AND type = 'New Government Buildings' THEN 1 END) as 'av_l_bg',
  COUNT(CASE WHEN issuance='Issued FSIC for Occupancy' AND form1_date_added BETWEEN '$start_lastyear_1' AND '$end_lastyear_1' AND type = 'New Government Buildings' THEN 1 END) as 'aw_l_bg',

  COUNT(CASE WHEN issuance='Issued With NOD for NOT OCCUPIED buildings/establishments' AND form1_date_added BETWEEN '$start' AND '$end' AND type = 'New Establishments Buildings' THEN 1 END) as 'ay',
  COUNT(CASE WHEN issuance='Issued With NOD for NOT OCCUPIED buildings/establishments' AND form1_date_added BETWEEN '$start_l' AND '$end_l' AND type = 'New Establishments Buildings' THEN 1 END) as 'az',
  COUNT(CASE WHEN issuance='Issued With NOD for NOT OCCUPIED buildings/establishments' AND form1_date_added BETWEEN '$start_lastyear' AND '$end_lastyear' AND type = 'New Establishments Buildings' THEN 1 END) as 'ay_l',
  COUNT(CASE WHEN issuance='Issued With NOD for NOT OCCUPIED buildings/establishments' AND form1_date_added BETWEEN '$start_lastyear_1' AND '$end_lastyear_1' AND type = 'New Establishments Buildings' THEN 1 END) as 'az_l',
  -- GB
  COUNT(CASE WHEN issuance='Issued With NOD for NOT OCCUPIED buildings/establishments' AND form1_date_added BETWEEN '$start' AND '$end' AND type = 'New Government Buildings' THEN 1 END) as 'ay_bg',
  COUNT(CASE WHEN issuance='Issued With NOD for NOT OCCUPIED buildings/establishments' AND form1_date_added BETWEEN '$start_l' AND '$end_l' AND type = 'New Government Buildings' THEN 1 END) as 'az_bg',
  COUNT(CASE WHEN issuance='Issued With NOD for NOT OCCUPIED buildings/establishments' AND form1_date_added BETWEEN '$start_lastyear' AND '$end_lastyear' AND type = 'New Government Buildings' THEN 1 END) as 'ay_l_bg',
  COUNT(CASE WHEN issuance='Issued With NOD for NOT OCCUPIED buildings/establishments' AND form1_date_added BETWEEN '$start_lastyear_1' AND '$end_lastyear_1' AND type = 'New Government Buildings' THEN 1 END) as 'az_l_bg',
  COUNT(CASE WHEN issuance='Issued With NTC for OCCUPIED buildings/establishments' AND form1_date_added BETWEEN '$start' AND '$end' AND type = 'New Establishments Buildings' THEN 1 END) as 'bb',
  COUNT(CASE WHEN issuance='Issued With NTC for OCCUPIED buildings/establishments' AND form1_date_added BETWEEN '$start_l' AND '$end_l' AND type = 'New Establishments Buildings' THEN 1 END) as 'bc',
  COUNT(CASE WHEN issuance='Issued With NTC for OCCUPIED buildings/establishments' AND form1_date_added BETWEEN '$start_lastyear' AND '$end_lastyear' AND type = 'New Establishments Buildings' THEN 1 END) as 'bb_l',
  COUNT(CASE WHEN issuance='Issued With NTC for OCCUPIED buildings/establishments' AND form1_date_added BETWEEN '$start_lastyear_1' AND '$end_lastyear_1' AND type = 'New Establishments Buildings' THEN 1 END) as 'bc_l',
  COUNT(CASE WHEN issuance='Issued With NTC for OCCUPIED buildings/establishments' AND form1_date_added BETWEEN '$start' AND '$end' AND type = 'New Government Buildings' THEN 1 END) as 'bb_bg',
  COUNT(CASE WHEN issuance='Issued With NTC for OCCUPIED buildings/establishments' AND form1_date_added BETWEEN '$start_l' AND '$end_l' AND type = 'New Government Buildings' THEN 1 END) as 'bc_bg',
  COUNT(CASE WHEN issuance='Issued With NTC for OCCUPIED buildings/establishments' AND form1_date_added BETWEEN '$start_lastyear' AND '$end_lastyear' AND type = 'New Government Buildings' THEN 1 END) as 'bb_l_bg',
  COUNT(CASE WHEN issuance='Issued With NTC for OCCUPIED buildings/establishments' AND form1_date_added BETWEEN '$start_lastyear_1' AND '$end_lastyear_1' AND type = 'New Government Buildings' THEN 1 END) as 'bc_l_bg'
  FROM bfp_form1
  LEFT JOIN bfp_users ON bfp_users.uid = bfp_form1.uid
  LEFT JOIN structure ON bfp_form1.structure = structure.structure_id
  WHERE bfp_users.location = '$province' AND bfp_users.municipal = '$v' AND form1_status = '1'"));
}
function f2query($link,$province,$start, $end, $v){
  global $f2data;
  $f2data = mysqli_fetch_assoc($link->query(
  "SELECT COUNT(CASE WHEN type = 'New' AND form2_date_added BETWEEN '$start' AND '$end' THEN 1 END) as 'b',
  COUNT(CASE WHEN type = 'Renew' AND form2_date_added BETWEEN '$start' AND '$end' THEN 1 END) as 'c',
  COUNT(CASE WHEN fsic = 'New' AND with_or_not = 'FSIC Issued WITHIN Prescribed Period' AND form2_date_added BETWEEN '$start' AND '$end' THEN 1 END) as 'w',
  COUNT(CASE WHEN fsic = 'New' AND with_or_not = 'FSIC Issued NOT WITHIN Prescribed Period' AND form2_date_added BETWEEN '$start' AND '$end' THEN 1 END) as 'x',
  COUNT(CASE WHEN fsic = 'Renew' AND with_or_not = 'FSIC Issued WITHIN Prescribed Period' AND form2_date_added BETWEEN '$start' AND '$end' THEN 1 END) as 'y',
  COUNT(CASE WHEN fsic = 'Renew' AND with_or_not = 'FSIC Issued NOT WITHIN Prescribed Period' AND form2_date_added BETWEEN '$start' AND '$end' THEN 1 END) as 'z',
  COUNT(CASE WHEN reinspection_1 = 'NOTICE TO COMPLY' AND reinspection_2 = 'Non-Compliant'  AND reinspection_3 = 'Issued NTC' AND form2_date_added BETWEEN '$start' AND '$end' THEN 1 END) as 'ab',
  COUNT(CASE WHEN reinspection_1 = 'NOTICE TO COMPLY' AND reinspection_2 = 'Compliant'  AND reinspection_3 = 'Issued FSIC for Business Operation' AND form2_date_added BETWEEN '$start' AND '$end' THEN 1 END) as 'ac',
  COUNT(CASE WHEN reinspection_1 = 'NOTICE TO CORRECT VIOLATION' AND reinspection_2 = 'Non-Compliant'  AND reinspection_3 = 'Issued NTCV' AND form2_date_added BETWEEN '$start' AND '$end' THEN 1 END) as 'ad',
  COUNT(CASE WHEN reinspection_1 = 'NOTICE TO CORRECT VIOLATION' AND reinspection_2 = 'Compliant'  AND reinspection_3 = 'Issued FSIC for Business Operation' AND form2_date_added BETWEEN '$start' AND '$end' THEN 1 END) as 'ae',
  COUNT(CASE WHEN reinspection_1 = 'ABATEMENT' AND reinspection_2 = 'Non-Compliant'  AND reinspection_3 = 'Issued Abatement Order' AND form2_date_added BETWEEN '$start' AND '$end' THEN 1 END) as 'af',
  COUNT(CASE WHEN reinspection_1 = 'ABATEMENT' AND reinspection_2 = 'Compliant'  AND reinspection_3 = 'Total Issued FSIC for Business/ Operation' AND form2_date_added BETWEEN '$start' AND '$end' THEN 1 END) as 'ag',
  COUNT(CASE WHEN closure='Closure Order for Failure to Comply the Abatement order' AND form2_date_added BETWEEN '$start' AND '$end' THEN 1 END) as 'ai',
  COUNT(CASE WHEN closure='Closure For Failure To Pay Fine' AND form2_date_added BETWEEN '$start' AND '$end' THEN 1 END) as 'aj'
  FROM bfp_form2
  LEFT JOIN bfp_users ON bfp_users.uid = bfp_form2.uid
  WHERE bfp_users.location='$province' AND bfp_users.municipal = '$v' AND form2_status = '1'"));
}
function f3query($link,$province,$start, $end, $v){
  global $f3data;
  $f3data = mysqli_fetch_assoc($link->query(
  "SELECT COUNT(CASE WHEN type = 'New' AND form3_date_added BETWEEN '$start' AND '$end' THEN 1 END) as 'b',
  COUNT(CASE WHEN type = 'Renew' AND form3_date_added BETWEEN '$start' AND '$end' THEN 1 END) as 'c',
  COUNT(CASE WHEN new_renew = 'New' AND with_or_not = 'FSIC Issued WITHIN Prescribed Period' AND form3_date_added BETWEEN '$start' AND '$end' THEN 1 END) as 'v',
  COUNT(CASE WHEN new_renew = 'New' AND with_or_not = 'FSIC Issued NOT WITHIN Prescribed Period' AND form3_date_added BETWEEN '$start' AND '$end' THEN 1 END) as 'w',
  COUNT(CASE WHEN new_renew = 'Renew' AND with_or_not = 'FSIC Issued WITHIN Prescribed Period' AND form3_date_added BETWEEN '$start' AND '$end' THEN 1 END) as 'x',
  COUNT(CASE WHEN new_renew = 'Renew' AND with_or_not = 'FSIC Issued NOT WITHIN Prescribed Period' AND form3_date_added BETWEEN '$start' AND '$end' THEN 1 END) as 'y',
  COUNT(CASE WHEN reinspection_1 = 'NOTICE TO COMPLY' AND reinspection_2 = 'Non-Compliant'  AND reinspection_3 = 'Issued NTC' AND form3_date_added BETWEEN '$start' AND '$end' THEN 1 END) as 'aa',
  COUNT(CASE WHEN reinspection_1 = 'NOTICE TO COMPLY' AND reinspection_2 = 'Compliant'  AND reinspection_3 = 'Issued FSIC for Business Operation' AND form3_date_added BETWEEN '$start' AND '$end' THEN 1 END) as 'ab',
  COUNT(CASE WHEN reinspection_1 = 'NOTICE TO CORRECT VIOLATION' AND reinspection_2 = 'Non-Compliant'  AND reinspection_3 = 'Issued NTCV' AND form3_date_added BETWEEN '$start' AND '$end' THEN 1 END) as 'ac',
  COUNT(CASE WHEN reinspection_1 = 'NOTICE TO CORRECT VIOLATION' AND reinspection_2 = 'Compliant'  AND reinspection_3 = 'Issued FSIC for Business Operation' AND form3_date_added BETWEEN '$start' AND '$end' THEN 1 END) as 'ad',
  COUNT(CASE WHEN reinspection_1 = 'ABATEMENT' AND reinspection_2 = 'Non-Compliant'  AND reinspection_3 = 'Issued Abatement Order' AND form3_date_added BETWEEN '$start' AND '$end' THEN 1 END) as 'ae',
  COUNT(CASE WHEN reinspection_1 = 'ABATEMENT' AND reinspection_2 = 'Compliant'  AND reinspection_3 = 'Total Issued FSIC for Business/ Operation' AND form3_date_added BETWEEN '$start' AND '$end' THEN 1 END) as 'af',
  COUNT(CASE WHEN closure='Closure Order for Failure to Comply the Abatement order' AND form3_date_added BETWEEN '$start' AND '$end' THEN 1 END) as 'ah',
  COUNT(CASE WHEN closure='Closure For Failure To Pay Fine' AND form3_date_added BETWEEN '$start' AND '$end' THEN 1 END) as 'ai'
  FROM bfp_form3
  LEFT JOIN bfp_users ON bfp_users.uid = bfp_form3.uid
  WHERE bfp_users.location='$province' AND bfp_users.municipal = '$v' AND form3_status = '1'"));
}
foreach($cavite_array as $province){
  f1query($link,$province,$start, $end, $start_lastyear, $end_lastyear, $start_l, $end_l,$start_lastyear_1, $end_lastyear_1,'Cavite');
  $sheet->setCellValue('C'.$cavite_start_eb, $data['c']);
  $sheet->setCellValue('C'.$cavite_last_eb, $data['c_l']);
  $sheet->setCellValue('C'.$cavite_start_gb, $data['c_bg']);
  $sheet->setCellValue('C'.$cavite_last_gb, $data['c_l_bg']);
  $sheet->setCellValue('D'.$cavite_start_eb, $data['d']);
  $sheet->setCellValue('D'.$cavite_last_eb, $data['d_l']);
  $sheet->setCellValue('E'.$cavite_start_eb, $data['e']);
  $sheet->setCellValue('E'.$cavite_last_eb, $data['e_l']);
  $sheet->setCellValue('D'.$cavite_start_gb, $data['d_bg']);
  $sheet->setCellValue('D'.$cavite_last_gb, $data['d_l_bg']);
  $sheet->setCellValue('E'.$cavite_start_gb, $data['e_bg']);
  $sheet->setCellValue('E'.$cavite_last_gb, $data['e_l_bg']);
  $sheet->setCellValue('G'.$cavite_start_eb, $data['g']);
  $sheet->setCellValue('G'.$cavite_last_eb, $data['g_l']);
  $sheet->setCellValue('H'.$cavite_start_eb, $data['h']);
  $sheet->setCellValue('H'.$cavite_last_eb, $data['h_l']);
  $sheet->setCellValue('G'.$cavite_start_gb, $data['g_bg']);
  $sheet->setCellValue('G'.$cavite_last_gb, $data['g_l_bg']);
  $sheet->setCellValue('H'.$cavite_start_gb, $data['h_bg']);
  $sheet->setCellValue('H'.$cavite_last_gb, $data['h_l_bg']);
  $sheet->setCellValue('AS'.$cavite_start_eb, $data['as']);
  $sheet->setCellValue('AS'.$cavite_last_eb, $data['as_l']);
  $sheet->setCellValue('AT'.$cavite_start_eb, $data['at']);
  $sheet->setCellValue('AT'.$cavite_last_eb, $data['at_l']);
  $sheet->setCellValue('AS'.$cavite_start_gb, $data['as_bg']);
  $sheet->setCellValue('AS'.$cavite_last_gb, $data['as_l_bg']);
  $sheet->setCellValue('AT'.$cavite_start_gb, $data['at_bg']);
  $sheet->setCellValue('AT'.$cavite_last_gb, $data['at_l_bg']);
  $sheet->setCellValue('AV'.$cavite_start_eb, $data['av']);
  $sheet->setCellValue('AV'.$cavite_last_eb, $data['av_l']);
  $sheet->setCellValue('AW'.$cavite_start_eb, $data['aw']);
  $sheet->setCellValue('AW'.$cavite_last_eb, $data['aw_l']);
  $sheet->setCellValue('AV'.$cavite_start_gb, $data['av_bg']);
  $sheet->setCellValue('AV'.$cavite_last_gb, $data['av_l_bg']);
  $sheet->setCellValue('AW'.$cavite_start_gb, $data['aw_bg']);
  $sheet->setCellValue('AW'.$cavite_last_gb, $data['aw_l_bg']);
  $sheet->setCellValue('AY'.$cavite_start_eb, $data['ay']);
  $sheet->setCellValue('AY'.$cavite_last_eb, $data['ay_l']);
  $sheet->setCellValue('AZ'.$cavite_start_eb, $data['az']);
  $sheet->setCellValue('AZ'.$cavite_last_eb, $data['az_l']);
  $sheet->setCellValue('AY'.$cavite_start_gb, $data['ay_bg']);
  $sheet->setCellValue('AY'.$cavite_last_gb, $data['ay_l_bg']);
  $sheet->setCellValue('AZ'.$cavite_start_gb, $data['az_bg']);
  $sheet->setCellValue('AZ'.$cavite_last_gb, $data['az_l_bg']);
  $sheet->setCellValue('BB'.$cavite_start_eb, $data['bb']);
  $sheet->setCellValue('BB'.$cavite_last_eb, $data['bb_l']);
  $sheet->setCellValue('BB'.$cavite_start_gb, $data['bb_bg']);
  $sheet->setCellValue('BB'.$cavite_last_gb, $data['bb_l_bg']);
  $sheet->setCellValue('BC'.$cavite_start_eb, $data['bc']);
  $sheet->setCellValue('BC'.$cavite_last_eb, $data['bc_l']);
  $sheet->setCellValue('BC'.$cavite_start_gb, $data['bc_bg']);
  $sheet->setCellValue('BC'.$cavite_last_gb, $data['bc_l_bg']);
  foreach ($NC as $sNC){
    $data = mysqli_fetch_assoc($link->query("SELECT 
    COUNT(CASE WHEN form1_date_added BETWEEN '$start' AND '$end' AND nc_or_rn = 'NC' 
    AND structure.lbl = '".$sNC[0]."' AND type = 'New Establishments Buildings' THEN 1 END) as 'stra_nc',
    COUNT(CASE WHEN form1_date_added BETWEEN '$start_lastyear' AND '$end_lastyear' AND nc_or_rn = 'NC'
      AND structure.lbl = '".$sNC[0]."' AND type = 'New Establishments Buildings' THEN 1 END) as 'stra_nc_l',
    COUNT(CASE WHEN form1_date_added BETWEEN '$start' AND '$end' AND nc_or_rn = 'NC'
      AND structure.lbl = '".$sNC[0]."' AND type = 'New Government Buildings' THEN 1 END) as 'stra_nc_gb',
    COUNT(CASE WHEN form1_date_added BETWEEN '$start_lastyear' AND '$end_lastyear' AND nc_or_rn = 'NC'
      AND structure.lbl = '".$sNC[0]."' AND type = 'New Government Buildings' THEN 1 END) as 'stra_nc_l_gb'
    FROM bfp_form1 LEFT JOIN bfp_users ON bfp_users.uid = bfp_form1.uid
    LEFT JOIN structure ON bfp_form1.structure = structure.structure_id
    WHERE bfp_users.location = '$province' AND bfp_users.municipal = 'Cavite' AND form1_status = '1'"));
    $sheet->setCellValue($sNC[1].$cavite_start_eb, $data['stra_nc']);
    $sheet->setCellValue($sNC[1].$cavite_last_eb, $data['stra_nc_l']);
    $sheet->setCellValue($sNC[1].$cavite_start_gb, $data['stra_nc_gb']);
    $sheet->setCellValue($sNC[1].$cavite_last_gb, $data['stra_nc_l_gb']);
  }
  foreach ($RN as $sRN){
    $data = mysqli_fetch_assoc($link->query("SELECT 
    COUNT(CASE WHEN form1_date_added BETWEEN '$start' AND '$end' AND nc_or_rn = 'RN' AND structure.lbl = '".$sRN[0]."' THEN 1 END) as 'stra_rn',
    COUNT(CASE WHEN form1_date_added BETWEEN '$start_lastyear' AND '$end_lastyear' AND nc_or_rn = 'RN' AND structure.lbl = '".$sRN[0]."' THEN 1 END) as 'stra_rn_l',
    COUNT(CASE WHEN form1_date_added BETWEEN '$start' AND '$end' AND nc_or_rn = 'RN' AND structure.lbl = '".$sRN[0]."' AND type = 'New Government Buildings' THEN 1 END) as 'stra_rn_gb',
    COUNT(CASE WHEN form1_date_added BETWEEN '$start_lastyear' AND '$end_lastyear' AND nc_or_rn = 'RN' AND structure.lbl = '".$sRN[0]."' AND type = 'New Government Buildings' THEN 1 END) as 'stra_rn_l_gb'
    FROM bfp_form1 LEFT JOIN bfp_users ON bfp_users.uid = bfp_form1.uid
    LEFT JOIN structure ON bfp_form1.structure = structure.structure_id
    WHERE bfp_users.location = '$province' AND bfp_users.municipal = 'Cavite' AND form1_status = '1'"));
    $sheet->setCellValue($sRN[1].$cavite_start_eb, $data['stra_rn']);
    $sheet->setCellValue($sRN[1].$cavite_last_eb, $data['stra_rn_l']);
    $sheet->setCellValue($sRN[1].$cavite_start_gb, $data['stra_rn_gb']);
    $sheet->setCellValue($sRN[1].$cavite_last_gb, $data['stra_rn_l_gb']);
  }
  // FORM 2
  f2query($link, $province, $start, $end, 'Cavite');
  $sheet2->setCellValue('B'.$f2cavite_start, $f2data['b']);
  $sheet2->setCellValue('C'.$f2cavite_start, $f2data['c']);
  $sheet2->setCellValue('W'.$f2cavite_start, $f2data['w']);
  $sheet2->setCellValue('X'.$f2cavite_start, $f2data['x']);
  $sheet2->setCellValue('Y'.$f2cavite_start, $f2data['y']);
  $sheet2->setCellValue('Z'.$f2cavite_start, $f2data['z']);
  $sheet2->setCellValue('AB'.$f2cavite_start, $f2data['ab']);
  $sheet2->setCellValue('AC'.$f2cavite_start, $f2data['ac']);
  $sheet2->setCellValue('AD'.$f2cavite_start, $f2data['ad']);
  $sheet2->setCellValue('AE'.$f2cavite_start, $f2data['ae']);
  $sheet2->setCellValue('AF'.$f2cavite_start, $f2data['af']);
  $sheet2->setCellValue('AG'.$f2cavite_start, $f2data['ag']);
  $sheet2->setCellValue('AI'.$f2cavite_start, $f2data['ai']);
  $sheet2->setCellValue('AJ'.$f2cavite_start, $f2data['aj']);
  foreach ($letter as $sletter) {
    $data = mysqli_fetch_assoc($link->query("SELECT 
    COUNT(CASE WHEN structure = '".$sletter[0]."' AND form2_date_added BETWEEN '$start' AND '$end' THEN 1 END) as 's'
    FROM bfp_form2 
    LEFT JOIN bfp_users ON bfp_users.uid = bfp_form2.uid
    WHERE bfp_users.location='$province' AND bfp_users.municipal = 'Cavite' AND form2_status = '1'"));
    $sheet2->setCellValue($sletter[1].$f2cavite_start, $data['s']);
  }
  f3query($link, $province, $start, $end, 'Cavite');
  $sheet3->setCellValue('B'.$f3cavite_start, $f3data['b']);
  $sheet3->setCellValue('C'.$f3cavite_start, $f3data['c']);
  $sheet3->setCellValue('V'.$f3cavite_start, $f3data['v']);
  $sheet3->setCellValue('W'.$f3cavite_start, $f3data['w']);
  $sheet3->setCellValue('X'.$f3cavite_start, $f3data['x']);
  $sheet3->setCellValue('Y'.$f3cavite_start, $f3data['y']);
  $sheet3->setCellValue('AA'.$f3cavite_start, $f3data['aa']);
  $sheet3->setCellValue('AB'.$f3cavite_start, $f3data['ab']);
  $sheet3->setCellValue('AC'.$f3cavite_start, $f3data['ac']);
  $sheet3->setCellValue('AD'.$f3cavite_start, $f3data['ad']);
  $sheet3->setCellValue('AE'.$f3cavite_start, $f3data['ae']);
  $sheet3->setCellValue('AF'.$f3cavite_start, $f3data['af']);
  $sheet3->setCellValue('AH'.$f3cavite_start, $f3data['ah']);
  $sheet3->setCellValue('AI'.$f3cavite_start, $f3data['ai']);
  foreach ($f3letter as $sletter) {
    $data = mysqli_fetch_assoc($link->query("SELECT 
    COUNT(CASE WHEN structure = '".$sletter[0]."' AND form3_date_added BETWEEN '$start' AND '$end' THEN 1 END) as 's',
    COUNT(CASE WHEN structure = '".$sletter[0]."' AND form3_date_added BETWEEN '$start_lastyear' AND '$end_lastyear' THEN 1 END) as 's_l'
    FROM bfp_form3 
    LEFT JOIN bfp_users ON bfp_users.uid = bfp_form3.uid
    WHERE bfp_users.location='$province' AND bfp_users.municipal = 'Cavite' AND form3_status = '1'"));
    $sheet3->setCellValue($sletter[1].$f3cavite_start, $data['s']);
  }

  foreach ($arrayfees as $shfees){
    $data = mysqli_fetch_assoc($link->query("SELECT 
    SUM(CASE WHEN fire_code_fees = '".$shfees[0]."' AND type = 'Business Establishments' AND form4_date_added BETWEEN '$start' AND '$end' THEN fees ELSE 0 END) as 'fees_be',
    SUM(CASE WHEN fire_code_fees = '".$shfees[0]."' AND type = 'Business Establishments' AND form4_date_added BETWEEN '$start_lastyear' AND '$end_lastyear' THEN fees ELSE 0 END) as 'fees_be_l',
    SUM(CASE WHEN fire_code_fees = '".$shfees[0]."' AND type = 'Government Buildings' AND form4_date_added BETWEEN '$start' AND '$end' THEN fees ELSE 0 END) as 'fees_gb',
    SUM(CASE WHEN fire_code_fees = '".$shfees[0]."' AND type = 'Government Buildings' AND form4_date_added BETWEEN '$start_lastyear' AND '$end_lastyear' THEN fees ELSE 0 END) as 'fees_gb_l'
    FROM bfp_form4 
    LEFT JOIN bfp_users ON bfp_users.uid = bfp_form4.uid
    WHERE bfp_users.location='$province' AND bfp_users.municipal = 'Cavite' AND form4_status = '1'"));
    $sheet4->setCellValue($shfees[1].$f4cavite_start_be, $data['fees_be']);
    $sheet4->setCellValue($shfees[1].$f4cavite_start_gb, $data['fees_gb']);
    $sheet4->setCellValue($shfees[1].$f4cavite_last_be, $data['fees_be_l']);
    $sheet4->setCellValue($shfees[1].$f4cavite_end_gb, $data['fees_gb_l']);
  }
  $cavite_start_eb++;
  $cavite_start_gb++;
  $f2cavite_start++;
  $f3cavite_start++;
  $f4cavite_start_be++;
  $f4cavite_start_gb++;
}
foreach ($laguna_array as $province) {
  f1query($link,$province,$start, $end, $start_lastyear, $end_lastyear, $start_l, $end_l,$start_lastyear_1, $end_lastyear_1,'Laguna');
  $sheet->setCellValue('C' . $laguna_start_eb, $data['c']);
  $sheet->setCellValue('C' . $laguna_last_eb, $data['c_l']);
  $sheet->setCellValue('C' . $laguna_start_gb, $data['c_bg']);
  $sheet->setCellValue('C' . $laguna_last_gb, $data['c_l_bg']);
  $sheet->setCellValue('D' . $laguna_start_eb, $data['d']);
  $sheet->setCellValue('D' . $laguna_last_eb, $data['d_l']);
  $sheet->setCellValue('E' . $laguna_start_eb, $data['e']);
  $sheet->setCellValue('E' . $laguna_last_eb, $data['e_l']);
  $sheet->setCellValue('D' . $laguna_start_gb, $data['d_bg']);
  $sheet->setCellValue('D' . $laguna_last_gb, $data['d_l_bg']);
  $sheet->setCellValue('E' . $laguna_start_gb, $data['e_bg']);
  $sheet->setCellValue('E' . $laguna_last_gb, $data['e_l_bg']);
  $sheet->setCellValue('G' . $laguna_start_eb, $data['g']);
  $sheet->setCellValue('G' . $laguna_last_eb, $data['g_l']);
  $sheet->setCellValue('H' . $laguna_start_eb, $data['h']);
  $sheet->setCellValue('H' . $laguna_last_eb, $data['h_l']);
  $sheet->setCellValue('G' . $laguna_start_gb, $data['g_bg']);
  $sheet->setCellValue('G' . $laguna_last_gb, $data['g_l_bg']);
  $sheet->setCellValue('H' . $laguna_start_gb, $data['h_bg']);
  $sheet->setCellValue('H' . $laguna_last_gb, $data['h_l_bg']);
  $sheet->setCellValue('AS' . $laguna_start_eb, $data['as']);
  $sheet->setCellValue('AS' . $laguna_last_eb, $data['as_l']);
  $sheet->setCellValue('AT' . $laguna_start_eb, $data['at']);
  $sheet->setCellValue('AT' . $laguna_last_eb, $data['at_l']);
  $sheet->setCellValue('AS' . $laguna_start_gb, $data['as_bg']);
  $sheet->setCellValue('AS' . $laguna_last_gb, $data['as_l_bg']);
  $sheet->setCellValue('AT' . $laguna_start_gb, $data['at_bg']);
  $sheet->setCellValue('AT' . $laguna_last_gb, $data['at_l_bg']);
  $sheet->setCellValue('AV' . $laguna_start_eb, $data['av']);
  $sheet->setCellValue('AV' . $laguna_last_eb, $data['av_l']);
  $sheet->setCellValue('AW' . $laguna_start_eb, $data['aw']);
  $sheet->setCellValue('AW' . $laguna_last_eb, $data['aw_l']);
  $sheet->setCellValue('AV' . $laguna_start_gb, $data['av_bg']);
  $sheet->setCellValue('AV' . $laguna_last_gb, $data['av_l_bg']);
  $sheet->setCellValue('AW' . $laguna_start_gb, $data['aw_bg']);
  $sheet->setCellValue('AW' . $laguna_last_gb, $data['aw_l_bg']);
  $sheet->setCellValue('AY' . $laguna_start_eb, $data['ay']);
  $sheet->setCellValue('AY' . $laguna_last_eb, $data['ay_l']);
  $sheet->setCellValue('AZ' . $laguna_start_eb, $data['az']);
  $sheet->setCellValue('AZ' . $laguna_last_eb, $data['az_l']);
  $sheet->setCellValue('AY' . $laguna_start_gb, $data['ay_bg']);
  $sheet->setCellValue('AY' . $laguna_last_gb, $data['ay_l_bg']);
  $sheet->setCellValue('AZ' . $laguna_start_gb, $data['az_bg']);
  $sheet->setCellValue('AZ' . $laguna_last_gb, $data['az_l_bg']);
  $sheet->setCellValue('BB' . $laguna_start_eb, $data['bb']);
  $sheet->setCellValue('BB' . $laguna_last_eb, $data['bb_l']);
  $sheet->setCellValue('BB' . $laguna_start_gb, $data['bb_bg']);
  $sheet->setCellValue('BB' . $laguna_last_gb, $data['bb_l_bg']);
  $sheet->setCellValue('BC' . $laguna_start_eb, $data['bc']);
  $sheet->setCellValue('BC' . $laguna_last_eb, $data['bc_l']);
  $sheet->setCellValue('BC' . $laguna_start_gb, $data['bc_bg']);
  $sheet->setCellValue('BC' . $laguna_last_gb, $data['bc_l_bg']);
  foreach ($NC as $sNC) {
    $data = mysqli_fetch_assoc($link->query("SELECT 
    COUNT(CASE WHEN form1_date_added BETWEEN '$start' AND '$end' AND nc_or_rn = 'NC' 
    AND structure.lbl = '".$sNC[0]."' AND type = 'New Establishments Buildings' THEN 1 END) as 'stra_nc',
    COUNT(CASE WHEN form1_date_added BETWEEN '$start_lastyear' AND '$end_lastyear' AND nc_or_rn = 'NC'
      AND structure.lbl = '".$sNC[0]."' AND type = 'New Establishments Buildings' THEN 1 END) as 'stra_nc_l',
    COUNT(CASE WHEN form1_date_added BETWEEN '$start' AND '$end' AND nc_or_rn = 'NC'
      AND structure.lbl = '".$sNC[0]."' AND type = 'New Government Buildings' THEN 1 END) as 'stra_nc_gb',
    COUNT(CASE WHEN form1_date_added BETWEEN '$start_lastyear' AND '$end_lastyear' AND nc_or_rn = 'NC'
      AND structure.lbl = '".$sNC[0]."' AND type = 'New Government Buildings' THEN 1 END) as 'stra_nc_l_gb'
    FROM bfp_form1 LEFT JOIN bfp_users ON bfp_users.uid = bfp_form1.uid
    LEFT JOIN structure ON bfp_form1.structure = structure.structure_id
    WHERE bfp_users.location = '$province' AND bfp_users.municipal = 'Laguna' AND form1_status = '1'"));
    $sheet->setCellValue($sNC[1] . $laguna_start_eb, $data['stra_nc']);
    $sheet->setCellValue($sNC[1] . $laguna_last_eb, $data['stra_nc_l']);
    $sheet->setCellValue($sNC[1] . $laguna_start_gb, $data['stra_nc_gb']);
    $sheet->setCellValue($sNC[1] . $laguna_last_gb, $data['stra_nc_l_gb']);
  }
  foreach ($RN as $sRN) {
    $data = mysqli_fetch_assoc($link->query("SELECT 
    COUNT(CASE WHEN form1_date_added BETWEEN '$start' AND '$end' AND nc_or_rn = 'RN' AND structure.lbl = '".$sRN[0]."' THEN 1 END) as 'stra_rn',
    COUNT(CASE WHEN form1_date_added BETWEEN '$start_lastyear' AND '$end_lastyear' AND nc_or_rn = 'RN' AND structure.lbl = '".$sRN[0]."' THEN 1 END) as 'stra_rn_l',
    COUNT(CASE WHEN form1_date_added BETWEEN '$start' AND '$end' AND nc_or_rn = 'RN' AND structure.lbl = '".$sRN[0]."' AND type = 'New Government Buildings' THEN 1 END) as 'stra_rn_gb',
    COUNT(CASE WHEN form1_date_added BETWEEN '$start_lastyear' AND '$end_lastyear' AND nc_or_rn = 'RN' AND structure.lbl = '".$sRN[0]."' AND type = 'New Government Buildings' THEN 1 END) as 'stra_rn_l_gb'
    FROM bfp_form1 LEFT JOIN bfp_users ON bfp_users.uid = bfp_form1.uid
    LEFT JOIN structure ON bfp_form1.structure = structure.structure_id
    WHERE bfp_users.location = '$province' AND bfp_users.municipal = 'Laguna' AND form1_status = '1'"));
    $sheet->setCellValue($sRN[1] . $laguna_start_eb, $data['stra_rn']);
    $sheet->setCellValue($sRN[1] . $laguna_last_eb, $data['stra_rn_l']);
    $sheet->setCellValue($sRN[1] . $laguna_start_gb, $data['stra_rn_gb']);
    $sheet->setCellValue($sRN[1] . $laguna_last_gb, $data['stra_rn_l_gb']);
  }
  // FORM 2
  f2query($link, $province, $start, $end, 'Laguna');
  $sheet2->setCellValue('B'.$f2laguna_start, $f2data['b']);
  $sheet2->setCellValue('C'.$f2laguna_start, $f2data['c']);
  $sheet2->setCellValue('W'.$f2laguna_start, $f2data['w']);
  $sheet2->setCellValue('X'.$f2laguna_start, $f2data['x']);
  $sheet2->setCellValue('Y'.$f2laguna_start, $f2data['y']);
  $sheet2->setCellValue('Z'.$f2laguna_start, $f2data['z']);
  $sheet2->setCellValue('AB'.$f2laguna_start, $f2data['ab']);
  $sheet2->setCellValue('AC'.$f2laguna_start, $f2data['ac']);
  $sheet2->setCellValue('AD'.$f2laguna_start, $f2data['ad']);
  $sheet2->setCellValue('AE'.$f2laguna_start, $f2data['ae']);
  $sheet2->setCellValue('AF'.$f2laguna_start, $f2data['af']);
  $sheet2->setCellValue('AG'.$f2laguna_start, $f2data['ag']);
  $sheet2->setCellValue('AI'.$f2laguna_start, $f2data['ai']);
  $sheet2->setCellValue('AJ'.$f2laguna_start, $f2data['aj']);
  foreach ($letter as $sletter) {
    $data = mysqli_fetch_assoc($link->query("SELECT 
    COUNT(CASE WHEN structure = '".$sletter[0]."' AND form2_date_added BETWEEN '$start' AND '$end' THEN 1 END) as 's'
    FROM bfp_form2 
    LEFT JOIN bfp_users ON bfp_users.uid = bfp_form2.uid
    WHERE bfp_users.location='$province' AND bfp_users.municipal = 'Laguna' AND form2_status = '1'"));
    $sheet2->setCellValue($sletter[1].$f2laguna_start, $data['s']);
  }
  // FORM 3
  f3query($link, $province, $start, $end, 'Laguna');
  $sheet3->setCellValue('B'.$f3laguna_start, $f3data['b']);
  $sheet3->setCellValue('C'.$f3laguna_start, $f3data['c']);
  $sheet3->setCellValue('V'.$f3laguna_start, $f3data['v']);
  $sheet3->setCellValue('W'.$f3laguna_start, $f3data['w']);
  $sheet3->setCellValue('X'.$f3laguna_start, $f3data['x']);
  $sheet3->setCellValue('Y'.$f3laguna_start, $f3data['y']);
  $sheet3->setCellValue('AA'.$f3laguna_start, $f3data['aa']);
  $sheet3->setCellValue('AB'.$f3laguna_start, $f3data['ab']);
  $sheet3->setCellValue('AC'.$f3laguna_start, $f3data['ac']);
  $sheet3->setCellValue('AD'.$f3laguna_start, $f3data['ad']);
  $sheet3->setCellValue('AE'.$f3laguna_start, $f3data['ae']);
  $sheet3->setCellValue('AF'.$f3laguna_start, $f3data['af']);
  $sheet3->setCellValue('AH'.$f3laguna_start, $f3data['ah']);
  $sheet3->setCellValue('AI'.$f3laguna_start, $f3data['ai']);
  foreach ($f3letter as $sletter) {
    $data = mysqli_fetch_assoc($link->query("SELECT 
    COUNT(CASE WHEN structure = '".$sletter[0]."' AND form3_date_added BETWEEN '$start' AND '$end' THEN 1 END) as 's',
    COUNT(CASE WHEN structure = '".$sletter[0]."' AND form3_date_added BETWEEN '$start_lastyear' AND '$end_lastyear' THEN 1 END) as 's_l'
    FROM bfp_form3 
    LEFT JOIN bfp_users ON bfp_users.uid = bfp_form3.uid
    WHERE bfp_users.location='$province' AND bfp_users.municipal = 'Laguna' AND form3_status = '1'"));
    $sheet3->setCellValue($sletter[1].$f3laguna_start, $data['s']);
  }
  foreach ($arrayfees as $shfees){
    $data = mysqli_fetch_assoc($link->query("SELECT 
    SUM(CASE WHEN fire_code_fees = '".$shfees[0]."' AND type = 'Business Establishments' AND form4_date_added BETWEEN '$start' AND '$end' THEN fees ELSE 0 END) as 'fees_be',
    SUM(CASE WHEN fire_code_fees = '".$shfees[0]."' AND type = 'Business Establishments' AND form4_date_added BETWEEN '$start_lastyear' AND '$end_lastyear' THEN fees ELSE 0 END) as 'fees_be_l',
    SUM(CASE WHEN fire_code_fees = '".$shfees[0]."' AND type = 'Government Buildings' AND form4_date_added BETWEEN '$start' AND '$end' THEN fees ELSE 0 END) as 'fees_gb',
    SUM(CASE WHEN fire_code_fees = '".$shfees[0]."' AND type = 'Government Buildings' AND form4_date_added BETWEEN '$start_lastyear' AND '$end_lastyear' THEN fees ELSE 0 END) as 'fees_gb_l'
    FROM bfp_form4 
    LEFT JOIN bfp_users ON bfp_users.uid = bfp_form4.uid
    WHERE bfp_users.location='$province' AND bfp_users.municipal = 'Laguna' AND form4_status = '1'"));
    $sheet4->setCellValue($shfees[1].$f4laguna_start_be, $data['fees_be']);
    $sheet4->setCellValue($shfees[1].$f4laguna_start_gb, $data['fees_gb']);
    $sheet4->setCellValue($shfees[1].$f4laguna_last_be, $data['fees_be_l']);
    $sheet4->setCellValue($shfees[1].$f4laguna_end_gb, $data['fees_gb_l']);
  }
  $laguna_start_eb++;
  $laguna_start_gb++;
  $f2laguna_start++;
  $f3laguna_start++;
  $f4laguna_start_be++;
  $f4laguna_start_gb++;
}
foreach ($batangas_array as $province) {
  f1query($link,$province,$start, $end, $start_lastyear, $end_lastyear, $start_l, $end_l,$start_lastyear_1, $end_lastyear_1,'Batangas');
  $sheet->setCellValue('C' . $batangas_start_eb, $data['c']);
  $sheet->setCellValue('C' . $batangas_end_eb, $data['c_l']);
  $sheet->setCellValue('C' . $batangas_start_gb, $data['c_bg']);
  $sheet->setCellValue('C' . $batangas_end_gb, $data['c_l_bg']);
  $sheet->setCellValue('D' . $batangas_start_eb, $data['d']);
  $sheet->setCellValue('D' . $batangas_end_eb, $data['d_l']);
  $sheet->setCellValue('E' . $batangas_start_eb, $data['e']);
  $sheet->setCellValue('E' . $batangas_end_eb, $data['e_l']);
  $sheet->setCellValue('D' . $batangas_start_gb, $data['d_bg']);
  $sheet->setCellValue('D' . $batangas_end_gb, $data['d_l_bg']);
  $sheet->setCellValue('E' . $batangas_start_gb, $data['e_bg']);
  $sheet->setCellValue('E' . $batangas_end_gb, $data['e_l_bg']);
  $sheet->setCellValue('G' . $batangas_start_eb, $data['g']);
  $sheet->setCellValue('G' . $batangas_end_eb, $data['g_l']);
  $sheet->setCellValue('H' . $batangas_start_eb, $data['h']);
  $sheet->setCellValue('H' . $batangas_end_eb, $data['h_l']);
  $sheet->setCellValue('G' . $batangas_start_gb, $data['g_bg']);
  $sheet->setCellValue('G' . $batangas_end_gb, $data['g_l_bg']);
  $sheet->setCellValue('H' . $batangas_start_gb, $data['h_bg']);
  $sheet->setCellValue('H' . $batangas_end_gb, $data['h_l_bg']);
  $sheet->setCellValue('AS' . $batangas_start_eb, $data['as']);
  $sheet->setCellValue('AS' . $batangas_end_eb, $data['as_l']);
  $sheet->setCellValue('AT' . $batangas_start_eb, $data['at']);
  $sheet->setCellValue('AT' . $batangas_end_eb, $data['at_l']);
  $sheet->setCellValue('AS' . $batangas_start_gb, $data['as_bg']);
  $sheet->setCellValue('AS' . $batangas_end_gb, $data['as_l_bg']);
  $sheet->setCellValue('AT' . $batangas_start_gb, $data['at_bg']);
  $sheet->setCellValue('AT' . $batangas_end_gb, $data['at_l_bg']);
  $sheet->setCellValue('AV' . $batangas_start_eb, $data['av']);
  $sheet->setCellValue('AV' . $batangas_end_eb, $data['av_l']);
  $sheet->setCellValue('AW' . $batangas_start_eb, $data['aw']);
  $sheet->setCellValue('AW' . $batangas_end_eb, $data['aw_l']);
  $sheet->setCellValue('AV' . $batangas_start_gb, $data['av_bg']);
  $sheet->setCellValue('AV' . $batangas_end_gb, $data['av_l_bg']);
  $sheet->setCellValue('AW' . $batangas_start_gb, $data['aw_bg']);
  $sheet->setCellValue('AW' . $batangas_end_gb, $data['aw_l_bg']);
  $sheet->setCellValue('AY' . $batangas_start_eb, $data['ay']);
  $sheet->setCellValue('AY' . $batangas_end_eb, $data['ay_l']);
  $sheet->setCellValue('AZ' . $batangas_start_eb, $data['az']);
  $sheet->setCellValue('AZ' . $batangas_end_eb, $data['az_l']);
  $sheet->setCellValue('AY' . $batangas_start_gb, $data['ay_bg']);
  $sheet->setCellValue('AY' . $batangas_end_gb, $data['ay_l_bg']);
  $sheet->setCellValue('AZ' . $batangas_start_gb, $data['az_bg']);
  $sheet->setCellValue('AZ' . $batangas_end_gb, $data['az_l_bg']);
  $sheet->setCellValue('BB' . $batangas_start_eb, $data['bb']);
  $sheet->setCellValue('BB' . $batangas_end_eb, $data['bb_l']);
  $sheet->setCellValue('BB' . $batangas_start_gb, $data['bb_bg']);
  $sheet->setCellValue('BB' . $batangas_end_gb, $data['bb_l_bg']);
  $sheet->setCellValue('BC' . $batangas_start_eb, $data['bc']);
  $sheet->setCellValue('BC' . $batangas_end_eb, $data['bc_l']);
  $sheet->setCellValue('BC' . $batangas_start_gb, $data['bc_bg']);
  $sheet->setCellValue('BC' . $batangas_end_gb, $data['bc_l_bg']);

  foreach ($NC as $sNC) {
    $data = mysqli_fetch_assoc($link->query("SELECT 
    COUNT(CASE WHEN form1_date_added BETWEEN '$start' AND '$end' AND nc_or_rn = 'NC' 
    AND structure.lbl = '" . $sNC[0] . "' AND type = 'New Establishments Buildings' THEN 1 END) as 'stra_nc',
    COUNT(CASE WHEN form1_date_added BETWEEN '$start_lastyear' AND '$end_lastyear' AND nc_or_rn = 'NC'
     AND structure.lbl = '" . $sNC[0] . "' AND type = 'New Establishments Buildings' THEN 1 END) as 'stra_nc_l',
    COUNT(CASE WHEN form1_date_added BETWEEN '$start' AND '$end' AND nc_or_rn = 'NC'
     AND structure.lbl = '" . $sNC[0] . "' AND type = 'New Government Buildings' THEN 1 END) as 'stra_nc_gb',
    COUNT(CASE WHEN form1_date_added BETWEEN '$start_lastyear' AND '$end_lastyear' AND nc_or_rn = 'NC'
     AND structure.lbl = '" . $sNC[0] . "' AND type = 'New Government Buildings' THEN 1 END) as 'stra_nc_l_gb'
    FROM bfp_form1 LEFT JOIN bfp_users ON bfp_users.uid = bfp_form1.uid
    LEFT JOIN structure ON bfp_form1.structure = structure.structure_id
    WHERE bfp_users.location = '$province' AND bfp_users.municipal = 'Batangas' AND form1_status = '1'"));
    $sheet->setCellValue($sNC[1] . $batangas_start_eb, $data['stra_nc']);
    $sheet->setCellValue($sNC[1] . $batangas_end_eb, $data['stra_nc_l']);
    $sheet->setCellValue($sNC[1] . $batangas_start_gb, $data['stra_nc_gb']);
    $sheet->setCellValue($sNC[1] . $batangas_end_gb, $data['stra_nc_l_gb']);
  }
  foreach ($RN as $sRN) {
    $data = mysqli_fetch_assoc($link->query("SELECT 
    COUNT(CASE WHEN form1_date_added BETWEEN '$start' AND '$end' AND nc_or_rn = 'RN' AND structure.lbl = '" . $sNC[0] . "' THEN 1 END) as 'stra_rn',
    COUNT(CASE WHEN form1_date_added BETWEEN '$start_lastyear' AND '$end_lastyear' AND nc_or_rn = 'RN' AND structure.lbl = '" . $sNC[0] . "' THEN 1 END) as 'stra_rn_l',
    COUNT(CASE WHEN form1_date_added BETWEEN '$start' AND '$end' AND nc_or_rn = 'RN' AND structure.lbl = '" . $sNC[0] . "' AND type = 'New Government Buildings' THEN 1 END) as 'stra_rn_gb',
    COUNT(CASE WHEN form1_date_added BETWEEN '$start_lastyear' AND '$end_lastyear' AND nc_or_rn = 'RN' AND structure.lbl = '" . $sNC[0] . "' AND type = 'New Government Buildings' THEN 1 END) as 'stra_rn_l_gb'
    FROM bfp_form1 LEFT JOIN bfp_users ON bfp_users.uid = bfp_form1.uid
    LEFT JOIN structure ON bfp_form1.structure = structure.structure_id
    WHERE bfp_users.location = '$province' AND bfp_users.municipal = 'Batangas' AND form1_status = '1'"));
    $sheet->setCellValue($sRN[1] . $batangas_start_eb, $data['stra_rn']);
    $sheet->setCellValue($sRN[1] . $batangas_end_eb, $data['stra_rn_l']);
    $sheet->setCellValue($sRN[1] . $batangas_start_gb, $data['stra_rn_gb']);
    $sheet->setCellValue($sRN[1] . $batangas_end_gb, $data['stra_rn_l_gb']);
  }
  // FORM 2
  f2query($link, $province, $start, $end, 'Batangas');
  $sheet2->setCellValue('B'.$f2batangas_start, $f2data['b']);
  $sheet2->setCellValue('C'.$f2batangas_start, $f2data['c']);
  $sheet2->setCellValue('W'.$f2batangas_start, $f2data['w']);
  $sheet2->setCellValue('X'.$f2batangas_start, $f2data['x']);
  $sheet2->setCellValue('Y'.$f2batangas_start, $f2data['y']);
  $sheet2->setCellValue('Z'.$f2batangas_start, $f2data['z']);
  $sheet2->setCellValue('AB'.$f2batangas_start, $f2data['ab']);
  $sheet2->setCellValue('AC'.$f2batangas_start, $f2data['ac']);
  $sheet2->setCellValue('AD'.$f2batangas_start, $f2data['ad']);
  $sheet2->setCellValue('AE'.$f2batangas_start, $f2data['ae']);
  $sheet2->setCellValue('AF'.$f2batangas_start, $f2data['af']);
  $sheet2->setCellValue('AG'.$f2batangas_start, $f2data['ag']);
  $sheet2->setCellValue('AI'.$f2batangas_start, $f2data['ai']);
  $sheet2->setCellValue('AJ'.$f2batangas_start, $f2data['aj']);
  foreach ($letter as $sletter) {
    $data = mysqli_fetch_assoc($link->query("SELECT 
    COUNT(CASE WHEN structure = '".$sletter[0]."' AND form2_date_added BETWEEN '$start' AND '$end' THEN 1 END) as 'stra'
    FROM bfp_form2 LEFT JOIN bfp_users ON bfp_users.uid = bfp_form2.uid
    WHERE bfp_users.location='$province' AND bfp_users.municipal = 'Batangas' AND form2_status = '1'"));
    $sheet2->setCellValue($sletter[1].$f2batangas_start, $data['stra']);
  }

  // FORM 3
  f3query($link, $province, $start, $end, 'Batangas');
  $sheet3->setCellValue('B'.$f3batangas_start, $f3data['b']);
  $sheet3->setCellValue('C'.$f3batangas_start, $f3data['c']);
  $sheet3->setCellValue('V'.$f3batangas_start, $f3data['v']);
  $sheet3->setCellValue('W'.$f3batangas_start, $f3data['w']);
  $sheet3->setCellValue('X'.$f3batangas_start, $f3data['x']);
  $sheet3->setCellValue('Y'.$f3batangas_start, $f3data['y']);
  $sheet3->setCellValue('AA'.$f3batangas_start, $f3data['aa']);
  $sheet3->setCellValue('AB'.$f3batangas_start, $f3data['ab']);
  $sheet3->setCellValue('AC'.$f3batangas_start, $f3data['ac']);
  $sheet3->setCellValue('AD'.$f3batangas_start, $f3data['ad']);
  $sheet3->setCellValue('AE'.$f3batangas_start, $f3data['ae']);
  $sheet3->setCellValue('AF'.$f3batangas_start, $f3data['af']);
  $sheet3->setCellValue('AH'.$f3batangas_start, $f3data['ah']);
  $sheet3->setCellValue('AI'.$f3batangas_start, $f3data['ai']);
  foreach ($f3letter as $sletter) {
    $data = mysqli_fetch_assoc($link->query("SELECT 
    COUNT(CASE WHEN structure = '".$sletter[0]."' AND form3_date_added BETWEEN '$start' AND '$end' THEN 1 END) as 's',
    COUNT(CASE WHEN structure = '".$sletter[0]."' AND form3_date_added BETWEEN '$start_lastyear' AND '$end_lastyear' THEN 1 END) as 's_l'
    FROM bfp_form3 
    LEFT JOIN bfp_users ON bfp_users.uid = bfp_form3.uid
    WHERE bfp_users.location='$province' AND bfp_users.municipal = 'Batangas' AND form3_status = '1'"));
    $sheet3->setCellValue($sletter[1].$f3batangas_start, $data['s']);
  }
  foreach ($arrayfees as $shfees){
    $data = mysqli_fetch_assoc($link->query("SELECT 
    SUM(CASE WHEN fire_code_fees = '".$shfees[0]."' AND type = 'Business Establishments' AND form4_date_added BETWEEN '$start' AND '$end' THEN fees ELSE 0 END) as 'fees_be',
    SUM(CASE WHEN fire_code_fees = '".$shfees[0]."' AND type = 'Business Establishments' AND form4_date_added BETWEEN '$start_lastyear' AND '$end_lastyear' THEN fees ELSE 0 END) as 'fees_be_l',
    SUM(CASE WHEN fire_code_fees = '".$shfees[0]."' AND type = 'Government Buildings' AND form4_date_added BETWEEN '$start' AND '$end' THEN fees ELSE 0 END) as 'fees_gb',
    SUM(CASE WHEN fire_code_fees = '".$shfees[0]."' AND type = 'Government Buildings' AND form4_date_added BETWEEN '$start_lastyear' AND '$end_lastyear' THEN fees ELSE 0 END) as 'fees_gb_l'
    FROM bfp_form4 
    LEFT JOIN bfp_users ON bfp_users.uid = bfp_form4.uid
    WHERE bfp_users.location='$province' AND bfp_users.municipal = 'Batangas' AND form4_status = '1'"));
    $sheet4->setCellValue($shfees[1].$f4batangas_start_be, $data['fees_be']);
    $sheet4->setCellValue($shfees[1].$f4batangas_start_gb, $data['fees_gb']);
    $sheet4->setCellValue($shfees[1].$f4batangas_last_be, $data['fees_be_l']);
    $sheet4->setCellValue($shfees[1].$f4batangas_end_gb, $data['fees_gb_l']);
  }
  $batangas_start_eb++;
  $batangas_start_gb++;
  $f2batangas_start++;
  $f3batangas_start++;
  $f4batangas_start_be++;
  $f4batangas_start_gb++;
}
foreach ($rizal_array as $province) {
  f1query($link,$province,$start, $end, $start_lastyear, $end_lastyear, $start_l, $end_l,$start_lastyear_1, $end_lastyear_1,'Rizal');
  $sheet->setCellValue('C' . $rizal_start_eb, $data['c']);
  $sheet->setCellValue('C' . $rizal_end_eb, $data['c_l']);
  $sheet->setCellValue('C' . $rizal_start_gb, $data['c_bg']);
  $sheet->setCellValue('C' . $rizal_end_gb, $data['c_l_bg']);
  $sheet->setCellValue('D' . $rizal_start_eb, $data['d']);
  $sheet->setCellValue('D' . $rizal_end_eb, $data['d_l']);
  $sheet->setCellValue('E' . $rizal_start_eb, $data['e']);
  $sheet->setCellValue('E' . $rizal_end_eb, $data['e_l']);
  $sheet->setCellValue('D' . $rizal_start_gb, $data['d_bg']);
  $sheet->setCellValue('D' . $rizal_end_gb, $data['d_l_bg']);
  $sheet->setCellValue('E' . $rizal_start_gb, $data['e_bg']);
  $sheet->setCellValue('E' . $rizal_end_gb, $data['e_l_bg']);
  $sheet->setCellValue('G' . $rizal_start_eb, $data['g']);
  $sheet->setCellValue('G' . $rizal_end_eb, $data['g_l']);
  $sheet->setCellValue('H' . $rizal_start_eb, $data['h']);
  $sheet->setCellValue('H' . $rizal_end_eb, $data['h_l']);
  $sheet->setCellValue('G' . $rizal_start_gb, $data['g_bg']);
  $sheet->setCellValue('G' . $rizal_end_gb, $data['g_l_bg']);
  $sheet->setCellValue('H' . $rizal_start_gb, $data['h_bg']);
  $sheet->setCellValue('H' . $rizal_end_gb, $data['h_l_bg']);
  $sheet->setCellValue('AS' . $rizal_start_eb, $data['as']);
  $sheet->setCellValue('AS' . $rizal_end_eb, $data['as_l']);
  $sheet->setCellValue('AT' . $rizal_start_eb, $data['at']);
  $sheet->setCellValue('AT' . $rizal_end_eb, $data['at_l']);
  $sheet->setCellValue('AS' . $rizal_start_gb, $data['as_bg']);
  $sheet->setCellValue('AS' . $rizal_end_gb, $data['as_l_bg']);
  $sheet->setCellValue('AT' . $rizal_start_gb, $data['at_bg']);
  $sheet->setCellValue('AT' . $rizal_end_gb, $data['at_l_bg']);
  $sheet->setCellValue('AV' . $rizal_start_eb, $data['av']);
  $sheet->setCellValue('AV' . $rizal_end_eb, $data['av_l']);
  $sheet->setCellValue('AW' . $rizal_start_eb, $data['aw']);
  $sheet->setCellValue('AW' . $rizal_end_eb, $data['aw_l']);
  $sheet->setCellValue('AV' . $rizal_start_gb, $data['av_bg']);
  $sheet->setCellValue('AV' . $rizal_end_gb, $data['av_l_bg']);
  $sheet->setCellValue('AW' . $rizal_start_gb, $data['aw_bg']);
  $sheet->setCellValue('AW' . $rizal_end_gb, $data['aw_l_bg']);
  $sheet->setCellValue('AY' . $rizal_start_eb, $data['ay']);
  $sheet->setCellValue('AY' . $rizal_end_eb, $data['ay_l']);
  $sheet->setCellValue('AZ' . $rizal_start_eb, $data['az']);
  $sheet->setCellValue('AZ' . $rizal_end_eb, $data['az_l']);
  $sheet->setCellValue('AY' . $rizal_start_gb, $data['ay_bg']);
  $sheet->setCellValue('AY' . $rizal_end_gb, $data['ay_l_bg']);
  $sheet->setCellValue('AZ' . $rizal_start_gb, $data['az_bg']);
  $sheet->setCellValue('AZ' . $rizal_end_gb, $data['az_l_bg']);
  $sheet->setCellValue('BB' . $rizal_start_eb, $data['bb']);
  $sheet->setCellValue('BB' . $rizal_end_eb, $data['bb_l']);
  $sheet->setCellValue('BB' . $rizal_start_gb, $data['bb_bg']);
  $sheet->setCellValue('BB' . $rizal_end_gb, $data['bb_l_bg']);
  $sheet->setCellValue('BC' . $rizal_start_eb, $data['bc']);
  $sheet->setCellValue('BC' . $rizal_end_eb, $data['bc_l']);
  $sheet->setCellValue('BC' . $rizal_start_gb, $data['bc_bg']);
  $sheet->setCellValue('BC' . $rizal_end_gb, $data['bc_l_bg']);

  foreach ($NC as $sNC) {
    $data = mysqli_fetch_assoc($link->query("SELECT 
    COUNT(CASE WHEN form1_date_added BETWEEN '$start' AND '$end' AND nc_or_rn = 'NC' 
    AND structure.lbl = '" . $sNC[0] . "' AND type = 'New Establishments Buildings' THEN 1 END) as 'stra_nc',
    COUNT(CASE WHEN form1_date_added BETWEEN '$start_lastyear' AND '$end_lastyear' AND nc_or_rn = 'NC'
     AND structure.lbl = '" . $sNC[0] . "' AND type = 'New Establishments Buildings' THEN 1 END) as 'stra_nc_l',
    COUNT(CASE WHEN form1_date_added BETWEEN '$start' AND '$end' AND nc_or_rn = 'NC'
     AND structure.lbl = '" . $sNC[0] . "' AND type = 'New Government Buildings' THEN 1 END) as 'stra_nc_gb',
    COUNT(CASE WHEN form1_date_added BETWEEN '$start_lastyear' AND '$end_lastyear' AND nc_or_rn = 'NC'
     AND structure.lbl = '" . $sNC[0] . "' AND type = 'New Government Buildings' THEN 1 END) as 'stra_nc_l_gb'
    FROM bfp_form1 LEFT JOIN bfp_users ON bfp_users.uid = bfp_form1.uid
    LEFT JOIN structure ON bfp_form1.structure = structure.structure_id
    WHERE bfp_users.location='$province' AND bfp_users.municipal = 'Rizal' AND form1_status = '1'"));
    $sheet->setCellValue($sNC[1] . $rizal_start_eb, $data['stra_nc']);
    $sheet->setCellValue($sNC[1] . $rizal_end_eb, $data['stra_nc_l']);
    $sheet->setCellValue($sNC[1] . $rizal_start_gb, $data['stra_nc_gb']);
    $sheet->setCellValue($sNC[1] . $rizal_end_gb, $data['stra_nc_l_gb']);
  }
  foreach ($RN as $sRN) {
    $data = mysqli_fetch_assoc($link->query("SELECT 
    COUNT(CASE WHEN form1_date_added BETWEEN '$start' AND '$end' AND nc_or_rn = 'RN' AND structure.lbl = '" . $sNC[0] . "' THEN 1 END) as 'stra_rn',
    COUNT(CASE WHEN form1_date_added BETWEEN '$start_lastyear' AND '$end_lastyear' AND nc_or_rn = 'RN' AND structure.lbl = '" . $sNC[0] . "' THEN 1 END) as 'stra_rn_l',
    COUNT(CASE WHEN form1_date_added BETWEEN '$start' AND '$end' AND nc_or_rn = 'RN' AND structure.lbl = '" . $sNC[0] . "' AND type = 'New Government Buildings' THEN 1 END) as 'stra_rn_gb',
    COUNT(CASE WHEN form1_date_added BETWEEN '$start_lastyear' AND '$end_lastyear' AND nc_or_rn = 'RN' AND structure.lbl = '" . $sNC[0] . "' AND type = 'New Government Buildings' THEN 1 END) as 'stra_rn_l_gb'
    FROM bfp_form1 LEFT JOIN bfp_users ON bfp_users.uid = bfp_form1.uid
    LEFT JOIN structure ON bfp_form1.structure = structure.structure_id
    WHERE bfp_users.location='$province' AND bfp_users.municipal = 'Rizal' AND form1_status = '1'"));
    $sheet->setCellValue($sRN[1] . $rizal_start_eb, $data['stra_rn']);
    $sheet->setCellValue($sRN[1] . $rizal_end_eb, $data['stra_rn_l']);
    $sheet->setCellValue($sRN[1] . $rizal_start_gb, $data['stra_rn_gb']);
    $sheet->setCellValue($sRN[1] . $rizal_end_gb, $data['stra_rn_l_gb']);
  }
// FORM 2
  f2query($link, $province, $start, $end, 'Rizal');
  $sheet2->setCellValue('B'.$f2rizal_start, $f2data['b']);
  $sheet2->setCellValue('C'.$f2rizal_start, $f2data['c']);
  $sheet2->setCellValue('W'.$f2rizal_start, $f2data['w']);
  $sheet2->setCellValue('X'.$f2rizal_start, $f2data['x']);
  $sheet2->setCellValue('Y'.$f2rizal_start, $f2data['y']);
  $sheet2->setCellValue('Z'.$f2rizal_start, $f2data['z']);
  $sheet2->setCellValue('AB'.$f2rizal_start, $f2data['ab']);
  $sheet2->setCellValue('AC'.$f2rizal_start, $f2data['ac']);
  $sheet2->setCellValue('AD'.$f2rizal_start, $f2data['ad']);
  $sheet2->setCellValue('AE'.$f2rizal_start, $f2data['ae']);
  $sheet2->setCellValue('AF'.$f2rizal_start, $f2data['af']);
  $sheet2->setCellValue('AG'.$f2rizal_start, $f2data['ag']);
  $sheet2->setCellValue('AI'.$f2rizal_start, $f2data['ai']);
  $sheet2->setCellValue('AJ'.$f2rizal_start, $f2data['aj']);
  foreach ($letter as $sletter) {
    $data = mysqli_fetch_assoc($link->query("SELECT 
    COUNT(CASE WHEN structure = '".$sletter[0]."' AND form2_date_added BETWEEN '$start' AND '$end' THEN 1 END) as 's'
    FROM bfp_form2 
    LEFT JOIN bfp_users ON bfp_users.uid = bfp_form2.uid
    WHERE bfp_users.location='$province' AND bfp_users.municipal = 'Rizal' AND form2_status = '1'"));
    $sheet2->setCellValue($sletter[1].$f2rizal_start, $data['s']);
  }
  // FORM 3
  f3query($link, $province, $start, $end, 'Rizal');
  $sheet3->setCellValue('B'.$f3rizal_start, $f3data['b']);
  $sheet3->setCellValue('C'.$f3rizal_start, $f3data['c']);
  $sheet3->setCellValue('V'.$f3rizal_start, $f3data['v']);
  $sheet3->setCellValue('W'.$f3rizal_start, $f3data['w']);
  $sheet3->setCellValue('X'.$f3rizal_start, $f3data['x']);
  $sheet3->setCellValue('Y'.$f3rizal_start, $f3data['y']);
  $sheet3->setCellValue('AA'.$f3rizal_start, $f3data['aa']);
  $sheet3->setCellValue('AB'.$f3rizal_start, $f3data['ab']);
  $sheet3->setCellValue('AC'.$f3rizal_start, $f3data['ac']);
  $sheet3->setCellValue('AD'.$f3rizal_start, $f3data['ad']);
  $sheet3->setCellValue('AE'.$f3rizal_start, $f3data['ae']);
  $sheet3->setCellValue('AF'.$f3rizal_start, $f3data['af']);
  $sheet3->setCellValue('AH'.$f3rizal_start, $f3data['ah']);
  $sheet3->setCellValue('AI'.$f3rizal_start, $f3data['ai']);
  foreach ($f3letter as $sletter) {
    $data = mysqli_fetch_assoc($link->query("SELECT 
    COUNT(CASE WHEN structure = '".$sletter[0]."' AND form3_date_added BETWEEN '$start' AND '$end' THEN 1 END) as 's',
    COUNT(CASE WHEN structure = '".$sletter[0]."' AND form3_date_added BETWEEN '$start_lastyear' AND '$end_lastyear' THEN 1 END) as 's_l'
    FROM bfp_form3 
    LEFT JOIN bfp_users ON bfp_users.uid = bfp_form3.uid
    WHERE bfp_users.location='$province' AND bfp_users.municipal = 'Rizal' AND form3_status = '1'"));
    $sheet3->setCellValue($sletter[1].$f3rizal_start, $data['s']);
  }
  foreach ($arrayfees as $shfees){
    $data = mysqli_fetch_assoc($link->query("SELECT 
    SUM(CASE WHEN fire_code_fees = '".$shfees[0]."' AND type = 'Business Establishments' AND form4_date_added BETWEEN '$start' AND '$end' THEN fees ELSE 0 END) as 'fees_be',
    SUM(CASE WHEN fire_code_fees = '".$shfees[0]."' AND type = 'Business Establishments' AND form4_date_added BETWEEN '$start_lastyear' AND '$end_lastyear' THEN fees ELSE 0 END) as 'fees_be_l',
    SUM(CASE WHEN fire_code_fees = '".$shfees[0]."' AND type = 'Government Buildings' AND form4_date_added BETWEEN '$start' AND '$end' THEN fees ELSE 0 END) as 'fees_gb',
    SUM(CASE WHEN fire_code_fees = '".$shfees[0]."' AND type = 'Government Buildings' AND form4_date_added BETWEEN '$start_lastyear' AND '$end_lastyear' THEN fees ELSE 0 END) as 'fees_gb_l'
    FROM bfp_form4 
    LEFT JOIN bfp_users ON bfp_users.uid = bfp_form4.uid
    WHERE bfp_users.location='$province' AND bfp_users.municipal = 'Rizal' AND form4_status = '1'"));
    $sheet4->setCellValue($shfees[1].$f4rizal_start_be, $data['fees_be']);
    $sheet4->setCellValue($shfees[1].$f4rizal_start_gb, $data['fees_gb']);
    $sheet4->setCellValue($shfees[1].$f4rizal_last_be, $data['fees_be_l']);
    $sheet4->setCellValue($shfees[1].$f4rizal_end_gb, $data['fees_gb_l']);
  }
  $rizal_start_eb++;
  $rizal_start_gb++;
  $f2rizal_start++;
  $f3rizal_start++;
  $f4rizal_start_be++;
  $f4rizal_start_gb++;
}
foreach($quezon_array as $province){
  f1query($link,$province,$start, $end, $start_lastyear, $end_lastyear, $start_l, $end_l,$start_lastyear_1, $end_lastyear_1,'Quezon');
  $sheet->setCellValue('C'.$quezon_start_eb, $data['c']);
  $sheet->setCellValue('C'.$quezon_end_eb, $data['c_l']);
  $sheet->setCellValue('C'.$quezon_start_gb, $data['c_bg']);
  $sheet->setCellValue('C'.$quezon_end_gb, $data['c_l_bg']);
  $sheet->setCellValue('D'.$quezon_start_eb, $data['d']);
  $sheet->setCellValue('D'.$quezon_end_eb, $data['d_l']);
  $sheet->setCellValue('E'.$quezon_start_eb, $data['e']);
  $sheet->setCellValue('E'.$quezon_end_eb, $data['e_l']);
  $sheet->setCellValue('D'.$quezon_start_gb, $data['d_bg']);
  $sheet->setCellValue('D'.$quezon_end_gb, $data['d_l_bg']);
  $sheet->setCellValue('E'.$quezon_start_gb, $data['e_bg']);
  $sheet->setCellValue('E'.$quezon_end_gb, $data['e_l_bg']);
  $sheet->setCellValue('G'.$quezon_start_eb, $data['g']);
  $sheet->setCellValue('G'.$quezon_end_eb, $data['g_l']);
  $sheet->setCellValue('H'.$quezon_start_eb, $data['h']);
  $sheet->setCellValue('H'.$quezon_end_eb, $data['h_l']);
  $sheet->setCellValue('G'.$quezon_start_gb, $data['g_bg']);
  $sheet->setCellValue('G'.$quezon_end_gb, $data['g_l_bg']);
  $sheet->setCellValue('H'.$quezon_start_gb, $data['h_bg']);
  $sheet->setCellValue('H'.$quezon_end_gb, $data['h_l_bg']);
  $sheet->setCellValue('AS'.$quezon_start_eb, $data['as']);
  $sheet->setCellValue('AS'.$quezon_end_eb, $data['as_l']);
  $sheet->setCellValue('AT'.$quezon_start_eb, $data['at']);
  $sheet->setCellValue('AT'.$quezon_end_eb, $data['at_l']);
  $sheet->setCellValue('AS'.$quezon_start_gb, $data['as_bg']);
  $sheet->setCellValue('AS'.$quezon_end_gb, $data['as_l_bg']);
  $sheet->setCellValue('AT'.$quezon_start_gb, $data['at_bg']);
  $sheet->setCellValue('AT'.$quezon_end_gb, $data['at_l_bg']);
  $sheet->setCellValue('AV'.$quezon_start_eb, $data['av']);
  $sheet->setCellValue('AV'.$quezon_end_eb, $data['av_l']);
  $sheet->setCellValue('AW'.$quezon_start_eb, $data['aw']);
  $sheet->setCellValue('AW'.$quezon_end_eb, $data['aw_l']);
  $sheet->setCellValue('AV'.$quezon_start_gb, $data['av_bg']);
  $sheet->setCellValue('AV'.$quezon_end_gb, $data['av_l_bg']);
  $sheet->setCellValue('AW'.$quezon_start_gb, $data['aw_bg']);
  $sheet->setCellValue('AW'.$quezon_end_gb, $data['aw_l_bg']);
  $sheet->setCellValue('AY'.$quezon_start_eb, $data['ay']);
  $sheet->setCellValue('AY'.$quezon_end_eb, $data['ay_l']);
  $sheet->setCellValue('AZ'.$quezon_start_eb, $data['az']);
  $sheet->setCellValue('AZ'.$quezon_end_eb, $data['az_l']);
  $sheet->setCellValue('AY'.$quezon_start_gb, $data['ay_bg']);
  $sheet->setCellValue('AY'.$quezon_end_gb, $data['ay_l_bg']);
  $sheet->setCellValue('AZ'.$quezon_start_gb, $data['az_bg']);
  $sheet->setCellValue('AZ'.$quezon_end_gb, $data['az_l_bg']);
  $sheet->setCellValue('BB'.$quezon_start_eb, $data['bb']);
  $sheet->setCellValue('BB'.$quezon_end_eb, $data['bb_l']);
  $sheet->setCellValue('BB'.$quezon_start_gb, $data['bb_bg']);
  $sheet->setCellValue('BB'.$quezon_end_gb, $data['bb_l_bg']);
  $sheet->setCellValue('BC'.$quezon_start_eb, $data['bc']);
  $sheet->setCellValue('BC'.$quezon_end_eb, $data['bc_l']);
  $sheet->setCellValue('BC'.$quezon_start_gb, $data['bc_bg']);
  $sheet->setCellValue('BC'.$quezon_end_gb, $data['bc_l_bg']);
  foreach ($NC as $sNC){
    $data = mysqli_fetch_assoc($link->query("SELECT 
    COUNT(CASE WHEN form1_date_added BETWEEN '$start' AND '$end' AND nc_or_rn = 'NC' 
    AND structure.lbl = '".$sNC[0]."' AND type = 'New Establishments Buildings' THEN 1 END) as 'stra_nc',
    COUNT(CASE WHEN form1_date_added BETWEEN '$start_lastyear' AND '$end_lastyear' AND nc_or_rn = 'NC'
     AND structure.lbl = '".$sNC[0]."' AND type = 'New Establishments Buildings' THEN 1 END) as 'stra_nc_l',
    COUNT(CASE WHEN form1_date_added BETWEEN '$start' AND '$end' AND nc_or_rn = 'NC'
     AND structure.lbl = '".$sNC[0]."' AND type = 'New Government Buildings' THEN 1 END) as 'stra_nc_gb',
    COUNT(CASE WHEN form1_date_added BETWEEN '$start_lastyear' AND '$end_lastyear' AND nc_or_rn = 'NC'
     AND structure.lbl = '".$sNC[0]."' AND type = 'New Government Buildings' THEN 1 END) as 'stra_nc_l_gb'
    FROM bfp_form1 LEFT JOIN bfp_users ON bfp_users.uid = bfp_form1.uid
    LEFT JOIN structure ON bfp_form1.structure = structure.structure_id
    WHERE bfp_users.location='$province' AND bfp_users.municipal = 'Quezon' AND form1_status = '1'"));
    $sheet->setCellValue($sNC[1].$quezon_start_eb, $data['stra_nc']);
    $sheet->setCellValue($sNC[1].$quezon_end_eb, $data['stra_nc_l']);
    $sheet->setCellValue($sNC[1].$quezon_start_gb, $data['stra_nc_gb']);
    $sheet->setCellValue($sNC[1].$quezon_end_gb, $data['stra_nc_l_gb']);
  }
  foreach ($RN as $sRN){
    $data = mysqli_fetch_assoc($link->query("SELECT 
    COUNT(CASE WHEN form1_date_added BETWEEN '$start' AND '$end' AND nc_or_rn = 'RN' AND structure.lbl = '".$sNC[0]."' THEN 1 END) as 'stra_rn',
    COUNT(CASE WHEN form1_date_added BETWEEN '$start_lastyear' AND '$end_lastyear' AND nc_or_rn = 'RN' AND structure.lbl = '".$sNC[0]."' THEN 1 END) as 'stra_rn_l',
    COUNT(CASE WHEN form1_date_added BETWEEN '$start' AND '$end' AND nc_or_rn = 'RN' AND structure.lbl = '".$sNC[0]."' AND type = 'New Government Buildings' THEN 1 END) as 'stra_rn_gb',
    COUNT(CASE WHEN form1_date_added BETWEEN '$start_lastyear' AND '$end_lastyear' AND nc_or_rn = 'RN' AND structure.lbl = '".$sNC[0]."' AND type = 'New Government Buildings' THEN 1 END) as 'stra_rn_l_gb'
    FROM bfp_form1 LEFT JOIN bfp_users ON bfp_users.uid = bfp_form1.uid
    LEFT JOIN structure ON bfp_form1.structure = structure.structure_id
    WHERE bfp_users.location='$province' AND bfp_users.municipal = 'Quezon' AND form1_status = '1'"));
    $sheet->setCellValue($sRN[1].$quezon_start_eb, $data['stra_rn']);
    $sheet->setCellValue($sRN[1].$quezon_end_eb, $data['stra_rn_l']);
    $sheet->setCellValue($sRN[1].$quezon_start_gb, $data['stra_rn_gb']);
    $sheet->setCellValue($sRN[1].$quezon_end_gb, $data['stra_rn_l_gb']);
  }
  // FORM 2
  f2query($link, $province, $start, $end, 'Quezon');
  $sheet2->setCellValue('B'.$f2quezon_start, $f2data['b']);
  $sheet2->setCellValue('C'.$f2quezon_start, $f2data['c']);
  $sheet2->setCellValue('W'.$f2quezon_start, $f2data['w']);
  $sheet2->setCellValue('X'.$f2quezon_start, $f2data['x']);
  $sheet2->setCellValue('Y'.$f2quezon_start, $f2data['y']);
  $sheet2->setCellValue('Z'.$f2quezon_start, $f2data['z']);
  $sheet2->setCellValue('AB'.$f2quezon_start, $f2data['ab']);
  $sheet2->setCellValue('AC'.$f2quezon_start, $f2data['ac']);
  $sheet2->setCellValue('AD'.$f2quezon_start, $f2data['ad']);
  $sheet2->setCellValue('AE'.$f2quezon_start, $f2data['ae']);
  $sheet2->setCellValue('AF'.$f2quezon_start, $f2data['af']);
  $sheet2->setCellValue('AG'.$f2quezon_start, $f2data['ag']);
  $sheet2->setCellValue('AI'.$f2quezon_start, $f2data['ai']);
  $sheet2->setCellValue('AJ'.$f2quezon_start, $f2data['aj']);
  foreach ($letter as $sletter) {
    $data = mysqli_fetch_assoc($link->query("SELECT 
    COUNT(CASE WHEN structure = '".$sletter[0]."' AND form2_date_added BETWEEN '$start' AND '$end' THEN 1 END) as 's'
    FROM bfp_form2 
    LEFT JOIN bfp_users ON bfp_users.uid = bfp_form2.uid
    WHERE bfp_users.location='$province' AND bfp_users.municipal = 'Quezon' AND form2_status = '1'"));
    $sheet2->setCellValue($sletter[1].$f2quezon_start, $data['s']);
  }
  // FORM 3
  f3query($link, $province, $start, $end, 'Quezon');
  $sheet3->setCellValue('B'.$f3quezon_start, $f3data['b']);
  $sheet3->setCellValue('C'.$f3quezon_start, $f3data['c']);
  $sheet3->setCellValue('V'.$f3quezon_start, $f3data['v']);
  $sheet3->setCellValue('W'.$f3quezon_start, $f3data['w']);
  $sheet3->setCellValue('X'.$f3quezon_start, $f3data['x']);
  $sheet3->setCellValue('Y'.$f3quezon_start, $f3data['y']);
  $sheet3->setCellValue('AA'.$f3quezon_start, $f3data['aa']);
  $sheet3->setCellValue('AB'.$f3quezon_start, $f3data['ab']);
  $sheet3->setCellValue('AC'.$f3quezon_start, $f3data['ac']);
  $sheet3->setCellValue('AD'.$f3quezon_start, $f3data['ad']);
  $sheet3->setCellValue('AE'.$f3quezon_start, $f3data['ae']);
  $sheet3->setCellValue('AF'.$f3quezon_start, $f3data['af']);
  $sheet3->setCellValue('AH'.$f3quezon_start, $f3data['ah']);
  $sheet3->setCellValue('AI'.$f3quezon_start, $f3data['ai']);
  foreach ($f3letter as $sletter) {
    $data = mysqli_fetch_assoc($link->query("SELECT 
    COUNT(CASE WHEN structure = '".$sletter[0]."' AND form3_date_added BETWEEN '$start' AND '$end' THEN 1 END) as 's',
    COUNT(CASE WHEN structure = '".$sletter[0]."' AND form3_date_added BETWEEN '$start_lastyear' AND '$end_lastyear' THEN 1 END) as 's_l'
    FROM bfp_form3 
    LEFT JOIN bfp_users ON bfp_users.uid = bfp_form3.uid
    WHERE bfp_users.location='$province' AND bfp_users.municipal = 'Quezon' AND form3_status = '1'"));
    $sheet3->setCellValue($sletter[1].$f3quezon_start, $data['s']);
  }
  foreach ($arrayfees as $shfees){
    $data = mysqli_fetch_assoc($link->query("SELECT 
    SUM(CASE WHEN fire_code_fees = '".$shfees[0]."' AND type = 'Business Establishments' AND form4_date_added BETWEEN '$start' AND '$end' THEN fees ELSE 0 END) as 'fees_be',
    SUM(CASE WHEN fire_code_fees = '".$shfees[0]."' AND type = 'Business Establishments' AND form4_date_added BETWEEN '$start_lastyear' AND '$end_lastyear' THEN fees ELSE 0 END) as 'fees_be_l',
    SUM(CASE WHEN fire_code_fees = '".$shfees[0]."' AND type = 'Government Buildings' AND form4_date_added BETWEEN '$start' AND '$end' THEN fees ELSE 0 END) as 'fees_gb',
    SUM(CASE WHEN fire_code_fees = '".$shfees[0]."' AND type = 'Government Buildings' AND form4_date_added BETWEEN '$start_lastyear' AND '$end_lastyear' THEN fees ELSE 0 END) as 'fees_gb_l'
    FROM bfp_form4 
    LEFT JOIN bfp_users ON bfp_users.uid = bfp_form4.uid
    WHERE bfp_users.location='$province' AND bfp_users.municipal = 'Quezon' AND form4_status = '1'"));
    $sheet4->setCellValue($shfees[1].$f4quezon_start_be, $data['fees_be']);
    $sheet4->setCellValue($shfees[1].$f4quezon_start_gb, $data['fees_gb']);
    $sheet4->setCellValue($shfees[1].$f4quezon_last_be, $data['fees_be_l']);
    $sheet4->setCellValue($shfees[1].$f4quezon_end_gb, $data['fees_gb_l']);
  }
  $quezon_start_eb++;
  $quezon_start_gb++;
  $f2quezon_start++;
  $f3quezon_start++;
  $f4quezon_start_be++;
  $f4quezon_start_gb++;
}
// FORM 2 LAST
$data = mysqli_fetch_assoc($link->query(
"SELECT COUNT(CASE WHEN type = 'New' AND form2_date_added BETWEEN '$start_lastyear' AND '$end_lastyear' THEN 1 END) as 'b',
COUNT(CASE WHEN type = 'Renew' AND form2_date_added BETWEEN '$start_lastyear' AND '$end_lastyear' THEN 1 END) as 'c',
COUNT(CASE WHEN fsic = 'New' AND with_or_not = 'FSIC Issued WITHIN Prescribed Period' AND form2_date_added BETWEEN '$start_lastyear' AND '$end_lastyear' THEN 1 END) as 'w',
COUNT(CASE WHEN fsic = 'New' AND with_or_not = 'FSIC Issued NOT WITHIN Prescribed Period' AND form2_date_added BETWEEN '$start_lastyear' AND '$end_lastyear' THEN 1 END) as 'x',
COUNT(CASE WHEN fsic = 'Renew' AND with_or_not = 'FSIC Issued WITHIN Prescribed Period' AND form2_date_added BETWEEN '$start_lastyear' AND '$end_lastyear' THEN 1 END) as 'y',
COUNT(CASE WHEN fsic = 'Renew' AND with_or_not = 'FSIC Issued NOT WITHIN Prescribed Period' AND form2_date_added BETWEEN '$start_lastyear' AND '$end_lastyear' THEN 1 END) as 'z',
COUNT(CASE WHEN reinspection_1 = 'NOTICE TO COMPLY' AND reinspection_2 = 'Non-Compliant'  AND reinspection_3 = 'Issued NTC' AND form2_date_added BETWEEN '$start_lastyear' AND '$end_lastyear' THEN 1 END) as 'ab',
COUNT(CASE WHEN reinspection_1 = 'NOTICE TO COMPLY' AND reinspection_2 = 'Compliant'  AND reinspection_3 = 'Issued FSIC for Business Operation' AND form2_date_added BETWEEN '$start_lastyear' AND '$end_lastyear' THEN 1 END) as 'ac',
COUNT(CASE WHEN reinspection_1 = 'NOTICE TO CORRECT VIOLATION' AND reinspection_2 = 'Non-Compliant'  AND reinspection_3 = 'Issued NTCV' AND form2_date_added BETWEEN '$start_lastyear' AND '$end_lastyear' THEN 1 END) as 'ad',
COUNT(CASE WHEN reinspection_1 = 'NOTICE TO CORRECT VIOLATION' AND reinspection_2 = 'Compliant'  AND reinspection_3 = 'Issued FSIC for Business Operation' AND form2_date_added BETWEEN '$start_lastyear' AND '$end_lastyear' THEN 1 END) as 'ae',
COUNT(CASE WHEN reinspection_1 = 'ABATEMENT' AND reinspection_2 = 'Non-Compliant'  AND reinspection_3 = 'Issued Abatement Order' AND form2_date_added BETWEEN '$start_lastyear' AND '$end_lastyear' THEN 1 END) as 'af',
COUNT(CASE WHEN reinspection_1 = 'ABATEMENT' AND reinspection_2 = 'Compliant'  AND reinspection_3 = 'Total Issued FSIC for Business/ Operation' AND form2_date_added BETWEEN '$start_lastyear' AND '$end_lastyear' THEN 1 END) as 'ag',
COUNT(CASE WHEN closure='Closure Order for Failure to Comply the Abatement order' AND form2_date_added BETWEEN '$start_lastyear' AND '$end_lastyear' THEN 1 END) as 'ai',
COUNT(CASE WHEN closure='Closure For Failure To Pay Fine' AND form2_date_added BETWEEN '$start_lastyear' AND '$end_lastyear' THEN 1 END) as 'aj'
FROM bfp_form2
LEFT JOIN bfp_users ON bfp_users.uid = bfp_form2.uid
WHERE form2_status = '1'"));
$sheet2->setCellValue('B'.$f2las, $data['b']);
$sheet2->setCellValue('C'.$f2las, $data['c']);
$sheet2->setCellValue('W'.$f2las, $data['w']);
$sheet2->setCellValue('X'.$f2las, $data['x']);
$sheet2->setCellValue('Y'.$f2las, $data['y']);
$sheet2->setCellValue('Z'.$f2las, $data['z']);
$sheet2->setCellValue('AB'.$f2las, $data['ab']);
$sheet2->setCellValue('AC'.$f2las, $data['ac']);
$sheet2->setCellValue('AD'.$f2las, $data['ad']);
$sheet2->setCellValue('AE'.$f2las, $data['ae']);
$sheet2->setCellValue('AF'.$f2las, $data['af']);
$sheet2->setCellValue('AG'.$f2las, $data['ag']);
$sheet2->setCellValue('AI'.$f2las, $data['ai']);
$sheet2->setCellValue('AJ'.$f2las, $data['aj']);

foreach ($letter as $sletter) {
  $data = mysqli_fetch_assoc($link->query("SELECT 
  COUNT(CASE WHEN structure = '".$sletter[0]."' AND form2_date_added BETWEEN '$start_lastyear' AND '$end_lastyear' THEN 1 END) as 's'
  FROM bfp_form2 
  LEFT JOIN bfp_users ON bfp_users.uid = bfp_form2.uid
  WHERE form2_status = '1'"));
  $sheet2->setCellValue($sletter[1].$f2las, $data['s']);
}

  // FORM 3 LAST 
  $data = mysqli_fetch_assoc($link->query(
  "SELECT COUNT(CASE WHEN type = 'New' AND form3_date_added BETWEEN '$start_lastyear' AND '$end_lastyear' THEN 1 END) as 'b_l',
  COUNT(CASE WHEN type = 'Renew' AND form3_date_added BETWEEN '$start_lastyear' AND '$end_lastyear' THEN 1 END) as 'c_l',
  COUNT(CASE WHEN new_renew = 'New' AND with_or_not = 'FSIC Issued WITHIN Prescribed Period' AND form3_date_added BETWEEN '$start_lastyear' AND '$end_lastyear' THEN 1 END) as 'v_l',
  COUNT(CASE WHEN new_renew = 'New' AND with_or_not = 'FSIC Issued NOT WITHIN Prescribed Period' AND form3_date_added BETWEEN '$start_lastyear' AND '$end_lastyear' THEN 1 END) as 'w_l',
  COUNT(CASE WHEN new_renew = 'Renew' AND with_or_not = 'FSIC Issued WITHIN Prescribed Period' AND form3_date_added BETWEEN '$start_lastyear' AND '$end_lastyear' THEN 1 END) as 'x_l',
  COUNT(CASE WHEN new_renew = 'Renew' AND with_or_not = 'FSIC Issued NOT WITHIN Prescribed Period' AND form3_date_added BETWEEN '$start_lastyear' AND '$end_lastyear' THEN 1 END) as 'y_l',
  COUNT(CASE WHEN reinspection_1 = 'NOTICE TO COMPLY' AND reinspection_2 = 'Non-Compliant'  AND reinspection_3 = 'Issued NTC' AND form3_date_added BETWEEN '$start_lastyear' AND '$end_lastyear' THEN 1 END) as 'aa_l',
  COUNT(CASE WHEN reinspection_1 = 'NOTICE TO COMPLY' AND reinspection_2 = 'Compliant'  AND reinspection_3 = 'Issued FSIC for Business Operation' AND form3_date_added BETWEEN '$start_lastyear' AND '$end_lastyear' THEN 1 END) as 'ab_l',
  COUNT(CASE WHEN reinspection_1 = 'NOTICE TO CORRECT VIOLATION' AND reinspection_2 = 'Non-Compliant'  AND reinspection_3 = 'Issued NTCV' AND form3_date_added BETWEEN '$start_lastyear' AND '$end_lastyear' THEN 1 END) as 'ac_l',
  COUNT(CASE WHEN reinspection_1 = 'NOTICE TO CORRECT VIOLATION' AND reinspection_2 = 'Compliant'  AND reinspection_3 = 'Issued FSIC for Business Operation' AND form3_date_added BETWEEN '$start_lastyear' AND '$end_lastyear' THEN 1 END) as 'ad_l',
  COUNT(CASE WHEN reinspection_1 = 'ABATEMENT' AND reinspection_2 = 'Non-Compliant'  AND reinspection_3 = 'Issued Abatement Order' AND form3_date_added BETWEEN '$start_lastyear' AND '$end_lastyear' THEN 1 END) as 'ae_l',
  COUNT(CASE WHEN reinspection_1 = 'ABATEMENT' AND reinspection_2 = 'Compliant'  AND reinspection_3 = 'Total Issued FSIC for Business/ Operation' AND form3_date_added BETWEEN '$start_lastyear' AND '$end_lastyear' THEN 1 END) as 'af_l',
  COUNT(CASE WHEN closure='Closure Order for Failure to Comply the Abatement order' AND form3_date_added BETWEEN '$start_lastyear' AND '$end_lastyear' THEN 1 END) as 'ah_l',
  COUNT(CASE WHEN closure='Closure For Failure To Pay Fine' AND form3_date_added BETWEEN '$start_lastyear' AND '$end_lastyear' THEN 1 END) as 'ai_l'
  FROM bfp_form3
  LEFT JOIN bfp_users ON bfp_users.uid = bfp_form3.uid
  WHERE form3_status = '1'"));
  $sheet3->setCellValue('B'.$f3las, $data['b_l']);
  $sheet3->setCellValue('C'.$f3las, $data['c_l']);
  $sheet3->setCellValue('V'.$f3las, $data['v_l']);
  $sheet3->setCellValue('W'.$f3las, $data['w_l']);
  $sheet3->setCellValue('X'.$f3las, $data['x_l']);
  $sheet3->setCellValue('Y'.$f3las, $data['y_l']);
  $sheet3->setCellValue('AA'.$f3las, $data['aa_l']);
  $sheet3->setCellValue('AB'.$f3las, $data['ab_l']);
  $sheet3->setCellValue('AC'.$f3las, $data['ac_l']);
  $sheet3->setCellValue('AD'.$f3las, $data['ad_l']);
  $sheet3->setCellValue('AE'.$f3las, $data['ae_l']);
  $sheet3->setCellValue('AF'.$f3las, $data['af_l']);
  $sheet3->setCellValue('AH'.$f3las, $data['ah_l']);
  $sheet3->setCellValue('AI'.$f3las, $data['ai_l']);

  foreach ($f3letter as $sletter) {
    $data = mysqli_fetch_assoc($link->query("SELECT 
    COUNT(CASE WHEN structure = '".$sletter[0]."' AND form3_date_added BETWEEN '$start_lastyear' AND '$end_lastyear' THEN 1 END) as 's_l'
    FROM bfp_form3 
    LEFT JOIN bfp_users ON bfp_users.uid = bfp_form3.uid
    WHERE form3_status = '1'"));
    $sheet3->setCellValue($sletter[1].$f3las, $data['s_l']);
  }

// Export
$newname = date('Y-m-d h-i-s');
$writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, "Xlsx");
$writer->save('files/BPF-REPORT ' . $newname . '.xlsx');

header("location: files/BPF-REPORT " . $newname . '.xlsx');