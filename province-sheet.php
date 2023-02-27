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
$spreadsheet = $reader->load('documents/Format.xlsx');
$sheet = $spreadsheet->getSheetByName('New Bldg_F1');
$sheet2 = $spreadsheet->getSheetByName('Bus Estab_F2');
$sheet3 = $spreadsheet->getSheetByName('Govt Bldg_F4');
$sheet4 = $spreadsheet->getSheetByName('FCF_F5');

$office = $_GET['office'];
$start = $_GET['start'];
$end = $_GET['end'];
$start_l = date('Y-m-d', strtotime($start . '- 1 month'));
$end_l = date('Y-m-d', strtotime($end . '- 1 month'));
$start_lastyear = date('Y-m-d', strtotime($start . '- 1 year'));
$end_lastyear = date('Y-m-d', strtotime($end . '- 1 year'));
$start_lastyear_1 = date('Y-m-d', strtotime($start_lastyear . '- 1 month'));
$end_lastyear_1 = date('Y-m-d', strtotime($end_lastyear . '- 1 month'));
// Date
$sheet->setCellValue('A9', $start . ' To ' . $end);

if($office == "Cavite"){
  // Start Row CAVITE
  $f1_1 = 19;
  $f1_2 = 45;
  $f1_NB = 43;
  $f1_GB = 69;
  $f2_1 = 11;
  $f3_start = 11;
  $f4be_start = 8;
  $f4be_last = 32;
  $f4gb_start = 34;
  $f4gb_last = 58;

  $municipal = array('Alfonso','Amadeo','Bacoor','Carmona','Cavite City','Dasmariñas',
		'General Emilio Aguinaldo','General Mariano Alvarez','General Trias','Imus','Indang','Kawit',
		'Magallanes','Maragondon','Mendez','Naic','Noveleta','Rosario',
		'Silang','Tagaytay','Tanza','Ternate','Trece Martires');
} elseif ($office == "Laguna"){
  // Start Row LAGUNA
  $f1_1 = 98;
  $f1_2 = 131;
  $f1_NB = 129;
  $f1_GB = 162;
  $f2_1 = 36;
  $f3_start = 36;

  $f4be_start = 84;
  $f4be_last = 118;
  $f4gb_start = 120;
  $f4gb_last = 151;
  $municipal = array('Alaminos','Bay','Biñan','Cabuyao','Calamba','Calauan',
    'Cavinti','Famy','Kalayaan','Liliw','Los Baños','Luisiana',
    'Lumban','Mabitac','Magdalena','Majayjay','Nagcarlan','Paete',
    'Pagsanjan','Pakil','Pangil','Pila','Rizal','San Pablo','San Pedro',
    'Santa Cruz','Santa Maria','Santa Rosa','Siniloan','Victoria');
} elseif ($office == "Batangas"){
  // Start Row BATANGAS
  $f1_1 = 172;
  $f1_2 = 209;
  $f1_NB = 207;
  $f1_GB = 244;
  $f2_1 = 68;
  $f3_start = 68;
  $f4be_start = 161;
  $f4be_last = 196;
  $f4gb_start = 198;
  $f4gb_last = 233;
  $municipal = array('Agoncillo','Alitagtag','Balayan','Balete','Batangas City','Bauan',
		'Calaca','Calatagan','Cuenca','Ibaan','Laurel','Lemery',
		'Lian','Lipa','Lobo','Mabini', 'Malvar','Mataas na kahoy',
		'Nasugbu','Padre Garcia','Rosario','San Jose','San Juan','San Luis',
		'San Nicolas','San Pascual','Santa Teresita','Santo Tomas','Taal',
		'Talisay','Tanauan','Taysan','Tingloy','Tuy');
} elseif ($office == "Rizal"){
  // Start Row RIZAL
  $f1_1 = 259;
  $f1_2 = 276;
  $f1_NB = 274;
  $f1_GB = 291;
  $f2_1 = 104;
  $f3_start = 104;
  $f4be_start = 248;
  $f4be_last = 263;
  $f4gb_start = 265;
  $f4gb_last = 280;
  $municipal = array('Angono','Antipolo','Baras','Binangonan','Cainta','Cardona',
		'Jalajala','Morong','Pililla','Rodriguez','San Mateo','Tanay',
		'Taytay','Teresa');
} elseif ($office == "Quezon"){
  // Start Row QUEZON
  $f1_1 = 294;
  $f1_2 = 338;
  $f1_NB = 336;
  $f1_GB = 380;
  $f2_1 = 120;
  $f3_start = 120;
  $f4be_start = 283;
  $f4be_last = 325;
  $f4gb_start = 327;
  $f4gb_last = 369;
  $municipal = array('Agdangan','Alabat','Atimonan','Buenavista','Burdeos','Calauag',
		'Candelaria','Catanauan','Dolores','General Luna','General Nakar','Guinayangan',
		'Gumaca','Infanta','Jomalig','Lopez','Lucban','Lucena',		
		'Macalelon','Mauban','Mulanay','Padre Burgos','Pagbilao','Panukulan',
		'Patnanungan','Perez','Pitogo','Plaridel','Polillo','Quezon',
		'Real','Sampaloc','San Andres','San Antonio','San Francisco','San Narciso',	
		'Sariaya','Tagkawayan','Tayabas','Tiaong','Unisan');
}
$f2_l = 163;
$f3_last = 163;

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

