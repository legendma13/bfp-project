$(document).on("submit", "#form1", function (e) {
	e.preventDefault();
	var formData = new FormData(this);
	formData.append("form1_submitthis", true);
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
        $("#form1")[0].reset();
			} else if (res.status == 500) {
        swal ( "Oops" ,  "Something went wrong!" ,  "error" );
			}
		},
	});
});
$(document).on("submit", "#form1-edit", function (e) {
	e.preventDefault();
	var formData = new FormData(this);
	formData.append("form1_editthis", true);
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
        swal ( "Success" ,  "Successfully Edit Record" ,  "success" );
			} else if (res.status == 500) {
        swal ( "Oops" ,  "Something went wrong!" ,  "error" );
			}
		},
	});
});
$(document).on("click", ".form1-removedata", function (e) {
	e.preventDefault();
	var report_id = $(this).val();
	if (confirm("Are you sure you want to Delete this Record?")) {
		$.ajax({
			type: "POST",
			url: "php/function.php",
			data: {
				delete_report: true,
				request_id: report_id,
			},
			success: function (response) {
				var res = jQuery.parseJSON(response);
				if (res.status == 500) {
					alertify.set("notifier", "position", "top-right");
					alertify.success(res.message);
				} else {
					alertify.set("notifier", "position", "top-right");
					alertify.success(res.message);

					$("#myTable").load(location.href + " #myTable");
				}
			},
		});
	}
});
// Form 2
$(document).on("submit", "#form2", function (e) {
	e.preventDefault();
	var formData = new FormData(this);
	formData.append("form2_submitthis", true);
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
				swal ( "Success" ,  "Successfully Add Record!" ,  "success" );
        $("#form2")[0].reset();
			} else if (res.status == 500) {
				swal ( "Oops" ,  "Something went wrong!" ,  "error" );
			}
		},
	});
});
$(document).on("submit", "#form2-edit", function (e) {
	e.preventDefault();
	var formData = new FormData(this);
	formData.append("form2_editthis", true);
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
				swal ( "Success" ,  "Successfully Edit Record!" ,  "success" );
			} else if (res.status == 500) {
				swal ( "Oops" ,  "Something went wrong!" ,  "error" );
			}
		},
	});
});
$(document).on("click", ".form2removereport", function (e) {
	e.preventDefault();
	var report_id = $(this).val();
	if (confirm("Are you sure you want to Delete this Record?")) {
		$.ajax({
			type: "POST",
			url: "php/function.php",
			data: {
				form2_delete_report: true,
				form2_id: report_id,
			},
			success: function (response) {
				var res = jQuery.parseJSON(response);
				if (res.status == 500) {
					alertify.set("notifier", "position", "top-right");
					alertify.success(res.message);
				} else {
					alertify.set("notifier", "position", "top-right");
					alertify.success(res.message);
					$("#myTable").load(location.href + " #myTable");
				}
			},
		});
	}
});
// Form 3
$(document).on("submit", "#form3", function (e) {
	e.preventDefault();
	var formData = new FormData(this);
	formData.append("form3_submitthis", true);
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
				swal ( "Success" ,  "Successfully Add Record!" ,  "success" );
        $("#form3")[0].reset();
			} else if (res.status == 500) {
				swal ( "Oops" ,  "Something went wrong!" ,  "error" );
			}
		},
	});
});
$(document).on("submit", "#form3-edit", function (e) {
	e.preventDefault();
	var formData = new FormData(this);
	formData.append("form3_editthis", true);
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
				swal ( "Success" ,  "Successfully Edit Record!" ,  "success" );
			} else if (res.status == 500) {
				swal ( "Oops" ,  "Something went wrong!" ,  "error" );
			}
		},
	});
});
$(document).on("click", ".form3removereport", function (e) {
	e.preventDefault();
	var report_id = $(this).val();
	if (confirm("Are you sure you want to Delete this Record?")) {
		$.ajax({
			type: "POST",
			url: "php/function.php",
			data: {
				form3_delete_report: true,
				form3_id: report_id,
			},
			success: function (response) {
				var res = jQuery.parseJSON(response);
				if (res.status == 500) {
					alertify.set("notifier", "position", "top-right");
					alertify.success(res.message);
				} else {
					alertify.set("notifier", "position", "top-right");
					alertify.success(res.message);
					$("#myTable").load(location.href + " #myTable");
				}
			},
		});
	}
});
// Form 4
$(document).on("submit", "#form4", function (e) {
	e.preventDefault();
	var formData = new FormData(this);
	formData.append("form4_submitthis", true);
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
				swal ( "Success" ,  "Successfully Add Record!" ,  "success" );
        $("#form4")[0].reset();
			} else if (res.status == 500) {
				swal ( "Oops" ,  "Something went wrong!" ,  "error" );
			}
		},
	});
});
$(document).on("submit", "#form4-edit", function (e) {
	e.preventDefault();
	var formData = new FormData(this);
	formData.append("form4_editthis", true);
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
				swal ( "Success" ,  "Successfully Add Record!" ,  "success" );
			} else if (res.status == 500) {
				swal ( "Oops" ,  "Something went wrong!" ,  "error" );
			}
		},
	});
});
$(document).on("click", ".form4removereport", function (e) {
	e.preventDefault();
	var report_id = $(this).val();
	if (confirm("Are you sure you want to Delete this Record?")) {
		$.ajax({
			type: "POST",
			url: "php/function.php",
			data: {
				form4_delete_report: true,
				form4_id: report_id,
			},
			success: function (response) {
				var res = jQuery.parseJSON(response);
				if (res.status == 500) {
					alertify.set("notifier", "position", "top-right");
					alertify.success(res.message);
				} else {
					alertify.set("notifier", "position", "top-right");
					alertify.success(res.message);

					$("#myTable").load(location.href + " #myTable");
				}
			},
		});
	}
});
