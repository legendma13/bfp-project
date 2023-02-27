<!DOCTYPE html>
<?php include_once "check.php" ?>
<html lang="en">
<?php include_once "head.php" ?>

<body>
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <?php include_once "topnav.php" ?>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_settings-panel.html -->
      <?php include_once "setting.php" ?>
      <!-- partial:partials/_sidebar.html -->
      <?php include_once "sidenav.php" ?>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-sm-12">
              <div class="home-tab">
                <div class="d-sm-flex align-items-center justify-content-between border-bottom">
                  <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                      <a class="nav-link active ps-0" id="home-tab" data-bs-toggle="tab" href="#Overview" role="tab" aria-controls="Overview" aria-selected="true">
                        Business Establishment Report For <?php echo $_GET['year'] . "-" . $_GET['month'] ?>
                      </a>
                    </li>
                  </ul>
                </div>
              </div>
              <div class="row mb-3" id="newstabshow">
                <?php if (isset($_GET['year']) and isset($_GET['month'])) {
                  $searchyear = $_GET['year'];
                  $searchmonth = $_GET['month'];
                  $lday = date('Y-m-t',strtotime($searchyear.'-'.$searchmonth));
                  $l = date('Y-m-01', strtotime($lday. " - 1 month"));
                  $l1 = date('Y-m-t', strtotime($lday. " - 1 month"));
                ?>
                  <h3 class="text-center">Number of Applications Received for BUSINESS ESTABLISHMENTS</h3>
                  <div class="col-lg-6 mt-3">
                    <div class="card">
                      <div class="card-body">
                        <?php $counttypenew = mysqli_fetch_assoc($link->query("SELECT COUNT(form2_id) FROM bfp_form2 
                        WHERE form2_date_added BETWEEN '$searchyear-$searchmonth-01' AND '$lday' AND uid='$uid' AND type = 'New' AND form2_status = '1'"))?>
                        <?php $counttyperenew = mysqli_fetch_assoc($link->query("SELECT COUNT(form2_id) FROM bfp_form2 
                        WHERE form2_date_added BETWEEN '$searchyear-$searchmonth-01' AND '$lday' AND uid='$uid' AND type = 'Renew' AND form2_status = '1'"))?>
                        <?php $counttypenew_l = mysqli_fetch_assoc($link->query("SELECT COUNT(form2_id) FROM bfp_form2 
                        WHERE form2_date_added BETWEEN '$l' AND '$l1' AND uid='$uid' AND type = 'New' AND form2_status = '1'"))?>
                        <?php $counttyperenew_l = mysqli_fetch_assoc($link->query("SELECT COUNT(form2_id) FROM bfp_form2 
                        WHERE form2_date_added BETWEEN '$l' AND '$l1' AND uid='$uid' AND type = 'Renew' AND form2_status = '1'"))?>
                        <canvas id="new_renewCMchart" style="width:100%;"></canvas>
                        <script>
                          var xValues = ["New","Renew"];
                          var yValues = [<?php echo $counttypenew['COUNT(form2_id)']?>,<?php echo $counttyperenew['COUNT(form2_id)']?>];
                          var barColors = [
                            "#b91d47",
                            "#0023AD",
                          ];
                          new Chart("new_renewCMchart", {
                            type: "pie",
                            data: {
                              labels: xValues,
                              datasets: [{
                                backgroundColor: barColors,
                                data: yValues
                              }]
                            },
                            options: {
                              title: {
                                display: true,
                                fontSize: 18,
                                text: "Current Month"
                              }
                            }
                          });
                        </script>
                        Total : <b><?php echo $counttypenew['COUNT(form2_id)']+$counttyperenew['COUNT(form2_id)']?></b>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-6 mt-3">
                    <div class="card">
                      <div class="card-body">
                        <canvas id="new_renewPMchart" style="width:100%;"></canvas>
                        <script>
                          var yValues = [<?php echo $counttypenew_l['COUNT(form2_id)']?>,<?php echo $counttyperenew_l['COUNT(form2_id)']?>];
                          var barColors = [
                            "#b91d47",
                            "#0023AD",
                          ];
                          new Chart("new_renewPMchart", {
                            type: "pie",
                            data: {
                              labels: xValues,
                              datasets: [{
                                backgroundColor: barColors,
                                data: yValues
                              }]
                            },
                            options: {
                              title: {
                                display: true,
                                fontSize: 18,
                                text: "Previous Month"
                              }
                            }
                          });
                        </script>
                        Total : <b><?php echo $counttypenew_l['COUNT(form2_id)']+$counttyperenew_l['COUNT(form2_id)']?></b>
                      </div>
                    </div>
                  </div>
                  <?php
                  $structure_total = 0;
                  $structure_total_last_month = 0;
                  ?>
                  <?php $read_structure_query = $link->query("SELECT * FROM structure")?>
                  <?php $read_structure_query2 = $link->query("SELECT * FROM structure")?>
                  <?php $read_structure_query3 = $link->query("SELECT * FROM structure")?>
                  <?php
                  $nonStructure = mysqli_fetch_assoc($link->query("SELECT COUNT(form2_id) FROM bfp_form2 
                  WHERE form2_date_added BETWEEN '$searchyear-$searchmonth-01' AND '$lday'
                  AND structure = '0' AND uid = '$uid' AND form2_status = '1'"));
                  $nonStructure2 = mysqli_fetch_assoc($link->query("SELECT COUNT(form2_id) FROM bfp_form2 
                  WHERE form2_date_added BETWEEN '$l' AND '$l1'
                  AND structure = '0' AND uid = '$uid' AND form2_status = '1'"));
                  ?>
                  <div class="col-lg-12 mt-3 grid-margin grid-margin-md-0 stretch-card">
                    <div class="card">
                      <div class="card-body">
                        <canvas id="form2_structure" style="width:100%;max-width:1300px"></canvas>
                        <script>
                          var xValues = [<?php while($sh_structure = $read_structure_query->fetch_assoc()){
                            echo "'" . $sh_structure['lbl'] . "',";
                          }
                          echo "'Non-Structure'";
                          ?>];
                          var yValues = [<?php while($sh_structure2 = $read_structure_query2->fetch_assoc()){
                            $count_read_structure_query = mysqli_fetch_assoc($link->query("SELECT COUNT(form2_id) FROM bfp_form2 
                            WHERE form2_date_added BETWEEN '$searchyear-$searchmonth-01' AND '$lday' 
                            AND structure = '".$sh_structure2['structure_id']."' AND uid = '$uid' AND form2_status = '1'"));
                            echo $count_read_structure_query['COUNT(form2_id)'] . ",";
                            $structure_total += $count_read_structure_query['COUNT(form2_id)'];
                          }?><?php echo $nonStructure["COUNT(form2_id)"];?>];
                          var zValues = [<?php while($sh_structure2 = $read_structure_query3->fetch_assoc()){
                            $count_read_structure_query = mysqli_fetch_assoc($link->query("SELECT COUNT(form2_id) FROM bfp_form2 
                            WHERE form2_date_added BETWEEN '$l' AND '$l1' AND structure = '".$sh_structure2['structure_id']."' 
                            AND uid = '$uid' AND form2_status = '1'"));
                            echo $count_read_structure_query['COUNT(form2_id)'] . ",";
                            $structure_total_last_month += $count_read_structure_query['COUNT(form2_id)'];
                          }?>
                          <?php echo $nonStructure2["COUNT(form2_id)"];?>];
                          new Chart("form2_structure", {
                            type: "bar",
                            data: {
                              labels: xValues,
                              datasets: [{
                                label: "Current Month",
                                backgroundColor: "#b91d47",
                                data: yValues
                              },{
                                label: "Previous Month",
                                backgroundColor: "#0023AD",
                                data: zValues
                              }]
                            },
                            options: {
                              legend: {display: true},
                              title: {
                                display: true,
                                fontSize: 20,
                                text: "1st Inspection"
                              },scales: {
                                yAxes: [{ticks: {min: 0}}]
                              }
                            }
                          });
                        </script>
                        Current Month Total : <b><?php echo $C_f2stracture = $structure_total + $nonStructure["COUNT(form2_id)"]?></b>  <br>
                        Previous Month Total : <b><?php echo $P_f2stracture = $structure_total_last_month + $nonStructure2["COUNT(form2_id)"]?></b> 
                      </div>
                    </div>
                  </div>
                  <?php $newfsic1 = mysqli_fetch_assoc($link->query("SELECT COUNT(form2_id) FROM bfp_form2 
                  WHERE form2_date_added BETWEEN '$searchyear-$searchmonth-01' AND '$lday' AND fsic = 'New' 
                  AND with_or_not = 'FSIC Issued WITHIN Prescribed Period' AND uid = '$uid' AND form2_status = '1'"))?>
                  <?php $newfsic2 = mysqli_fetch_assoc($link->query("SELECT COUNT(form2_id) FROM bfp_form2 
                  WHERE form2_date_added BETWEEN '$searchyear-$searchmonth-01' AND '$lday' AND fsic = 'New' 
                  AND with_or_not = 'FSIC Issued NOT WITHIN Prescribed Period' AND uid = '$uid' AND form2_status = '1'"))?>
                  <?php $renewfsic1 = mysqli_fetch_assoc($link->query("SELECT COUNT(form2_id) FROM bfp_form2 
                  WHERE form2_date_added BETWEEN '$searchyear-$searchmonth-01' AND '$lday' AND fsic = 'Renew' 
                  AND with_or_not = 'FSIC Issued WITHIN Prescribed Period' AND uid = '$uid' AND form2_status = '1'"))?>
                  <?php $renewfsic2 = mysqli_fetch_assoc($link->query("SELECT COUNT(form2_id) FROM bfp_form2 
                  WHERE form2_date_added BETWEEN '$searchyear-$searchmonth-01' AND '$lday' AND fsic = 'Renew' 
                  AND with_or_not = 'FSIC Issued NOT WITHIN Prescribed Period' AND uid = '$uid' AND form2_status = '1'"))?>
                  
                  <?php $newfsic1_l = mysqli_fetch_assoc($link->query("SELECT COUNT(form2_id) FROM bfp_form2 
                  WHERE form2_date_added BETWEEN '$l' AND '$l1' AND fsic = 'New' 
                  AND with_or_not = 'FSIC Issued WITHIN Prescribed Period' AND uid = '$uid' AND form2_status = '1'"))?>
                  <?php $newfsic2_l = mysqli_fetch_assoc($link->query("SELECT COUNT(form2_id) FROM bfp_form2 
                  WHERE form2_date_added BETWEEN '$l' AND '$l1' AND '$lday' AND fsic = 'New' 
                  AND with_or_not = 'FSIC Issued NOT WITHIN Prescribed Period' AND uid = '$uid' AND form2_status = '1'"))?>
                  <?php $renewfsic1_l = mysqli_fetch_assoc($link->query("SELECT COUNT(form2_id) FROM bfp_form2 
                  WHERE form2_date_added BETWEEN '$l' AND '$l1' AND '$lday' AND fsic = 'Renew' 
                  AND with_or_not = 'FSIC Issued WITHIN Prescribed Period' AND uid = '$uid' AND form2_status = '1'"))?>
                  <?php $renewfsic2_l = mysqli_fetch_assoc($link->query("SELECT COUNT(form2_id) FROM bfp_form2 
                  WHERE form2_date_added BETWEEN '$l' AND '$l1' AND '$lday' AND fsic = 'Renew' 
                  AND with_or_not = 'FSIC Issued NOT WITHIN Prescribed Period' AND uid = '$uid' AND form2_status = '1'"))?>
                  <h3 class="d-flex justify-content-between mt-3 mb-3">
                    <div>
                    Current Month Total FSIC Issued : <b><?php echo $fsictotal = $newfsic1['COUNT(form2_id)'] + $newfsic2['COUNT(form2_id)'] + $renewfsic1['COUNT(form2_id)'] + $renewfsic2['COUNT(form2_id)']?></b>
                    </div>
                    <div>
                    Previous Month Total FSIC Issued : <b><?php echo $fsictotal_l = $newfsic1_l['COUNT(form2_id)'] + $newfsic2_l['COUNT(form2_id)'] + $renewfsic1_l['COUNT(form2_id)'] + $renewfsic2_l['COUNT(form2_id)']?></b>
                    </div>
                  </h3>
                  <div class="col-lg-6 mt-3">
                    <div class="card">
                      <div class="card-body">
                        <canvas id="newfsic" style="width: 100%;"></canvas>
                        <script>
                          var xValues = ["FSIC Issued WITHIN Prescribed Period","FSIC Issued NOT WITHIN Prescribed Period"];
                          var yValues = [<?php echo $newfsic1['COUNT(form2_id)']?>,<?php echo $newfsic2['COUNT(form2_id)']?>];
                          var barColors = [
                            "#b91d47",
                            "#0023AD",
                          ];
                          new Chart("newfsic", {
                            type: "pie",
                            data: {
                              labels: xValues,
                              datasets: [{
                                backgroundColor: barColors,
                                data: yValues
                              }]
                            },
                            options: {
                              title: {
                                display: true,
                                fontSize: 20,
                                text: "New"
                              }
                            }
                          });
                        </script>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-6 mt-3">
                    <div class="card">
                      <div class="card-body">
                        <canvas id="renewfsic" style="width: 100%;"></canvas>
                        <script>
                          var yValues = [<?php echo $renewfsic1['COUNT(form2_id)']?>,<?php echo $renewfsic2['COUNT(form2_id)']?>];
                          var barColors = [
                            "#b91d47",
                            "#0023AD",
                          ];
                          new Chart("renewfsic", {
                            type: "pie",
                            data: {
                              labels: xValues,
                              datasets: [{
                                backgroundColor: barColors,
                                data: yValues
                              }]
                            },
                            options: {
                              title: {
                                display: true,
                                fontSize: 20,
                                text: "Renew"
                              }
                            }
                          });
                        </script>
                      </div>
                    </div>
                  </div>
                  <h3 class="text-center mt-3 mb-3">Re-Inspection</h3>
                  <div class="col-lg-4 mt-3">
                    <div class="card">
                      <div class="card-body">
                        <?php
                        $reinspect1 = mysqli_fetch_assoc($link->query("SELECT COUNT(form2_id) FROM bfp_form2
                        WHERE form2_date_added BETWEEN '$searchyear-$searchmonth-01' AND '$lday' AND 
                        reinspection_1 = 'NOTICE TO COMPLY' AND reinspection_3='Issued NTC' AND uid = '$uid' AND form2_status = '1'"));
                        $reinspect2 = mysqli_fetch_assoc($link->query("SELECT COUNT(form2_id) FROM bfp_form2
                        WHERE form2_date_added BETWEEN '$searchyear-$searchmonth-01' AND '$lday' AND 
                        reinspection_1 = 'NOTICE TO COMPLY' AND reinspection_3='Issued FSIC for Business Operation' AND uid = '$uid' AND form2_status = '1'"));
                        ?>
                        <canvas id="reinspectiongraph" style="width:100%;max-width: fit-content"></canvas>
                        <script>
                        var xValues = ["Issued NTC", "Issued FSIC for Business Operation"];
                        var yValues = [<?php echo $reinspect1['COUNT(form2_id)'];?>,<?php echo $reinspect2['COUNT(form2_id)']?>];
                        var barColors = ['#b91d47','#0023AD','yellow'];
                        new Chart("reinspectiongraph", {
                          type: "pie",
                          data: {
                            labels: xValues,
                            datasets: [{
                              backgroundColor: barColors,
                              data: yValues
                            }]
                          },
                          options: {
                            title: {
                              display: true,
                              fontSize: 20,
                              text: "NOTICE TO COMPLY"
                            }
                          }
                        });
                        </script>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-4 mt-3">
                    <div class="card">
                      <div class="card-body">
                        <?php
                        $reinspect3 = mysqli_fetch_assoc($link->query("SELECT COUNT(form2_id) FROM bfp_form2
                        WHERE form2_date_added BETWEEN '$searchyear-$searchmonth-01' AND '$lday' AND 
                        reinspection_1 = 'NOTICE TO CORRECT VIOLATION' AND reinspection_3='Issued NTCV' AND uid = '$uid' AND form2_status = '1'"));
                        $reinspect4 = mysqli_fetch_assoc($link->query("SELECT COUNT(form2_id) FROM bfp_form2
                        WHERE form2_date_added BETWEEN '$searchyear-$searchmonth-01' AND '$lday' AND 
                        reinspection_1 = 'NOTICE TO CORRECT VIOLATION' AND reinspection_3='Issued FSIC for Business Operation' AND uid = '$uid' AND form2_status = '1'"));
                        ?>
                        <canvas id="reinspectiongraph2" style="width:100%;max-width: fit-content"></canvas>
                        <script>
                        var xValues = ["Issued NTCV", "Issued FSIC for Business Operation"];
                        var yValues = [<?php echo $reinspect3['COUNT(form2_id)'];?>,<?php echo $reinspect4['COUNT(form2_id)']?>];
                        var barColors = ['#b91d47','#0023AD','yellow'];
                        new Chart("reinspectiongraph2", {
                          type: "pie",
                          data: {
                            labels: xValues,
                            datasets: [{
                              backgroundColor: barColors,
                              data: yValues
                            }]
                          },
                          options: {
                            title: {
                              display: true,
                              fontSize: 20,
                              text: "NOTICE TO CORRECT VIOLATION"
                            }
                          }
                        });
                        </script>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-4 mt-3">
                    <div class="card">
                      <div class="card-body">
                        <?php
                        $reinspect5 = mysqli_fetch_assoc($link->query("SELECT COUNT(form2_id) FROM bfp_form2
                        WHERE form2_date_added BETWEEN '$searchyear-$searchmonth-01' AND '$lday' AND 
                        reinspection_1 = 'ABATEMENT' AND reinspection_3='Issued Abatement Order' AND uid = '$uid' AND form2_status = '1'"));
                        $reinspect6 = mysqli_fetch_assoc($link->query("SELECT COUNT(form2_id) FROM bfp_form2
                        WHERE form2_date_added BETWEEN '$searchyear-$searchmonth-01' AND '$lday' AND 
                        reinspection_1 = 'ABATEMENT' AND reinspection_3='Total Issued FSIC for Business/ Operation' AND uid = '$uid' AND form2_status = '1'"));
                        ?>
                        <canvas id="reinspectiongraph3" style="width:100%;max-width: fit-content"></canvas>
                        <script>
                        var xValues = ["Issued Abatement Order", "Total Issued FSIC for Business/ Operation"];
                        var yValues = [<?php echo $reinspect5['COUNT(form2_id)'];?>,<?php echo $reinspect6['COUNT(form2_id)']?>];
                        var barColors = ['#b91d47','#0023AD','yellow'];
                        new Chart("reinspectiongraph3", {
                          type: "pie",
                          data: {
                            labels: xValues,
                            datasets: [{
                              backgroundColor: barColors,
                              data: yValues
                            }]
                          },
                          options: {
                            title: {
                              display: true,
                              fontSize: 20,
                              text: "ABATEMENT"
                            }
                          }
                        });
                        </script>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-6 mt-3">
                    <div class="card">
                      <div class="card-body">
                        <?php
                        $reinspect_1l = mysqli_fetch_assoc($link->query("SELECT COUNT(form2_id) FROM bfp_form2
                        WHERE form2_date_added BETWEEN '$l' AND '$l1' AND 
                        reinspection_1 = 'NOTICE TO COMPLY' AND reinspection_3='Issued FSIC for Business Operation' AND uid = '$uid' AND form2_status = '1'"));
                        $reinspect_2l = mysqli_fetch_assoc($link->query("SELECT COUNT(form2_id) FROM bfp_form2
                        WHERE form2_date_added BETWEEN '$l' AND '$l1' AND 
                        reinspection_1 = 'NOTICE TO CORRECT VIOLATION' AND reinspection_3='Issued FSIC for Business Operation' AND uid = '$uid' AND form2_status = '1'"));
                        $reinspect_3l = mysqli_fetch_assoc($link->query("SELECT COUNT(form2_id) FROM bfp_form2
                        WHERE form2_date_added BETWEEN '$l' AND '$l1' AND 
                        reinspection_1 = 'ABATEMENT' AND reinspection_3='Total Issued FSIC for Business/ Operation' AND uid = '$uid' AND form2_status = '1'"));


                        $reinspect_4l = mysqli_fetch_assoc($link->query("SELECT COUNT(form2_id) FROM bfp_form2
                        WHERE form2_date_added BETWEEN '$l' AND '$l1' AND 
                        reinspection_1 = 'NOTICE TO CORRECT VIOLATION' AND reinspection_3='Issued NTCV' AND uid = '$uid' AND form2_status = '1'"));
                        $reinspect_5l = mysqli_fetch_assoc($link->query("SELECT COUNT(form2_id) FROM bfp_form2
                        WHERE form2_date_added BETWEEN '$l' AND '$l1' AND 
                        reinspection_1 = 'ABATEMENT' AND reinspection_3='Issued Abatement Order' AND uid = '$uid' AND form2_status = '1'"));
                        ?>
                        <canvas id="reinspecttotal" style="width:100%;max-width: fit-content"></canvas>
                        <script>
                        var xValues = ["Current Month", "Previous Month"];
                        var yValues = [<?php 
                        echo $a = $reinspect2['COUNT(form2_id)']+$reinspect4['COUNT(form2_id)']+$reinspect6['COUNT(form2_id)'];?>,
                        <?php echo $a2 = $reinspect_1l['COUNT(form2_id)']+$reinspect_2l['COUNT(form2_id)']+$reinspect_3l['COUNT(form2_id)']?>];
                        var barColors = ['#b91d47','#0023AD'];
                        new Chart("reinspecttotal", {
                          type: "bar",
                          data: {
                            labels: xValues,
                            datasets: [{
                              backgroundColor: barColors,
                              data: yValues
                            }]
                          },
                          options: {
                            legend: {display: false},
                            title: {
                              display: true,
                              fontSize: 20,
                              text: "Total Number of Compliant from Re-Inspection"
                            },scales: {
                              yAxes: [{ticks: {min: 0}}]
                            }
                          }
                        });
                        </script>
                        Difference : <b><?php echo $a-$a2?></b>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-6 mt-3">
                    <div class="card">
                      <div class="card-body">
                        <?php
                        $form2_closure = mysqli_fetch_assoc($link->query("SELECT COUNT(form2_id) FROM bfp_form2
                        WHERE form2_date_added BETWEEN '$searchyear-$searchmonth-01' AND '$lday' AND 
                        closure = 'Closure Order for Failure to Comply the Abatement order' AND uid = '$uid' AND form2_status = '1'"));
                        $form2_closure2 = mysqli_fetch_assoc($link->query("SELECT COUNT(form2_id) FROM bfp_form2
                        WHERE form2_date_added BETWEEN '$searchyear-$searchmonth-01' AND '$lday' AND 
                        closure = 'Closure For Failure To Pay Fine' AND uid = '$uid' AND form2_status = '1'"));

                        $l_form2_closure = mysqli_fetch_assoc($link->query("SELECT COUNT(form2_id) FROM bfp_form2
                        WHERE form2_date_added BETWEEN '$l' AND '$l1' AND 
                        closure = 'Closure Order for Failure to Comply the Abatement order' AND uid = '$uid' AND form2_status = '1'"));
                        $l_form2_closure2 = mysqli_fetch_assoc($link->query("SELECT COUNT(form2_id) FROM bfp_form2
                        WHERE form2_date_added BETWEEN '$l' AND '$l1' AND 
                        closure = 'Closure For Failure To Pay Fine' AND uid = '$uid' AND form2_status = '1'"));
                        ?>
                        <canvas id="form2closuregraph" style="width:100%;max-width: fit-content"></canvas>
                        <script>
                        var xValues = ["Failure to Comply the Abatement order", "Failure To Pay Fine"];
                        var yValues = [<?php echo $form2_closure['COUNT(form2_id)'];?>,<?php echo $form2_closure2['COUNT(form2_id)']?>];
                        var barColors = ['#b91d47','#0023AD'];
                        new Chart("form2closuregraph", {
                          type: "bar",
                          data: {
                            labels: xValues,
                            datasets: [{
                              backgroundColor: barColors,
                              data: yValues
                            }]
                          },
                          options: {
                            legend: {display: false},
                            title: {
                              display: true,
                              fontSize: 20,
                              text: "Closure Order"
                            },scales: {
                              yAxes: [{ticks: {min: 0}}]
                            }
                          }
                        });
                        </script>
                        Total Issued Closure Order : <b><?php echo $totalClosure = $form2_closure['COUNT(form2_id)']+$form2_closure2['COUNT(form2_id)']?></b>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-4 mt-3">
                    <div class="card">
                      <div class="card-body">
                        <?php $f2overall = $C_f2stracture+$reinspect2['COUNT(form2_id)']+$reinspect3['COUNT(form2_id)']
                        +$reinspect4['COUNT(form2_id)']+$reinspect5['COUNT(form2_id)']+$reinspect6['COUNT(form2_id)']+$totalClosure?>
                         <?php $P_f2overall = $P_f2stracture+$a2+$l_form2_closure['COUNT(form2_id)']+$l_form2_closure2['COUNT(form2_id)']+$reinspect_4l['COUNT(form2_id)']+$reinspect_5l['COUNT(form2_id)']?>
                        <canvas id="f2overall"></canvas>
                        <script>
                          var xValues = ["Current Month","Previous Month"];
                          var yValues = [<?php echo $f2overall?>,<?php echo $P_f2overall?>];
                          new Chart("f2overall", {
                          type: "pie",
                          data: {
                            labels: xValues,
                            datasets: [{
                              backgroundColor: barColors,
                              data: yValues
                            }]
                          },
                          options: {
                            title: {
                              display: true,
                              fontSize: 18,
                              text: "OVERALL NO. OF BUSINESS ESTABLISHMENTS INSPECTED"
                            }
                          }
                        });
                        </script>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-4 mt-3">
                    <div class="card">
                      <div class="card-body">
                        <?php $f2overallcompliant = $fsictotal+$a?>
                         <?php $P_f2overallcompliant = $fsictotal_l+$a2?>
                        <canvas id="f2overallcompliant"></canvas>
                        <script>
                          var xValues = ["Current Month","Previous Month"];
                          var yValues = [<?php echo $f2overallcompliant?>,<?php echo $P_f2overallcompliant?>];
                          new Chart("f2overallcompliant", {
                          type: "pie",
                          data: {
                            labels: xValues,
                            datasets: [{
                              backgroundColor: barColors,
                              data: yValues
                            }]
                          },
                          options: {
                            title: {
                              display: true,
                              fontSize: 18,
                              text: "OVERALL NO. OF COMPLIANT"
                            }
                          }
                        });
                        </script>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-4 mt-3">
                    <div class="card">
                      <div class="card-body">
                        <?php $f2overallreinspect = $totalClosure+$reinspect3['COUNT(form2_id)']+$reinspect5['COUNT(form2_id)']?>
                         <?php $P_f2overallreinspect = $l_form2_closure['COUNT(form2_id)']+$l_form2_closure2['COUNT(form2_id)']+$reinspect_4l['COUNT(form2_id)']+$reinspect_5l['COUNT(form2_id)']?>
                        <canvas id="f2overallreinspect"></canvas>
                        <script>
                          var xValues = ["Current Month","Previous Month"];
                          var yValues = [<?php echo $f2overallreinspect?>,<?php echo $P_f2overallreinspect?>];
                          new Chart("f2overallreinspect", {
                          type: "pie",
                          data: {
                            labels: xValues,
                            datasets: [{
                              backgroundColor: barColors,
                              data: yValues
                            }]
                          },
                          options: {
                            title: {
                              display: true,
                              fontSize: 18,
                              text: "TOTAL NO. OF NON-COMPLIANT AFTER RE-INSPECTIONS"
                            }
                          }
                        });
                        </script>
                      </div>
                    </div>
                  </div>
                <?php } ?>
              </div>
            </div>
          </div>
        </div>
        <!-- partial:partials/_footer.html -->
        <?php include_once "footer.php" ?>
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->

  <!-- plugins:js -->
  <script src="../template/vendors/js/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <script src="../template/vendors/chart.js/Chart.min.js"></script>
  <script src="../template/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
  <script src="../template/vendors/progressbar.js/progressbar.min.js"></script>

  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="../template/js/off-canvas.js"></script>
  <script src="../template/js/hoverable-collapse.js"></script>
  <script src="../template/js/template.js"></script>
  <script src="../template/js/settings.js"></script>
  <script src="../template/js/todolist.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="../template/js/jquery.cookie.js" type="text/javascript"></script>
  <script src="../template/js/dashboard.js"></script>

  <!-- End custom js for this page-->
</body>

</html>