<!DOCTYPE html>
<?php include_once "check.php" ?>
<html lang="en">
<?php include_once "head.php" ?>
<script>
  $(document).ready(function() {
    $('#f1table').DataTable();
    $('#f2table').DataTable();
    $('#f3table').DataTable();
    $('#f4table').DataTable();

    $("#shownewestab").click(function() {
      $("#Newestab").show();
      $("#Newgov").hide();
    });
    $("#shownewgov").click(function() {
      $("#Newestab").hide();
      $("#Newgov").show();
    });
    $(".form1-tab").click(function() {
      $("#form1").show();
      $("#form2").hide();
      $("#form3").hide();
      $("#form4").hide();
      $("html, body").animate({ scrollTop: 0 });
      return false;
    });
    $(".form2-tab").click(function() {
      $("#form1").hide();
      $("#form2").show();
      $("#form3").hide();
      $("#form4").hide();
      $("html, body").scrollTop({ scrollTop: 0 });
      return false;
    });
    $(".form3-tab").click(function() {
      $("#form1").hide();
      $("#form2").hide();
      $("#form3").show();
      $("#form4").hide();
      $("html, body").animate({ scrollTop: 0 });
      return false;
    });
    $(".form4-tab").click(function() {
      $("#form1").hide();
      $("#form2").hide();
      $("#form3").hide();
      $("#form4").show();
      $("html, body").animate({ scrollTop: 0 });
      return false;
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
                      <a class="form1-tab nav-link active ps-0" id="form1-tab" data-bs-toggle="tab" href="#form1" role="tab" aria-controls="form1" aria-selected="true">
                        NEW BUILDINGS
                      </a>
                    </li>
                    <li class="nav-item">
                      <a class="form2-tab nav-link ps-0" id="form2-tab" data-bs-toggle="tab" href="#form2" role="tab" aria-controls="form2" aria-selected="true">
                        BUSINESS ESTABLISHMENTS REPORT
                      </a>
                    </li>
                    <li class="nav-item">
                      <a class="form3-tab nav-link ps-0" id="form3-tab" data-bs-toggle="tab" href="#form3" role="tab" aria-controls="form3" aria-selected="true">
                        GOVERNMENT BUILDINGS REPORT
                      </a>
                    </li>
                    <li class="nav-item">
                      <a class="form4-tab nav-link ps-0" id="form4-tab" data-bs-toggle="tab" href="#form4" role="tab" aria-controls="form4" aria-selected="true">
                        SUMMARY ACCOMPLISHMENT REPORT ON FIRE CODE FEES COLLECTION
                      </a>
                    </li>
                  </ul>
                </div>
              </div>
              
              <!-- Report -->
              <div class="row mt-3 mb-3">
                <div class="col-lg-12">
                  <?php $report = mysqli_fetch_assoc($link->query("SELECT * FROM report 
                  LEFT JOIN bfp_users ON report.uid = bfp_users.uid 
                  WHERE report.report_id = '".$_GET['rid']."'"))?>
                  <h3><?php echo $report['location']?> Report for <?php echo date('Y-F',strtotime($report['start_report']))?></h3>
                  <small><?php echo $report['details']?></small>
                </div>
              </div>
              <!-- Report -->
              <div class="row">
                <?php if (isset($_GET['start']) and isset($_GET['end'])) {
                  $start = $_GET['start'];
                  $end = $_GET['end'];
                  $l = date('Y-m-01', strtotime($start. " - 1 month"));
                  $l1 = date('Y-m-t', strtotime($end. " - 1 month"));
                ?>
                <div class="col-lg-12" id="form1">
                  <div class="row">
                    <div class="col-lg-12 mb-3">
                      <div class="card">
                        <div class="card-header fw-bold">
                          New Building Table
                        </div>
                        <div class="card-body table-responsive">
                          <table id="f1table" class="table table-striped">
                            <thead>
                              <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Barangay</th>
                                <th>Type</th>
                                <th>Structure</th>
                                <th>Date Created</th>
                                <th>Action</th>
                              </tr>
                            </thead>
                            <?php $monthnow = date('Y-m'); ?>
                            <?php $i = 0 ?>
                            <tbody>
                              <?php $Qform1 = mysqli_query($link, "SELECT * FROM bfp_form1 
                              LEFT JOIN structure ON bfp_form1.structure = structure.structure_id 
                              LEFT JOIN bfp_users ON bfp_users.uid = bfp_form1.uid
                              WHERE form1_date_added BETWEEN '$start' AND '$end' AND bfp_users.municipal = '".$sh_user['municipal']."' AND bfp_form1.form1_status = '1'
                              ORDER BY bfp_form1.form1_date_added DESC") ?>
                              <?php while ($shform1 = mysqli_fetch_assoc($Qform1)) { ?>
                                <?php $i++ ?>
                                <tr>
                                  <td><?php echo $i?></td>
                                  <td class="text-uppercase"><?php echo $shform1['lname'] ?>, <?php echo $shform1['fname'] ?> <?php echo $shform1['mname'] ?></td>
                                  <td><?php echo $shform1['brgy'] ?></td>
                                  <td><?php echo $shform1['type'] ?></td>
                                  <td><?php echo $shform1['lbl'] ?></td>
                                  <td><?php echo $shform1['form1_date_added'] ?></td>
                                  <td>
                                    <a href="form1-view.php?reportid=<?php echo $shform1['form1_id'] ?>">
                                      <button class="btn btn-primary btn-sm text-white p-2">View</button>
                                    </a>
                                  </td>
                                </tr>
                              <?php } ?>
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-lg-6">
                      <?php
                        $counttotaleb = mysqli_fetch_array($link->query("SELECT COUNT(form1_id) FROM bfp_form1 
                        LEFT JOIN bfp_users ON bfp_form1.uid = bfp_users.uid
                        WHERE form1_date_added BETWEEN '$start' AND '$end' AND bfp_users.municipal = '".$sh_user['municipal']."' AND bfp_users.location =  '".$report['location']."'
                        AND type='New Establishments Buildings'"));
                        $counttotalpeb = mysqli_fetch_array($link->query("SELECT COUNT(form1_id) FROM bfp_form1 
                        LEFT JOIN bfp_users ON bfp_form1.uid = bfp_users.uid
                        WHERE form1_date_added BETWEEN '$l' AND '$l1' AND bfp_users.municipal = '".$sh_user['municipal']."' AND bfp_users.location =  '".$report['location']."'
                        AND type='New Establishments Buildings'"));

                        $counttotalgb = mysqli_fetch_array($link->query("SELECT COUNT(form1_id) FROM bfp_form1 
                        LEFT JOIN bfp_users ON bfp_form1.uid = bfp_users.uid
                        WHERE form1_date_added BETWEEN '$start' AND '$end' AND bfp_users.municipal = '".$sh_user['municipal']."' AND bfp_users.location =  '".$report['location']."'
                        AND type='New Government Buildings'"));
                        $counttotalpgb = mysqli_fetch_array($link->query("SELECT COUNT(form1_id) FROM bfp_form1 
                        LEFT JOIN bfp_users ON bfp_form1.uid = bfp_users.uid
                        WHERE form1_date_added BETWEEN '$l' AND '$l1' AND bfp_users.municipal = '".$sh_user['municipal']."' AND bfp_users.location =  '".$report['location']."'
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
                    LEFT JOIN bfp_users ON bfp_form1.uid = bfp_users.uid
                    WHERE form1_date_added BETWEEN '$start' AND '$end' AND bfp_users.municipal = '".$sh_user['municipal']."' AND bfp_users.location =  '".$report['location']."'
                    AND fsec = 'Issued FSEC'"))?>
                    <?php $countfsecpgbissue = mysqli_fetch_assoc($link->query("SELECT COUNT(form1_id) FROM bfp_form1 
                    LEFT JOIN bfp_users ON bfp_form1.uid = bfp_users.uid
                    WHERE form1_date_added BETWEEN '$l' AND '$l1' AND bfp_users.municipal = '".$sh_user['municipal']."' AND bfp_users.location =  '".$report['location']."'
                    AND fsec = 'Issued FSEC'"))?>
                    <?php $countfsecebnod = mysqli_fetch_assoc($link->query("SELECT COUNT(form1_id) FROM bfp_form1 
                    LEFT JOIN bfp_users ON bfp_form1.uid = bfp_users.uid
                    WHERE form1_date_added BETWEEN '$start' AND '$end' AND  bfp_users.municipal = '".$sh_user['municipal']."' AND bfp_users.location =  '".$report['location']."'
                    AND fsec = 'Issued Notice of Disapproval (NOD)'"))?>
                    <?php $countfsecpgbnod = mysqli_fetch_assoc($link->query("SELECT COUNT(form1_id) FROM bfp_form1 
                    LEFT JOIN bfp_users ON bfp_form1.uid = bfp_users.uid
                    WHERE form1_date_added BETWEEN '$l' AND '$l1' AND bfp_users.municipal = '".$sh_user['municipal']."' AND bfp_users.location =  '".$report['location']."'
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
                              LEFT JOIN bfp_users ON bfp_form1.uid = bfp_users.uid
                              WHERE form1_date_added BETWEEN '$start' AND '$end' 
                              AND structure = '".$sh_structure['structure_id']."' AND nc_or_rn='NC' 
                              AND bfp_users.municipal = '".$sh_user['municipal']."' AND bfp_users.location =  '".$report['location']."'"));
                              echo $countnc['COUNT(form1_id)'].",";
                              $cmnc += $countnc['COUNT(form1_id)'];
                              }
                            ?>];
                            <?php $cmrn = 0?>
                            var zstrarray = [<?php
                              while ($sh_structure = $rn->fetch_assoc()) {
                              $countrn = mysqli_fetch_assoc($link->query("SELECT COUNT(form1_id) FROM bfp_form1
                              LEFT JOIN bfp_users ON bfp_form1.uid = bfp_users.uid
                              WHERE form1_date_added BETWEEN '$start' AND '$end' 
                              AND structure = '".$sh_structure['structure_id']."' AND nc_or_rn='RN' AND bfp_users.municipal = '".$sh_user['municipal']."' AND bfp_users.location =  '".$report['location']."'"));
                              echo $countrn['COUNT(form1_id)'].",";
                              $cmrn += $countrn['COUNT(form1_id)'];
                              }
                            ?>];
                            <?php $pmnc = 0?>
                            var Pstrarray = [<?php
                              while ($sh_structure = $nc_l->fetch_assoc()) {
                              $countnc_l = mysqli_fetch_assoc($link->query("SELECT COUNT(form1_id) FROM bfp_form1 
                              LEFT JOIN bfp_users ON bfp_form1.uid = bfp_users.uid
                              WHERE form1_date_added BETWEEN '$l' AND '$l1' 
                              AND structure = '".$sh_structure['structure_id']."' AND nc_or_rn='NC' AND bfp_users.municipal='".$sh_user['municipal']."' AND bfp_users.location =  '".$report['location']."'"));
                              echo $countnc_l['COUNT(form1_id)'].",";
                              $pmnc += $countnc_l['COUNT(form1_id)'];
                              }
                            ?>];
                            <?php $pmrn = 0?>
                            var Mstrarray = [<?php
                              while ($sh_structure = $rn_l->fetch_assoc()) {
                              $countrn_l = mysqli_fetch_assoc($link->query("SELECT COUNT(form1_id) FROM bfp_form1 
                              LEFT JOIN bfp_users ON bfp_form1.uid = bfp_users.uid
                              WHERE form1_date_added BETWEEN '$l' AND '$l1' 
                              AND structure = '".$sh_structure['structure_id']."' AND nc_or_rn='RN' AND bfp_users.municipal='".$sh_user['municipal']."' AND bfp_users.location =  '".$report['location']."'"));
                              echo $countrn_l['COUNT(form1_id)'].",";
                              $pmrn += $countrn_l['COUNT(form1_id)'];
                              }
                            ?>];
                            new Chart("f1structure", {
                              type: "horizontalBar",
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
                  </div>
                  <div class="row">
                    <div class="col-lg-8 mt-3">
                      <div class="card">
                        <div class="card-body">
                          <?php
                          $underNC = mysqli_fetch_assoc($link->query("SELECT COUNT(form1_id) FROM bfp_form1 
                          LEFT JOIN bfp_users ON bfp_form1.uid = bfp_users.uid
                          WHERE form1_date_added BETWEEN '$start' AND '$end'
                          AND inspection = 'NC' AND bfp_users.municipal='".$sh_user['municipal']."' AND bfp_users.location =  '".$report['location']."'"));
                          $underRN = mysqli_fetch_assoc($link->query("SELECT COUNT(form1_id) FROM bfp_form1 
                          LEFT JOIN bfp_users ON bfp_form1.uid = bfp_users.uid
                          WHERE form1_date_added BETWEEN '$start' AND '$end'
                          AND inspection = 'RN' AND bfp_users.municipal='".$sh_user['municipal']."' AND bfp_users.location =  '".$report['location']."'"));
                          $underNC_l = mysqli_fetch_assoc($link->query("SELECT COUNT(form1_id) FROM bfp_form1 
                          LEFT JOIN bfp_users ON bfp_form1.uid = bfp_users.uid
                          WHERE form1_date_added BETWEEN '$l' AND '$l1'
                          AND inspection = 'NC' AND bfp_users.municipal='".$sh_user['municipal']."' AND bfp_users.location =  '".$report['location']."'"));
                          $underRN_l = mysqli_fetch_assoc($link->query("SELECT COUNT(form1_id) FROM bfp_form1 
                          LEFT JOIN bfp_users ON bfp_form1.uid = bfp_users.uid
                          WHERE form1_date_added BETWEEN '$l' AND '$l1'
                          AND inspection = 'RN' AND bfp_users.municipal='".$sh_user['municipal']."' AND bfp_users.location =  '".$report['location']."'"));
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
                                  backgroundColor: ["#b91d47","#0023AD","red","blue"],
                                  data: yValues
                                },{
                                  label: "Previous Month",
                                  backgroundColor: ["#b91d47","#0023AD","red","blue"],
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
                          LEFT JOIN bfp_users ON bfp_form1.uid = bfp_users.uid
                          WHERE form1_date_added BETWEEN '$start' AND '$end'
                          AND issuance = 'Issued FSIC for Occupancy' AND bfp_users.municipal='".$sh_user['municipal']."' AND bfp_users.location =  '".$report['location']."'"));
                          $PMoccupancy = mysqli_fetch_assoc($link->query("SELECT COUNT(form1_id) FROM bfp_form1 
                          LEFT JOIN bfp_users ON bfp_form1.uid = bfp_users.uid
                          WHERE form1_date_added BETWEEN '$l' AND '$l1'
                          AND issuance = 'Issued FSIC for Occupancy' AND bfp_users.municipal='".$sh_user['municipal']."' AND bfp_users.location =  '".$report['location']."'"));
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
                          LEFT JOIN bfp_users ON bfp_form1.uid = bfp_users.uid
                          WHERE form1_date_added BETWEEN '$start' AND '$end'
                          AND issuance = 'Issued With NOD for NOT OCCUPIED buildings/establishments' AND bfp_users.municipal='".$sh_user['municipal']."' AND bfp_users.location =  '".$report['location']."'"));
                          $PMoccupancy = mysqli_fetch_assoc($link->query("SELECT COUNT(form1_id) FROM bfp_form1 
                          LEFT JOIN bfp_users ON bfp_form1.uid = bfp_users.uid
                          WHERE form1_date_added BETWEEN '$l' AND '$l1'
                          AND issuance = 'Issued With NOD for NOT OCCUPIED buildings/establishments' AND bfp_users.municipal='".$sh_user['municipal']."' AND bfp_users.location =  '".$report['location']."'"));
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
                          LEFT JOIN bfp_users ON bfp_form1.uid = bfp_users.uid
                          WHERE form1_date_added BETWEEN '$start' AND '$end'
                          AND issuance = 'Issued With NTC for OCCUPIED buildings/establishments' AND bfp_users.municipal='".$sh_user['municipal']."' AND bfp_users.location =  '".$report['location']."'"));
                          $PMoccupancy = mysqli_fetch_assoc($link->query("SELECT COUNT(form1_id) FROM bfp_form1 
                          LEFT JOIN bfp_users ON bfp_form1.uid = bfp_users.uid
                          WHERE form1_date_added BETWEEN '$l' AND '$l1'
                          AND issuance = 'Issued With NTC for OCCUPIED buildings/establishments' AND bfp_users.municipal='".$sh_user['municipal']."' AND bfp_users.location =  '".$report['location']."'"));
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
                  <div class="row mt-3">
                    <div class="col-lg-12 text-end">
                      <button class="form2-tab btn btn-primary">Next</button>
                    </div>
                  </div>
                </div>
                <div class="col-lg-12" id="form2" style="display: none;">
                  <div class="row mb-3">
                    <div class="col-lg-12">
                      <div class="card">
                        <div class="card-header fw-bold">
                          Business Establishment Table
                        </div>
                        <div class="card-body">
                          <div class="table-responsive">
                            <table id="f2table" class="table table-striped">
                              <thead>
                                <tr>
                                  <th>No</th>
                                  <th>Name</th>
                                  <th>Barangay</th>
                                  <th>Type</th>
                                  <th>Structure</th>
                                  <th>Re-Inspection</th>
                                  <th>Date Recorded</th>
                                  <th>Action</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php $i = 0?>
                                <?php $form2_data = mysqli_query($link,"SELECT * FROM bfp_form2 
                                LEFT JOIN bfp_users ON bfp_users.uid = bfp_form2.uid 
                                LEFT JOIN structure ON bfp_form2.structure = structure.structure_id 
                                WHERE form2_date_added BETWEEN ' $start' AND ' $end' AND bfp_users.municipal = '".$sh_user['municipal']."' AND form2_status = '1' 
                                ORDER BY bfp_form2.form2_date_added DESC")?>
                                <?php while($shform2_data = $form2_data->fetch_assoc()){?>
                                <?php $i++?>
                                <tr>
                                  <td><?php echo $i?></td>
                                  <td class="text-uppercase"><?php echo $shform2_data['lname'] ?>, <?php echo $shform2_data['fname'] ?> <?php echo $shform2_data['mname'] ?></td>
                                  <td><?php echo $shform2_data['brgy']?></td>
                                  <td><?php echo $shform2_data['type']?></td>
                                  <td><?php echo $shform2_data['lbl']?></td>
                                  <td><?php echo $shform2_data['reinspection_1']?></td>
                                  <td><?php echo $shform2_data['form2_date_added']?></td>
                                  <td>
                                    <a href="form2-view.php?reportid=<?php echo $shform2_data['form2_id'] ?>">
                                      <button class="btn btn-primary btn-sm text-white p-2">View</button>
                                    </a>
                                  </td>
                                </tr>
                                <?php }?>
                              </tbody>
                            </table>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <h3 class="text-center">Number of Applications Received for BUSINESS ESTABLISHMENTS</h3>
                  <div class="row">
                    <div class="col-lg-6 mt-3">
                      <div class="card">
                        <div class="card-body">
                          <?php $counttypenew = mysqli_fetch_assoc($link->query("SELECT COUNT(form2_id) FROM bfp_form2 
                          LEFT JOIN bfp_users ON bfp_users.uid = bfp_form2.uid
                          WHERE form2_date_added BETWEEN ' $start' AND ' $end' AND bfp_users.municipal='".$sh_user['municipal']."' AND bfp_users.location =  '".$report['location']."' AND type = 'New'"))?>
                          <?php $counttyperenew = mysqli_fetch_assoc($link->query("SELECT COUNT(form2_id) FROM bfp_form2 
                          LEFT JOIN bfp_users ON bfp_users.uid = bfp_form2.uid
                          WHERE form2_date_added BETWEEN ' $start' AND ' $end' AND bfp_users.municipal='".$sh_user['municipal']."' AND bfp_users.location =  '".$report['location']."' AND type = 'Renew'"))?>
                          <?php $counttypenew_l = mysqli_fetch_assoc($link->query("SELECT COUNT(form2_id) FROM bfp_form2 
                          LEFT JOIN bfp_users ON bfp_users.uid = bfp_form2.uid
                          WHERE form2_date_added BETWEEN '$l' AND '$l1' AND bfp_users.municipal='".$sh_user['municipal']."' AND bfp_users.location =  '".$report['location']."' AND type = 'New'"))?>
                          <?php $counttyperenew_l = mysqli_fetch_assoc($link->query("SELECT COUNT(form2_id) FROM bfp_form2 
                          LEFT JOIN bfp_users ON bfp_users.uid = bfp_form2.uid
                          WHERE form2_date_added BETWEEN '$l' AND '$l1' AND bfp_users.municipal='".$sh_user['municipal']."' AND bfp_users.location =  '".$report['location']."' AND type = 'Renew'"))?>
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
                  LEFT JOIN bfp_users ON bfp_users.uid = bfp_form2.uid
                  WHERE form2_date_added BETWEEN '$start' AND '$end'
                  AND structure = '0' AND bfp_users.municipal='".$sh_user['municipal']."' AND bfp_users.location = '".$report['location']."'"));
                  $nonStructure2 = mysqli_fetch_assoc($link->query("SELECT COUNT(form2_id) FROM bfp_form2 
                  LEFT JOIN bfp_users ON bfp_users.uid = bfp_form2.uid
                  WHERE form2_date_added BETWEEN '$l' AND '$l1'
                  AND structure = '0' AND bfp_users.municipal='".$sh_user['municipal']."' AND bfp_users.location = '".$report['location']."'"));
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
                            LEFT JOIN bfp_users ON bfp_form2.uid = bfp_users.uid
                            WHERE form2_date_added BETWEEN '$start' AND '$end' 
                            AND structure = '".$sh_structure2['structure_id']."' AND bfp_users.municipal='".$sh_user['municipal']."'
                            AND bfp_users.location =  '".$report['location']."'"));
                            echo $count_read_structure_query['COUNT(form2_id)'] . ",";
                            $structure_total += $count_read_structure_query['COUNT(form2_id)'];
                          }?><?php echo $nonStructure["COUNT(form2_id)"];?>];
                          var zValues = [<?php while($sh_structure2 = $read_structure_query3->fetch_assoc()){
                            $count_read_structure_query = mysqli_fetch_assoc($link->query("SELECT COUNT(form2_id) FROM bfp_form2 
                            LEFT JOIN bfp_users ON bfp_form2.uid = bfp_users.uid
                            WHERE form2_date_added BETWEEN '$l' AND '$l1' AND structure = '".$sh_structure2['structure_id']."' 
                            AND bfp_users.municipal='".$sh_user['municipal']."' AND bfp_users.location =  '".$report['location']."'"));
                            echo $count_read_structure_query['COUNT(form2_id)'] . ",";
                            $structure_total_last_month += $count_read_structure_query['COUNT(form2_id)'];
                          }?>
                          <?php echo $nonStructure2["COUNT(form2_id)"];?>];
                          new Chart("form2_structure", {
                            type: "horizontalBar",
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
                  LEFT JOIN bfp_users ON bfp_form2.uid = bfp_users.uid
                  WHERE form2_date_added BETWEEN '$start' AND '$end' AND fsic = 'New' 
                  AND with_or_not = 'FSIC Issued WITHIN Prescribed Period' AND bfp_users.municipal='".$sh_user['municipal']."' AND bfp_users.location =  '".$report['location']."'"))?>
                  <?php $newfsic2 = mysqli_fetch_assoc($link->query("SELECT COUNT(form2_id) FROM bfp_form2 
                  LEFT JOIN bfp_users ON bfp_form2.uid = bfp_users.uid
                  WHERE form2_date_added BETWEEN '$start' AND '$end' AND fsic = 'New' 
                  AND with_or_not = 'FSIC Issued NOT WITHIN Prescribed Period' AND bfp_users.municipal='".$sh_user['municipal']."' AND bfp_users.location =  '".$report['location']."'"))?>
                  <?php $renewfsic1 = mysqli_fetch_assoc($link->query("SELECT COUNT(form2_id) FROM bfp_form2 
                  LEFT JOIN bfp_users ON bfp_form2.uid = bfp_users.uid
                  WHERE form2_date_added BETWEEN '$start' AND '$end' AND fsic = 'Renew' 
                  AND with_or_not = 'FSIC Issued WITHIN Prescribed Period' AND bfp_users.municipal='".$sh_user['municipal']."' AND bfp_users.location =  '".$report['location']."'"))?>
                  <?php $renewfsic2 = mysqli_fetch_assoc($link->query("SELECT COUNT(form2_id) FROM bfp_form2 
                  LEFT JOIN bfp_users ON bfp_form2.uid = bfp_users.uid
                  WHERE form2_date_added BETWEEN '$start' AND '$end' AND fsic = 'Renew' 
                  AND with_or_not = 'FSIC Issued NOT WITHIN Prescribed Period' AND bfp_users.municipal='".$sh_user['municipal']."' AND bfp_users.location =  '".$report['location']."'"))?>
                  
                  <?php $newfsic1_l = mysqli_fetch_assoc($link->query("SELECT COUNT(form2_id) FROM bfp_form2 
                  LEFT JOIN bfp_users ON bfp_form2.uid = bfp_users.uid
                  WHERE form2_date_added BETWEEN '$l' AND '$l1' AND fsic = 'New' 
                  AND with_or_not = 'FSIC Issued WITHIN Prescribed Period' AND bfp_users.municipal='".$sh_user['municipal']."' AND bfp_users.location =  '".$report['location']."'"))?>
                  <?php $newfsic2_l = mysqli_fetch_assoc($link->query("SELECT COUNT(form2_id) FROM bfp_form2 
                  LEFT JOIN bfp_users ON bfp_form2.uid = bfp_users.uid
                  WHERE form2_date_added BETWEEN '$l' AND '$l1' AND '$end' AND fsic = 'New' 
                  AND with_or_not = 'FSIC Issued NOT WITHIN Prescribed Period' AND bfp_users.municipal='".$sh_user['municipal']."' AND bfp_users.location =  '".$report['location']."'"))?>
                  <?php $renewfsic1_l = mysqli_fetch_assoc($link->query("SELECT COUNT(form2_id) FROM bfp_form2 
                  LEFT JOIN bfp_users ON bfp_form2.uid = bfp_users.uid
                  WHERE form2_date_added BETWEEN '$l' AND '$l1' AND '$end' AND fsic = 'Renew' 
                  AND with_or_not = 'FSIC Issued WITHIN Prescribed Period' AND bfp_users.municipal='".$sh_user['municipal']."' AND bfp_users.location =  '".$report['location']."'"))?>
                  <?php $renewfsic2_l = mysqli_fetch_assoc($link->query("SELECT COUNT(form2_id) FROM bfp_form2 
                  LEFT JOIN bfp_users ON bfp_form2.uid = bfp_users.uid
                  WHERE form2_date_added BETWEEN '$l' AND '$l1' AND '$end' AND fsic = 'Renew' 
                  AND with_or_not = 'FSIC Issued NOT WITHIN Prescribed Period' AND bfp_users.municipal='".$sh_user['municipal']."' AND bfp_users.location =  '".$report['location']."'"))?>
                  <h3 class="d-flex justify-content-between mt-3 mb-3">
                    <div>
                    Current Month Total FSIC Issued : <b><?php echo $fsictotal = $newfsic1['COUNT(form2_id)'] + $newfsic2['COUNT(form2_id)'] + $renewfsic1['COUNT(form2_id)'] + $renewfsic2['COUNT(form2_id)']?></b>
                    </div>
                    <div>
                    Previous Month Total FSIC Issued : <b><?php echo $fsictotal_l = $newfsic1_l['COUNT(form2_id)'] + $newfsic2_l['COUNT(form2_id)'] + $renewfsic1_l['COUNT(form2_id)'] + $renewfsic2_l['COUNT(form2_id)']?></b>
                    </div>
                  </h3>
                  <div class="row">
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
                  </div>
                 
                  <h3 class="text-center mt-3 mb-3">Re-Inspection</h3>
                  <div class="row">
                    <div class="col-lg-4 mt-3">
                      <div class="card">
                        <div class="card-body">
                          <?php
                          $reinspect1 = mysqli_fetch_assoc($link->query("SELECT COUNT(form2_id) FROM bfp_form2
                          LEFT JOIN bfp_users ON bfp_form2.uid = bfp_users.uid
                          WHERE form2_date_added BETWEEN '$start' AND '$end' AND 
                          reinspection_1 = 'NOTICE TO COMPLY' AND reinspection_3='Issued NTC' AND bfp_users.municipal='".$sh_user['municipal']."' AND bfp_users.location =  '".$report['location']."'"));
                          $reinspect2 = mysqli_fetch_assoc($link->query("SELECT COUNT(form2_id) FROM bfp_form2
                          LEFT JOIN bfp_users ON bfp_form2.uid = bfp_users.uid
                          WHERE form2_date_added BETWEEN '$start' AND '$end' AND 
                          reinspection_1 = 'NOTICE TO COMPLY' AND reinspection_3='Issued FSIC for Business Operation' AND bfp_users.municipal='".$sh_user['municipal']."' AND bfp_users.location =  '".$report['location']."'"));
                          ?>
                          <canvas id="reinspectiongraph" style="width:100%;max-width: fit-content"></canvas>
                          <script>
                          var xValues = ["Issued NTC (Non-Compliant)", "Issued FSIC for Business Operation (Compliant)"];
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
                          LEFT JOIN bfp_users ON bfp_form2.uid = bfp_users.uid
                          WHERE form2_date_added BETWEEN '$start' AND '$end' AND 
                          reinspection_1 = 'NOTICE TO CORRECT VIOLATION' AND reinspection_3='Issued NTCV' AND bfp_users.municipal='".$sh_user['municipal']."' AND bfp_users.location =  '".$report['location']."'"));
                          $reinspect4 = mysqli_fetch_assoc($link->query("SELECT COUNT(form2_id) FROM bfp_form2
                          LEFT JOIN bfp_users ON bfp_form2.uid = bfp_users.uid
                          WHERE form2_date_added BETWEEN '$start' AND '$end' AND 
                          reinspection_1 = 'NOTICE TO CORRECT VIOLATION' AND reinspection_3='Issued FSIC for Business Operation' AND bfp_users.municipal='".$sh_user['municipal']."' AND bfp_users.location =  '".$report['location']."'"));
                          ?>
                          <canvas id="reinspectiongraph2" style="width:100%;max-width: fit-content"></canvas>
                          <script>
                          var xValues = ["Issued NTCV (Non-Compliant)", "Issued FSIC for Business Operation (Compliant)"];
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
                          LEFT JOIN bfp_users ON bfp_form2.uid = bfp_users.uid
                          WHERE form2_date_added BETWEEN '$start' AND '$end' AND 
                          reinspection_1 = 'ABATEMENT' AND reinspection_3='Issued Abatement Order' AND bfp_users.municipal='".$sh_user['municipal']."' AND bfp_users.location =  '".$report['location']."'"));
                          $reinspect6 = mysqli_fetch_assoc($link->query("SELECT COUNT(form2_id) FROM bfp_form2
                          LEFT JOIN bfp_users ON bfp_form2.uid = bfp_users.uid
                          WHERE form2_date_added BETWEEN '$start' AND '$end' AND 
                          reinspection_1 = 'ABATEMENT' AND reinspection_3='Total Issued FSIC for Business/ Operation' AND bfp_users.municipal='".$sh_user['municipal']."' AND bfp_users.location =  '".$report['location']."'"));
                          ?>
                          <canvas id="reinspectiongraph3" style="width:100%;max-width: fit-content"></canvas>
                          <script>
                          var xValues = ["Issued Abatement Order (Non-Compliant)", "Total Issued FSIC for Business/ Operation (Compliant)"];
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
                          LEFT JOIN bfp_users ON bfp_form2.uid = bfp_users.uid
                          WHERE form2_date_added BETWEEN '$l' AND '$l1' AND 
                          reinspection_1 = 'NOTICE TO COMPLY' AND reinspection_3='Issued FSIC for Business Operation' AND bfp_users.municipal='".$sh_user['municipal']."' AND bfp_users.location =  '".$report['location']."'"));
                          $reinspect_2l = mysqli_fetch_assoc($link->query("SELECT COUNT(form2_id) FROM bfp_form2
                          LEFT JOIN bfp_users ON bfp_form2.uid = bfp_users.uid
                          WHERE form2_date_added BETWEEN '$l' AND '$l1' AND 
                          reinspection_1 = 'NOTICE TO CORRECT VIOLATION' AND reinspection_3='Issued FSIC for Business Operation' AND bfp_users.municipal='".$sh_user['municipal']."' AND bfp_users.location =  '".$report['location']."'"));
                          $reinspect_3l = mysqli_fetch_assoc($link->query("SELECT COUNT(form2_id) FROM bfp_form2
                          LEFT JOIN bfp_users ON bfp_form2.uid = bfp_users.uid
                          WHERE form2_date_added BETWEEN '$l' AND '$l1' AND 
                          reinspection_1 = 'ABATEMENT' AND reinspection_3='Total Issued FSIC for Business/ Operation' AND bfp_users.municipal='".$sh_user['municipal']."' AND bfp_users.location =  '".$report['location']."'"));
                          $reinspect_4l = mysqli_fetch_assoc($link->query("SELECT COUNT(form2_id) FROM bfp_form2
                          LEFT JOIN bfp_users ON bfp_form2.uid = bfp_users.uid
                          WHERE form2_date_added BETWEEN '$l' AND '$l1' AND 
                          reinspection_1 = 'NOTICE TO CORRECT VIOLATION' AND reinspection_3='Issued NTCV' AND bfp_users.municipal='".$sh_user['municipal']."' AND bfp_users.location =  '".$report['location']."'"));
                          $reinspect_5l = mysqli_fetch_assoc($link->query("SELECT COUNT(form2_id) FROM bfp_form2
                          LEFT JOIN bfp_users ON bfp_form2.uid = bfp_users.uid
                          WHERE form2_date_added BETWEEN '$l' AND '$l1' AND 
                          reinspection_1 = 'ABATEMENT' AND reinspection_3='Issued Abatement Order' AND bfp_users.municipal='".$sh_user['municipal']."' AND bfp_users.location =  '".$report['location']."'"));
                          ?>
                          <canvas id="reinspecttotal" style="width:100%;max-width: fit-content"></canvas>
                          <script>
                          var xValues = ["Current Month", "Previous Month"];
                          var yValues = [<?php echo $a = $reinspect2['COUNT(form2_id)']+$reinspect4['COUNT(form2_id)']+$reinspect6['COUNT(form2_id)'];?>,
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
                          LEFT JOIN bfp_users ON bfp_form2.uid = bfp_users.uid
                          WHERE form2_date_added BETWEEN '$start' AND '$end' AND 
                          closure = 'Closure Order for Failure to Comply the Abatement order' AND bfp_users.municipal='".$sh_user['municipal']."' AND bfp_users.location =  '".$report['location']."'"));
                          $form2_closure2 = mysqli_fetch_assoc($link->query("SELECT COUNT(form2_id) FROM bfp_form2
                          LEFT JOIN bfp_users ON bfp_form2.uid = bfp_users.uid
                          WHERE form2_date_added BETWEEN '$start' AND '$end' AND 
                          closure = 'Closure For Failure To Pay Fine' AND bfp_users.municipal='".$sh_user['municipal']."' AND bfp_users.location =  '".$report['location']."'"));

                          $l_form2_closure = mysqli_fetch_assoc($link->query("SELECT COUNT(form2_id) FROM bfp_form2
                          LEFT JOIN bfp_users ON bfp_form2.uid = bfp_users.uid
                          WHERE form2_date_added BETWEEN '$l' AND '$l1' AND 
                          closure = 'Closure Order for Failure to Comply the Abatement order' AND bfp_users.municipal='".$sh_user['municipal']."' AND bfp_users.location =  '".$report['location']."'"));
                          $l_form2_closure2 = mysqli_fetch_assoc($link->query("SELECT COUNT(form2_id) FROM bfp_form2
                          LEFT JOIN bfp_users ON bfp_form2.uid = bfp_users.uid
                          WHERE form2_date_added BETWEEN '$l' AND '$l1' AND 
                          closure = 'Closure For Failure To Pay Fine' AND bfp_users.municipal='".$sh_user['municipal']."' AND bfp_users.location =  '".$report['location']."'"));
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
                  </div>
                  <div class="row mt-3">
                    <div class="col-lg-12 text-end">
                      <button class="form1-tab btn btn-dark text-white">Back</button>
                      <button class="form3-tab btn btn-primary">Next</button>
                    </div>
                  </div>
                </div>
                <div class="col-lg-12" id="form3" style="display: none;">
                  <div class="row mb-3">
                    <div class="col-lg-12">
                      <div class="card">
                        <div class="card-header fw-bold">
                          Government Building
                        </div>
                        <div class="card-body">
                          <div class="table-responsive">
                            <table id="f3table" class="table table-striped">
                              <thead>
                                <tr>
                                  <th>No</th>
                                  <th>Name</th>
                                  <th>Barangay</th>
                                  <th>Type</th>
                                  <th>Structure</th>
                                  <th>Re-Inspection</th>
                                  <th>Date Recorded</th>
                                  <th>Action</th>
                                </tr>
                              </thead>
                              <tbody>
                                  <?php $i = 0?>
                                  <?php $form3_data = mysqli_query($link,"SELECT * FROM bfp_form3 
                                  LEFT JOIN bfp_users ON bfp_users.uid = bfp_form3.uid 
                                  LEFT JOIN structure ON bfp_form3.structure = structure.structure_id 
                                  WHERE form3_date_added BETWEEN '$start' AND '$end' AND bfp_users.municipal = '".$sh_user['municipal']."' AND bfp_form3.form3_status = '1'
                                  ORDER BY bfp_form3.form3_date_added DESC")?>
                                  <?php while($shform3_data = $form3_data->fetch_assoc()){?>
                                  <?php $i++?>
                                <tr>
                                  <td><?php echo $i?></td>
                                  <td class="text-uppercase">
                                    <?php echo $shform3_data['lname'] ?>,
                                    <?php echo $shform3_data['fname'] ?> 
                                    <?php echo $shform3_data['mname'] ?>
                                  </td>
                                  <td><?php echo $shform3_data['brgy']?></td>
                                  <td><?php echo $shform3_data['type']?></td>
                                  <td><?php echo $shform3_data['lbl']?></td>
                                  <td><?php echo $shform3_data['reinspection_1']?></td>
                                  <td><?php echo $shform3_data['form3_date_added']?></td>
                                  <td>
                                    <a href="form3-view.php?reportid=<?php echo $shform3_data['form3_id'] ?>">
                                      <button class="btn btn-primary btn-sm text-white p-2">View</button>
                                    </a>
                                  </td>
                                </tr>
                                <?php }?>
                              </tbody>
                            </table>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <h3 class="text-center">Number of Applications Received for GOVERNMENT ESTABLISHMENTS</h3>
                    <div class="col-lg-6 mt-3">
                      <div class="card">
                        <div class="card-body">
                          <?php $counttypenew = mysqli_fetch_assoc($link->query("SELECT COUNT(form3_id) FROM bfp_form3 
                          LEFT JOIN bfp_users ON bfp_form3.uid = bfp_users.uid
                          WHERE form3_date_added BETWEEN '$start' AND '$end' AND bfp_users.municipal='".$sh_user['municipal']."' AND bfp_users.location =  '".$report['location']."' AND type = 'New'"))?>
                          <?php $counttyperenew = mysqli_fetch_assoc($link->query("SELECT COUNT(form3_id) FROM bfp_form3 
                          LEFT JOIN bfp_users ON bfp_form3.uid = bfp_users.uid
                          WHERE form3_date_added BETWEEN '$start' AND '$end' AND bfp_users.municipal='".$sh_user['municipal']."' AND bfp_users.location =  '".$report['location']."' AND type = 'Renew'"))?>
                          <?php $counttypenew_l = mysqli_fetch_assoc($link->query("SELECT COUNT(form3_id) FROM bfp_form3 
                          LEFT JOIN bfp_users ON bfp_form3.uid = bfp_users.uid
                          WHERE form3_date_added BETWEEN '$l' AND '$l1' AND bfp_users.municipal='".$sh_user['municipal']."' AND bfp_users.location =  '".$report['location']."' AND type = 'New'"))?>
                          <?php $counttyperenew_l = mysqli_fetch_assoc($link->query("SELECT COUNT(form3_id) FROM bfp_form3 
                          LEFT JOIN bfp_users ON bfp_form3.uid = bfp_users.uid
                          WHERE form3_date_added BETWEEN '$l' AND '$l1' AND bfp_users.municipal='".$sh_user['municipal']."' AND bfp_users.location =  '".$report['location']."' AND type = 'Renew'"))?>
                          <canvas id="f3new_renewCMchart" style="width:100%;"></canvas>
                          <script>
                            var xValues = ["New","Renew"];
                            var yValues = [<?php echo $counttypenew['COUNT(form3_id)']?>,<?php echo $counttyperenew['COUNT(form3_id)']?>];
                            var barColors = [
                              "#b91d47",
                              "#0023AD",
                            ];
                            new Chart("f3new_renewCMchart", {
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
                          Total : <b><?php echo $counttypenew['COUNT(form3_id)']+$counttyperenew['COUNT(form3_id)']?></b>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-6 mt-3">
                      <div class="card">
                        <div class="card-body">
                          <canvas id="f3new_renewPMchart" style="width:100%;"></canvas>
                          <script>
                            var yValues = [<?php echo $counttypenew_l['COUNT(form3_id)']?>,<?php echo $counttyperenew_l['COUNT(form3_id)']?>];
                            var barColors = [
                              "#b91d47",
                              "#0023AD",
                            ];
                            new Chart("f3new_renewPMchart", {
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
                          Total : <b><?php echo $counttypenew_l['COUNT(form3_id)']+$counttyperenew_l['COUNT(form3_id)']?></b>
                        </div>
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
                  ?>
                  <div class="col-lg-12 mt-3 grid-margin grid-margin-md-0 stretch-card">
                    <div class="card">
                      <div class="card-body">
                        <canvas id="form3_structure" style="width:100%;max-width:1300px"></canvas>
                        <script>
                          var xValues = [<?php while($sh_structure = $read_structure_query->fetch_assoc()){
                            echo "'" . $sh_structure['lbl'] . "',";
                          }
                          ?>];
                          var yValues = [<?php while($sh_structure3 = $read_structure_query2->fetch_assoc()){
                            $count_read_structure_query = mysqli_fetch_assoc($link->query("SELECT COUNT(form3_id) FROM bfp_form3 
                            LEFT JOIN bfp_users ON bfp_form3.uid = bfp_users.uid
                            WHERE form3_date_added BETWEEN '$start' AND '$end' 
                            AND structure = '".$sh_structure3['structure_id']."' AND bfp_users.municipal='".$sh_user['municipal']."' AND bfp_users.location =  '".$report['location']."'"));
                            echo $count_read_structure_query['COUNT(form3_id)'] . ",";
                            $structure_total += $count_read_structure_query['COUNT(form3_id)'];
                          }?>];
                          var zValues = [<?php while($sh_structure3 = $read_structure_query3->fetch_assoc()){
                            $count_read_structure_query = mysqli_fetch_assoc($link->query("SELECT COUNT(form3_id) FROM bfp_form3 
                            LEFT JOIN bfp_users ON bfp_form3.uid = bfp_users.uid
                            WHERE form3_date_added BETWEEN '$l' AND '$l1' AND structure = '".$sh_structure3['structure_id']."' 
                            AND bfp_users.municipal='".$sh_user['municipal']."' AND bfp_users.location =  '".$report['location']."'"));
                            echo $count_read_structure_query['COUNT(form3_id)'] . ",";
                            $structure_total_last_month += $count_read_structure_query['COUNT(form3_id)'];
                          }?>];
                          new Chart("form3_structure", {
                            type: "horizontalBar",
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
                        Current Month Total : <b><?php echo $C_f2stracture = $structure_total?></b>  <br>
                        Previous Month Total : <b><?php echo $P_f2stracture = $structure_total_last_month?></b> 
                      </div>
                    </div>
                  </div>
                  <?php $newfsic1 = mysqli_fetch_assoc($link->query("SELECT COUNT(form3_id) FROM bfp_form3 
                  LEFT JOIN bfp_users ON bfp_form3.uid = bfp_users.uid
                  WHERE form3_date_added BETWEEN '$start' AND '$end' AND new_renew = 'New' 
                  AND with_or_not = 'FSIC Issued WITHIN Prescribed Period' AND bfp_users.municipal='".$sh_user['municipal']."' AND bfp_users.location =  '".$report['location']."'"))?>
                  <?php $newfsic2 = mysqli_fetch_assoc($link->query("SELECT COUNT(form3_id) FROM bfp_form3 
                  LEFT JOIN bfp_users ON bfp_form3.uid = bfp_users.uid
                  WHERE form3_date_added BETWEEN '$start' AND '$end' AND new_renew = 'New' 
                  AND with_or_not = 'FSIC Issued NOT WITHIN Prescribed Period' AND bfp_users.municipal='".$sh_user['municipal']."' AND bfp_users.location =  '".$report['location']."'"))?>
                  <?php $renewfsic1 = mysqli_fetch_assoc($link->query("SELECT COUNT(form3_id) FROM bfp_form3 
                  LEFT JOIN bfp_users ON bfp_form3.uid = bfp_users.uid
                  WHERE form3_date_added BETWEEN '$start' AND '$end' AND new_renew = 'Renew' 
                  AND with_or_not = 'FSIC Issued WITHIN Prescribed Period' AND bfp_users.municipal='".$sh_user['municipal']."' AND bfp_users.location =  '".$report['location']."'"))?>
                  <?php $renewfsic2 = mysqli_fetch_assoc($link->query("SELECT COUNT(form3_id) FROM bfp_form3 
                  LEFT JOIN bfp_users ON bfp_form3.uid = bfp_users.uid
                  WHERE form3_date_added BETWEEN '$start' AND '$end' AND new_renew = 'Renew' 
                  AND with_or_not = 'FSIC Issued NOT WITHIN Prescribed Period' AND bfp_users.municipal='".$sh_user['municipal']."' AND bfp_users.location =  '".$report['location']."'"))?>
                  
                  <?php $newfsic1_l = mysqli_fetch_assoc($link->query("SELECT COUNT(form3_id) FROM bfp_form3 
                  LEFT JOIN bfp_users ON bfp_form3.uid = bfp_users.uid
                  WHERE form3_date_added BETWEEN '$l' AND '$l1' AND new_renew = 'New' 
                  AND with_or_not = 'FSIC Issued WITHIN Prescribed Period' AND bfp_users.municipal='".$sh_user['municipal']."' AND bfp_users.location =  '".$report['location']."'"))?>
                  <?php $newfsic2_l = mysqli_fetch_assoc($link->query("SELECT COUNT(form3_id) FROM bfp_form3 
                  LEFT JOIN bfp_users ON bfp_form3.uid = bfp_users.uid
                  WHERE form3_date_added BETWEEN '$l' AND '$l1' AND '$end' AND new_renew = 'New' 
                  AND with_or_not = 'FSIC Issued NOT WITHIN Prescribed Period' AND bfp_users.municipal='".$sh_user['municipal']."' AND bfp_users.location =  '".$report['location']."'"))?>
                  <?php $renewfsic1_l = mysqli_fetch_assoc($link->query("SELECT COUNT(form3_id) FROM bfp_form3 
                  LEFT JOIN bfp_users ON bfp_form3.uid = bfp_users.uid
                  WHERE form3_date_added BETWEEN '$l' AND '$l1' AND '$end' AND new_renew = 'Renew' 
                  AND with_or_not = 'FSIC Issued WITHIN Prescribed Period' AND bfp_users.municipal='".$sh_user['municipal']."' AND bfp_users.location =  '".$report['location']."'"))?>
                  <?php $renewfsic2_l = mysqli_fetch_assoc($link->query("SELECT COUNT(form3_id) FROM bfp_form3 
                  LEFT JOIN bfp_users ON bfp_form3.uid = bfp_users.uid
                  WHERE form3_date_added BETWEEN '$l' AND '$l1' AND '$end' AND new_renew = 'Renew' 
                  AND with_or_not = 'FSIC Issued NOT WITHIN Prescribed Period' AND bfp_users.municipal='".$sh_user['municipal']."' AND bfp_users.location =  '".$report['location']."'"))?>
                  <h3 class="d-flex justify-content-between mt-3 mb-3">
                    <div>
                      Current Month Total FSIC Issued : <b><?php echo $fsictotal = $newfsic1['COUNT(form3_id)'] + $newfsic2['COUNT(form3_id)'] + $renewfsic1['COUNT(form3_id)'] + $renewfsic2['COUNT(form3_id)']?></b>
                    </div>
                    <div>
                      Previous Month Totla FSIC Issued : <b><?php echo $fsictotal_l = $newfsic1_l['COUNT(form3_id)'] + $newfsic2_l['COUNT(form3_id)'] + $renewfsic1_l['COUNT(form3_id)'] + $renewfsic2_l['COUNT(form3_id)']?></b>
                    </div>
                  </h3>
                  <div class="row">
                    <div class="col-lg-6 mt-3">
                      <div class="card">
                        <div class="card-body">
                          <canvas id="f3newfsic" style="width: 100%;"></canvas>
                          <script>
                            var xValues = ["FSIC Issued WITHIN Prescribed Period","FSIC Issued NOT WITHIN Prescribed Period"];
                            var yValues = [<?php echo $newfsic1['COUNT(form3_id)']?>,<?php echo $newfsic2['COUNT(form3_id)']?>];
                            var barColors = [
                              "#b91d47",
                              "#0023AD",
                            ];
                            new Chart("f3newfsic", {
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
                          <canvas id="f3renewfsic" style="width: 100%;"></canvas>
                          <script>
                            var yValues = [<?php echo $renewfsic1['COUNT(form3_id)']?>,<?php echo $renewfsic2['COUNT(form3_id)']?>];
                            var barColors = [
                              "#b91d47",
                              "#0023AD",
                            ];
                            new Chart("f3renewfsic", {
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
                          $reinspect1 = mysqli_fetch_assoc($link->query("SELECT COUNT(form3_id) FROM bfp_form3
                          LEFT JOIN bfp_users ON bfp_form3.uid = bfp_users.uid
                          WHERE form3_date_added BETWEEN '$start' AND '$end' AND 
                          reinspection_1 = 'NOTICE TO COMPLY' AND reinspection_3='Issued NTC' AND bfp_users.municipal='".$sh_user['municipal']."' AND bfp_users.location =  '".$report['location']."'"));
                          $reinspect2 = mysqli_fetch_assoc($link->query("SELECT COUNT(form3_id) FROM bfp_form3
                          LEFT JOIN bfp_users ON bfp_form3.uid = bfp_users.uid
                          WHERE form3_date_added BETWEEN '$start' AND '$end' AND 
                          reinspection_1 = 'NOTICE TO COMPLY' AND reinspection_3='Issued FSIC for Business Operation' AND bfp_users.municipal='".$sh_user['municipal']."' AND bfp_users.location =  '".$report['location']."'"));
                          ?>
                          <canvas id="f3reinspectiongraph" style="width:100%;max-width: fit-content"></canvas>
                          <script>
                          var xValues = ["Issued NTC (Non-Compliant)", "Issued FSIC for Business Operation (Compliant)"];
                          var yValues = [<?php echo $reinspect1['COUNT(form3_id)'];?>,<?php echo $reinspect2['COUNT(form3_id)']?>];
                          var barColors = ['#b91d47','#0023AD','yellow'];
                          new Chart("f3reinspectiongraph", {
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
                          $reinspect3 = mysqli_fetch_assoc($link->query("SELECT COUNT(form3_id) FROM bfp_form3
                          LEFT JOIN bfp_users ON bfp_form3.uid = bfp_users.uid
                          WHERE form3_date_added BETWEEN '$start' AND '$end' AND 
                          reinspection_1 = 'NOTICE TO CORRECT VIOLATION' AND reinspection_3='Issued NTCV' AND bfp_users.municipal='".$sh_user['municipal']."' AND bfp_users.location =  '".$report['location']."'"));
                          $reinspect4 = mysqli_fetch_assoc($link->query("SELECT COUNT(form3_id) FROM bfp_form3
                          LEFT JOIN bfp_users ON bfp_form3.uid = bfp_users.uid
                          WHERE form3_date_added BETWEEN '$start' AND '$end' AND 
                          reinspection_1 = 'NOTICE TO CORRECT VIOLATION' AND reinspection_3='Issued FSIC for Business Operation' AND bfp_users.municipal='".$sh_user['municipal']."' AND bfp_users.location =  '".$report['location']."'"));
                          ?>
                          <canvas id="f3reinspectiongraph2" style="width:100%;max-width: fit-content"></canvas>
                          <script>
                          var xValues = ["Issued NTCV (Non-Compliant)", "Issued FSIC for Business Operation (Compliant)"];
                          var yValues = [<?php echo $reinspect3['COUNT(form3_id)'];?>,<?php echo $reinspect4['COUNT(form3_id)']?>];
                          var barColors = ['#b91d47','#0023AD','yellow'];
                          new Chart("f3reinspectiongraph2", {
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
                          $reinspect5 = mysqli_fetch_assoc($link->query("SELECT COUNT(form3_id) FROM bfp_form3
                          LEFT JOIN bfp_users ON bfp_form3.uid = bfp_users.uid
                          WHERE form3_date_added BETWEEN '$start' AND '$end' AND 
                          reinspection_1 = 'ABATEMENT' AND reinspection_3='Issued Abatement Order' AND bfp_users.municipal='".$sh_user['municipal']."' AND bfp_users.location =  '".$report['location']."'"));
                          $reinspect6 = mysqli_fetch_assoc($link->query("SELECT COUNT(form3_id) FROM bfp_form3
                          LEFT JOIN bfp_users ON bfp_form3.uid = bfp_users.uid
                          WHERE form3_date_added BETWEEN '$start' AND '$end' AND 
                          reinspection_1 = 'ABATEMENT' AND reinspection_3='Total Issued FSIC for Business/ Operation' AND bfp_users.municipal='".$sh_user['municipal']."' AND bfp_users.location =  '".$report['location']."'"));
                          ?>
                          <canvas id="f3reinspectiongraph3" style="width:100%;max-width: fit-content"></canvas>
                          <script>
                          var xValues = ["Issued Abatement Order (Non-Compliant)", "Total Issued FSIC for Business/ Operation (Compliant)"];
                          var yValues = [<?php echo $reinspect5['COUNT(form3_id)'];?>,<?php echo $reinspect6['COUNT(form3_id)']?>];
                          var barColors = ['#b91d47','#0023AD','yellow'];
                          new Chart("f3reinspectiongraph3", {
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
                          $reinspect_1l = mysqli_fetch_assoc($link->query("SELECT COUNT(form3_id) FROM bfp_form3
                          LEFT JOIN bfp_users ON bfp_form3.uid = bfp_users.uid
                          WHERE form3_date_added BETWEEN '$l' AND '$l1' AND 
                          reinspection_1 = 'NOTICE TO COMPLY' AND reinspection_3='Issued FSIC for Business Operation' AND bfp_users.municipal='".$sh_user['municipal']."' AND bfp_users.location =  '".$report['location']."'"));
                          $reinspect_2l = mysqli_fetch_assoc($link->query("SELECT COUNT(form3_id) FROM bfp_form3
                          LEFT JOIN bfp_users ON bfp_form3.uid = bfp_users.uid
                          WHERE form3_date_added BETWEEN '$l' AND '$l1' AND 
                          reinspection_1 = 'NOTICE TO CORRECT VIOLATION' AND reinspection_3='Issued FSIC for Business Operation' AND bfp_users.municipal='".$sh_user['municipal']."' AND bfp_users.location =  '".$report['location']."'"));
                          $reinspect_3l = mysqli_fetch_assoc($link->query("SELECT COUNT(form3_id) FROM bfp_form3
                          LEFT JOIN bfp_users ON bfp_form3.uid = bfp_users.uid
                          WHERE form3_date_added BETWEEN '$l' AND '$l1' AND 
                          reinspection_1 = 'ABATEMENT' AND reinspection_3='Total Issued FSIC for Business/ Operation' AND bfp_users.municipal='".$sh_user['municipal']."' AND bfp_users.location =  '".$report['location']."'"));


                          $reinspect_4l = mysqli_fetch_assoc($link->query("SELECT COUNT(form3_id) FROM bfp_form3
                          LEFT JOIN bfp_users ON bfp_form3.uid = bfp_users.uid
                          WHERE form3_date_added BETWEEN '$l' AND '$l1' AND 
                          reinspection_1 = 'NOTICE TO CORRECT VIOLATION' AND reinspection_3='Issued NTCV' AND bfp_users.municipal='".$sh_user['municipal']."' AND bfp_users.location =  '".$report['location']."'"));
                          $reinspect_5l = mysqli_fetch_assoc($link->query("SELECT COUNT(form3_id) FROM bfp_form3
                          LEFT JOIN bfp_users ON bfp_form3.uid = bfp_users.uid
                          WHERE form3_date_added BETWEEN '$l' AND '$l1' AND 
                          reinspection_1 = 'ABATEMENT' AND reinspection_3='Issued Abatement Order' AND bfp_users.municipal='".$sh_user['municipal']."' AND bfp_users.location =  '".$report['location']."'"));
                          ?>
                          <canvas id="f3reinspecttotal" style="width:100%;max-width: fit-content"></canvas>
                          <script>
                          var xValues = ["Current Month", "Previous Month"];
                          var yValues = [<?php 
                          echo $a = $reinspect2['COUNT(form3_id)']+$reinspect4['COUNT(form3_id)']+$reinspect6['COUNT(form3_id)'];?>,
                          <?php echo $a2 = $reinspect_1l['COUNT(form3_id)']+$reinspect_2l['COUNT(form3_id)']+$reinspect_3l['COUNT(form3_id)']?>];
                          var barColors = ['#b91d47','#0023AD'];
                          new Chart("f3reinspecttotal", {
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
                          $form2_closure = mysqli_fetch_assoc($link->query("SELECT COUNT(form3_id) FROM bfp_form3
                          LEFT JOIN bfp_users ON bfp_form3.uid = bfp_users.uid
                          WHERE form3_date_added BETWEEN '$start' AND '$end' AND 
                          closure = 'Closure Order for Failure to Comply the Abatement order' AND bfp_users.municipal='".$sh_user['municipal']."' AND bfp_users.location =  '".$report['location']."'"));
                          $form2_closure2 = mysqli_fetch_assoc($link->query("SELECT COUNT(form3_id) FROM bfp_form3
                          LEFT JOIN bfp_users ON bfp_form3.uid = bfp_users.uid
                          WHERE form3_date_added BETWEEN '$start' AND '$end' AND 
                          closure = 'Closure For Failure To Pay Fine' AND bfp_users.municipal='".$sh_user['municipal']."' AND bfp_users.location =  '".$report['location']."'"));

                          $l_form2_closure = mysqli_fetch_assoc($link->query("SELECT COUNT(form3_id) FROM bfp_form3
                          LEFT JOIN bfp_users ON bfp_form3.uid = bfp_users.uid
                          WHERE form3_date_added BETWEEN '$l' AND '$l1' AND 
                          closure = 'Closure Order for Failure to Comply the Abatement order' AND bfp_users.municipal='".$sh_user['municipal']."' AND bfp_users.location =  '".$report['location']."'"));
                          $l_form2_closure2 = mysqli_fetch_assoc($link->query("SELECT COUNT(form3_id) FROM bfp_form3
                          LEFT JOIN bfp_users ON bfp_form3.uid = bfp_users.uid
                          WHERE form3_date_added BETWEEN '$l' AND '$l1' AND 
                          closure = 'Closure For Failure To Pay Fine' AND bfp_users.municipal='".$sh_user['municipal']."' AND bfp_users.location =  '".$report['location']."'"));
                          ?>
                          <canvas id="f3closuregraph" style="width:100%;max-width: fit-content"></canvas>
                          <script>
                          var xValues = ["Failure to Comply the Abatement order", "Failure To Pay Fine"];
                          var yValues = [<?php echo $form2_closure['COUNT(form3_id)'];?>,<?php echo $form2_closure2['COUNT(form3_id)']?>];
                          var barColors = ['#b91d47','#0023AD'];
                          new Chart("f3closuregraph", {
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
                          Total Issued Closure Order : <b><?php echo $totalClosure = $form2_closure['COUNT(form3_id)']+$form2_closure2['COUNT(form3_id)']?></b>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-4 mt-3">
                      <div class="card">
                        <div class="card-body">
                          <?php $f2overall = $C_f2stracture+$reinspect2['COUNT(form3_id)']+$reinspect3['COUNT(form3_id)']
                          +$reinspect4['COUNT(form3_id)']+$reinspect5['COUNT(form3_id)']+$reinspect6['COUNT(form3_id)']+$totalClosure?>
                          <?php $P_f2overall = $P_f2stracture+$a2+$l_form2_closure['COUNT(form3_id)']+$l_form2_closure2['COUNT(form3_id)']+$reinspect_4l['COUNT(form3_id)']+$reinspect_5l['COUNT(form3_id)']?>
                          <canvas id="f3overall"></canvas>
                          <script>
                            var xValues = ["Current Month","Previous Month"];
                            var yValues = [<?php echo $f2overall?>,<?php echo $P_f2overall?>];
                            new Chart("f3overall", {
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
                          <canvas id="f3overallcompliant"></canvas>
                          <script>
                            var xValues = ["Current Month","Previous Month"];
                            var yValues = [<?php echo $f2overallcompliant?>,<?php echo $P_f2overallcompliant?>];
                            new Chart("f3overallcompliant", {
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
                          <?php $f2overallreinspect = $totalClosure+$reinspect3['COUNT(form3_id)']+$reinspect5['COUNT(form3_id)']?>
                          <?php $P_f2overallreinspect = $l_form2_closure['COUNT(form3_id)']+$l_form2_closure2['COUNT(form3_id)']+$reinspect_4l['COUNT(form3_id)']+$reinspect_5l['COUNT(form3_id)']?>
                          <canvas id="f3overallreinspect"></canvas>
                          <script>
                            var xValues = ["Current Month","Previous Month"];
                            var yValues = [<?php echo $f2overallreinspect?>,<?php echo $P_f2overallreinspect?>];
                            new Chart("f3overallreinspect", {
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
                  </div>
                  <div class="row mt-3">
                    <div class="col-lg-12 text-end">
                      <button class="form2-tab btn btn-dark text-white">Back</button>
                      <button class="form4-tab btn btn-primary">Next</button>
                    </div>
                  </div>
                </div>
                <div class="col-lg-12" id="form4" style="display: none;">
                  <div class="row mb-3">
                    <div class="col-lg-12">
                      <div class="card">
                        <div class="card-header fw-bold">
                          Fire Code Fees Collection Table
                        </div>
                        <div class="card-body">
                          <div class="table-responsive">
                            <table id="f4table" class="table table-striped">
                              <thead>
                                <tr>
                                  <th>No</th>
                                  <th>Name</th>
                                  <th>Barangay</th>
                                  <th>Fire Code Fees</th>
                                  <th>Fee</th>
                                  <th>Date Created</th>
                                  <th>Action</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php $i = 0?>
                                <?php $form4_data = mysqli_query($link,"SELECT * FROM bfp_form4 
                                LEFT JOIN bfp_users ON bfp_users.uid = bfp_form4.uid
                                WHERE form4_date_added BETWEEN '$start' AND '$end' AND bfp_users.municipal ='".$sh_user['municipal']."' 
                                ORDER BY bfp_form4.form4_date_added DESC")?>
                                <?php while($shform4_data = $form4_data->fetch_assoc()){?>
                                <?php $i++?>
                                <tr>
                                  <td><?php echo $i++?></td>
                                  <td class="text-uppercase">
                                    <?php echo $shform4_data['lname'] ?>, 
                                    <?php echo $shform4_data['fname'] ?> 
                                    <?php echo $shform4_data['mname'] ?>
                                  </td>
                                  <td><?php echo $shform4_data['brgy']?></td>
                                  <td><?php echo $shform4_data['fire_code_fees']?></td>
                                  <td><?php echo $shform4_data['fees']?></td>
                                  <td><?php echo $shform4_data['form4_date_added']?></td>
                                  <td>
                                    <a href="form4-view.php?reportid=<?php echo $shform4_data['form4_id'] ?>">
                                      <button class="btn btn-primary btn-sm text-white p-2">View</button>
                                    </a>
                                  </td>
                                </tr>
                                <?php }?>
                              </tbody>
                            </table>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <?php $feesarray = array("Fire Code Construction","Fire Code Realty","Fire Code Premuim","Fire Code Sales","Fire Code Proceeds Tax","Fire Code Fees for Occupancy",
                 "Fire Code Fees for Business","Storage Clearance Fee","Conveyance Cleance Fee","Installation of Building Service Equipment","Installation of AFSS",
                 "Installation of FDAS","Installation of KHSS","Installation of Flammable and Combustible Liquids Storage Tanks","Installation of LPGAS System","Other Installation Clearances",
                 "Fire Code Administrative Fines","Fireworks Display","Electrical Installation","Filing Fees for FSEC","Certified True Copy of FSEC/FSIC/ Other Clearances",
                 "Fumigation/Fogging","Fire Incident Clearance","Protest Fee","Fire Drill","Appeal Fee",
                 "Open Flame","Fire Prevention and Safety Seminar","Soundstage and Approved Production Facilities and Locations","Welding, Cutting and Other Hotworks","Others",
                 "Certificate of Competency (COC) Fees");?>
                <div class="row">
                  <div class="col-lg-12">
                    <div class="card">
                      <div class="card-body">
                        <div class="chart-container" style="position: relative;height:auto; width:80vw">
                          <h3 class="card-title text-center">SUMMARY ACCOMPLISHMENT REPORT ON FIRE CODE FEES COLLECTION</h3>
                          <canvas id="inspectionchart"></canvas>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                  <script>
                  var xValues = ["Fire Code Construction","Fire Code Realty","Fire Code Premuim","Fire Code Sales","Fire Code Proceeds Tax","Fire Code Fees for Occupancy",
                 "Fire Code Fees for Business","Storage Clearance Fee","Conveyance Cleance Fee","Installation of Building Service Equipment","Installation of AFSS",
                 "Installation of FDAS","Installation of KHSS","Installation of Flammable and Combustible Liquids Storage Tanks","Installation of LPGAS System","Other Installation Clearances",
                 "Fire Code Administrative Fines","Fireworks Display","Electrical Installation","Filing Fees for FSEC","Certified True Copy of FSEC/FSIC/ Other Clearances",
                 "Fumigation/Fogging","Fire Incident Clearance","Protest Fee","Fire Drill","Appeal Fee",
                 "Open Flame","Fire Prevention and Safety Seminar","Soundstage and Approved Production Facilities and Locations","Welding, Cutting and Other Hotworks","Others",
                 "Certificate of Competency (COC) Fees"];
                  var yValues = [<?php foreach ($feesarray as $sharray1) {
                                  $count = mysqli_fetch_assoc($link->query("SELECT SUM(fees) 
                                  FROM bfp_form4 LEFT JOIN bfp_users ON bfp_form4.uid = bfp_users.uid
                                  WHERE form4_date_added BETWEEN '$start' AND '$end' 
                                  AND fire_code_fees = '$sharray1' AND bfp_users.municipal='".$sh_user['municipal']."' 
                                  AND bfp_users.location =  '".$report['location']."'"));
                                  echo $count['SUM(fees)'].",";
                                } ?>];
                  var zValues = [<?php foreach ($feesarray as $sharray2) {
                                  $count = mysqli_fetch_assoc($link->query("SELECT SUM(fees) 
                                  FROM bfp_form4 LEFT JOIN bfp_users ON bfp_users.uid = bfp_form4.uid
                                  WHERE form4_date_added BETWEEN '$l' AND '$l1' 
                                  AND fire_code_fees = '$sharray2' AND bfp_users.municipal='".$sh_user['municipal']."' 
                                  AND bfp_users.location =  '".$report['location']."'"));
                                  echo $count['SUM(fees)'].",";
                  } ?>];

                  new Chart("inspectionchart", {
                    type: "horizontalBar",
                    data: {
                      labels: xValues,
                      datasets: [{
                        backgroundColor: "red",
                        label: "Current Month",
                        data: yValues
                      },{
                        backgroundColor: "blue",
                        label: "Previous Month",
                        data: zValues
                      }]
                    },
                    options: {
                      legend: {display: true},
                      title: {
                        display: true
                      },
                      scales: {
                        yAxes: [{ 
                          ticks: {
                            min: 0,
                          } 
                        }],
                      }
                    }
                  });
                  </script>
                  <div class="row mt-3">
                    <div class="col-lg-12 text-end">
                      <div class="dropdown">
                        <button class="form3-tab btn btn-dark text-white">Back</button>
                        <?php if($report['report_status'] == "Requesting"){?>
                        <button class="Need-Edit btn btn-primary" data-bs-toggle="modal" data-bs-target="#neededit">Need Edit</button>
                        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#approve">Approve</button>
                        <?php }?>
                      </div>
                    </div>
                  </div>
                </div>
                <?php } ?>
              </div>
            </div>
          </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="approve" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Approve this Report</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <form id="approveform" class="modal-body">
                <input type="hidden" name="id" value="<?php echo $_GET['rid']?>">
                Make A Comment
                <textarea name="approvecomment" id="approvecomment" cols="30" rows="10"></textarea>
              </form>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button form="approveform" type="submit" class="btn btn-primary">Confirm</button>
              </div>
            </div>
          </div>
        </div>
        <div class="modal fade" id="neededit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">This Report Need Edit</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <form id="editform" class="modal-body">
                <div class="row">
                  <h6 class="fw-bold">Reason: (You can check as many as you want)</h6>
                  <div class="col-lg-6">
                    <div class="form-check">
                      <label class="form-check-label">
                        <input class="form-check-input" name="reason[]" type="checkbox" value="Wrong Entry of Data">
                        Wrong Entry of Data
                      </label>
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-check">
                      <label class="form-check-label">
                        <input class="form-check-input" name="reason[]" type="checkbox" value="Mismatch">
                        Mismatch
                      </label>
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-check">
                      <label class="form-check-label">
                        <input class="form-check-input" name="reason[]" type="checkbox" value="Missing Record">
                        Missing Record
                      </label>
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-check">
                      <label class="form-check-label">
                        <input class="form-check-input" name="reason[]" type="checkbox" value="Formula Miscalculation">
                        Formula Miscalculation
                      </label>
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-check">
                      <label class="form-check-label">
                        <input class="form-check-input" name="reason[]" type="checkbox" value="Incorrect List">
                        Incorrect List
                      </label>
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-check">
                      <label class="form-check-label">
                        <input class="form-check-input" name="reason[]" type="checkbox" value="Error in forms">
                        Error in forms
                      </label>
                    </div>
                  </div>
                </div>
                <input type="hidden" name="id" value="<?php echo $_GET['rid']?>">
                Specify your Reason
                <textarea name="editcomment" id="editcomment" cols="30" rows="10"></textarea>
              </form>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button form="editform" type="submit" class="btn btn-primary">Confirm</button>
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
  <script>
    $('#approvecomment').summernote({
      placeholder: 'Type here...',
      height: 200,
      toolbar: [
        // [groupName, [list of button]]
        ['style', ['bold', 'italic', 'underline', 'clear']],
        ['font', ['strikethrough', 'superscript', 'subscript']],
        ['fontsize', ['fontsize']],
        ['color', ['color']],
        ['para', ['ul', 'ol', 'paragraph']],
        ['height', ['height']]
      ]
    });
    $('#editcomment').summernote({
      placeholder: 'Type here...',
      height: 200,
      toolbar: [
        // [groupName, [list of button]]
        ['style', ['bold', 'italic', 'underline', 'clear']],
        ['font', ['strikethrough', 'superscript', 'subscript']],
        ['fontsize', ['fontsize']],
        ['color', ['color']],
        ['para', ['ul', 'ol', 'paragraph']],
        ['height', ['height']]
      ]
    });
  </script>
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
  <script src="js/report.js"></script>

  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="../template/js/jquery.cookie.js" type="text/javascript"></script>
  <script src="../template/js/dashboard.js"></script>
  <script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
  <!-- End custom js for this page-->
</body>

</html>