<!DOCTYPE html>
<?php include_once "check.php"?>
<html lang="en">
<?php include_once "head.php"?>
<body>
  <div class="container-scroller">
    <?php $report = mysqli_fetch_assoc(mysqli_query($link,"SELECT * FROM bfp_form2 
    LEFT JOIN structure ON bfp_form2.structure = structure.structure_id 
    WHERE form2_id = '".$_GET['reportid']."' LIMIT 1"))?>
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
            <h3>BUSINESS OPERATION</h3>
            <div class="home-tab">
              <div class="tab-content tab-content-basic">
                <form class="row was-validated" id="form2-edit">
                  <input type="hidden" name="id" value="<?php echo $report['form2_id']?>">
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
                            <input type="text" class="form-control" value="<?php echo $report['gender']?>" readonly>
                          </dt>
                          <dt class="col-lg-3 mb-3 fs-6">Birth Day :</dt>
                          <dt class="col-lg-9 mb-3">
                            <input type="date" value="<?php echo $report['bday']?>" name="bday" class="form-control" readonly>
                          </dt>
                          <dt class="col-lg-3 mb-3 fs-6">Barangay :</dt>
                          <dt class="col-lg-9 mb-3">
                            <input type="text" class="form-control" value="<?php echo $report['brgy']?>" readonly>
                          </dt>
                          <dt class="col-lg-3 fs-6">Type of Application :</dt>
                          <div class="col-lg-9">
                            <input type="text" class="form-control" value="<?php echo $report['type']?>" readonly>
                          </div>
                        </dl>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-12 mb-3">
                    <div class="card mb-3">
                      <div class="card-body">
                        <h5 class="card-title">1st Inspection </h5>
                        <dl class="row">
                          <dt class="col-lg-3 fs-6">
                            Instructural INSPECTED
                          </dt>
                          <dt class="col-lg-9">
                            <input type="text" class="form-control" value="<?php echo $report['lbl']?>" readonly>
                          </dt>
                        </dl>
                        <dl class="row">
                          <dt class="col-lg-3 fs-6">FSIC Issued</dt>
                          <dt class="col-lg-4">
                            New or Renewal
                            <input type="text" class="form-control" value="<?php echo $report['fsic']?>" readonly>
                          </dt>
                          <dt class="col-lg-5">
                            WITHIN Prescribed Period or NOT WITHIN
                            <input type="text" class="form-control" value="<?php echo $report['with_or_not']?>" readonly>
                          </dt>
                        </dl>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-12">
                    <div class="card">
                      <div class="card-body">
                        <dl class="row">
                          <dt class="col-lg-3 fs=6">Re- Inspection</dt>
                          <dt class="col-lg-3">
                            <input type="text" class="form-control" value="<?php echo $report['reinspection_1']?>" readonly>
                          </dt>
                          <dt class="col-lg-3">
                            <input type="text" class="form-control" value="<?php echo $report['reinspection_2']?>" readonly>
                          </dt>
                          <dt class="col-lg-3">
                            <input type="text" class="form-control" value="<?php echo $report['reinspection_3']?>" readonly>
                          </dt>
                        </dl>
                        <dl class="row">
                          <dt class="col-lg-3 fs-6">Closure Order</dt>
                          <dt class="col-lg-9">
                            <input type="text" class="form-control" value="<?php echo $report['closure']?>" readonly>
                          </dt>
                        </dl>
                        
                        <div class="row">
                          <div class="col text-end">
                            <a href="form2-table.php"><button type="button" class="btn btn-dark text-white p-3 m-0">Back</button></a>
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
  <script src="../js/hideandshow.js"></script>
  <script src="js/addform.js"></script>
  <!-- Custom js for this page-->
  <script src="../template/js/jquery.cookie.js" type="text/javascript"></script>
  <script src="../template/js/dashboard.js"></script>
  <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

  <!-- End custom js for this page-->
  
</body>

</html>

