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
          <div class="row">
            <h3> SUMMARY ACCOMPLISHMENT REPORT ON FIRE CODE FEES COLLECTION </h3>
            <?php $array = array("Fire Code Construction","Fire Code Realty","Fire Code Premuim","Fire Code Sales","Fire Code Proceeds Tax","Fire Code Fees for Occupancy",
             "Fire Code Fees for Business","Storage Clearance Fee","Conveyance Cleance Fee","Installation of Building Service Equipment","Installation of AFSS",
             "Installation of FDAS","Installation of KHSS","Installation of Flammable and Combustible Liquids Storage Tanks","Installation of LPGAS System","Other Installation Clearances",
             "Fire Code Administrative Fines","Fireworks Display","Electrical Installation","Filing Fees for FSEC","Certified True Copy of FSEC/FSIC/ Other Clearances",
             "Fumigation/Fogging","Fire Incident Clearance","Protest Fee","Fire Drill","Appeal Fee",
             "Open Flame","Fire Prevention and Safety Seminar","Soundstage and Approved Production Facilities and Locations","Welding, Cutting and Other Hotworks","Others",
             "Certificate of Competency (COC) Fees");?>
            <div class="col-sm-12">
              <div class="home-tab">
                <div class="tab-content tab-content-basic">
                  <form id="form4" class="tab-pane fade show active"> 
                    <div class="col-lg-12 mb-3">
                      <div class="card mb-3">
                        <div class="card-body">
                          <h4 class="card-title">Profile</h4>
                          <dl class="row">
                            <!-- Name -->
                            <dt class="col-lg-3 fs-6">Name :</dt>
                            <dt class="col-lg-3">
                              First Name
                              <input type="text" name="fname" class="form-control mb-3" id="fname" placeholder="First Name" required>
                            </dt>
                            <dt class="col-lg-3">
                              Middle Name
                              <input type="text" name="mname" class="form-control mb-3" id="mname" placeholder="Middle Name" required>
                            </dt>
                            <dt class="col-lg-3">
                              Last Name
                              <input type="text" name="lname" class="form-control" id="lname" placeholder="Last Name" required>
                            </dt>
                            <!-- Gender -->
                            <dt class="col-lg-3 fs-6">Gender :</dt>
                            <dt class="col-lg-9 mb-3 d-flex justify-content-start">
                              <div class="form-check me-4">
                                <label class="form-check-label">
                                  <input type="radio" class="form-check-input" name="gender" id="gender_male" value="Male" required>
                                  Male
                                </label>
                              </div>
                              <div class="form-check">
                                <label class="form-check-label">
                                  <input type="radio" class="form-check-input" name="gender" id="gender_female" value="Female" required>
                                  Female
                                </label>
                              </div>
                            </dt>
                            <dt class="col-lg-3 fs-6">Birth Day :</dt>
                            <dt class="col-lg-9 mb-3">
                              <input type="date" name="bday" class="form-control" required>
                            </dt>
                            <dt class="col-lg-3 fs-6">Barangay :</dt>
                            <dt class="col-lg-9 mb-3">
                              Choose Barangay
                              <?php $new_registerQuery = $link->query("SELECT * FROM brgy WHERE municipal='".$sh_user['location']."'")?>
                              <select name="brgy" id="barangay" class="form-select" required>
                                <option value="">-- Choose Brgy --</option> 
                                <?php while($new_register = $new_registerQuery->fetch_assoc()){?>
                                <option value="<?php echo $new_register['barangay']?>"><?php echo $new_register['barangay']?></option>
                                <?php }?>
                              </select>
                            </dt>
                            <dt class="col-lg-3 fs-6">Choose What Type :</dt>
                            <dt class="col-lg-9">
                              <select name="type" id="type" class="form-select mb-3" required>
                                <option value="">-- Choose--</option> 
                                <option value="Business Establishments">Business Establishments</option>
                                <option value="Government Buildings">Government Buildings</option>
                              </select>
                            </dt>
                            <dt class="col-lg-3 fs-6">FIRE CODE FEES COLLECTION</dt>
                            <dt class="col-lg-9">
                              <select name="fire_code_fees" id="fire_code_fees" class="form-select mb-3" required>
                                <option value="">--choose--</option>
                                <?php foreach($array as $sharray){?>
                                  <option value="<?php echo $sharray?>"><?php echo $sharray?></option>
                                <?php }?>
                              </select>
                            </dt>
                            <dt class="col-lg-3 fs-6">Fees</dt>
                            <dt class="col-lg-9">
                              <input type="number" name="fees" class="form-control" placeholder="00" required>
                            </dt>
                          </dl>                          
                          <div class="row">
                            <div class="col text-end">
                              <button type="submit" class="btn btn-primary text-white p-3 m-0">Submit</button>
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

