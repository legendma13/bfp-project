<!DOCTYPE html>
<?php include_once "check.php" ?>
<html lang="en">
<?php include_once "head.php" ?>
<script>
  $(document).ready(function() {
    $("#shownewestab").click(function() {
      $("#Newestab").show();
      $("#Newgov").hide();
    });
    $("#shownewgov").click(function() {
      $("#Newestab").hide();
      $("#Newgov").show();
    });
  });
</script>
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
                      <a class="nav-link active ps-0" id="home-tab" data-bs-toggle="tab" href="#Overview" role="tab" aria-controls="Overview" aria-selected="true">New Building</a>
                    </li>
                  </ul>
                </div>
              </div>
              <div class="mt-3 mb-3" id="newstabshow">
                <?php if (isset($_GET['year']) and isset($_GET['month'])) {
                  $searchyear = $_GET['year'];
                  $searchmonth = $_GET['month'];
                  $lday = date('Y-m-t',strtotime($searchyear.'-'.$searchmonth));
                  $l = date('Y-m-01', strtotime($lday. " - 1 month"));
                  $l1 = date('Y-m-t', strtotime($lday. " - 1 month"));
                ?>
                <div class="row">
                  <div class="col-lg-6">
                    <?php
                      $counttotaleb = mysqli_fetch_array($link->query("SELECT COUNT(form1_id) FROM bfp_form1 
                      WHERE form1_date_added BETWEEN '$searchyear-$searchmonth-01' AND '$lday' AND uid='$uid'
                      AND type='New Establishments Buildings'"));
                      $counttotalpeb = mysqli_fetch_array($link->query("SELECT COUNT(form1_id) FROM bfp_form1 
                      WHERE form1_date_added BETWEEN '$l' AND '$l1' AND uid='$uid'
                      AND type='New Establishments Buildings'"));

                      $counttotalgb = mysqli_fetch_array($link->query("SELECT COUNT(form1_id) FROM bfp_form1 
                      WHERE form1_date_added BETWEEN '$searchyear-$searchmonth-01' AND '$lday' AND uid='$uid'
                      AND type='New Government Buildings'"));
                      $counttotalpgb = mysqli_fetch_array($link->query("SELECT COUNT(form1_id) FROM bfp_form1 
                      WHERE form1_date_added BETWEEN '$l' AND '$l1' AND uid='$uid'
                      AND type='New Government Buildings'"));
                    ?>
                    <div class="card">
                      <div class="card-body">
                        <canvas id="total" style="width:100%;max-width:1000px"></canvas>
                      </div>
                    </div>
                    <script>
                    var xValues = ["Current Month", "Previous Month"];
                    var yValues = [<?php echo $counttotaleb['COUNT(form1_id)']?>, <?php echo $counttotalpeb['COUNT(form1_id)']?>];
                    var zValues = [<?php echo $counttotalgb['COUNT(form1_id)']?>, <?php echo $counttotalpgb['COUNT(form1_id)']?>];
                    new Chart("total", {
                      type: "bar",
                      data: {
                        labels: xValues,
                        datasets: [{
                          label: "New Establishments/Buildings",
                          backgroundColor: "#b91d47",
                          data: yValues
                        },{
                          label: "New Government Buildings",
                          backgroundColor: "#0023AD",
                          data: zValues
                        }]
                      },
                      options: {
                        legend: {display: true},
                        title: {
                          display: true,
                          fontSize:18,
                          text: "Total Number Application Received within the Month"
                        }, scales: {
                          yAxes: [{ticks: {min: 0}}]
                        }
                      }
                    });
                    </script>
                  </div>
                  <?php $countfsecebissue = mysqli_fetch_assoc($link->query("SELECT COUNT(form1_id) FROM bfp_form1 
                  WHERE form1_date_added BETWEEN '$searchyear-$searchmonth-01' AND '$lday' AND uid='$uid'
                  AND fsec = 'Issued FSEC'"))?>
                  <?php $countfsecpgbissue = mysqli_fetch_assoc($link->query("SELECT COUNT(form1_id) FROM bfp_form1 
                  WHERE form1_date_added BETWEEN '$l' AND '$l1' AND uid='$uid'
                  AND fsec = 'Issued FSEC'"))?>
                  <?php $countfsecebnod = mysqli_fetch_assoc($link->query("SELECT COUNT(form1_id) FROM bfp_form1 
                  WHERE form1_date_added BETWEEN '$searchyear-$searchmonth-01' AND '$lday' AND uid='$uid'
                  AND fsec = 'Issued Notice of Disapproval (NOD)'"))?>
                  <?php $countfsecpgbnod = mysqli_fetch_assoc($link->query("SELECT COUNT(form1_id) FROM bfp_form1 
                  WHERE form1_date_added BETWEEN '$l' AND '$l1' AND uid='$uid'
                  AND fsec = 'Issued Notice of Disapproval (NOD)'"))?>
                  <?php 
                    //Calculate 
                    $totalCissue = $countfsecebissue['COUNT(form1_id)'] + $countfsecpgbissue['COUNT(form1_id)']; //issue fsic
                    $totalCnod = $countfsecebnod['COUNT(form1_id)'] + $countfsecpgbnod['COUNT(form1_id)'];//Nod
                    $overalltotalfsic = $totalCissue + $totalCnod;  // Overall Total
                  ?>
                  <div class="col-lg-6">
                    <div class="card">
                      <div class="card-body">
                        <canvas id="issued" style="width:100%;max-width:1000px"></canvas>
                        <script>
                          var xValues = ["Issued FSEC", ['Issued Notice of', 'Disapproval (NOD)']];
                          var yValues = [<?php echo $totalCissue?>, <?php echo $totalCnod?>];
                          new Chart("issued", {
                            type: "bar",
                            data: {
                              labels: xValues,
                              datasets: [{
                                backgroundColor: "#b91d47",
                                data: yValues
                              }]
                            },
                            options: {
                              legend: {display: false},
                              title: {
                                display: true,
                                fontSize:18,
                                text: "FSEC"
                              }, scales: {
                                yAxes: [{ticks: {min: 0}}]
                              }
                            }
                          });
                        </script>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="col-lg-12 mt-3">
                  <div class="card">
                    <div class="card-body">
                      <?php $read_structure_query = $link->query("SELECT * FROM structure") ?>
                      <?php $nc = $link->query("SELECT * FROM structure") ?>
                      <?php $rn = $link->query("SELECT * FROM structure") ?>
                      <?php $nc_l = $link->query("SELECT * FROM structure") ?>
                      <?php $rn_l = $link->query("SELECT * FROM structure") ?>

                      <canvas id="f1structure" style="width: 100%;max-width:fit-content"></canvas>
                      <script>
                        var xstrarray = [<?php
                          while ($sh_structure = $read_structure_query->fetch_assoc()) {
                            echo "'" . $sh_structure['lbl']."',";
                          }
                        ?>];
                        <?php $cmnc = 0?>
                        var ystrarray = [<?php
                          while ($sh_structure = $nc->fetch_assoc()) {
                          $countnc = mysqli_fetch_assoc($link->query("SELECT COUNT(form1_id) FROM bfp_form1 
                          WHERE form1_date_added BETWEEN '$searchyear-$searchmonth-01' AND '$lday' 
                          AND structure = '".$sh_structure['structure_id']."' AND nc_or_rn='NC' AND uid = '$uid'"));
                          echo $countnc['COUNT(form1_id)'].",";
                          $cmnc += $countnc['COUNT(form1_id)'];
                          }
                        ?>];
                        <?php $cmrn = 0?>
                        var zstrarray = [<?php
                          while ($sh_structure = $rn->fetch_assoc()) {
                          $countrn = mysqli_fetch_assoc($link->query("SELECT COUNT(form1_id) FROM bfp_form1 
                          WHERE form1_date_added BETWEEN '$searchyear-$searchmonth-01' AND '$lday' 
                          AND structure = '".$sh_structure['structure_id']."' AND nc_or_rn='RN' AND uid = '$uid'"));
                          echo $countrn['COUNT(form1_id)'].",";
                          $cmrn += $countrn['COUNT(form1_id)'];
                          }
                        ?>];
                        <?php $pmnc = 0?>
                        var Pstrarray = [<?php
                          while ($sh_structure = $nc_l->fetch_assoc()) {
                          $countnc_l = mysqli_fetch_assoc($link->query("SELECT COUNT(form1_id) FROM bfp_form1 
                          WHERE form1_date_added BETWEEN '$l' AND '$l1' 
                          AND structure = '".$sh_structure['structure_id']."' AND nc_or_rn='NC' AND uid = '$uid'"));
                          echo $countnc_l['COUNT(form1_id)'].",";
                          $pmnc += $countnc_l['COUNT(form1_id)'];
                          }
                        ?>];
                        <?php $pmrn = 0?>
                        var Mstrarray = [<?php
                          while ($sh_structure = $rn_l->fetch_assoc()) {
                          $countrn_l = mysqli_fetch_assoc($link->query("SELECT COUNT(form1_id) FROM bfp_form1 
                          WHERE form1_date_added BETWEEN '$l' AND '$l1' 
                          AND structure = '".$sh_structure['structure_id']."' AND nc_or_rn='RN' AND uid = '$uid'"));
                          echo $countrn_l['COUNT(form1_id)'].",";
                          $pmrn += $countrn_l['COUNT(form1_id)'];
                          }
                        ?>];
                        new Chart("f1structure", {
                          type: "bar",
                          data: {
                            labels: xstrarray,
                            datasets: [{
                              label: "(CM) Newly Constructed",
                              backgroundColor: "#b91d47",
                              data: ystrarray
                            },{
                              label: "(CM) Renovation, Repair, Modified",
                              backgroundColor: "#0023AD",
                              data: zstrarray
                            },{
                              label: "(PM) Newly Constructed",
                              backgroundColor: "red",
                              data: Pstrarray
                            },{
                              label: "(PM) Renovation, Repair, Modified",
                              backgroundColor: "blue",
                              data: Mstrarray
                            }]
                          },
                          options: {
                            legend: {display: true},
                            responsive: true,
                            title: {
                              display: true,
                              fontSize:18,
                              text: "1st INSPECTION FOR FSIC (OCCUPANCY PERMIT) "
                            }, scales: {
                              yAxes: [{ticks: {min: 0}}]
                            }
                          }
                        });
                      </script>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-8 mt-3">
                    <div class="card">
                      <div class="card-body">
                        <?php
                        $underNC = mysqli_fetch_assoc($link->query("SELECT COUNT(form1_id) FROM bfp_form1 
                        WHERE form1_date_added BETWEEN '$searchyear-$searchmonth-01' AND '$lday'
                        AND inspection = 'NC' AND uid='$uid'"));
                        $underRN = mysqli_fetch_assoc($link->query("SELECT COUNT(form1_id) FROM bfp_form1 
                        WHERE form1_date_added BETWEEN '$searchyear-$searchmonth-01' AND '$lday'
                        AND inspection = 'RN' AND uid='$uid'"));
                        $underNC_l = mysqli_fetch_assoc($link->query("SELECT COUNT(form1_id) FROM bfp_form1 
                        WHERE form1_date_added BETWEEN '$l' AND '$l1'
                        AND inspection = 'NC' AND uid='$uid'"));
                        $underRN_l = mysqli_fetch_assoc($link->query("SELECT COUNT(form1_id) FROM bfp_form1 
                        WHERE form1_date_added BETWEEN '$l' AND '$l1'
                        AND inspection = 'RN' AND uid='$uid'"));
                        ?>
                        <canvas id="undercons" style="width: 100%;"></canvas>
                        <script>
                          var xValues = ["Current Month NC", "Current Month RN","Previous Month NC", "Previous Month RN",];
                          var yValues = [<?php echo $underNC['COUNT(form1_id)']?>, <?php echo $underRN['COUNT(form1_id)']?>,0,0];
                          var zValues = [0,0,<?php echo $underNC_l['COUNT(form1_id)']?>, <?php echo $underRN_l['COUNT(form1_id)']?>];

                          new Chart("undercons", {
                            type: "bar",
                            data: {
                              labels: xValues,
                              datasets: [{
                                label: "Current Month",
                                backgroundColor: "red",
                                data: yValues
                              },{
                                label: "Previous Month",
                                backgroundColor: "blue",
                                data: zValues
                              }]
                            },
                            options: {
                              title: {
                                display: true,
                                fontSize:18,
                                text: "Inspection during Under Construction"
                              }
                            }
                          });
                        </script>
                        <div class="d-flex justify-content-between">
                          <div>
                            CM Total : <b><?php echo $tunder = $underNC['COUNT(form1_id)']+$underRN['COUNT(form1_id)']?></b>
                          </div>
                          <div>
                            PM Total : <b><?php echo $tunder_l = $underNC_l['COUNT(form1_id)']+$underRN_l['COUNT(form1_id)']?></b>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-4 mt-3 overflow-auto">
                    <div class="row flex-row flex-nowrap">
                      <div class="col-12 col-sm-12">
                        <div class="card">
                          <div class="card-body">
                            <canvas id="nctotal" style="width: 100%;"></canvas>
                            <script>
                              var xValues = ["NC", "RN"];
                              var yValues = [<?php echo $cmnc?>, <?php echo $cmrn?>];
                              new Chart("nctotal", {
                                type: "pie",
                                data: {
                                  labels: xValues,
                                  datasets: [{
                                    backgroundColor: ["#b91d47","#0023AD"],
                                    data: yValues
                                  }]
                                },
                                options: {
                                  title: {
                                    display: true,
                                    fontSize:18,
                                    text: "Current Month 1st INSPECTION Total NC"
                                  }
                                }
                              });
                            </script>
                            Overall : <b><?php echo $t = $cmnc+$cmrn?></b>
                          </div>
                        </div>
                      </div>
                      <div class="col-12 col-sm-12">
                        <div class="card">
                          <div class="card-body">
                            <canvas id="rntotal" style="width: 100%;"></canvas>
                            <script>
                              var xValues = ["NC", "RN"];
                              var yValues = [<?php echo $pmnc?>, <?php echo $pmrn?>];
                              new Chart("rntotal", {
                                type: "pie",
                                data: {
                                  labels: xValues,
                                  datasets: [{
                                    backgroundColor: ["#b91d47","#0023AD"],
                                    data: yValues
                                  }]
                                },
                                options: {
                                  title: {
                                    display: true,
                                    fontSize:18,
                                    text: "Previous Month 1st INSPECTION Total RN"
                                  }
                                }
                              });
                            </script>
                            Overall : <b><?php echo $t = $pmnc+$pmrn?></b>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-4 mt-3">
                    <div class="card">
                      <div class="card-body">
                        <?php
                        $CMoccupancy = mysqli_fetch_assoc($link->query("SELECT COUNT(form1_id) FROM bfp_form1 
                        WHERE form1_date_added BETWEEN '$searchyear-$searchmonth-01' AND '$lday'
                        AND issuance = 'Issued FSIC for Occupancy' AND uid='$uid'"));
                        $PMoccupancy = mysqli_fetch_assoc($link->query("SELECT COUNT(form1_id) FROM bfp_form1 
                        WHERE form1_date_added BETWEEN '$l' AND '$l1'
                        AND issuance = 'Issued FSIC for Occupancy' AND uid='$uid'"));
                        ?>
                        <canvas id="issueoccupancy" style="width: 100%;"></canvas>
                        <script>
                          var xValues = ["Current Month", "Previous Month"];
                          var yValues = [<?php echo $CMoccupancy['COUNT(form1_id)']?>, <?php echo $PMoccupancy['COUNT(form1_id)']?>];

                          new Chart("issueoccupancy", {
                            type: "pie",
                            data: {
                              labels: xValues,
                              datasets: [{
                                backgroundColor: ["#b91d47","#0023AD"],
                                data: yValues
                              }]
                            },
                            options: {
                              title: {
                                display: true,
                                fontSize:18,
                                text: "Issued FSIC for Occupancy"
                              }
                            }
                          });
                        </script>
                        Total : <b><?php echo $toccupancy = $CMoccupancy['COUNT(form1_id)']+$PMoccupancy['COUNT(form1_id)']?></b>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-4 mt-3">
                    <div class="card">
                      <div class="card-body">
                        <?php
                        $CMoccupancy = mysqli_fetch_assoc($link->query("SELECT COUNT(form1_id) FROM bfp_form1 
                        WHERE form1_date_added BETWEEN '$searchyear-$searchmonth-01' AND '$lday'
                        AND issuance = 'Issued With NOD for NOT OCCUPIED buildings/establishments' AND uid='$uid'"));
                        $PMoccupancy = mysqli_fetch_assoc($link->query("SELECT COUNT(form1_id) FROM bfp_form1 
                        WHERE form1_date_added BETWEEN '$l' AND '$l1'
                        AND issuance = 'Issued With NOD for NOT OCCUPIED buildings/establishments' AND uid='$uid'"));
                        ?>
                        <canvas id="issueoccupancyWNod" style="width: 100%;"></canvas>
                        <script>
                          var xValues = ["Current Month", "Previous Month"];
                          var yValues = [<?php echo $CMoccupancy['COUNT(form1_id)']?>, <?php echo $PMoccupancy['COUNT(form1_id)']?>];

                          new Chart("issueoccupancyWNod", {
                            type: "pie",
                            data: {
                              labels: xValues,
                              datasets: [{
                                backgroundColor: ["#b91d47","#0023AD"],
                                data: yValues
                              }]
                            },
                            options: {
                              title: {
                                display: true,
                                fontSize:18,
                                text: "Issued With NOD for NOT OCCUPIED buildings/establishments"
                              }
                            }
                          });
                        </script>
                        Total : <b><?php echo $toccupancy = $CMoccupancy['COUNT(form1_id)']+$PMoccupancy['COUNT(form1_id)']?></b>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-4 mt-3">
                    <div class="card">
                      <div class="card-body">
                        <?php
                        $CMoccupancy = mysqli_fetch_assoc($link->query("SELECT COUNT(form1_id) FROM bfp_form1 
                        WHERE form1_date_added BETWEEN '$searchyear-$searchmonth-01' AND '$lday'
                        AND issuance = 'Issued With NTC for OCCUPIED buildings/establishments' AND uid='$uid'"));
                        $PMoccupancy = mysqli_fetch_assoc($link->query("SELECT COUNT(form1_id) FROM bfp_form1 
                        WHERE form1_date_added BETWEEN '$l' AND '$l1'
                        AND issuance = 'Issued With NTC for OCCUPIED buildings/establishments' AND uid='$uid'"));
                        ?>
                        <canvas id="issueoccupancyWNTC" style="width: 100%;"></canvas>
                        <script>
                          var xValues = ["Current Month", "Previous Month"];
                          var yValues = [<?php echo $CMoccupancy['COUNT(form1_id)']?>, <?php echo $PMoccupancy['COUNT(form1_id)']?>];
                          new Chart("issueoccupancyWNTC", {
                            type: "pie",
                            data: {
                              labels: xValues,
                              datasets: [{
                                backgroundColor: ["#b91d47","#0023AD"],
                                data: yValues
                              }]
                            },
                            options: {
                              title: {
                                display: true,
                                fontSize:18,
                                text: "Issued With NTC for OCCUPIED buildings/establishments"
                              }
                            }
                          });
                        </script>
                        Total : <b><?php echo $toccupancy = $CMoccupancy['COUNT(form1_id)']+$PMoccupancy['COUNT(form1_id)']?></b>
                      </div>
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