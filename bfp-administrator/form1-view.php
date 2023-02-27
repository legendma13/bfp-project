<!DOCTYPE html>
<?php include_once "check.php"?>
<html lang="en">
<?php $report = mysqli_fetch_assoc(mysqli_query($link,"SELECT * FROM bfp_form1 
LEFT JOIN structure ON bfp_form1.structure = structure.structure_id
WHERE bfp_form1.form1_id = '".$_GET['reportid']."' LIMIT 1"))?>
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
            <h3>NEWLY CONSTRUCTED BUILDING, (RENOVATION, REPAIR, MODIFIED)</h3>
            <div class="col-sm-12">
              <div class="home-tab">
                <div class="tab-content tab-content-basic">
                  <form id="form1-edit" class="tab-pane fade show active">
                    <input type="hidden" name="id" value="<?php echo $_GET['reportid']?>">
                    <div class="row was-validated" id="FSEC">
                      <div class="row">
                        <div class="col-lg-12 mb-3">
                          <div class="card mb-3">
                            <div class="card-body">
                              <h4 class="card-title">Profile</h4>
                              <dl class="row">
                                <!-- Name -->
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
                                  <input type="text" name="gender" value="<?php echo $report['gender']?>" class="form-control" id="gender" placeholder="gender" readonly>
                                </dt>
                                <dt class="col-lg-3 mb-3 fs-6">Birth Day :</dt>
                                <dt class="col-lg-9 mb-3">
                                  <input type="date" value="<?php echo $report['bday']?>" name="bday" class="form-control" readonly>
                                </dt>
                                <dt class="col-lg-3 mb-3 fs-6">Barangay :</dt>
                                <dt class="col-lg-9">
                                  <input type="text" value="<?php echo $report['brgy']?>" name="brgy" class="form-control" readonly>
                                </dt>
                              </dl>
                            </div>
                          </div>
                          <div class="card mb-3">
                            <div class="card-body">
                              <h4 class="card-title">A.) FSEC</h4>
                              <dl class="row">
                                <dt class="col-sm-3 fs-6">
                                  What type of buildings?
                                </dt>
                                <dt class="col-lg-9">
                                  <input type="text" value="<?php echo $report['type']?>" name="type" class="form-control" readonly>
                                </dt>
                              </dl>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-lg-12">
                              <div class="card">
                                <div class="card-body">
                                  <h4 class="card-title">B.) 1st INSPECTION FOR FSIC (OCCUPANCY PERMIT)</h4>
                                  <?php $read_structure_query = $link->query("SELECT * FROM structure") ?>
                                  <dl class="row">
                                    <dt class="col-sm-6 fs-6">What structure?</dt>
                                    <dt class="col-sm-6 mb-3">
                                      <input type="text" value="<?php echo $report['lbl']?>" name="lbl" class="form-control" readonly>
                                    </dt>
                                    <dt class="col-sm-6 fs-6">Newly Constructed / Renovation, Repair, Modified</dt>
                                    <dt class="col-sm-6">
                                      <input type="text" value="<?php echo $report['nc_or_rn']?>" name="nc_or_rn" class="form-control" readonly>
                                    </dt>
                                  </dl>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-lg-12">
                          <div class="card mb-3">
                            <div class="card-body">
                              <dl class="row">
                                <dt class="col-sm-6 fs-6">Inspection during Under Construction</dt>
                                <dt class="col-sm-6 mb-3">
                                  <input type="text" value="<?php echo $report['inspection']?>" name="inspection" class="form-control" readonly>
                                </dt>
                                <dt class="col-sm-6 fs-6">Issuances</dt>
                                <dt class="col-sm-6">
                                  <input type="text" value="<?php echo $report['issuance']?>" name="issuance" class="form-control" readonly>
                                </dt>
                              </dl>
                              <div class="row">
                                <div class="col text-end">
                                  <a href="form1-table.php"><button type="button" class="btn btn-dark text-white p-3 m-0">Back</button></a>
                                </div>
                              </div>
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
  <script src="js/addform.js"></script>

  <script src="../js/hideandshow.js"></script>
  <!-- Custom js for this page-->
  <script src="../template/js/jquery.cookie.js" type="text/javascript"></script>
  <script src="../template/js/dashboard.js"></script>
  <script src="../template/js/Chart.roundedBarCharts.js"></script>
  <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

  <!-- End custom js for this page-->
</body>

</html>

