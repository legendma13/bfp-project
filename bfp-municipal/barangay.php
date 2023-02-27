<!DOCTYPE html>
<html lang="en">
<?php include_once "check.php"?>
<?php if(isset($_GET['id'])){ $link->query("UPDATE notification SET click='1', date_created = '".$_GET['date']."' WHERE id = '".$_GET['id']."'");}?>
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
    <?php include_once "topnav.php"?>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_settings-panel.html -->
      <?php include_once "setting.php"?>
      <!-- partial -->
      <!-- partial:partials/_sidebar.html -->
      <?php include_once "sidenav.php"?>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <h1 class="h3 mb-3">Barangay</h1>
          <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb border border-0">
              <li class="breadcrumb-item"><a href="./">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Barangay</li>
            </ol>
          </nav>
          <div class="row">
            <div class="col-sm-4">
                <div class="card">
                    <div class="card-body">
                        <form action="" id="barangayform">
                            <h5>Municipal</h5>
                            <input type="text" name="municipal" id="" class="form-control mb-3" value="<?php echo $sh_user['location']?>" readonly>
                            <h5>Barangay</h5>
                            <input type="text" name="barangay" id="" class="form-control mb-3" placeholder="Type here..." required>
                            <div class="col ms-auto text-end">
                              <button type="reset" class="btn btn-dark">Reset</button>
                              <button type="submit" class="btn btn-success">Add</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
              <div class="home-tab">
                
              <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h4 class="card-title">List of Barangay</h4>
                        </div>
                    </div>
                  <div class="table-responsive">
                    <table id="myTable" class="table table-striped">
                      <thead>
                        <tr>
                          <th>No.</th>
                          <th>Municipal</th>
                          <th>Barangay</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $brgyQuery = $link->query("SELECT * FROM brgy WHERE municipal='".$sh_user['location']."'")?>
                        <?php $i=0?>
                        <?php while($brgy = $brgyQuery->fetch_assoc()){?>
                        <?php $i++?>
                        <tr>
                          <td><?php echo $i?></td>
                          <td><?php echo $brgy['municipal']?></td>
                          <td><?php echo $brgy['barangay']?></td>
                          <td>
                            <button type="button" value="<?php echo $brgy['id']?>" class="dropthisbrgy p-2 badge btn btn-danger btn-sm">Drop</button>
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

  <!-- Confirm -->
  <script src="js/addbrgy.js"></script>

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

