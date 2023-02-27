<!DOCTYPE html>
<?php include_once "check.php"?>
<html lang="en">
<?php $report = mysqli_fetch_assoc(mysqli_query($link,"SELECT * FROM bfp_form1 WHERE form1_id = '".$_GET['reportid']."' LIMIT 1"))?>
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
                                  <input type="text" name="fname" value="<?php echo $report['fname']?>" class="form-control mb-3" id="fname" placeholder="First Name" required>
                                </dt>
                                <dt class="col-lg-3">
                                  Middle Name
                                  <input type="text" name="mname" value="<?php echo $report['mname']?>" class="form-control mb-3" id="mname" placeholder="Middle Name" required>
                                </dt>
                                <dt class="col-lg-3">
                                  Last Name
                                  <input type="text" name="lname" value="<?php echo $report['lname']?>" class="form-control mb-3" id="lname" placeholder="Last Name" required>
                                </dt>
                                <!-- Gender -->
                                <dt class="col-lg-3 mb-3 fs-6">Gender :</dt>
                                <dt class="col-lg-9 mb-3 d-flex justify-content-start">
                                  <?php if ($report['gender'] == "Male") {?>
                                    <div class="form-check me-4">
                                    <label class="form-check-label">
                                      <input type="radio" class="form-check-input" name="gender" id="gender_male" value="Male" checked required>
                                      Male
                                    </label>
                                    </div>
                                    <div class="form-check">
                                      <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="gender" id="gender_female" value="Female" required>
                                        Female
                                      </label>
                                    </div>
                                  <?php } else { ?>
                                    <div class="form-check me-4">
                                    <label class="form-check-label">
                                      <input type="radio" class="form-check-input" name="gender" id="gender_male" value="Male" required>
                                      Male
                                    </label>
                                    </div>
                                    <div class="form-check">
                                      <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="gender" id="gender_female" value="Female" checked required>
                                        Female
                                      </label>
                                    </div>
                                  <?php }?>
                                  
                                </dt>
                                <dt class="col-lg-3 mb-3 fs-6">Birth Day :</dt>
                                <dt class="col-lg-9 mb-3">
                                  <input type="date" value="<?php echo $report['bday']?>" name="bday" class="form-control" required>
                                </dt>
                                <dt class="col-lg-3 mb-3 fs-6">Barangay :</dt>
                                <dt class="col-lg-9">
                                  Choose Barangay
                                  <?php $new_registerQuery = $link->query("SELECT * FROM brgy WHERE municipal='" . $sh_user['location'] . "'") ?>
                                  <select name="brgy" id="barangay" class="form-select" required>
                                    <option value="">-- Choose Brgy --</option>
                                    <?php while ($new_register = $new_registerQuery->fetch_assoc()) { ?>
                                      <?php if ($report['brgy'] == $new_register['barangay']) { ?>
                                        <option value="<?php echo $new_register['barangay'] ?>" selected><?php echo $new_register['barangay'] ?></option>
                                      <?php } else { ?>
                                        <option value="<?php echo $new_register['barangay'] ?>"><?php echo $new_register['barangay'] ?></option>
                                      <?php }?>
                                    <?php } ?>
                                  </select>
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
                                  Choose What Type
                                  <select name="type" id="type" class="form-select" required>
                                    <option value="">-- Choose Type --</option>
                                    <?php if ($report['type'] == "New Establishments Buildings") { ?>
                                      <option value="New Establishments Buildings" selected>New Establishments/Buildings</option>
                                      <option value="New Government Buildings">New Government Buildings</option>
                                    <?php } else { ?>
                                      <option value="New Establishments Buildings">New Establishments/Buildings</option>
                                      <option value="New Government Buildings" selected>New Government Buildings</option>
                                    <?php }?>
                                  </select>
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
                                      <select name="structure" id="structure" class="form-select" required>
                                        <option value="">--choose--</option>
                                        <?php while ($sh_structure = $read_structure_query->fetch_assoc()) { ?>
                                          <?php if($report['structure'] == $sh_structure['structure_id']){?>
                                            <option value="<?php echo $sh_structure['structure_id'] ?>" selected><?php echo $sh_structure['lbl'] ?></option>
                                          <?php } else {?>
                                            <option value="<?php echo $sh_structure['structure_id'] ?>"><?php echo $sh_structure['lbl'] ?></option>
                                          <?php } ?>
                                        <?php } ?>
                                      </select>
                                    </dt>
                                    <dt class="col-sm-6 fs-6">Newly Constructed / Renovation, Repair, Modified</dt>
                                    <dt class="col-sm-6">
                                      <select name="ncrn" id="ncrn" class="form-select" required>
                                        <option value="">--choose--</option>
                                        <?php if ($report['ncrn'] == "NC") { ?>
                                          <option value="NC" selected>Newly Constructed Building</option>
                                          <option value="RN">Renovation, Repair, Modified</option>
                                        <?php } else { ?>
                                          <option value="NC">Newly Constructed Building</option>
                                          <option value="RN" selected>Renovation, Repair, Modified</option>
                                        <?php }?>
                                      </select>
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
                                  <select name="inspection" id="inspection" class="form-select" required>
                                    <option value="">--choose--</option>
                                    <?php if ($report['inspection'] == "NC") { ?>
                                      <option value="NC" selected>Newly Constructed Building</option>
                                      <option value="RN">Renovation, Repair, Modified</option>
                                    <?php } else { ?>
                                      <option value="NC">Newly Constructed Building</option>
                                      <option value="RN" selected>Renovation, Repair, Modified</option>
                                    <?php }?>
                                    
                                  </select>
                                </dt>
                                <dt class="col-sm-6 fs-6">Issuances</dt>
                                <dt class="col-sm-6">
                                  <select name="issuances" id="issuances" class="form-select">
                                    <option value="">--choose--</option>
                                    <?php $issuances = array("Issued FSIC for Occupancy",
                                    "Issued With NOD for NOT OCCUPIED buildings/establishments"
                                    ,"Issued With NTC for OCCUPIED buildings/establishments")?>
                                    <?php foreach($issuances as $shissuances){?>
                                      <?php if ($shissuances == $report['issuance']) { ?>
                                        <option value="<?php echo $shissuances?>" selected><?php echo $shissuances?></option>
                                      <?php }?>
                                        <option value="<?php echo $shissuances?>"><?php echo $shissuances?></option>
                                    <?php }?>
                                  </select>
                                </dt>
                              </dl>
                              <div class="row">
                                <div class="col text-end">
                                  <a href="form1-table.php"><button type="button" class="btn btn-dark text-white p-3 m-0">Back</button></a>
                                  <button type="submit" class="btn btn-primary text-white p-3 m-0">Edit</button>
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

