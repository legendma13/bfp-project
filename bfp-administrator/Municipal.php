<!DOCTYPE html>
<html lang="en">
<?php include_once "check.php"?>
<?php if(isset($_GET['id'])){ $link->query("UPDATE notification SET click='1', date_created = '".$_GET['date']."' WHERE id = '".$_GET['id']."'");}?>
<?php include_once "head.php"?>
<script>
    $(document).ready( function () {
        $('#reporttable').DataTable();
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
      <!-- partial:partials/_sidebar.html -->
      <?php include_once "sidenav.php"?>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <h1 class="h3 mb-3">Municipal Report</h1>
          <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb border border-0">
              <li class="breadcrumb-item"><a href="./">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Report</li>
            </ol>
          </nav>
          <div class="row">
            <div class="col-sm-12">
              <div class="home-tab">
                <div class="card">
                  <div class="card-body">
                    <div class="d-sm-flex align-items-center justify-content-between">
                      <div>
                        <h4 class="card-title">Municipal Report Table</h4>
                      </div>
                      <div>
                        <button type="button" class="btn btn-success me-0" data-bs-toggle="modal" data-bs-target="#pdfmodal">Export PDF</button>
                        <button type="button" class="btn btn-warning me-0" data-bs-toggle="modal" data-bs-target="#excelmodal">Export Excel</button>
                      </div>
                    </div>
                    <div class="table-responsive">
                      <table id="reporttable" class="table table-striped">
                        <thead>
                          <tr>
                            <th>No</th>
                            <th>Report<br>Name</th>
                            <th>Municipal</th>
                            <th>Provincial</th>
                            <th>Start Of Report</th>
                            <th>End Of Report</th>
                            <th>Report Status</th>
                            <th>Report Date Requested</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <?php $i=0?>
                        <tbody>
                          <?php $Qform1 = mysqli_query($link,"SELECT * FROM report 
                          LEFT JOIN bfp_users ON bfp_users.uid = report.uid ORDER BY report_submit DESC")?>
                          <?php while($shform1 = mysqli_fetch_assoc($Qform1)){?>
                            <?php $i++?>
                          <tr>
                            <td><?php echo $i?></td>
                            <td><?php echo $shform1['report_name']?></td>
                            <td><?php echo $shform1['location']?></td>
                            <td><?php echo $shform1['municipal']?></td>
                            <td><?php echo $shform1['start_report']?></td>
                            <td><?php echo $shform1['end_report']?></td>
                            <td>
                              <?php if ($shform1['report_status'] == "Requesting") {
                                echo '<span class="badge bg-warning">' . $shform1['report_status'] . '</span>';
                              } elseif($shform1['report_status'] == "Approved") {
                                echo '<span class="badge bg-primary">' . $shform1['report_status'] . '</span>';
                              } else {
                                echo '<span class="badge bg-success">' . $shform1['report_status'] . '</span>';
                              }?>
                            </td>
                            <td><?php echo $shform1['report_submit']?></td>
                            <td>
                              <a href="View-report.php?rid=<?php echo $shform1['report_id']?>&start=<?php echo $shform1['start_report']?>&end=<?php echo $shform1['end_report']?>">
                                <button type="button" class="btn btn-primary p-2 text-white">
                                  View
                                </button>
                              </a>
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
  <script>
    $('#summernote').summernote({
      placeholder: 'Type here...',
      height: 300,
      toolbar: [
        // [groupName, [list of button]]
        ['style', ['bold', 'italic', 'underline', 'clear']],
        ['font', ['strikethrough', 'superscript', 'subscript']],
        ['fontsize', ['fontsize']],
        ['color', ['color']],
        ['para', ['ul', 'ol', 'paragraph']],
        ['height', ['height']]
      ]
    });
    $('#editcomment').summernote({
      placeholder: 'Type here...',
      height: 300,
      toolbar: [
        // [groupName, [list of button]]
        ['style', ['bold', 'italic', 'underline', 'clear']],
        ['font', ['strikethrough', 'superscript', 'subscript']],
        ['fontsize', ['fontsize']],
        ['color', ['color']],
        ['para', ['ul', 'ol', 'paragraph']],
        ['height', ['height']]
      ]
    });
    $(document).on("submit", "#reportform", function (e) {
      e.preventDefault();
      var formData = new FormData(this);
      formData.append("send_report", true);
      $.ajax({
        type: "POST",
        url: "php/function.php",
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {
          var res = jQuery.parseJSON(response);
          if (res.status == 422) {
            swal ( "Oops" ,  "Something went wrong!" ,  "error" );
          } else if (res.status == 200) {
            swal ( "Success" ,  "Successfully Add Record" ,  "success" );
            $('#reporttable').load(location.href + " #reporttable");
            $("#sendreportform1modal").modal("hide");
            $("#reportform")[0].reset();
          } else if (res.status == 500) {
            swal ( "Oops" ,  "Something went wrong!" ,  "error" );
          }
        },
      });
    });
    $(document).ready(function(){
      $(".resubmit").click(function(){
        var id = $(this).val();
        $("#resubmit").val(id);
      });
    });
    $(document).on('submit', '#editform', function (e) {
      e.preventDefault();
      var formData = new FormData(this);
      formData.append("editreport", true);
      $.ajax({
          type: "POST",
          url: "php/report.php",
          data: formData,
          processData: false,
          contentType: false,
          success: function (response) {
          var res = jQuery.parseJSON(response);
          if(res.status == 422) {
            swal ( "Oops" ,  "Something went wrong!" ,  "error" );
          }else if(res.status == 200){
            swal ( "Success" ,  res.message ,  "success" );
            $("#editform")[0].reset();
            $("#neededit").modal('hide');
            $('#reporttable').load(location.href + " #reporttable");
          }else if(res.status == 500) {
            swal ( "Oops" ,  "Something went wrong!" ,  "error" );
          }
        }
      });
    });
  </script>
  <!-- Modal -->
  <div class="modal fade" id="excelmodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Export EXCEL</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form id="excelform" action="../admin-sheet.php" method="GET" class="modal-body">
          <div class="row">
            <div class="col-lg-6">
              Start
              <input type="date" value="<?php echo date('Y-m-01')?>" name="start" id="start" class="form-control" required>
            </div>
            <div class="col-lg-6">
              End
              <input type="date" value="<?php echo date('Y-m-t')?>" name="end" id="end" class="form-control" required>
            </div>
          </div>
          <div id="alert-download" class="alert alert-warning text-dark mt-3" role="alert" style="display:none">
            Please wait for your file to be Download
          </div>
        </form>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button form="excelform" type="submit" id="download-click" class="btn btn-primary">Download</button>
        </div>
      </div>
    </div>
  </div>
  <script>
    $(document).ready(function(){
      $("#download-click").click(function(){
        $("#alert-download").show(700);
      });
    });
  </script>
  <!-- Modal -->
  <div class="modal fade" id="pdfmodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Export PDF</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form id="pdfform" action="../pdfreport.php" method="GET" target="_blank" class="modal-body">
          <div class="row">
            <input type="hidden" name="office" value="<?php echo $sh_user['location'].', '.$sh_user['municipal']?>" id="">
            <div class="col-lg-6">
              Start
              <input type="date" value="<?php echo date('Y-m-01')?>" name="start" id="start" class="form-control" required>
            </div>
            <div class="col-lg-6">
              End
              <input type="date" value="<?php echo date('Y-m-t')?>" name="end" id="end" class="form-control" required>
            </div>
          </div>
        </form>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button form="pdfform" type="submit" class="btn btn-primary">View PDF Report</button>
        </div>
      </div>
    </div>
  </div>
  <!-- plugins:js -->
  <script src="../template/vendors/js/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <script src="../template/vendors/chart.js/Chart.min.js"></script>
  <script src="../template/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
  <script src="../template/vendors/progressbar.js/progressbar.min.js"></script>

  <!-- End plugin js for this page -->
  <script src="js/sendreport.js"></script>
  <!-- Confirm -->
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

