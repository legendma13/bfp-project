<!DOCTYPE html>
<html lang="en">
<?php include_once "check.php"?>
<?php if(isset($_GET['id'])){ $link->query("UPDATE notification SET click='1', date_created = '".$_GET['date']."' WHERE id = '".$_GET['id']."'");}?>
<?php include_once "head.php"?>
<script>
  $(document).ready(function() {
    var table = $('#myTable').DataTable();
        
    new $.fn.dataTable.Buttons( table, {
    buttons: [
      {
        extend: 'print',
        title: "Fire Code Fees Collection Data",
        exportOptions: {
          columns: "thead th:not(.exclude)"
        }
      },{
        extend: 'excel',
        title: "Fire Code Fees Collection Data",
        exportOptions: {
          columns: "thead th:not(.exclude)"
        }
      },{
        extend: 'pdf',
        title: "Fire Code Fees Collection Data",
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
          <h1 class="h3 mb-3">Fire Code Fees Collection</h1>
          <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb border border-0">
              <li class="breadcrumb-item"><a href="./">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Fire Code Fees Collection</li>
            </ol>
          </nav>
          <div class="row">
            <div class="col-sm-12">
              <div class="home-tab">
                <div class="card">
                  <div class="card-body">
                    <div class="d-sm-flex align-items-center justify-content-between">
                      <div>
                        <h4 class="card-title">FCF F4 Report</h4>
                      </div>
                      <div>
                        <a href="form4.php"><button class="btn btn-info me-0">Add Data</button></a>
                      </div>
                    </div>
                    <div class="table-responsive">
                      <table id="myTable" class="table table-striped">
                        <thead>
                          <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Barangay</th>
                            <th>Fire Code Fees</th>
                            <th>Fees</th>
                            <th>Date Created</th>
                            <th class="exclude">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php $monthnow = date('Y-m-1');?>
                          <?php $monthnowlastdate = date('Y-m-t');?>
                          <?php $i = 0?>
                          <?php $form4_data = mysqli_query($link,"SELECT * FROM bfp_form4 
                          WHERE uid='$uid' ORDER BY form4_date_added DESC")?>
                          <?php while($shform4_data = $form4_data->fetch_assoc()){?>
                          <?php $i++?>
                          <tr>
                            <td><?php echo $i++?></td>
                            <td class="text-uppercase"><?php echo $shform4_data['lname'] ?>, <?php echo $shform4_data['fname'] ?> <?php echo $shform4_data['mname'] ?></td>
                            <td><?php echo $shform4_data['brgy']?></td>
                            <td><?php echo $shform4_data['fire_code_fees']?></td>
                            <td><?php echo $shform4_data['fees']?></td>
                            <td><?php echo $shform4_data['form4_date_added']?></td>
                            <td>
                              <a href="form4-edit.php?reportid=<?php echo $shform4_data['form4_id']?>">
                                <button class="badge bg-success ps-3 pe-3">Edit</button>
                              </a>
                              <button type="button" value="<?php echo $shform4_data['form4_id']?>" class="form4removereport badge bg-danger ps-3 pe-3">Remove</button>
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
  <script src="../template/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
  <script src="../template/vendors/progressbar.js/progressbar.min.js"></script>

  <!-- End plugin js for this page -->

  <!-- Confirm -->
  <script src="../js/confirm.js"></script>
  <!-- inject:js -->
  <script src="../template/js/off-canvas.js"></script>
  <script src="../template/js/hoverable-collapse.js"></script>
  <script src="../template/js/template.js"></script>
  <script src="../template/js/settings.js"></script>
  <script src="../template/js/todolist.js"></script>
  <!-- endinject -->
  <script src="js/addform.js"></script>
  <!-- Custom js for this page-->
  <script src="../template/js/jquery.cookie.js" type="text/javascript"></script>
  <script src="../template/js/dashboard.js"></script>
  <script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
  <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
  <!-- End custom js for this page-->
  
  
      
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
  <script src="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.13.2/b-2.3.4/b-colvis-2.3.4/b-html5-2.3.4/b-print-2.3.4/r-2.4.0/datatables.min.js"></script>
  
</body>

</html>

