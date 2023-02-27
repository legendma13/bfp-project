<!DOCTYPE html>
<?php include_once "check.php"?>
<html lang="en">
<?php $report = mysqli_fetch_assoc(mysqli_query($link,"SELECT * FROM bfp_form4 
WHERE form4_id = '".$_GET['reportid']."' LIMIT 1"))?>
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
          <div class="row">
            <div class="alert alert-success alert-dismissible" id="errorMessage" style="display:none;">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
            </div>
            <h3> SUMMARY ACCOMPLISHMENT REPORT ON FIRE CODE FEES COLLECTION </h3>
            <div class="col-sm-12">
              <div class="home-tab">
                <div class="tab-content tab-content-basic">
                  <form id="form4-edit" class="tab-pane fade show active was-validated"> 
                    <input type="hidden" name="id" value="<?php echo $report['form4_id']?>">
                    <div class="col-lg-12 mb-3">
                      <div class="card mb-3">
                        <div class="card-body">
                          <h4 class="card-title">Profile</h4>
                          <dl class="row">
                            <dt class="col-lg-3 mb-3 fs-6">Name :</dt>
                            <dt class="col-lg-3">
                              First Name
                              <input type="text" name="fname" value="<?php echo $report['fname']?>" class="form-control mb-3" id="fname" placeholder="First Name" readonly>
                            </dt>
                            <dt class="col-lg-3">
                              Middle Name
                              <input type="text" name="mname" value="<?php echo $report['mname']?>" class="form-control mb-3" id="mname" placeholder="Middle Name" readonly>
                            </dt>
                            <dt class="col-lg-3">
                              Last Name
                              <input type="text" name="lname" value="<?php echo $report['lname']?>" class="form-control mb-3" id="lname" placeholder="Last Name" readonly>
                            </dt>
                            <!-- Gender -->
                            <dt class="col-lg-3 mb-3 fs-6">Gender :</dt>
                            <dt class="col-lg-9 mb-3 d-flex justify-content-start">
                              <input type="text" class="form-control" value="<?php echo $report['gender']?>" readonly>
                            </dt>
                            <dt class="col-lg-3 fs-6">Birth Day :</dt>
                            <dt class="col-lg-9 mb-3">
                              <input type="date" value="<?php echo $report['bday']?>" name="bday" class="form-control" readonly>
                            </dt>
                            <dt class="col-lg-3 fs-6">Barangay :</dt>
                            <dt class="col-lg-9">
                              <input type="text" class="form-control" value="<?php echo $report['brgy']?>" readonly>
                            </dt>
                            <dt class="col-lg-3 fs-6">Choose What Type :</dt>
                            <dt class="col-lg-9">
                              <input type="text" class="form-control" value="<?php echo $report['type']?>" readonly>
                            </dt>
                            <dt class="col-lg-3 fs-6">FIRE CODE FEES COLLECTION</dt>
                            <dt class="col-lg-9">
                              <input type="text" class="form-control" value="<?php echo $report['fire_code_fees']?>" readonly>
                            </dt>
                          </dl>                          
                          <div class="row">
                            <div class="col text-end">
                              <a href="form4-table.php"><button type="button" class="btn btn-dark text-white p-3 m-0">Back</button></a>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </form>
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
  <script src="js/addform.js"></script>
  <script src="../js/hideandshow.js"></script>
  <!-- Custom js for this page-->
  <script src="../template/js/jquery.cookie.js" type="text/javascript"></script>
  <script src="../template/js/dashboard.js"></script>
  <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
  <!-- End custom js for this page-->
</body>

</html>

