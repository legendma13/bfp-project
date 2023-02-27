<?php 
include_once "check.php";
$uid = $_GET['uid'];


$user = mysqli_fetch_assoc(mysqli_query($link,"SELECT * FROM bfp_users WHERE uid = '$uid'"));

$countbrgy = mysqli_fetch_assoc(mysqli_query($link,"SELECT COUNT(id) FROM brgy WHERE municipal = '".$user['location']."'"));
$barangay = mysqli_query($link,"SELECT * FROM brgy WHERE municipal = '".$user['location']."'");

$htmlrow = '<table class="tg">
<thead>
  <tr>
    <th class="tg-c3ow" colspan="55">NEWLY  CONSTRUCTED BUILDING, (RENOVATION, REPAIR, MODIFIED)</th>
  </tr>
</thead>';

$htmlrow .='<tbody>
  <tr>
    <td>City / Municipality<br><br><br><br></td>
    <td>FSEC</td>
    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;TOTAL</td>
    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Inspection during <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Under Construction</td>
    <td>Issuances</td>
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

$QEstablishments = mysqli_query($link,"SELECT * FROM form1 WHERE uid='$uid' AND Form1Type = 'New Establishment Buildings'");
$countrow = $countbrgy['COUNT(id)'] + 3;
$htmlrow .='<tr>
              <td class="tg-bft9" rowspan="'.$countrow.'">for New Establishments/Buildings</td>';
            while($shEstablishments=mysqli_fetch_assoc($QEstablishments)){
              $htmlrow .='<tr>
                            <td>'.$shEstablishments['brgy'].'</td>
                            <td>'.$shEstablishments['ThisMonthTotalApp'].'</td>
                            <td>'.$shEstablishments['IssuedFSEC_Curmonth'].'</td>
                            <td>'.$shEstablishments['IssuedFSEC_PreMonth'].'</td>';
                            $totalFsec = $shEstablishments['IssuedFSEC_Curmonth'] + $shEstablishments['IssuedFSEC_PreMonth'];
                $htmlrow .='<td>'.$totalFsec.'</td>
                            <td>'.$shEstablishments['IssuedNOD_Curmonth'].'</td>
                            <td>'.$shEstablishments['IssuedNOD_PreMonth'].'</td>';
                            $totalNOD = $shEstablishments['IssuedNOD_Curmonth'] + $shEstablishments['IssuedNOD_PreMonth'];
                $htmlrow .='<td>'.$totalNOD.'</td>';

                $htmlrow .='</tr>';
            }

$htmlrow .='</tr>';
$htmlrow .='<tr><tr><td>Sub-Total</td></tr>
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
              <td class="tg-0lax" rowspan="'.$countrow.'">for New PEZA Establishments Buildings</td>
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