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
            <h3>PEZA Establishments</h3>
            <div class="col-sm-12">
              <div class="home-tab">
                <div class="tab-content tab-content-basic">
                  <div class="tab-pane fade show active"> 
                    <div class="row">
                      <div class="col-lg-12">
                        <div class="card">
                          <div class="card-body">
                            <dl class="row">
                              <dt class="col-lg-5">
                                <h5 class="card-title">A.) Number of Applications Received for PEZA ESTABLISHMENTS (within a month)</h5>
                              </dt>
                              <dt class="col-lg-7">
                                <dl class="row">
                                  <dt class="col-lg-6">
                                    <input type="text" name="new" class="form-control shadow-sm text-end" placeholder="NEW"> 
                                  </dt>
                                  <dt class="col-lg-6">
                                      <input type="text" name="renew" class="form-control shadow-sm text-end" placeholder="RENEWAL"> 
                                  </dt>
                                </dl>
                              </dt>
                            </dl>
                          </div>
                        </div>
                        <div class="col-lg-12 mt-3">
                          <div class="card">
                            <div class="card-body">
                              <h5 class="card-title">B.) 1st Inspection </h5>
                              <?php $structure_query = "SELECT * FROM structure"?>
                              <?php $i=0?>
                              <?php $read_structure_query = $link->query($structure_query)?>
                              <?php while($sh_structure = $read_structure_query->fetch_assoc()){?>
                              <?php $i++?>
                              <div class="row">
                                <div class="col-lg-12">
                                  <h4><b><?php echo $sh_structure['lbl']?></b></h4>
                                </div>
                              </div>
                              <div class="row mb-3">
                                <div class="col-lg-12">
                                  <input form="form1" type="number" name="nc<?php echo $i?>" value="0" class="form-control text-end shadow-sm" id="nc<?php echo $i?>" placeholder="For Current Month (Within the Month)" required>
                                </div>
                              </div>
                              <?php }?>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-lg-12">
                        <div class="card mb-3">
                          <div class="card-body">
                            <h5 class="card-title">C.) FSIC Issued</h5>
                            <div class="row">
                              <div class="col-lg-12">
                                <h5><b>NEW</b></h5>
                                <div class="row mb-3">
                                  <div class="col-lg-12 mb-3">
                                      <h5><b>* For Certificate of Annual Inspection</b></h5>
                                      <div class="row">
                                          <div class="col-lg-6">
                                              <h6>FSIC Issued WITHIN Prescribed Period</h6>
                                              <input type="text" name="" id="" placeholder="0" class="form-control text-end">
                                          </div>
                                          <div class="col-lg-6">
                                              <h6>FSIC Issued NOT WITHIN Prescribed Period</h6>
                                              <input type="text" name="" id="" placeholder="0" class="form-control text-end">
                                          </div>
                                      </div>
                                  </div>   
                                  <div class="col-lg-12">
                                      <h5><b>* For BPLO</b></h5>
                                      <div class="row">
                                          <div class="col-lg-6">
                                              <h6>FSIC Issued WITHIN Prescribed Period</h6>
                                              <input type="text" name="" id="" placeholder="0" class="form-control text-end">
                                          </div>
                                          <div class="col-lg-6">
                                              <h6>FSIC Issued NOT WITHIN Prescribed Period</h6>
                                              <input type="text" name="" id="" placeholder="0" class="form-control text-end">
                                          </div>
                                      </div>
                                  </div>      
                                </div>
                                <hr>
                              </div>
                              <div class="col-lg-12">
                                <h5><b>RENEW</b></h5>  
                                <div class="row mb-3">
                                  <div class="col-lg-12 mb-3">
                                      <h5><b>* For Certificate of Annual Inspection</b></h5>
                                      <div class="row">
                                          <div class="col-lg-6">
                                              <h6>FSIC Issued WITHIN Prescribed Period</h6>
                                              <input type="text" name="" id="" placeholder="0" class="form-control text-end">
                                          </div>
                                          <div class="col-lg-6">
                                              <h6>FSIC Issued NOT WITHIN Prescribed Period</h6>
                                              <input type="text" name="" id="" placeholder="0" class="form-control text-end">
                                          </div>
                                      </div>
                                  </div>   
                                  <div class="col-lg-12">
                                      <h5><b>* For BPLO</b></h5>
                                      <div class="row">
                                          <div class="col-lg-6">
                                              <h6>FSIC Issued WITHIN Prescribed Period</h6>
                                              <input type="text" name="" id="" placeholder="0" class="form-control text-end">
                                          </div>
                                          <div class="col-lg-6">
                                              <h6>FSIC Issued NOT WITHIN Prescribed Period</h6>
                                              <input type="text" name="" id="" placeholder="0" class="form-control text-end">
                                          </div>
                                      </div>
                                  </div>      
                                </div>                             
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-lg-12 mb-3">
                          <div class="card">
                            <div class="card-body">
                              <h5 class="card-title">D.) Re- Inspection</h5>
                              <div class="col-lg-12">
                                <h5><b>* NOTICE TO COMPLY</b></h5>
                                <div class="row mb-3">
                                  <div class="col-lg-12">
                                    <h5>Non- Compliant (Issued NTC)</h5>
                                    <input type="number" name="" id="" placeholder="0" class="form-control text-end">
                                  </div>   
                                  <div class="col-lg-12">
                                    <h5>Compliant (Issued FSIC for Business Operation)</h5>
                                    <input type="number" name="" id="" placeholder="0" class="form-control text-end">
                                  </div>      
                                </div>
                              </div>
                              <div class="col-lg-12">
                                <h5><b>* NOTICE TO CORRECT VIOLATION</b></h5>  
                                <div class="row mb-3">
                                  <div class="col-lg-12">
                                    <h5>Non- Compliant (Issued NTCV)</h5>
                                    <input type="number" name="" id="" placeholder="0" class="form-control text-end">
                                  </div>   
                                  <div class="col-lg-12">
                                    <h5>Compliant (Issued FSIC for Business Operation)</h5>
                                    <input type="number" name="" id="" placeholder="0" class="form-control text-end">
                                  </div>     
                                </div>                             
                              </div>
                              <div class="col-lg-12">
                                <h5><b>* ABATEMENT</b></h5>  
                                <div class="row mb-3">
                                  <div class="col-lg-12">
                                    <h5>Non- Compliant (Issued Abatement Order)</h5>
                                    <input type="number" name="" id="" placeholder="0" class="form-control text-end">
                                  </div>   
                                  <div class="col-lg-12">
                                    <h5>Compliant (Total Issued FSIC for Business/ Operation)</h5>
                                    <input type="number" name="" id="" placeholder="0" class="form-control text-end">
                                  </div>     
                                </div>                             
                              </div>

                              <div class="col-lg-12">
                                <h5><b>* Closure Order</b></h5>  
                                <div class="row mb-3">
                                  <div class="col-lg-12">
                                    <h5>Closure Order for Failure to Comply the Abatement order</h5>
                                    <input type="number" name="" id="" placeholder="0" class="form-control text-end">
                                  </div>   
                                  <div class="col-lg-12">
                                    <h5>Closure For Failure To Pay Fine</h5>
                                    <input type="number" name="" id="" placeholder="0" class="form-control text-end">
                                  </div>     
                                </div>                             
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-lg-12">
                          <div class="card">
                            <div class="card-body">
                              <h5 class="card-title">E.) Closure Order</h5>
                              <div class="col-lg-12">
                                  <h5>Closure Order for Failure to Comply the Abatement order</h5>
                                  <input type="number" name="" id="" placeholder="0" class="form-control text-end">
                              </div>   
                              <div class="col-lg-12 mb-3">
                                  <h5>Closure For Failure To Pay Fine</h5>
                                  <input type="number" name="" id="" placeholder="0" class="form-control text-end">
                              </div>
                              
                              

                              
                              <div class="row">
                                <div class="col text-end">
                                  <button form="form1" name="form1_submit" type="submit" class="btn btn-primary text-white p-3 m-0" data-bs-toggle="modal" data-bs-target="#confirmmodal">Submit</button>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- Modal -->
                      <div class="modal fade" id="confirmmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">Before Confirmation</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                              <h4>Please double check all of the information you have provided.</h4>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary p-3 m-2" data-bs-dismiss="modal">Back to Confirm Record</button>
                              <button type="button" class="btn btn-primary text-white p-3 m-0">Submit Record</button>
                            </div>
                          </div>
                        </div>
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
  <!-- inject:js -->
  <script src="../template/js/off-canvas.js"></script>
  <script src="../template/js/hoverable-collapse.js"></script>
  <script src="../template/js/template.js"></script>
  <script src="../template/js/settings.js"></script>
  <script src="../template/js/todolist.js"></script>
  <!-- endinject -->
  <script src="../js/hideandshow.js"></script>
  <!-- Custom js for this page-->
  <script src="../template/js/jquery.cookie.js" type="text/javascript"></script>
  <script src="../template/js/dashboard.js"></script>
  <!-- End custom js for this page-->
</body>

</html>

