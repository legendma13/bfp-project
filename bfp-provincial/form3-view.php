<!DOCTYPE html>
<?php include_once "check.php"?>
<html lang="en">
  <?php include_once "head.php"?>
  <body>
    <div class="container-scroller">
      <?php $report = mysqli_fetch_assoc(mysqli_query($link,"SELECT * FROM bfp_form3 
      LEFT JOIN structure ON bfp_form3.structure = structure.structure_id 
      WHERE form3_id = '".$_GET['reportid']."' LIMIT 1"))?>
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
              <h3>GOVERNMENT BUILDINGS</h3>
              <div class="col-sm-12">
                <div class="home-tab">
                  <div class="tab-content tab-content-basic">
                    <div class="tab-pane fade show active"> 
                      <form id="form3-edit" class="row was-validated">
                        <input type="hidden" value="<?php echo $report['form3_id']?>" name="id">
                        <div class="col-lg-12 mb-3">
                          <!--profile-->
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
                                  <input type="text" value="<?php echo $report['gender']?>" class="form-control" readonly>
                                </dt>
                                <dt class="col-lg-3 mb-3 fs-6">Birth Day :</dt>
                                <dt class="col-lg-9 mb-3">
                                  <input type="date" value="<?php echo $report['bday']?>" name="bday" class="form-control" readonly>
                                </dt>
                                <dt class="col-lg-3 mb-3 fs-6">Barangay :</dt>
                                <dt class="col-lg-9">
                                  <input type="text" value="<?php echo $report['brgy']?>" class="form-control" readonly>
                                </dt>
                                <dt class="col-lg-3 fs-6">Type of Application :</dt>
                                <div class="col-lg-9">
                                  <input type="text" value="<?php echo $report['type']?>" class="form-control" readonly>
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
                                  <?php $read_structure_query = $link->query("SELECT * FROM structure")?>
                                </dt>
                                <dt class="col-lg-9">
                                  <input type="text" value="<?php echo $report['lbl']?>" class="form-control" readonly>
                                </dt>
                              </dl>
                            </div>
                          </div>
                        </div>
                        <div class="col-lg-12 mb-3">
                          <div class="card mb-3">
                            <div class="card-body">
                              <div class="col-lg-12">
                                <dl class="row">
                                  <h5 class="card-title">Compliant from 1st Inspection (Total FSIC  Issued for Permit to Operate,PHILHEALTH ACCREDITATION for Hospital,DOH License to Operate and Other Permits or licenses being issued by other Government agencies.)</h5>
                                  <dt class="col-lg-6">
                                    New or Renewal
                                    <input type="text" value="<?php echo $report['new_renew']?>" class="form-control" readonly>
                                  </dt>
                                  <dt class="col-lg-6">
                                    WITHIN Prescribed Period or NOT WITHIN
                                    <input type="text" value="<?php echo $report['with_or_not']?>" class="form-control" readonly>
                                  </dt>
                                </dl>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-lg-12">
                          <div class="card">
                            <div class="card-body">
                              <dl class="row">
                                <dt class="col-lg-3 fs=6">Re- Inspection</dt>
                                <dt class="col-lg-3">
                                  <input type="text" value="<?php echo $report['reinspection_1']?>" class="form-control" readonly>
                                </dt>
                                <dt class="col-lg-3">
                                  <input type="text" value="<?php echo $report['reinspection_2']?>" class="form-control" readonly>
                                </dt>
                                <dt class="col-lg-3">
                                  <input name="reinspection_3" value="<?php echo $report['reinspection_3']?>" type="text" id="reins3" class="form-control" readonly readonly>
                                </dt>
                              </dl>
                              <dl class="row">
                                <dt class="col-lg-3 fs-6">Closure Order</dt>
                                <dt class="col-lg-9">
                                  <input type="text" value="<?php echo $report['closure']?>" class="form-control" readonly>
                                </dt>
                              </dl>
                              <div class="row">
                                <div class="col text-end">
                                  <a href="form3-table.php"><button type="button" class="btn btn-dark text-white p-3 m-0">Back</button></a>
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

