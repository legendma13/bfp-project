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