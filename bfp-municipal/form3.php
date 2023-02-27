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
            <h3>GOVERNMENT BUILDINGS</h3>
            <div class="col-sm-12">
              <div class="home-tab">
                <div class="tab-content tab-content-basic">
                  <div class="tab-pane fade show active"> 
                  <form id="form3" class="row">
                    <div class="col-lg-12 mb-3">
                      <!--profile-->
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
                            <dt class="col-lg-3 fs-6">Type of Application :</dt>
                            <div class="col-lg-9">
                              <select name="type" id="type" class="form-select" required>
                                <option value="">-- Choose--</option> 
                                <option value="New">New</option>
                                <option value="Renew">Renew</option>
                              </select>
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
                              <select name="structure" id="structure" class="form-select" required>
                                <option value="">--choose--</option>
                                <?php while($sh_structure = $read_structure_query->fetch_assoc()){?>
                                  <option value="<?php echo $sh_structure['structure_id']?>"><?php echo $sh_structure['lbl']?></option>
                                <?php }?>
                              </select>
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
                                <select name="new_renew" id="new_renew" class="form-select" required>
                                  <option value="">--choose--</option>
                                  <option value="New">New</option>
                                  <option value="Renewal">Renewal</option>
                                </select>
                              </dt>
                              <dt class="col-lg-6">
                              WITHIN Prescribed Period or NOT WITHIN
                                <select name="with_or_not" id="with_or_not" class="form-select" required>
                                  <option value="">--choose--</option>
                                  <option value="FSIC Issued WITHIN Prescribed Period">FSIC Issued WITHIN Prescribed Period</option>
                                  <option value="FSIC Issued NOT WITHIN Prescribed Period">FSIC Issued NOT WITHIN Prescribed Period</option>
                                </select>
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
                              <select name="reinspection_1" id="reins1" class="form-select mb-3" onchange="reinspect(this.id,'reins2')" required>
                                <option value="">--choose--</option>
                                <option value="NOTICE TO COMPLY">NOTICE TO COMPLY</option>
                                <option value="NOTICE TO CORRECT VIOLATION">NOTICE TO CORRECT VIOLATION</option>
                                <option value="ABATEMENT">ABATEMENT</option>
                              </select>
                            </dt>
                            <dt class="col-lg-3">
                              <select name="reinspection_2" id="reins2" class="form-select mb-3" onchange="reinspect2(this.id)" required>
                                <option value="">--choose--</option>
                                <option value="Compliant">Compliant</option>
                                <option value="Non- Compliant">Non- Compliant</option>
                              </select>
                            </dt>
                            <dt class="col-lg-3">
                              <input name="reinspection_3" type="text" id="reins3" class="form-control" readonly required>
                            </dt>
                          </dl>
                          <dl class="row">
                            <dt class="col-lg-3 fs-6">Closure Order</dt>
                            <dt class="col-lg-9">
                              <select name="closure" id="closure" class="form-select">
                                <option value="">--choose--</option>
                                <option value="Closure Order for Failure to Comply the Abatement order">Closure Order for Failure to Comply the Abatement order</option>
                                <option value="Closure For Failure To Pay Fine">Closure For Failure To Pay Fine</option>
                              </select>
                            </dt>
                          </dl>
                          <div class="row">
                            <div class="col text-end">
                              <button type="submit" class="btn btn-primary text-white p-3 m-0">Submit</button>
                            </div>
                          </div>
                          <script>
                            function reinspect(s1,s2){
                              var s1 = document.getElementById(s1);
                              var s2 = document.getElementById(s2);
                              s2.innerHTML = "";
                              if (s1.value == "NOTICE TO COMPLY") {
                                var choose2 = ['|--choose--','Compliant|Compliant','Non-Conpliant|Non-Conpliant'];
                              } else if (s1.value == "NOTICE TO CORRECT VIOLATION") {
                                var choose2 = ['|--choose--','Compliant|Compliant','Non-Conpliant|Non-Conpliant'];
                              } else if (s1.value == "ABATEMENT") {
                                var choose2 = ['|--choose--','Compliant|Compliant','Non-Conpliant|Non-Conpliant'];
                              }
                              for (var option in choose2) {
                                var pair = choose2[option].split("|");
                                var newoption = document.createElement("option");
                                newoption.value = pair[0];
                                newoption.innerHTML = pair[1];
                                s2.options.add(newoption);
                              }
                            }
                            function reinspect2(s1){
                              var reins1 = document.getElementById("reins1");
                              var s1 = document.getElementById(s1);
                              var s2 = document.getElementById("reins3");
                              if (s1.value == "Non-Compliant" && reins1.value == "NOTICE TO COMPLY") {
                                s2.value = "Issued NTC";
                              } else if(s1.value == "Compliant" && reins1.value == "NOTICE TO COMPLY") {
                                s2.value = "Issued FSIC for Business Operation";
                              } else if (s1.value == "Non-Compliant" && reins1.value == "NOTICE TO CORRECT VIOLATION") {
                                s2.value = "Issued NTCV";
                              } else if(s1.value == "Compliant" && reins1.value == "NOTICE TO CORRECT VIOLATION") {
                                s2.value = "Issued FSIC for Business Operation";
                              } else if (s1.value == "Non-Compliant" && reins1.value == "ABATEMENT") {
                                s2.value = "Issued Abatement Order";
                              } else if(s1.value == "Compliant" && reins1.value == "ABATEMENT") {
                                s2.value = "Total Issued FSIC for Business/ Operation";
                              } 
                            }
                          </script>
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

