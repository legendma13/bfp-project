<!DOCTYPE html>
  <?php include_once "check.php"?>
  <html lang="en">
  <?php include_once "head.php"?>
  <body>
    <div class="container-scroller">
      <!-- partial:partials/_navbar.html -->
      <?php include_once "topnav.php"?>
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_settings-panel.html -->
        <?php include_once "setting.php"?>
        <!-- partial:partials/_sidebar.html -->
        <?php include_once "sidenav.php"?>
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
            <h1 class="h3 mb-3">Dashboard</h1>
            <div class="row">
              <div class="col-sm-12">
                <div class="home-tab">
                  <div class="d-sm-flex align-items-center justify-content-between border-bottom">
                    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                      <ol class="breadcrumb border-0">
                        <li class="breadcrumb-item active"><a href="./">Home</a></li>
                      </ol>
                    </nav>
                    <div>
                      <div class="btn-wrapper">
                        <a href="#" class="btn btn-success text-white me-0" data-bs-toggle="modal" data-bs-target="#pdfmodal"><i class="mdi mdi-file-pdf"></i> Export PDF</a>
                        <a href="#" class="btn btn-primary text-white me-0" data-bs-toggle="modal" data-bs-target="#excelmodal"><i class="icon-download"></i> Export Excel</a>
                      </div>
                    </div>
                  </div>
                  <div class="tab-content tab-content-basic">
                  <div class="tab-pane fade show active" id="Overview" role="tabpanel" aria-labelledby="Overview">
                  <?php $query = mysqli_fetch_assoc($link->query("SELECT COUNT(CASE WHEN M_report_status='Approved' THEN 1 END) as 'approved', 
                    COUNT(CASE WHEN M_report_status='Requesting' THEN 1 END) as 'Requesting',
                    COUNT(CASE WHEN M_report_status='Need Edit' THEN 1 END) as 'NeedEdit' 
                    FROM m_report LEFT JOIN bfp_users ON bfp_users.uid = m_report.M_uid"))?>
                    <div class="tab-pane fade show active" id="Overview" role="tabpanel" aria-labelledby="Overview">
                    <div class="row mb-3">
                      <div class="col-lg-4">
                        <div class="card" style="border-left: 5px solid orange;border-right: 5px solid orange;">
                          <div class="card-header fw-bold d-flex justify-content-between">
                            Approved Report
                            <div class="dropdown">
                              <button class="bg-transparent border border-0" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="mdi mdi-menu"></i>
                              </button>
                              <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="Provincial.php">View Report</a></li>
                              </ul>
                            </div>
                          </div>
                          <div class="card-body fw-bold">
                            <h3><?php echo $query['approved']?></h3>
                          </div>
                        </div>
                      </div>
                      <div class="col-lg-4">
                        <div class="card" style="border-left: 5px solid orange;border-right: 5px solid orange;">
                          <div class="card-header fw-bold d-flex justify-content-between">
                            Pending Report
                            <div class="dropdown">
                              <button class="bg-transparent border border-0" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="mdi mdi-menu"></i>
                              </button>
                              <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="Provincial.php">View Report</a></li>
                              </ul>
                            </div>
                          </div>
                          <div class="card-body">
                            <h3><?php echo $query['Requesting']?></h3>
                          </div>
                        </div>
                      </div>
                      <div class="col-lg-4">
                        <div class="card" style="border-left: 5px solid orange;border-right: 5px solid orange;">
                          <div class="card-header fw-bold d-flex justify-content-between">
                            Need Edit Report
                            <div class="dropdown">
                              <button class="bg-transparent border border-0" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="mdi mdi-menu"></i>
                              </button>
                              <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="Provincial.php">View Report</a></li>
                              </ul>
                            </div>
                          </div>
                          <div class="card-body">
                            <h3><?php echo $query['NeedEdit']?></h3>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <!-- Yearly Graph -->
                      <div class="col-lg-8 mb-3 overflow-auto">
                        <div class="row flex-row flex-nowrap">
                          <div class="card me-3">
                            <div class="card-body">
                            <?php  
                              $now = date('Y');
                              $minus5year = $now - 5;
                              $lastday = date('t');
                            ?>
                            <h4 class="text-center">Yearly Total Number Application Received</h4>
                            <canvas id="yearlyf1" style="width:100%;"></canvas>
                            <script>
                              var xArray = [<?php
                                            for($i=$minus5year; $i<=$now;$i++){
                                                echo "'$i',";
                                            }
                                            ?>];
                              var yArray = [<?php
                                            for($a=$minus5year; $a<=$now;$a++){
                              $countallappyear = mysqli_fetch_assoc(mysqli_query($link,"SELECT COUNT(form1_id) FROM bfp_form1 
                              WHERE form1_date_added BETWEEN '$a-1-1 00-00-01' AND '$a-12-$lastday 23-59-59'
                              AND form1_status = '1'"));
                                              if($countallappyear['COUNT(form1_id)'] == null){
                                                  echo '0,';
                                                } else{
                                                  echo $countallappyear['COUNT(form1_id)'].',';
                                                }
                                              }
                                            ?>
                              ];
                              var zArray = [<?php
                                            for($a=$minus5year; $a<=$now;$a++){
                              $zArray = mysqli_fetch_assoc(mysqli_query($link,"SELECT COUNT(form2_id) FROM bfp_form2 
                              WHERE form2_date_added BETWEEN '$a-1-1 00-00-01' AND '$a-12-$lastday 23-59-59' 
                              AND form2_status = '1';"));
                                              if($zArray['COUNT(form2_id)'] == null){
                                                  echo '0,';
                                                } else{
                                                  echo $zArray['COUNT(form2_id)'].',';
                                                }
                                              }
                                            ?>
                              ];
                              var cArray = [<?php
                                            for($a=$minus5year; $a<=$now;$a++){
                              $cArray = mysqli_fetch_assoc(mysqli_query($link,"SELECT COUNT(form3_id) FROM bfp_form3
                              WHERE form3_date_added BETWEEN '$a-1-1 00-00-01' AND '$a-12-$lastday 23-59-59'
                              AND form3_status = '1';"));
                                              if($cArray['COUNT(form3_id)'] == null){
                                                  echo '0,';
                                                } else{
                                                  echo $cArray['COUNT(form3_id)'].',';
                                                }
                                              }
                                            ?>
                              ];
                              new Chart("yearlyf1", {
                                type: "bar",
                                data: {
                                  labels: xArray,
                                  datasets: [{
                                    fill: true,
                                    lineTension: 0,
                                    label: "Total Number Application Received (New Building)",
                                    backgroundColor: "rgba(0,0,255,0.4)",
                                    borderColor: "rgba(0,0,255,0.1)",
                                    data: yArray
                                  },{
                                    fill: true,
                                    lineTension: 0,
                                    label: "Number of Applications Received for BUSINESS ESTABLISHMENTS",
                                    backgroundColor: "rgba(0,255,0,0.4)",
                                    borderColor: "rgba(0,0,255,0.1)",
                                    data: zArray
                                  },{
                                    fill: true,
                                    lineTension: 0,
                                    label: "Number of Applications Received for GOVERNMENT ESTABLISHMENTS",
                                    backgroundColor: "rgba(255,0,0,0.4)",
                                    borderColor: "rgba(0,0,255,0.1)",
                                    data: cArray
                                  }]
                                },
                                options: {
                                  legend: {display: true},
                                  scales: {
                                    yAxes: [{ticks: {min:0}}],
                                  }
                                }
                              });
                            </script>
                            </div>
                          </div>
                          <div class="card">
                            <div class="card-body">
                            <?php  
                              $now = date('Y-m-d');
                              $nowmonth = date('n');
                              $minus5month = date('n', strtotime($now . ' - 5 month'));
                              $datamonthnow = date('n');
                              $dataminus5month = date('n', strtotime($now . ' - 5 month'));
                              $minus5month12 = date('Y-m-d', strtotime($now . ' - 5 month'));
                              $minus5m = date('Y-m-d', strtotime($now . ' - 5 month'));
                            ?>
                            <h4 class="text-center">Montly Total Number Application Received</h4>
                            <canvas id="monthly" style="width:100%;"></canvas>
                            <script>
                              var xArray = [<?php 
                                          while ($nowmonth != $minus5month) {
                                            $minus5month = date('n', strtotime($minus5month12 . ' + 1 month'));
                                            $minus5month1 = date('Y-m-d', strtotime($minus5month12 . ' + 1 month'));
                                            $monthofthis = date('M', strtotime($minus5month1));
                                            $minus5month12 = $minus5month1;
                                            echo "'" . $monthofthis . "'" . ',';
                                          }
                                          ?>];
                              var yArray = [<?php 
                                            while($datamonthnow != $dataminus5month){
                                              $dataminus5month = date('n', strtotime($minus5m . ' + 1 month'));
                                              $minus5 = date('Y-m-d', strtotime($minus5m . ' + 1 month'));
                                              $monthofth = date('Y-n-1', strtotime($minus5));
                                              $monthofth1 = date('Y-n-t', strtotime($minus5));
                                              $minus5m = $minus5;
                                              $monthrequest = mysqli_fetch_assoc(mysqli_query($link, "SELECT COUNT(form1_id) FROM bfp_form1 
                                              WHERE form1_date_added BETWEEN '$monthofth 00-00-01' AND '$monthofth1 23-59-59' 
                                              AND form1_status = '1';"));
                                              if($monthrequest['COUNT(form1_id)'] == ""){
                                                $monthrequest['COUNT(form1_id)'] = 0;
                                              }
                                              echo $monthrequest['COUNT(form1_id)'] . ',';
                                            }
                                            ?>];
                                            <?php $minus5m = date('Y-m-d', strtotime($now . ' - 5 month'));?>
                                            <?php $dataminus5month = date('n', strtotime($now . ' - 5 month'));?>
                              var zArray = [<?php 
                                            while($datamonthnow != $dataminus5month){
                                              $dataminus5month = date('n', strtotime($minus5m . ' + 1 month'));
                                              $minus5 = date('Y-m-d', strtotime($minus5m . ' + 1 month'));
                                              $monthofth = date('Y-n-1', strtotime($minus5));
                                              $monthofth1 = date('Y-n-t', strtotime($minus5));
                                              $minus5m = $minus5;
                                              $monthrequest = mysqli_fetch_assoc(mysqli_query($link, "SELECT COUNT(form2_id) FROM bfp_form2 
                                              WHERE form2_date_added BETWEEN '$monthofth 00-00-01' AND '$monthofth1 23-59-59'
                                              AND form2_status = '1';"));

                                              if($monthrequest['COUNT(form2_id)'] == ""){
                                                $monthrequest['COUNT(form2_id)'] = 0;
                                              }
                                              echo $monthrequest['COUNT(form2_id)'] . ',';
                                            }
                                            ?>];
                                            <?php $minus5m = date('Y-m-d', strtotime($now . ' - 5 month'));?>
                                            <?php $dataminus5month = date('n', strtotime($now . ' - 5 month'));?>
                              var cArray = [<?php 
                                            while($datamonthnow != $dataminus5month){
                                              $dataminus5month = date('n', strtotime($minus5m . ' + 1 month'));
                                              $minus5 = date('Y-m-d', strtotime($minus5m . ' + 1 month'));
                                              $monthofth = date('Y-n-1', strtotime($minus5));
                                              $monthofth1 = date('Y-n-t', strtotime($minus5));
                                              $minus5m = $minus5;
                                              $monthrequest = mysqli_fetch_assoc(mysqli_query($link, "SELECT COUNT(form3_id) FROM bfp_form3 
                                              WHERE form3_date_added BETWEEN '$monthofth 00-00-01' AND '$monthofth1 23-59-59'
                                              AND form3_status = '1';"));
                                              if($monthrequest['COUNT(form3_id)'] == ""){
                                                $monthrequest['COUNT(form3_id)'] = 0;
                                              }
                                              echo $monthrequest['COUNT(form3_id)'] . ',';
                                            }
                                            ?>];
                              new Chart("monthly", {
                                type: "bar",
                                data: {
                                  labels: xArray,
                                  datasets: [{
                                    fill: true,
                                    lineTension: 0,
                                    label: "Total Number Application Received (New Building)",
                                    backgroundColor: "rgba(0,0,255,0.5)",
                                    borderColor: "rgba(0,0,255,0.1)",
                                    data: yArray
                                  },{
                                    fill: true,
                                    lineTension: 0,
                                    label: "Number of Applications Received for BUSINESS ESTABLISHMENTS",
                                    backgroundColor: "rgba(0,255,0,0.5)",
                                    borderColor: "rgba(0,0,255,0.1)",
                                    data: zArray
                                  },{
                                    fill: true,
                                    lineTension: 0,
                                    label: "Number of Applications Received for GOVERNMENT ESTABLISHMENTS",
                                    backgroundColor: "rgba(255,0,0,0.5)",
                                    borderColor: "rgba(0,0,255,0.1)",
                                    data: cArray
                                  }]
                                },
                                options: {
                                  legend: {display: true},
                                  scales: {
                                    yAxes: [{ticks: {min: 0}}],
                                  }
                                }
                              });
                            </script>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- Pie -->
                      <div class="col-lg-4">
                        <div class="card mb-3">
                          <div class="card-body text-center">
                            <h1 id="clock"></h1>
                            <script>
                              function currentTime() {
                                let date = new Date(); 
                                let hh = date.getHours();
                                let mm = date.getMinutes();
                                let ss = date.getSeconds();
                                let session = "AM";

                                if(hh === 0){
                                    hh = 12;
                                }
                                if(hh > 12){
                                    hh = hh - 12;
                                    session = "PM";
                                }

                                hh = (hh < 10) ? "0" + hh : hh;
                                mm = (mm < 10) ? "0" + mm : mm;
                                ss = (ss < 10) ? "0" + ss : ss;
                                  
                                let time = hh + ":" + mm + ":" + ss + " " + session;

                                document.getElementById("clock").innerText = time; 
                                let t = setTimeout(function(){ currentTime() }, 1000);
                              }

                              currentTime();
                            </script>
                          </div>
                        </div>
                        <div class="card">
                          <div class="card-body">
                            <div id="piegraph" class="carousel slide" data-bs-ride="carousel">
                              <div class="carousel-inner">
                                <div class="carousel-item active">
                                  <h4 class="text-center">(New Building)<br>Total Number Application Received</h4>
                                  <canvas id="lastyearvcurrent" style="width:100%;"></canvas>
                                </div>
                                <div class="carousel-item">
                                  <h4 class="text-center">Number of Applications Received for BUSINESS ESTABLISHMENTS</h4>
                                  <canvas id="businessEstab" style="width:100%;"></canvas>
                                </div>
                                <div class="carousel-item">
                                  <h4 class="text-center">Number of Applications Received for GOVERNMENT ESTABLISHMENTS</h4>
                                  <canvas id="govEstab" style="width:100%;"></canvas>
                                </div>
                              </div>
                              <button class="carousel-control-prev" type="button" data-bs-target="#piegraph" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                              </button>
                              <button class="carousel-control-next" type="button" data-bs-target="#piegraph" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                              </button>
                            </div>

                            <?php $yearngayon = date('Y-1-1')?>
                            <?php $yearngayonlastday = date('Y-12-t')?>
                            <?php $dataminus1year = date('Y-1-1', strtotime($yearngayon . ' - 1 year'));?>
                            <?php $dataminus1yearlastday = date('Y-12-t', strtotime($yearngayon . ' - 1 year'));?>
                            
                            <?php $currentmonth = mysqli_fetch_assoc(mysqli_query($link,"SELECT COUNT(form1_id) FROM bfp_form1 
                            WHERE form1_date_added BETWEEN '$yearngayon 00-00-01' AND '$yearngayonlastday 23-59-59'
                            AND form1_status = '1';"))?>
                            <?php $reviewsmonth = mysqli_fetch_assoc(mysqli_query($link,"SELECT COUNT(form1_id) FROM bfp_form1
                            WHERE form1_date_added BETWEEN '$dataminus1year 00-00-01' AND '$dataminus1yearlastday 23-59-59'
                            AND form1_status = '1';"))?>

                            <?php $be = mysqli_fetch_assoc(mysqli_query($link,"SELECT COUNT(form2_id) FROM bfp_form2 
                            WHERE form2_date_added BETWEEN '$yearngayon 00-00-01' AND '$yearngayonlastday 23-59-59'
                            AND form2_status = '1';"))?>
                            <?php $be2 = mysqli_fetch_assoc(mysqli_query($link,"SELECT COUNT(form2_id) FROM bfp_form2 
                            WHERE form2_date_added BETWEEN '$dataminus1year 00-00-01' AND '$dataminus1yearlastday 23-59-59'
                            AND form2_status = '1';"))?>

                            <?php $ge = mysqli_fetch_assoc(mysqli_query($link,"SELECT COUNT(form3_id) FROM bfp_form3 
                            WHERE form3_date_added BETWEEN '$yearngayon 00-00-01' AND '$yearngayonlastday 23-59-59'
                            AND form3_status = '1';"))?>
                            <?php $ge2 = mysqli_fetch_assoc(mysqli_query($link,"SELECT COUNT(form3_id) FROM bfp_form3 
                            WHERE form3_date_added BETWEEN '$dataminus1year 00-00-01' AND '$dataminus1yearlastday 23-59-59'
                            AND form3_status = '1';"))?>

                            <script>
                              var xArray = ["Current Year Data", "Previous Year Data"];
                              var yArray = [<?php echo $currentmonth['COUNT(form1_id)']?>,
                              <?php if($reviewsmonth['COUNT(form1_id)'] == ""){ echo '0';}else{ echo $reviewsmonth['COUNT(form1_id)'];} ?>];
                              //Form1
                              new Chart("lastyearvcurrent", {
                                type: "doughnut",
                                data: {
                                  labels: xArray,
                                  datasets: [{
                                    backgroundColor: ["red","blue"],
                                    data: yArray
                                  }]
                                },
                                options: {
                                  title: {
                                    display: true,
                                    text: "Current Data VS Previous Data"
                                  }
                                }
                              });
                              //Form2
                              var yArray = [<?php echo $be['COUNT(form2_id)']?>,
                              <?php if($be2['COUNT(form2_id)'] == ""){ echo '0';}else{ echo $be2['COUNT(form2_id)'];} ?>];
                              new Chart("businessEstab", {
                                type: "doughnut",
                                data: {
                                  labels: xArray,
                                  datasets: [{
                                    backgroundColor: ["red","blue"],
                                    data: yArray
                                  }]
                                },
                                options: {
                                  title: {
                                    display: true,
                                    text: "Current Data VS Previous Data"
                                  }
                                }
                              });
                              var yArray = [<?php echo $ge['COUNT(form3_id)']?>,
                              <?php if($ge2['COUNT(form3_id)'] == ""){ echo '0';}else{ echo $ge2['COUNT(form3_id)'];} ?>];
                              new Chart("govEstab", {
                                type: "doughnut",
                                data: {
                                  labels: xArray,
                                  datasets: [{
                                    backgroundColor: ["red","blue"],
                                    data: yArray
                                  }]
                                },
                                options: {
                                  title: {
                                    display: true,
                                    text: "Current Data VS Previous Data"
                                  }
                                }
                              });
                            </script>
                          </div>
                        </div>
                      </div>
                    </div>

                    <?php $provinceArray = array("Batangas","Cavite","Laguna","Quezon","Rizal")?>
                    <div class="row">
                      <div class="col-lg-12 mt-3">
                        <div class="card chart-container p-2" style="position: relative;height:auto; width:80vw">
                          <canvas id="municipalchart"></canvas>
                          <script>
                          var xValues = ["Batangas","Cavite","Laguna","Quezon","Rizal"];
                          var f1Values = [
                            <?php foreach($provinceArray as $p1){
                              $f1ProvinceReport = mysqli_fetch_assoc($link->query("SELECT COUNT(bfp_form1.uid) FROM bfp_form1
                              LEFT JOIN bfp_users ON bfp_users.uid = bfp_form1.uid
                              WHERE bfp_users.municipal = '$p1' AND bfp_users.status = 'true' AND bfp_users.position = 'Municipal'
                              AND bfp_form1.form1_status = '1'"));
                              echo "'" . $f1ProvinceReport['COUNT(bfp_form1.uid)'] . "',";
                            }?>
                          ];
                          var f2Values = [
                            <?php foreach($provinceArray as $p1){
                              $f2ProvinceReport = mysqli_fetch_assoc($link->query("SELECT COUNT(bfp_form2.uid) FROM bfp_form2
                              LEFT JOIN bfp_users ON bfp_users.uid = bfp_form2.uid
                              WHERE bfp_users.municipal = '$p1' AND bfp_users.status = 'true' AND bfp_users.position = 'Municipal'
                              AND bfp_form2.form2_status = '1'"));
                              echo "'" . $f2ProvinceReport['COUNT(bfp_form2.uid)'] . "',";
                            }?>
                          ];
                          var f3Values = [
                            <?php foreach($provinceArray as $p1){
                              $f3ProvinceReport = mysqli_fetch_assoc($link->query("SELECT COUNT(bfp_form3.uid) FROM bfp_form3
                              LEFT JOIN bfp_users ON bfp_users.uid = bfp_form3.uid
                              WHERE bfp_users.municipal = '$p1' AND bfp_users.status = 'true' AND bfp_users.position = 'Municipal'
                              AND bfp_form3.form3_status = '1'"));
                              echo "'" . $f3ProvinceReport['COUNT(bfp_form3.uid)'] . "',";
                            }?>
                          ];
                          var f4Values = [
                            <?php foreach($provinceArray as $p1){
                              $f4ProvinceReport = mysqli_fetch_assoc($link->query("SELECT COUNT(bfp_form4.uid) FROM bfp_form4
                              LEFT JOIN bfp_users ON bfp_users.uid = bfp_form4.uid
                              WHERE bfp_users.municipal = '$p1' AND bfp_users.status = 'true' AND bfp_users.position = 'Municipal'
                              AND bfp_form4.form4_status = '1'"));
                              echo "'" . $f4ProvinceReport['COUNT(bfp_form4.uid)'] . "',";
                            }?>
                          ];

                          new Chart("municipalchart", {
                            type: "bar",
                            data: {
                              labels: xValues,
                              datasets: [{
                                backgroundColor: "rgb(0, 0, 255,0.5)",
                                label: "New Building",
                                data: f1Values
                              },
                              {
                                backgroundColor: "rgb(0, 255, 0,0.5)",
                                label: "Business Operation",
                                data: f2Values
                              },
                              {
                                backgroundColor: "rgb(255, 0, 0,0.5)",
                                label: "Government Building",
                                data: f3Values
                              },
                              {
                                backgroundColor: "rgb(255, 255, 0,0.5)",
                                label: "Fire Code Fees Collection",
                                data: f4Values
                              }]
                            },
                            options: {
                              legend: {display: true},
                              responsive: true,
                              title: {
                                display: true,
                                text: "Total Application Per Provincial",
                                fontSize: 18
                              },scales: {
                                yAxes: [{ticks: {min: 0}}]
                              }
                            }
                          });
                          </script>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- Modal -->
          <div class="modal fade" id="excelmodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="staticBackdropLabel">Export EXCEL</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="excelform" action="../admin-sheet.php" method="GET" class="modal-body">
                  <div class="row">
                    <div class="col-lg-6">
                      Start
                      <input type="date" value="<?php echo date('Y-m-01')?>" name="start" id="start" class="form-control" required>
                    </div>
                    <div class="col-lg-6">
                      End
                      <input type="date" value="<?php echo date('Y-m-t')?>" name="end" id="end" class="form-control" required>
                    </div>
                  </div>
                  <div id="alert-download" class="alert alert-warning text-dark mt-3" role="alert" style="display:none">
                    Please wait for your file to be Download
                  </div>
                </form>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <button form="excelform" type="submit" id="download-click" class="btn btn-primary">Download</button>
                </div>
              </div>
            </div>
          </div>
          <script>
            $(document).ready(function(){
              $("#download-click").click(function(){
                $("#alert-download").show(700);
              });
            });
          </script>
          <!-- Modal -->
          <div class="modal fade" id="pdfmodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="staticBackdropLabel">Export PDF</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="pdfform" action="../pdfreport.php" method="GET" target="_blank" class="modal-body">
                  <div class="row">
                    <input type="hidden" name="office" value="<?php echo $sh_user['location'].', '.$sh_user['municipal']?>" id="">
                    <div class="col-lg-6">
                      Start
                      <input type="date" value="<?php echo date('Y-m-01')?>" name="start" id="start" class="form-control" required>
                    </div>
                    <div class="col-lg-6">
                      End
                      <input type="date" value="<?php echo date('Y-m-t')?>" name="end" id="end" class="form-control" required>
                    </div>
                  </div>
                </form>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <button form="pdfform" type="submit" class="btn btn-primary">View PDF Report</button>
                </div>
              </div>
            </div>
          </div>
          <!-- content-wrapper ends -->
          <!-- partial:partials/_footer.html -->
          <?php include_once "footer.php"?>
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

