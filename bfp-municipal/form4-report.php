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
                      SUMMARY ACCOMPLISHMENT REPORT ON FIRE CODE FEES COLLECTION For <?php echo $_GET['year'] . "-" . $_GET['month'] ?>
                      </a>
                    </li>
                  </ul>
                </div>
              </div>
              <div class="row mb-3">
                <?php if (isset($_GET['year']) and isset($_GET['month'])) {
                 $feesarray = array("Fire Code Construction","Fire Code Realty","Fire Code Premuim","Fire Code Sales","Fire Code Proceeds Tax","Fire Code Fees for Occupancy",
                 "Fire Code Fees for Business","Storage Clearance Fee","Conveyance Cleance Fee","Installation of Building Service Equipment","Installation of AFSS",
                 "Installation of FDAS","Installation of KHSS","Installation of Flammable and Combustible Liquids Storage Tanks","Installation of LPGAS System","Other Installation Clearances",
                 "Fire Code Administrative Fines","Fireworks Display","Electrical Installation","Filing Fees for FSEC","Certified True Copy of FSEC/FSIC/ Other Clearances",
                 "Fumigation/Fogging","Fire Incident Clearance","Protest Fee","Fire Drill","Appeal Fee",
                 "Open Flame","Fire Prevention and Safety Seminar","Soundstage and Approved Production Facilities and Locations","Welding, Cutting and Other Hotworks","Others",
                 "Certificate of Competency (COC) Fees");
                  $searchyear = $_GET['year'];
                  $searchmonth = $_GET['month'];
                  $lday = date('Y-m-t',strtotime($searchyear.'-'.$searchmonth));
                  $l = date('Y-m-01', strtotime($lday. " - 1 month"));
                  $l1 = date('Y-m-t', strtotime($lday. " - 1 month"));
                ?>
                <div class="row card">
                  <div class="col-lg-12 card-body">
                    <h3 class="card-title text-center">SUMMARY ACCOMPLISHMENT REPORT ON FIRE CODE FEES COLLECTION</h3>
                    <canvas id="inspectionchart" style="width:100%;max-height:700px"></canvas>
                  </div>
                </div>
                  <script>
                  var xValues = [<?php foreach ($feesarray as $sharray) { ?>
                                  <?php echo "'" . $sharray . "'," ?>
                                <?php } ?>];
                  var yValues = [<?php foreach ($feesarray as $sharray1) {
                                  $count = mysqli_fetch_assoc($link->query("SELECT SUM(fees) 
                                  FROM bfp_form4 WHERE form4_date_added BETWEEN '$searchyear-$searchmonth-01' AND '$lday' 
                                  AND fire_code_fees = '$sharray1' AND uid = '$uid'"));
                                  echo $count['SUM(fees)'].",";
                                } ?>];
                  var zValues = [<?php foreach ($feesarray as $sharray2) {
                    $count = mysqli_fetch_assoc($link->query("SELECT SUM(fees) 
                    FROM bfp_form4 WHERE form4_date_added BETWEEN '$l' AND '$l1' 
                    AND fire_code_fees = '$sharray2' AND uid = '$uid'"));
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