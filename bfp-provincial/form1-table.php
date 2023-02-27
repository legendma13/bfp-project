<!DOCTYPE html>
<html lang="en">
<?php include_once "check.php" ?>
<?php if (isset($_GET['id'])) {
  $link->query("UPDATE notification SET click='1', date_created = '" . $_GET['date'] . "' WHERE id = '" . $_GET['id'] . "'");
} ?>
<?php include_once "head.php" ?>
<script>
  $(document).ready(function() {
    var table = $('#myTable').DataTable();
        
    new $.fn.dataTable.Buttons( table, {
    buttons: [
      {
        extend: 'print',
        title: "New Building Table",
        exportOptions: {
          columns: "thead th:not(.exclude)"
        }
      },{
        extend: 'excel',
        title: "New Building Table",
        exportOptions: {
          columns: "thead th:not(.exclude)"
        }
      },{
        extend: 'pdf',
        title: "New Building Table",
        exportOptions: {
          columns: "thead th:not(.exclude)"
        }
      },
    ]
    } );
    table.buttons().container()
        .appendTo( $('.dataTables_filter', table.table().container() ) );
    
  });
</script>
<style>
  .dt-button{
    margin-top: 5px;
    background-color: #46c35f;
    color: black;
    border-radius: 5px;
    border: none;
    padding: 3px 15px 3px 15px;
  }
  .dt-button:hover{
    background-color: #58d8a3;
    color: white;
  }
</style>
<body>
  <div class="alert alert-success alert-dismissible" id="errorMessage" style="display:none;">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
  </div>
  <div class="container-scroller">

    <!-- partial:partials/_navbar.html -->
    <?php include_once "topnav.php" ?>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_settings-panel.html -->
      <?php include_once "setting.php" ?>
      <!-- partial:partials/_sidebar.html -->
      <?php include_once "sidenav.php" ?>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <h1 class="h3 mb-3">New Building</h1>
          <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb border border-0">
              <li class="breadcrumb-item"><a href="./">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">New Building</li>
            </ol>
          </nav>
          <div class="row">
            <div class="col-sm-12">
              <div class="home-tab">
                <div class="card">
                  <div class="card-body">
                    <div class="d-sm-flex align-items-center justify-content-between">
                      <div>
                        <h4 class="card-title">New Building List of Application</h4>
                      </div>
                    </div>
                    <div class="table-responsive">
                      <table id="myTable" class="table table-striped">
                        <thead>
                          <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Barangay</th>
                            <th>Type</th>
                            <th>Structure</th>
                            <th>Date Created</th>
                            <th class="exclude">Action</th>
                          </tr>
                        </thead>
                        <?php $monthnow = date('Y-m'); ?>
                        <?php $i = 0 ?>
                        <tbody>
                          <?php $Qform1 = mysqli_query($link, "SELECT * FROM bfp_form1 
                          LEFT JOIN structure ON bfp_form1.structure = structure.structure_id 
                          LEFT JOIN bfp_users ON bfp_users.uid = bfp_form1.uid
                          WHERE bfp_users.municipal = '".$sh_user['municipal']."' AND bfp_form1.form1_status = '1'
                          ORDER BY bfp_form1.form1_date_added DESC") ?>
                          <?php while ($shform1 = mysqli_fetch_assoc($Qform1)) { ?>
                            <?php $i++ ?>
                            <tr>
                              <td><?php echo $i?></td>
                              <td class="text-uppercase"><?php echo $shform1['lname'] ?>, <?php echo $shform1['fname'] ?> <?php echo $shform1['mname'] ?></td>
                              <td><?php echo $shform1['brgy'] ?></td>
                              <td><?php echo $shform1['type'] ?></td>
                              <td><?php echo $shform1['lbl'] ?></td>
                              <td><?php echo $shform1['form1_date_added'] ?></td>
                              <td>
                                <a href="form1-view.php?reportid=<?php echo $shform1['form1_id'] ?>">
                                  <button class="btn btn-primary btn-sm text-white p-2">View</button>
                                </a>
                              </td>
                            </tr>
                          <?php } ?>
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

  <!-- Confirm -->
  <script src="../js/confirm.js"></script>
  <script src="js/addform.js"></script>

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
  
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
  <script src="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.13.2/b-2.3.4/b-colvis-2.3.4/b-html5-2.3.4/b-print-2.3.4/r-2.4.0/datatables.min.js"></script>
  
  
</body>

</html>