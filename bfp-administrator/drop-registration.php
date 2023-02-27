<!DOCTYPE html>
<html lang="en">
<?php include_once "check.php"?>
<?php include_once "head.php"?>
<script>
  $(document).ready( function () {
      $('#myTable').DataTable();
  } );
</script>
<body>
    <div class="alert alert-success alert-dismissible" id="errorMessage" style="display:none;">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
    </div>
  <div class="container-scroller">
    
    <!-- partial:partials/_navbar.html -->
    <nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex align-items-top flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
        <div class="me-3">
          <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-bs-toggle="minimize">
            <span class="icon-menu"></span>
          </button>
        </div>
        <div>
          <a class="navbar-brand brand-logo" href="index.html">
            <img src="../assets/bfp-logo.png" alt="logo" />
          </a>
          <a class="navbar-brand brand-logo-mini" href="index.html">
            <img src="../assets/bfp-logo.png" alt="logo" />
          </a>
        </div>
      </div>
      <?php include_once "topnav.php"?>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_settings-panel.html -->
      <?php include_once "setting.php"?>
      <!-- partial:partials/_sidebar.html -->
      <?php include_once "sidenav.php"?>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <h1 class="h3 mb-3">Dropped Registration</h1>
          <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb border border-0">
              <li class="breadcrumb-item"><a href="./">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Dropped Registration</li>
            </ol>
          </nav>
          <div class="row">
            <div class="col-sm-12">
              <div class="home-tab">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">DROP REGISTRATION TABLE</h4>
                    <div class="table-responsive">
                      <table id="myTable" class="table table-striped">
                        <thead>
                          <tr>
                            <th>User Code</th>
                            <th>Position</th>
                            <th>User</th>
                            <th>Status</th>
                            <th>Date Drop</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php $new_registerQuery = $link->query("SELECT * FROM bfp_users WHERE status='drop' 
                          and position != 'Admin' ORDER BY date_created dESC")?>
                          <?php while($new_register = $new_registerQuery->fetch_assoc()){?>
                          <tr>
                            <td><?php echo $new_register['username']?></td>
                            <td><?php echo $new_register['position']?></td>
                            <td><?php echo $new_register['location']?></td>
                            <td><span class="badge bg-danger"><?php echo $new_register['status']?></span></td>
                            <td><?php echo $new_register['date_created']?></td>
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

