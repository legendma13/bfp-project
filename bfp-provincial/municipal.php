<!DOCTYPE html>
<html lang="en">
<?php include_once "check.php"?>
<?php if(isset($_GET['id'])){ $link->query("UPDATE notification SET click='1', date_created = '".$_GET['date']."' WHERE id = '".$_GET['id']."'");}?>
<?php include_once "head.php"?>
<script>
    $(document).ready( function () {
        $('#reporttable').DataTable();
    } );
</script>
<body>
  <div class="alert alert-success alert-dismissible" id="errorMessage" style="display:none;">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
  </div>
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
          <h1 class="h3 mb-3">Municipal Reports</h1>
          <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb border border-0">
              <li class="breadcrumb-item"><a href="./">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Reports</li>
            </ol>
          </nav>
          <div class="row">
            <div class="col-sm-12">
              <div class="home-tab">
                <div class="card">
                  <div class="card-body">
                    <div class="d-sm-flex align-items-center justify-content-between">
                      <div>
                        <h4 class="card-title">List of Report</h4>
                      </div>
                    </div>
                    <div class="table-responsive">
                      <table id="reporttable" class="table table-striped">
                        <thead>
                          <tr>
                            <th>No</th>
                            <th>Municipal</th>
                            <th>Report<br>Name</th>
                            <th>Start Of Report</th>
                            <th>End Of Report</th>
                            <th>Report Status</th>
                            <th>Report Date Requested</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <?php $i=0?>
                        <tbody>
                          <?php $Qform1 = mysqli_query($link,"SELECT * FROM report 
                          LEFT JOIN bfp_users ON report.uid = bfp_users.uid
                          WHERE bfp_users.municipal = '".$sh_user['municipal']."'
                          ORDER BY report.report_submit DESC")?>
                          <?php while($shform1 = mysqli_fetch_assoc($Qform1)){?>
                            <?php $i++?>
                          <tr>
                            <td><?php echo $i?></td>
                            <td><?php echo $shform1['report_name']?></td>
                            <td><?php echo $shform1['location']?></td>
                            <td><?php echo $shform1['start_report']?></td>
                            <td><?php echo $shform1['end_report']?></td>
                            <td>
                              <?php if ($shform1['report_status'] == "Requesting") {
                                echo '<span class="badge bg-warning">' . $shform1['report_status'] . '</span>';
                              } elseif($shform1['report_status'] == "Approved") {
                                echo '<span class="badge bg-primary">' . $shform1['report_status'] . '</span>';
                              } else {
                                echo '<span class="badge bg-success">' . $shform1['report_status'] . '</span>';
                              }?>
                            </td>
                            <td><?php echo $shform1['report_submit']?></td>
                            <td>
                              <a href="View-report.php?rid=<?php echo $shform1['report_id']?>&start=<?php echo $shform1['start_report']?>&end=<?php echo $shform1['end_report']?>">
                                <button type="button" class="btn btn-primary p-2 text-white">
                                  View
                                </button>
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
  <script src="js/sendreport.js"></script>
  <!-- Confirm -->
  <script src="../js/confirm.js"></script>
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
  <script src="../template/js/Chart.roundedBarCharts.js"></script>
  <script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
  <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
  <!-- End custom js for this page-->
</body>

</html>