// PRINT MUNICIPAL
foreach($municipal as $municipal){
  // Current
  $data = mysqli_fetch_assoc($link->query("SELECT
  COUNT(CASE WHEN form1_date_added BETWEEN '$start' AND '$end' AND type = 'New Establishments Buildings' THEN 1 END) AS 'c',
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
  WHERE bfp_users.location='$municipal' AND bfp_users.municipal = '$office' AND form1_status = '1'"));

  $sheet->setCellValue('C'.$f1_1, $data['c']);
  $sheet->setCellValue('C'.$f1_NB, $data['c_l']);
  $sheet->setCellValue('C'.$f1_2, $data['c_bg']);
  $sheet->setCellValue('C'.$f1_GB, $data['c_l_bg']);

  $sheet->setCellValue('D'.$f1_1, $data['d']);
  $sheet->setCellValue('D'.$f1_NB, $data['d_l']);
  $sheet->setCellValue('E'.$f1_1, $data['e']);
  $sheet->setCellValue('E'.$f1_NB, $data['e_l']);
  $sheet->setCellValue('D'.$f1_2, $data['d_bg']);
  $sheet->setCellValue('D'.$f1_GB, $data['d_l_bg']);
  $sheet->setCellValue('E'.$f1_2, $data['e_bg']);
  $sheet->setCellValue('E'.$f1_GB, $data['e_l_bg']);

  $sheet->setCellValue('G'.$f1_1, $data['g']);
  $sheet->setCellValue('G'.$f1_NB, $data['g_l']);
  $sheet->setCellValue('H'.$f1_1, $data['h']);
  $sheet->setCellValue('H'.$f1_NB, $data['h_l']);
  $sheet->setCellValue('G'.$f1_2, $data['g_bg']);
  $sheet->setCellValue('G'.$f1_GB, $data['g_l_bg']);
  $sheet->setCellValue('H'.$f1_2, $data['h_bg']);
  $sheet->setCellValue('H'.$f1_GB, $data['h_l_bg']);

  $sheet->setCellValue('AS'.$f1_1, $data['as']);
  $sheet->setCellValue('AS'.$f1_NB, $data['as_l']);
  $sheet->setCellValue('AT'.$f1_1, $data['at']);
  $sheet->setCellValue('AT'.$f1_NB, $data['at_l']);
  $sheet->setCellValue('AS'.$f1_2, $data['as_bg']);
  $sheet->setCellValue('AS'.$f1_GB, $data['as_l_bg']);
  $sheet->setCellValue('AT'.$f1_2, $data['at_bg']);
  $sheet->setCellValue('AT'.$f1_GB, $data['at_l_bg']);

  $sheet->setCellValue('AV'.$f1_1, $data['av']);
  $sheet->setCellValue('AV'.$f1_NB, $data['av_l']);
  $sheet->setCellValue('AW'.$f1_1, $data['aw']);
  $sheet->setCellValue('AW'.$f1_NB, $data['aw_l']);
  $sheet->setCellValue('AV'.$f1_2, $data['av_bg']);
  $sheet->setCellValue('AV'.$f1_GB, $data['av_l_bg']);
  $sheet->setCellValue('AW'.$f1_2, $data['aw_bg']);
  $sheet->setCellValue('AW'.$f1_GB, $data['aw_l_bg']);

  $sheet->setCellValue('AY'.$f1_1, $data['ay']);
  $sheet->setCellValue('AY'.$f1_NB, $data['ay_l']);
  $sheet->setCellValue('AZ'.$f1_1, $data['az']);
  $sheet->setCellValue('AZ'.$f1_NB, $data['az_l']);
  $sheet->setCellValue('AY'.$f1_2, $data['ay_bg']);
  $sheet->setCellValue('AY'.$f1_GB, $data['ay_l_bg']);
  $sheet->setCellValue('AZ'.$f1_2, $data['az_bg']);
  $sheet->setCellValue('AZ'.$f1_GB, $data['az_l_bg']);

  $sheet->setCellValue('BB'.$f1_1, $data['bb']);
  $sheet->setCellValue('BB'.$f1_NB, $data['bb_l']);
  $sheet->setCellValue('BB'.$f1_2, $data['bb_bg']);
  $sheet->setCellValue('BB'.$f1_GB, $data['bb_l_bg']);

  $sheet->setCellValue('BC'.$f1_1, $data['bc']);
  $sheet->setCellValue('BC'.$f1_NB, $data['bc_l']);
  $sheet->setCellValue('BC'.$f1_2, $data['bc_bg']);
  $sheet->setCellValue('BC'.$f1_GB, $data['bc_l_bg']);

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
    WHERE bfp_users.location='$municipal' AND bfp_users.municipal = '$office' AND form1_status = '1'"));
    $sheet->setCellValue($sNC[1].$f1_1, $data['stra_nc']);
    $sheet->setCellValue($sNC[1].$f1_NB, $data['stra_nc_l']);
    $sheet->setCellValue($sNC[1].$f1_2, $data['stra_nc_gb']);
    $sheet->setCellValue($sNC[1].$f1_GB, $data['stra_nc_l_gb']);
  }
  foreach ($RN as $sRN){
    $data = mysqli_fetch_assoc($link->query("SELECT 
    COUNT(CASE WHEN form1_date_added BETWEEN '$start' AND '$end' AND nc_or_rn = 'RN' AND structure.lbl = '".$sNC[0]."' THEN 1 END) as 'stra_rn',
    COUNT(CASE WHEN form1_date_added BETWEEN '$start_lastyear' AND '$end_lastyear' AND nc_or_rn = 'RN' AND structure.lbl = '".$sNC[0]."' THEN 1 END) as 'stra_rn_l',
    COUNT(CASE WHEN form1_date_added BETWEEN '$start' AND '$end' AND nc_or_rn = 'RN' AND structure.lbl = '".$sNC[0]."' AND type = 'New Government Buildings' THEN 1 END) as 'stra_rn_gb',
    COUNT(CASE WHEN form1_date_added BETWEEN '$start_lastyear' AND '$end_lastyear' AND nc_or_rn = 'RN' AND structure.lbl = '".$sNC[0]."' AND type = 'New Government Buildings' THEN 1 END) as 'stra_rn_l_gb'
    FROM bfp_form1 LEFT JOIN bfp_users ON bfp_users.uid = bfp_form1.uid
    LEFT JOIN structure ON bfp_form1.structure = structure.structure_id
    WHERE bfp_users.location='$municipal' AND bfp_users.municipal = '$office' AND form1_status = '1'"));
    $sheet->setCellValue($sRN[1].$f1_1, $data['stra_rn']);
    $sheet->setCellValue($sRN[1].$f1_NB, $data['stra_rn_l']);
    $sheet->setCellValue($sRN[1].$f1_2, $data['stra_rn_gb']);
    $sheet->setCellValue($sRN[1].$f1_GB, $data['stra_rn_l_gb']);
  }


  // FORM 2
  $data = mysqli_fetch_assoc($link->query(
    "SELECT COUNT(CASE WHEN type = 'New' AND form2_date_added BETWEEN '$start' AND '$end' THEN 1 END) as 'b',
    COUNT(CASE WHEN type = 'New' AND form2_date_added BETWEEN '$start_lastyear' AND '$end_lastyear' THEN 1 END) as 'b_l',
    COUNT(CASE WHEN type = 'Renew' AND form2_date_added BETWEEN '$start' AND '$end' THEN 1 END) as 'c',
    COUNT(CASE WHEN type = 'Renew' AND form2_date_added BETWEEN '$start_lastyear' AND '$end_lastyear' THEN 1 END) as 'c_l',

    COUNT(CASE WHEN fsic = 'New' AND with_or_not = 'FSIC Issued WITHIN Prescribed Period' AND form2_date_added BETWEEN '$start' AND '$end' THEN 1 END) as 'w',
    COUNT(CASE WHEN fsic = 'New' AND with_or_not = 'FSIC Issued WITHIN Prescribed Period' AND form2_date_added BETWEEN '$start_lastyear' AND '$end_lastyear' THEN 1 END) as 'w_l',
    COUNT(CASE WHEN fsic = 'New' AND with_or_not = 'FSIC Issued NOT WITHIN Prescribed Period' AND form2_date_added BETWEEN '$start' AND '$end' THEN 1 END) as 'x',
    COUNT(CASE WHEN fsic = 'New' AND with_or_not = 'FSIC Issued NOT WITHIN Prescribed Period' AND form2_date_added BETWEEN '$start_lastyear' AND '$end_lastyear' THEN 1 END) as 'x_l',

    COUNT(CASE WHEN fsic = 'Renew' AND with_or_not = 'FSIC Issued WITHIN Prescribed Period' AND form2_date_added BETWEEN '$start' AND '$end' THEN 1 END) as 'y',
    COUNT(CASE WHEN fsic = 'Renew' AND with_or_not = 'FSIC Issued WITHIN Prescribed Period' AND form2_date_added BETWEEN '$start_lastyear' AND '$end_lastyear' THEN 1 END) as 'y_l',
    COUNT(CASE WHEN fsic = 'Renew' AND with_or_not = 'FSIC Issued NOT WITHIN Prescribed Period' AND form2_date_added BETWEEN '$start' AND '$end' THEN 1 END) as 'z',
    COUNT(CASE WHEN fsic = 'Renew' AND with_or_not = 'FSIC Issued NOT WITHIN Prescribed Period' AND form2_date_added BETWEEN '$start_lastyear' AND '$end_lastyear' THEN 1 END) as 'z_l',

    COUNT(CASE WHEN reinspection_1 = 'NOTICE TO COMPLY' AND reinspection_2 = 'Non-Compliant'  AND reinspection_3 = 'Issued NTC' AND form2_date_added BETWEEN '$start' AND '$end' THEN 1 END) as 'ab',
    COUNT(CASE WHEN reinspection_1 = 'NOTICE TO COMPLY' AND reinspection_2 = 'Non-Compliant'  AND reinspection_3 = 'Issued NTC' AND form2_date_added BETWEEN '$start_lastyear' AND '$end_lastyear' THEN 1 END) as 'ab_l',
    COUNT(CASE WHEN reinspection_1 = 'NOTICE TO COMPLY' AND reinspection_2 = 'Compliant'  AND reinspection_3 = 'Issued FSIC for Business Operation' AND form2_date_added BETWEEN '$start' AND '$end' THEN 1 END) as 'ac',
    COUNT(CASE WHEN reinspection_1 = 'NOTICE TO COMPLY' AND reinspection_2 = 'Compliant'  AND reinspection_3 = 'Issued FSIC for Business Operation' AND form2_date_added BETWEEN '$start_lastyear' AND '$end_lastyear' THEN 1 END) as 'ac_l',
    
    COUNT(CASE WHEN reinspection_1 = 'NOTICE TO CORRECT VIOLATION' AND reinspection_2 = 'Non-Compliant'  AND reinspection_3 = 'Issued NTCV' AND form2_date_added BETWEEN '$start' AND '$end' THEN 1 END) as 'ad',
    COUNT(CASE WHEN reinspection_1 = 'NOTICE TO CORRECT VIOLATION' AND reinspection_2 = 'Non-Compliant'  AND reinspection_3 = 'Issued NTCV' AND form2_date_added BETWEEN '$start_lastyear' AND '$end_lastyear' THEN 1 END) as 'ad_l',
    COUNT(CASE WHEN reinspection_1 = 'NOTICE TO CORRECT VIOLATION' AND reinspection_2 = 'Compliant'  AND reinspection_3 = 'Issued FSIC for Business Operation' AND form2_date_added BETWEEN '$start' AND '$end' THEN 1 END) as 'ae',
    COUNT(CASE WHEN reinspection_1 = 'NOTICE TO CORRECT VIOLATION' AND reinspection_2 = 'Compliant'  AND reinspection_3 = 'Issued FSIC for Business Operation' AND form2_date_added BETWEEN '$start_lastyear' AND '$end_lastyear' THEN 1 END) as 'ae_l',

    COUNT(CASE WHEN reinspection_1 = 'ABATEMENT' AND reinspection_2 = 'Non-Compliant'  AND reinspection_3 = 'Issued Abatement Order' AND form2_date_added BETWEEN '$start' AND '$end' THEN 1 END) as 'af',
    COUNT(CASE WHEN reinspection_1 = 'ABATEMENT' AND reinspection_2 = 'Non-Compliant'  AND reinspection_3 = 'Issued Abatement Order' AND form2_date_added BETWEEN '$start_lastyear' AND '$end_lastyear' THEN 1 END) as 'af_l',
    COUNT(CASE WHEN reinspection_1 = 'ABATEMENT' AND reinspection_2 = 'Compliant'  AND reinspection_3 = 'Total Issued FSIC for Business/ Operation' AND form2_date_added BETWEEN '$start' AND '$end' THEN 1 END) as 'ag',
    COUNT(CASE WHEN reinspection_1 = 'ABATEMENT' AND reinspection_2 = 'Compliant'  AND reinspection_3 = 'Total Issued FSIC for Business/ Operation' AND form2_date_added BETWEEN '$start_lastyear' AND '$end_lastyear' THEN 1 END) as 'ag_l',
  
    COUNT(CASE WHEN closure='Closure Order for Failure to Comply the Abatement order' AND form2_date_added BETWEEN '$start' AND '$end' THEN 1 END) as 'ai',
    COUNT(CASE WHEN closure='Closure Order for Failure to Comply the Abatement order' AND form2_date_added BETWEEN '$start_lastyear' AND '$end_lastyear' THEN 1 END) as 'ai_l',
    COUNT(CASE WHEN closure='Closure For Failure To Pay Fine' AND form2_date_added BETWEEN '$start' AND '$end' THEN 1 END) as 'aj',
    COUNT(CASE WHEN closure='Closure For Failure To Pay Fine' AND form2_date_added BETWEEN '$start_lastyear' AND '$end_lastyear' THEN 1 END) as 'aj_l'
    FROM bfp_form2
    LEFT JOIN bfp_users ON bfp_users.uid = bfp_form2.uid
    WHERE bfp_users.location='$municipal' AND bfp_users.municipal = '$office' AND form2_status = '1'"));


  $sheet2->setCellValue('B'.$f2_1, $data['b']);
  $sheet2->setCellValue('B'.$f2_l, $data['b_l']);
  $sheet2->setCellValue('C'.$f2_1, $data['c']);
  $sheet2->setCellValue('C'.$f2_l, $data['c_l']);

  $sheet2->setCellValue('W'.$f2_1, $data['w']);
  $sheet2->setCellValue('W'.$f2_l, $data['w_l']);
  $sheet2->setCellValue('X'.$f2_1, $data['x']);
  $sheet2->setCellValue('X'.$f2_l, $data['x_l']);
  $sheet2->setCellValue('Y'.$f2_1, $data['y']);
  $sheet2->setCellValue('Y'.$f2_l, $data['y_l']);
  $sheet2->setCellValue('Z'.$f2_1, $data['z']);
  $sheet2->setCellValue('Z'.$f2_l, $data['z_l']);
  
  $sheet2->setCellValue('AB'.$f2_1, $data['ab']);
  $sheet2->setCellValue('AB'.$f2_l, $data['ab_l']);
  $sheet2->setCellValue('AC'.$f2_1, $data['ac']);
  $sheet2->setCellValue('AC'.$f2_l, $data['ac_l']);
  $sheet2->setCellValue('AD'.$f2_1, $data['ad']);
  $sheet2->setCellValue('AD'.$f2_l, $data['ad_l']);
  $sheet2->setCellValue('AE'.$f2_1, $data['ae']);
  $sheet2->setCellValue('AE'.$f2_l, $data['ae_l']);
  $sheet2->setCellValue('AF'.$f2_1, $data['af']);
  $sheet2->setCellValue('AF'.$f2_l, $data['af_l']);
  $sheet2->setCellValue('AG'.$f2_1, $data['ag']);
  $sheet2->setCellValue('AG'.$f2_l, $data['ag_l']);
  $sheet2->setCellValue('AI'.$f2_1, $data['ai']);
  $sheet2->setCellValue('AI'.$f2_l, $data['ai_l']);
  $sheet2->setCellValue('AJ'.$f2_1, $data['aj']);
  $sheet2->setCellValue('AJ'.$f2_l, $data['aj_l']);

  foreach ($letter as $sletter) {
    $data = mysqli_fetch_assoc($link->query("SELECT 
    COUNT(CASE WHEN structure = '".$sletter[0]."' AND form2_date_added BETWEEN '$start' AND '$end' THEN 1 END) as 's',
    COUNT(CASE WHEN structure = '".$sletter[0]."' AND form2_date_added BETWEEN '$start_lastyear' AND '$end_lastyear' THEN 1 END) as 's_l'
    FROM bfp_form2 
    LEFT JOIN bfp_users ON bfp_users.uid = bfp_form2.uid
    WHERE bfp_users.location='$municipal' AND bfp_users.municipal = '$office' AND form2_status = '1'"));

    $sheet2->setCellValue($sletter[1].$f2_1, $data['s']);
    $sheet2->setCellValue($sletter[1].$f2_l, $data['s_l']);
  }

  // FORM 3
  $data = mysqli_fetch_assoc($link->query(
    "SELECT COUNT(CASE WHEN type = 'New' AND form3_date_added BETWEEN '$start' AND '$end' THEN 1 END) as 'b',
    COUNT(CASE WHEN type = 'New' AND form3_date_added BETWEEN '$start_lastyear' AND '$end_lastyear' THEN 1 END) as 'b_l',
    COUNT(CASE WHEN type = 'Renew' AND form3_date_added BETWEEN '$start' AND '$end' THEN 1 END) as 'c',
    COUNT(CASE WHEN type = 'Renew' AND form3_date_added BETWEEN '$start_lastyear' AND '$end_lastyear' THEN 1 END) as 'c_l',

    COUNT(CASE WHEN new_renew = 'New' AND with_or_not = 'FSIC Issued WITHIN Prescribed Period' AND form3_date_added BETWEEN '$start' AND '$end' THEN 1 END) as 'v',
    COUNT(CASE WHEN new_renew = 'New' AND with_or_not = 'FSIC Issued WITHIN Prescribed Period' AND form3_date_added BETWEEN '$start_lastyear' AND '$end_lastyear' THEN 1 END) as 'v_l',
    COUNT(CASE WHEN new_renew = 'New' AND with_or_not = 'FSIC Issued NOT WITHIN Prescribed Period' AND form3_date_added BETWEEN '$start' AND '$end' THEN 1 END) as 'w',
    COUNT(CASE WHEN new_renew = 'New' AND with_or_not = 'FSIC Issued NOT WITHIN Prescribed Period' AND form3_date_added BETWEEN '$start_lastyear' AND '$end_lastyear' THEN 1 END) as 'w_l',

    COUNT(CASE WHEN new_renew = 'Renew' AND with_or_not = 'FSIC Issued WITHIN Prescribed Period' AND form3_date_added BETWEEN '$start' AND '$end' THEN 1 END) as 'x',
    COUNT(CASE WHEN new_renew = 'Renew' AND with_or_not = 'FSIC Issued WITHIN Prescribed Period' AND form3_date_added BETWEEN '$start_lastyear' AND '$end_lastyear' THEN 1 END) as 'x_l',
    COUNT(CASE WHEN new_renew = 'Renew' AND with_or_not = 'FSIC Issued NOT WITHIN Prescribed Period' AND form3_date_added BETWEEN '$start' AND '$end' THEN 1 END) as 'y',
    COUNT(CASE WHEN new_renew = 'Renew' AND with_or_not = 'FSIC Issued NOT WITHIN Prescribed Period' AND form3_date_added BETWEEN '$start_lastyear' AND '$end_lastyear' THEN 1 END) as 'y_l',

    COUNT(CASE WHEN reinspection_1 = 'NOTICE TO COMPLY' AND reinspection_2 = 'Non-Compliant'  AND reinspection_3 = 'Issued NTC' AND form3_date_added BETWEEN '$start' AND '$end' THEN 1 END) as 'aa',
    COUNT(CASE WHEN reinspection_1 = 'NOTICE TO COMPLY' AND reinspection_2 = 'Non-Compliant'  AND reinspection_3 = 'Issued NTC' AND form3_date_added BETWEEN '$start_lastyear' AND '$end_lastyear' THEN 1 END) as 'aa_l',
    COUNT(CASE WHEN reinspection_1 = 'NOTICE TO COMPLY' AND reinspection_2 = 'Compliant'  AND reinspection_3 = 'Issued FSIC for Business Operation' AND form3_date_added BETWEEN '$start' AND '$end' THEN 1 END) as 'ab',
    COUNT(CASE WHEN reinspection_1 = 'NOTICE TO COMPLY' AND reinspection_2 = 'Compliant'  AND reinspection_3 = 'Issued FSIC for Business Operation' AND form3_date_added BETWEEN '$start_lastyear' AND '$end_lastyear' THEN 1 END) as 'ab_l',
    
    COUNT(CASE WHEN reinspection_1 = 'NOTICE TO CORRECT VIOLATION' AND reinspection_2 = 'Non-Compliant'  AND reinspection_3 = 'Issued NTCV' AND form3_date_added BETWEEN '$start' AND '$end' THEN 1 END) as 'ac',
    COUNT(CASE WHEN reinspection_1 = 'NOTICE TO CORRECT VIOLATION' AND reinspection_2 = 'Non-Compliant'  AND reinspection_3 = 'Issued NTCV' AND form3_date_added BETWEEN '$start_lastyear' AND '$end_lastyear' THEN 1 END) as 'ac_l',
    COUNT(CASE WHEN reinspection_1 = 'NOTICE TO CORRECT VIOLATION' AND reinspection_2 = 'Compliant'  AND reinspection_3 = 'Issued FSIC for Business Operation' AND form3_date_added BETWEEN '$start' AND '$end' THEN 1 END) as 'ad',
    COUNT(CASE WHEN reinspection_1 = 'NOTICE TO CORRECT VIOLATION' AND reinspection_2 = 'Compliant'  AND reinspection_3 = 'Issued FSIC for Business Operation' AND form3_date_added BETWEEN '$start_lastyear' AND '$end_lastyear' THEN 1 END) as 'ad_l',

    COUNT(CASE WHEN reinspection_1 = 'ABATEMENT' AND reinspection_2 = 'Non-Compliant'  AND reinspection_3 = 'Issued Abatement Order' AND form3_date_added BETWEEN '$start' AND '$end' THEN 1 END) as 'ae',
    COUNT(CASE WHEN reinspection_1 = 'ABATEMENT' AND reinspection_2 = 'Non-Compliant'  AND reinspection_3 = 'Issued Abatement Order' AND form3_date_added BETWEEN '$start_lastyear' AND '$end_lastyear' THEN 1 END) as 'ae_l',
    COUNT(CASE WHEN reinspection_1 = 'ABATEMENT' AND reinspection_2 = 'Compliant'  AND reinspection_3 = 'Total Issued FSIC for Business/ Operation' AND form3_date_added BETWEEN '$start' AND '$end' THEN 1 END) as 'af',
    COUNT(CASE WHEN reinspection_1 = 'ABATEMENT' AND reinspection_2 = 'Compliant'  AND reinspection_3 = 'Total Issued FSIC for Business/ Operation' AND form3_date_added BETWEEN '$start_lastyear' AND '$end_lastyear' THEN 1 END) as 'af_l',
  
    COUNT(CASE WHEN closure='Closure Order for Failure to Comply the Abatement order' AND form3_date_added BETWEEN '$start' AND '$end' THEN 1 END) as 'ah',
    COUNT(CASE WHEN closure='Closure Order for Failure to Comply the Abatement order' AND form3_date_added BETWEEN '$start_lastyear' AND '$end_lastyear' THEN 1 END) as 'ah_l',
    COUNT(CASE WHEN closure='Closure For Failure To Pay Fine' AND form3_date_added BETWEEN '$start' AND '$end' THEN 1 END) as 'ai',
    COUNT(CASE WHEN closure='Closure For Failure To Pay Fine' AND form3_date_added BETWEEN '$start_lastyear' AND '$end_lastyear' THEN 1 END) as 'ai_l'
    FROM bfp_form3
    LEFT JOIN bfp_users ON bfp_users.uid = bfp_form3.uid
    WHERE bfp_users.location='$municipal' AND bfp_users.municipal = '$office' AND form3_status = '1'"));

    $sheet3->setCellValue('B'.$f3_start, $data['b']);
    $sheet3->setCellValue('B'.$f3_last, $data['b_l']);
    $sheet3->setCellValue('C'.$f3_start, $data['c']);
    $sheet3->setCellValue('C'.$f3_last, $data['c_l']);
    $sheet3->setCellValue('V'.$f3_start, $data['v']);
    $sheet3->setCellValue('V'.$f3_last, $data['v_l']);
    $sheet3->setCellValue('W'.$f3_start, $data['w']);
    $sheet3->setCellValue('W'.$f3_last, $data['w_l']);
    $sheet3->setCellValue('X'.$f3_start, $data['x']);
    $sheet3->setCellValue('X'.$f3_last, $data['x_l']);
    $sheet3->setCellValue('Y'.$f3_start, $data['y']);
    $sheet3->setCellValue('Y'.$f3_last, $data['y_l']);
    $sheet3->setCellValue('AA'.$f3_start, $data['aa']);
    $sheet3->setCellValue('AA'.$f3_last, $data['aa_l']);
    $sheet3->setCellValue('AB'.$f3_start, $data['ab']);
    $sheet3->setCellValue('AB'.$f3_last, $data['ab_l']);
    $sheet3->setCellValue('AC'.$f3_start, $data['ac']);
    $sheet3->setCellValue('AC'.$f3_last, $data['ac_l']);
    $sheet3->setCellValue('AD'.$f3_start, $data['ad']);
    $sheet3->setCellValue('AD'.$f3_last, $data['ad_l']);
    $sheet3->setCellValue('AE'.$f3_start, $data['ae']);
    $sheet3->setCellValue('AE'.$f3_last, $data['ae_l']);
    $sheet3->setCellValue('AF'.$f3_start, $data['af']);
    $sheet3->setCellValue('AF'.$f3_last, $data['af_l']);
    $sheet3->setCellValue('AH'.$f3_start, $data['ah']);
    $sheet3->setCellValue('AH'.$f3_last, $data['ah_l']);
    $sheet3->setCellValue('AI'.$f3_start, $data['ai']);
    $sheet3->setCellValue('AI'.$f3_last, $data['ai_l']);

    foreach ($f3letter as $sletter) {
      $data = mysqli_fetch_assoc($link->query("SELECT 
      COUNT(CASE WHEN structure = '".$sletter[0]."' AND form3_date_added BETWEEN '$start' AND '$end' THEN 1 END) as 's',
      COUNT(CASE WHEN structure = '".$sletter[0]."' AND form3_date_added BETWEEN '$start_lastyear' AND '$end_lastyear' THEN 1 END) as 's_l'
      FROM bfp_form3 
      LEFT JOIN bfp_users ON bfp_users.uid = bfp_form3.uid
      WHERE bfp_users.location='$municipal' AND bfp_users.municipal = '$office' AND form3_status = '1'"));
  
      $sheet3->setCellValue($sletter[1].$f3_start, $data['s']);
      $sheet3->setCellValue($sletter[1].$f3_last, $data['s_l']);
    }
  // FORM 4
  foreach ($arrayfees as $shfees){
    $data = mysqli_fetch_assoc($link->query("SELECT 
    SUM(CASE WHEN fire_code_fees = '".$shfees[0]."' AND type = 'Business Establishments' AND form4_date_added BETWEEN '$start' AND '$end' THEN fees ELSE 0 END) as 'fees_be',
    SUM(CASE WHEN fire_code_fees = '".$shfees[0]."' AND type = 'Business Establishments' AND form4_date_added BETWEEN '$start_lastyear' AND '$end_lastyear' THEN fees ELSE 0 END) as 'fees_be_l',
    SUM(CASE WHEN fire_code_fees = '".$shfees[0]."' AND type = 'Government Buildings' AND form4_date_added BETWEEN '$start' AND '$end' THEN fees ELSE 0 END) as 'fees_gb',
    SUM(CASE WHEN fire_code_fees = '".$shfees[0]."' AND type = 'Government Buildings' AND form4_date_added BETWEEN '$start_lastyear' AND '$end_lastyear' THEN fees ELSE 0 END) as 'fees_gb_l'
    FROM bfp_form4 
    LEFT JOIN bfp_users ON bfp_users.uid = bfp_form4.uid
    WHERE bfp_users.location='$municipal' AND bfp_users.municipal = '$office' AND form4_status = '1'"));

    $sheet4->setCellValue($shfees[1].$f4be_start, $data['fees_be']);
    $sheet4->setCellValue($shfees[1].$f4gb_start, $data['fees_gb']);

    $sheet4->setCellValue($shfees[1].$f4be_last, $data['fees_be_l']);
    $sheet4->setCellValue($shfees[1].$f4gb_last, $data['fees_gb_l']);
  }
  $f4be_start++;
  $f4gb_start++;
  $f1_1++;
  $f1_2++;
  $f2_1++;
  $f3_start++;
}




// Export
$newname = date('Y-m-d h-i-s');
$writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, "Xlsx");
$writer->save('files/BPF-REPORT ' . $newname . '.xlsx');

header("location: files/BPF-REPORT " . $newname . '.xlsx');
