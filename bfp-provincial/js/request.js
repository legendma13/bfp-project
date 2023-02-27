$(document).on("click", ".approverequest", function (e) {
	e.preventDefault();
	var request_id = $(this).val();

	if (confirm("Are you sure you want Approve this Report?")) {
		$.ajax({
			type: "POST",
			url: "php/function.php",
			data: {
				approverequest: true,
				request_id: request_id,
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

$(document).on("click", ".neededit", function (e) {
	e.preventDefault();
	var request_id = $(this).val();

	if (confirm("Are you sure you want to Return this Report?")) {
		$.ajax({
			type: "POST",
			url: "php/function.php",
			data: {
				neededitrequest: true,
				request_id: request_id,
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
