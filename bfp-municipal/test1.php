<?php 
include_once "check.php";
$uid = $_GET['uid'];
$docu = $_GET['docu'];

$query = mysqli_query($link,"SELECT * FROM form1 WHERE form_uid='$docu'");

$user = mysqli_fetch_assoc(mysqli_query($link,"SELECT * FROM bfp_users WHERE uid = '$uid'"));

$countbrgy = mysqli_fetch_assoc(mysqli_query($link,"SELECT COUNT(id) FROM brgy WHERE municipal = '".$user['location']."'"));
$barangay = mysqli_query($link,"SELECT * FROM brgy WHERE municipal = '".$user['location']."'");

$htmlrow = '
<style type="text/css">
  .tg  {border-collapse:collapse;border-spacing:0;}
  .tg td{border-color:black;border-style:solid;border-width:1px;font-family:Arial, sans-serif;font-size:14px;
    overflow:hidden;padding:10px 5px;word-break:normal;}
  .tg th{border-color:black;border-style:solid;border-width:1px;font-family:Arial, sans-serif;font-size:14px;
    font-weight:normal;overflow:hidden;padding:10px 5px;word-break:normal;}
  .tg .tg-lboi{border-color:inherit;text-align:left;vertical-align:middle}
  .tg .tg-4ttc{background-color:#92D050;border-color:inherit;color:#339;text-align:center;vertical-align:top}
  .tg .tg-7v9f{background-color:#FCD5B4;border-color:inherit;text-align:center;vertical-align:top}
  .tg .tg-9wq8{border-color:inherit;text-align:center;vertical-align:middle}
  .tg .tg-ui5r{background-color:#FCD5B4;border-color:inherit;text-align:left;vertical-align:middle}
  .tg .tg-fiv1{background-color:#00b050;border-color:inherit;font-weight:bold;text-align:center;vertical-align:top}
  .tg .tg-9ms1{background-color:#FCD5B4;border-color:inherit;text-align:left;vertical-align:top}
  .tg .tg-bqvn{background-color:#FCD5B4;border-color:inherit;text-align:center;vertical-align:bottom}
  .tg .tg-k45f{background-color:#92D050;border-color:inherit;text-align:center;vertical-align:top}
  .tg .tg-3pf0{background-color:#92D050;border-color:inherit;font-weight:bold;text-align:center;vertical-align:middle}
  .tg .tg-c3ow{border-color:inherit;text-align:center;vertical-align:top}
  .tg .tg-glh0{background-color:#92D050;border-color:inherit;font-weight:bold;text-align:center;vertical-align:top}
  .tg .tg-wcl9{background-color:#FCD5B4;border-color:inherit;text-align:center;vertical-align:middle}
  .tg .tg-gmvy{background-color:#92D050;border-color:inherit;font-weight:bold;text-align:left;vertical-align:middle}
  .tg .tg-0pky{border-color:inherit;text-align:left;vertical-align:top}
  .tg .tg-1l78{background-color:#FCD5B4;border-color:inherit;font-weight:bold;text-align:center;vertical-align:middle}
  .tg .tg-ngbt{background-color:#FCD5B4;border-color:inherit;color:#00B0F0;text-align:center;vertical-align:bottom}
  .tg .tg-n0h9{background-color:#92D050;border-color:inherit;text-align:center;vertical-align:bottom}
  .tg .tg-2ern{background-color:#92D050;border-color:inherit;text-align:center;vertical-align:middle}
  .tg .tg-fb7a{background-color:#00B050;border-color:inherit;text-align:center;vertical-align:bottom}
  .tg .tg-d8zr{background-color:#00B050;border-color:inherit;font-weight:bold;text-align:center;vertical-align:bottom}
  .tg .tg-saeb{background-color:#00B050;border-color:inherit;font-weight:bold;text-align:center;vertical-align:top}
  .tg .tg-bft9{background-color:#E26B0A;border-color:inherit;text-align:center;vertical-align:middle}
  .tg .tg-3xi5{background-color:#ffffff;border-color:inherit;text-align:center;vertical-align:top}
  .tg .tg-rcip{background-color:#FFF;border-color:inherit;text-align:center;vertical-align:middle}
  .tg .tg-h7c6{background-color:#38fff8;border-color:inherit;text-align:center;vertical-align:top}
  .tg .tg-hgfy{background-color:#92D050;border-color:inherit;font-weight:bold;text-align:left;vertical-align:top}
  .tg .tg-0lax{text-align:left;vertical-align:top}
  .tg .tg-3rrg{background-color:#FCD5B4;text-align:left;vertical-align:top}
</style>';

$htmlrow .='<table class="tg">
<thead>
  <tr>
    <th class="tg-c3ow" colspan="55">NEWLY  CONSTRUCTED BUILDING, (RENOVATION, REPAIR, MODIFIED)</th>
  </tr>
</thead>';

$htmlrow .='<tbody>
  <tr>
    <td class="tg-0pky" rowspan="6">City/ Municipality<br><br><br><br></td>
    <td class="tg-1l78" colspan="7">FSEC </td>
    <td class="tg-k45f" colspan="32">     1st INSPECTION FOR FSIC (OCCUPANCY PERMIT)   </td>
    <td class="tg-7v9f" colspan="3" rowspan="3">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;TOTAL</td>
    <td class="tg-4ttc" colspan="3" rowspan="3">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Inspection during <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Under Construction</td>
    <td class="tg-wcl9" colspan="9" rowspan="2">Issuances </td>
  </tr>
  <tr>
    <td class="tg-ngbt" rowspan="4">Total Number Application Received within the Month</td>
    <td class="tg-bqvn" colspan="3" rowspan="2">Number&nbsp;&nbsp;&nbsp;of Issued FSEC  <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td class="tg-bqvn" colspan="3" rowspan="2">Number of Issued Notice of&nbsp;&nbsp;&nbsp;Disapproval (NOD) </td>
    <td class="tg-n0h9" colspan="2" rowspan="2">Assembly</td>
    <td class="tg-n0h9" colspan="2" rowspan="2">Educational</td>
    <td class="tg-n0h9" colspan="2" rowspan="2">Day Care</td>
    <td class="tg-n0h9" colspan="2" rowspan="2">Health Care</td>
    <td class="tg-n0h9" colspan="2" rowspan="2">Residential Board &amp; Care</td>
    <td class="tg-n0h9" colspan="2" rowspan="2">Detention &amp; Correctional</td>
    <td class="tg-2ern" colspan="10">Residential</td>
    <td class="tg-n0h9" colspan="2" rowspan="2">Mercantile</td>
    <td class="tg-n0h9" colspan="2" rowspan="2">Business</td>
    <td class="tg-n0h9" colspan="2" rowspan="2">Industrial</td>
    <td class="tg-n0h9" colspan="2" rowspan="2">Storage</td>
    <td class="tg-n0h9" colspan="2" rowspan="2">Special&nbsp;&nbsp;&nbsp;Structures</td>
  </tr>
  <tr>
    <td class="tg-n0h9" colspan="2">Hotel</td>
    <td class="tg-n0h9" colspan="2">Dormitories</td>
    <td class="tg-n0h9" colspan="2">Apartment Building</td>
    <td class="tg-n0h9" colspan="2">Lodging and Rooming house</td>
    <td class="tg-n0h9" colspan="2">Single and Two Family Dwelling Unit</td>
    <td class="tg-wcl9" colspan="3">Issued FSIC for <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Occupancy<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td class="tg-wcl9" colspan="3">Issued&nbsp;&nbsp;&nbsp;With NOD for NOT OCCUPIED buildings/establishments<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td class="tg-wcl9" colspan="3">Issued&nbsp;&nbsp;&nbsp;With NTC for OCCUPIED buildings/establishments<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
  </tr>
  <tr>
    <td class="tg-bqvn">For Current Month (Within the Month)</td>
    <td class="tg-bqvn">From&nbsp;&nbsp;&nbsp;Previous Month(s)</td>
    <td class="tg-bqvn">Total Issued FSEC</td>
    <td class="tg-bqvn">For Current Month&nbsp;&nbsp;&nbsp;(Within the Month)</td>
    <td class="tg-bqvn">From&nbsp;&nbsp;&nbsp;Previous Month(s)</td>
    <td class="tg-bqvn">Total&nbsp;&nbsp;&nbsp;Issued NOD</td>
    <td class="tg-2ern">NC</td>
    <td class="tg-2ern">RN</td>
    <td class="tg-2ern">NC</td>
    <td class="tg-2ern">RN</td>
    <td class="tg-2ern">NC</td>
    <td class="tg-2ern">RN</td>
    <td class="tg-2ern">NC</td>
    <td class="tg-2ern">RN</td>
    <td class="tg-2ern">NC</td>
    <td class="tg-2ern">RN</td>
    <td class="tg-2ern">NC</td>
    <td class="tg-2ern">RN</td>
    <td class="tg-2ern">NC</td>
    <td class="tg-2ern">RN</td>
    <td class="tg-2ern">NC</td>
    <td class="tg-2ern">RN</td>
    <td class="tg-2ern">NC</td>
    <td class="tg-2ern">RN</td>
    <td class="tg-2ern">NC</td>
    <td class="tg-2ern">RN</td>
    <td class="tg-2ern">NC</td>
    <td class="tg-2ern">RN</td>
    <td class="tg-2ern">NC</td>
    <td class="tg-2ern">RN</td>
    <td class="tg-2ern">NC</td>
    <td class="tg-2ern">RN</td>
    <td class="tg-2ern">NC</td>
    <td class="tg-2ern">RN</td>
    <td class="tg-2ern">NC</td>
    <td class="tg-2ern">RN</td>
    <td class="tg-2ern">NC</td>
    <td class="tg-2ern">RN</td>
    <td class="tg-wcl9">NC</td>
    <td class="tg-wcl9">RN</td>
    <td class="tg-wcl9">OVERALL</td>
    <td class="tg-2ern">NC</td>
    <td class="tg-2ern">RN</td>
    <td class="tg-2ern">Total</td>
    <td class="tg-bqvn">For Current Month (Within the Month)</td>
    <td class="tg-bqvn">**From Previous&nbsp;&nbsp;&nbsp;Month<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td class="tg-bqvn">Total<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td class="tg-bqvn">For&nbsp;&nbsp;&nbsp;Current Month (Within the Month)</td>
    <td class="tg-bqvn">From Previous&nbsp;&nbsp;&nbsp;Month<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td class="tg-bqvn">Total<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td class="tg-bqvn">For&nbsp;&nbsp;&nbsp;Current Month (Within the Month)</td>
    <td class="tg-bqvn">From Previous&nbsp;&nbsp;&nbsp;Month<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td class="tg-bqvn">Total<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
  </tr>
  <tr>
    <td class="tg-1l78" colspan="6">A</td>
    <td class="tg-3pf0" colspan="32">B</td>
    <td class="tg-1l78" colspan="3">C</td>
    <td class="tg-3pf0" colspan="2">D</td>
    <td class="tg-3pf0"> </td>
    <td class="tg-1l78" colspan="9">E</td>
  </tr>
  <tr>
    <td class="tg-7v9f">A.1</td>
    <td class="tg-7v9f">A.2</td>
    <td class="tg-7v9f">A.3</td>
    <td class="tg-7v9f">A.4</td>
    <td class="tg-7v9f">A.5</td>
    <td class="tg-7v9f">A.6</td>
    <td class="tg-7v9f">A.7</td>
    <td class="tg-2ern">B.1</td>
    <td class="tg-2ern">B.2</td>
    <td class="tg-2ern">B.3</td>
    <td class="tg-2ern">B.4</td>
    <td class="tg-2ern">B.5</td>
    <td class="tg-2ern">B.6</td>
    <td class="tg-2ern">B.7</td>
    <td class="tg-2ern">B.8</td>
    <td class="tg-2ern">B.9</td>
    <td class="tg-2ern">B.10</td>
    <td class="tg-2ern">B.11</td>
    <td class="tg-2ern">B.12</td>
    <td class="tg-2ern">B.13</td>
    <td class="tg-2ern">B.14</td>
    <td class="tg-2ern">B.15</td>
    <td class="tg-2ern">B.16</td>
    <td class="tg-2ern">B.17</td>
    <td class="tg-2ern">B.18</td>
    <td class="tg-2ern">B.19</td>
    <td class="tg-2ern">B.20</td>
    <td class="tg-2ern">B.21</td>
    <td class="tg-2ern">B.22</td>
    <td class="tg-2ern">B.23</td>
    <td class="tg-2ern">B.24</td>
    <td class="tg-2ern">B.25</td>
    <td class="tg-2ern">B.26</td>
    <td class="tg-2ern">B.27</td>
    <td class="tg-2ern">B.28</td>
    <td class="tg-2ern">B.29</td>
    <td class="tg-2ern">B.30</td>
    <td class="tg-2ern">B.31</td>
    <td class="tg-2ern">B.32</td>
    <td class="tg-wcl9">C.1</td>
    <td class="tg-wcl9">C.2</td>
    <td class="tg-wcl9">C.3</td>
    <td class="tg-2ern">D.1</td>
    <td class="tg-2ern">D.2</td>
    <td class="tg-2ern">D.3</td>
    <td class="tg-wcl9">E.1</td>
    <td class="tg-wcl9">E.2</td>
    <td class="tg-wcl9">E.3</td>
    <td class="tg-wcl9">E.4</td>
    <td class="tg-wcl9">E.5</td>
    <td class="tg-wcl9">E.6</td>
    <td class="tg-wcl9">E.7</td>
    <td class="tg-wcl9">E.8</td>
    <td class="tg-wcl9">E.9</td>
  </tr>
  <tr>
    <td class="tg-fb7a" colspan="2"><span style="font-weight:bold">'.$user['location'].'</span></td>
    <td class="tg-d8zr"> </td>
    <td class="tg-d8zr"> </td>
    <td class="tg-fiv1"></td>
    <td class="tg-saeb"> </td>
    <td class="tg-saeb"> </td>
    <td class="tg-saeb"></td>
    <td class="tg-d8zr"> </td>
    <td class="tg-d8zr"> </td>
    <td class="tg-d8zr"> </td>
    <td class="tg-d8zr"> </td>
    <td class="tg-d8zr"> </td>
    <td class="tg-d8zr"> </td>
    <td class="tg-d8zr"> </td>
    <td class="tg-d8zr"> </td>
    <td class="tg-d8zr"> </td>
    <td class="tg-d8zr"> </td>
    <td class="tg-d8zr"> </td>
    <td class="tg-d8zr"> </td>
    <td class="tg-d8zr"> </td>
    <td class="tg-d8zr"> </td>
    <td class="tg-d8zr"> </td>
    <td class="tg-d8zr"> </td>
    <td class="tg-d8zr"> </td>
    <td class="tg-d8zr"> </td>
    <td class="tg-d8zr"> </td>
    <td class="tg-d8zr"> </td>
    <td class="tg-d8zr"> </td>
    <td class="tg-d8zr"> </td>
    <td class="tg-d8zr"> </td>
    <td class="tg-d8zr"> </td>
    <td class="tg-d8zr"> </td>
    <td class="tg-d8zr"> </td>
    <td class="tg-d8zr"> </td>
    <td class="tg-d8zr"> </td>
    <td class="tg-d8zr"> </td>
    <td class="tg-d8zr"> </td>
    <td class="tg-d8zr"> </td>
    <td class="tg-d8zr"> </td>
    <td class="tg-d8zr"> </td>
    <td class="tg-d8zr"> </td>
    <td class="tg-d8zr"> </td>
    <td class="tg-d8zr"> </td>
    <td class="tg-d8zr"> </td>
    <td class="tg-d8zr"> </td>
    <td class="tg-saeb"> </td>
    <td class="tg-saeb"> </td>
    <td class="tg-saeb"> </td>
    <td class="tg-saeb"> </td>
    <td class="tg-saeb"> </td>
    <td class="tg-saeb"> </td>
    <td class="tg-saeb"> </td>
    <td class="tg-saeb"> </td>
    <td class="tg-saeb"> </td>
  </tr>';

$form1 = mysqli_query($link,"SELECT * FROM form1 WHERE Form1Type = 'New Establishments/Buildings'");
$countrow = $countbrgy['COUNT(id)'] + 3;
$htmlrow .='<tr>
              <td class="tg-bft9" rowspan="'.$countrow.'">for New Establishments/Buildings</td>';
$htmlrow .='<td></td>';
              
            for($i=0;$i<$countrow;$i++){
              $htmlrow .='<tr><td></td><td></td><td></td></tr>';
            }
$htmlrow .='<tr>';
            
$htmlrow .= ' <tr><td>Sub-Total</td></tr>
              <tr><td>(Past year,same month)</td></tr>
              <tr><td>Variance</td></tr>
            </tr>';
$htmlrow .='<tr>
              <td class="tg-h7c6" rowspan="'.$countrow.'">for New Government Buildings</td>
              <tr><td>Sub-Total</td></tr>
              <tr><td>(Past year,same month)</td></tr>
              <tr><td>Variance</td></tr>
            </tr>';
$htmlrow .='<tr>
              <td class="tg-0lax" rowspan="'.$countrow.'">for New PEZA Establishments/ Buildings</td>
              <tr><td>Sub-Total</td></tr>
              <tr><td>(Past year,same month)</td></tr>
              <tr><td>Variance</td></tr>
            </tr>';
$htmlrow .='</tbody>
</table>';

header('Content-Type:application/xls');
header('Content-Disposition:attachment;filename=rereport-'.date('Y-d-m').'.xls');
echo $htmlrow;
?>