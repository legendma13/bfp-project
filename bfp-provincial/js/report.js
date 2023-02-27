$(document).on('submit', '#approveform', function (e) {
  e.preventDefault();
  var formData = new FormData(this);
  formData.append("approvereport", true);
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
        $("#approveform")[0].reset();
        $("#approve").modal('hide');
        var seconds = 1;  
        setInterval(function () {  
            seconds--;  
            if (seconds == 0) {  
                window.location = "municipal.php";  
            }  
        }, 1000);  
      }else if(res.status == 500) {
        swal ( "Oops" ,  "Something went wrong!" ,  "error" );
      }
      setTimeout('page_redirect()', 5000);  
    }
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
        var seconds = 1;  
        setInterval(function () {  
            seconds--;  
            if (seconds == 0) {  
                window.location = "municipal.php";  
            }  
        }, 1000);  
      }else if(res.status == 500) {
        swal ( "Oops" ,  "Something went wrong!" ,  "error" );
      }
      setTimeout('page_redirect()', 5000);  
    }
  });
});