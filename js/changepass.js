$(document).on("submit", "#changeform", function (e) {
	e.preventDefault();
	var formData = new FormData(this);
	formData.append("changepasswordsubmit", true);
	$.ajax({
		type: "POST",
		url: "../php/changepass.php",
		data: formData,
		processData: false,
		contentType: false,
		success: function (response) {
			var res = jQuery.parseJSON(response);
			if (res.status == 422) {
        swal ( "Oops" ,  res.message ,  "error" );
			} else if (res.status == 200) {
        swal ( "Success" ,  "Successfully Change Password" ,  "success" );
        $("#changeform")[0].reset();
				var seconds = 1;  

				setInterval(function () {  
						seconds--;  
						if (seconds == 0) {  
								window.location = "../php/logout.php";  
						}  
				}, 1000);  

			} else if (res.status == 500) {
        swal ( "Oops" ,  res.message ,  "error" );
			}
			setTimeout('page_redirect()', 5000);  
		},
	});
});



$(document).on("click", "#countDropdown", function (e) {
	e.preventDefault();
	$.ajax({
		type: "POST",
		url: "../php/changepass.php",
		data: {
			reddot: true,
		},
		success: function (response) {
			var res = jQuery.parseJSON(response);
			if(res.status == 200)
				$("#reddot").hide()
			}
	});
});