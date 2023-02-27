<!DOCTYPE html>
<?php include_once "check.php" ?>
<html lang="en">
<?php include_once "head.php" ?>
<?php if (isset($_GET['chatuid'])) {
	$_SESSION['chatuid'] = $_GET['chatuid'];
}?>
<link rel="stylesheet" href="chat/chat-style.css">
<script>
	$(document).ready(function() {
		$("#chat-messages").mouseenter(function() {
			$("#chat-messages").addClass('Active');
		});
		$("#chat-messages").mouseleave(function() {
			$("#chat-messages").removeClass('Active');
		});
	});
</script>
<body>
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
					<div class="row">
						<div class="col-sm-12">
							<div class="home-tab">
								<main class="content">
									<div class="container p-0">
										<h1 class="h3 mb-3">Messages</h1>
										<nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
											<ol class="breadcrumb border border-0">
												<li class="breadcrumb-item"><a href="./">Home</a></li>
												<li class="breadcrumb-item active" aria-current="page">Messages</li>
											</ol>
										</nav>
										<div class="card">
											<div class="row g-0">
												<div class="col-12 col-lg-5 col-xl-3 border-right">
													<!--Search-->
													<div class="px-4 d-none d-md-block">
														<div class="d-flex align-items-center">
															<div class="flex-grow-1 form-group">
																<div class="input-group my-4">
																	<input type="text" class="form-control" id="search-user" value="" onkeyup="searchuser(this.value)" placeholder="Search...">
																	<div class="input-group-append">
																		<span class="input-group-text"><i class="mdi mdi-account-search text-dark"></i></span>	
																	</div>
																</div>
															</div>
														</div>
													</div>
													<!--Chat Users-->
													<div id="chat-users" class="overflow-auto" style="max-height:400px"></div>
													<hr class="d-block d-lg-none mt-1 mb-0">
												</div>
												<div class="col-12 col-lg-7 col-xl-9">
													<!--head-->
													<?php if (isset($_GET['chatuid'])) { ?>
													<?php $chat_user = mysqli_fetch_assoc(mysqli_query($link, "SELECT * FROM bfp_users WHERE uid = '" . $_GET['chatuid'] . "'"));?>
													<div class="py-2 px-4 border-bottom d-none d-lg-block">
														<div class="d-flex align-items-center py-1">
															<div class="position-relative">
																<img src="../assets/img/<?php echo $chat_user['profile_img']?>" class="rounded-circle me-3" alt="Sharon Lessman" width="40" height="40">
															</div>
															<div class="flex-grow-1 pl-3">
																<strong><?php
																if ($chat_user['position'] == "Provincial") {
																	echo $chat_user['location'] . ' (' . $chat_user['position'] . ')';
																} elseif ($chat_user['position'] == "Municipal") {
																	echo $chat_user['location'] . "," . $chat_user['municipal'] . ' (' . $chat_user['position'] . ')';
																	echo $chat_user['active'];
																} else {
																	echo "Regional";
																}
																?></strong>
															</div>
														</div>
													</div>
													<?php }?>
													<!--head-->
													<div class="position-relative" style="height:400px;">
														<div id="chat-messages" class="chat-messages p-4 overflow-auto" style="max-height: 400px;"></div>			
													</div>
													<form id="chat-send" class="flex-grow-0 py-3 px-4 border-top">
														<div class="input-group">
															<input type="text" id="msg" name="msg" class="form-control" placeholder="Type your message" required>
															<button type="submit" class="btn btn-primary text-white">Send</button>
														</div>
													</form>
												</div>
											</div>
										</div>
									</div>
								</main>
							</div>
						</div>
					</div>
					<script>
						$(document).on("click", ".deletemsg", function (e) {
							e.preventDefault();
							var msgid = $(this).val();
							if (confirm("Are you sure you want to Delete this Message?")) {
								$.ajax({
									type: "POST",
									url: "php/function.php",
									data: {
										delete_msg: true,
										msgid: msgid,
									},
									success: function (response) {
										var res = jQuery.parseJSON(response);
										if (res.status == 500) {
											swal ( "Oops" ,  "Something went wrong!" ,  "error" );
										} else {
											swal ( "Success" ,  "Successfully Delete Message!" ,  "success" );
										}
									},
								});
							}
						});
						$(document).on('submit', '#chat-send', function (e) {
							e.preventDefault();
							var msg = $("#msg").val();
							let currentDate = new Date();
							let cDay = currentDate.getDate();
							let cMonth = currentDate.getMonth() + 1;
							let cYear = currentDate.getFullYear();
							let date = cDay + "/" + cMonth + "/" + cYear;
							let time = currentDate.getHours() + ":" + currentDate.getMinutes() + ":" + currentDate.getSeconds();   
							var formData = new FormData(this);
							formData.append("send_message", true);
							$.ajax({
									type: "POST",
									url: "chat/send-message.php",
									data: formData,
									processData: false,
									contentType: false,
									success: function (response) {
																							
									var message = '<div class="chat-message-right pb-4">'+
																	'<div>'+
																		'<img src="https://bootdey.com/img/Content/avatar/avatar1.png" class="rounded-circle mr-1" alt="Chris Wood" width="40" height="40">'+
																		'<div class="text-muted small text-nowrap mt-2">'+time+
																		'</div>'+
																	'</div>'+
																	'<div class="flex-shrink-1 bg-light rounded py-2 px-3 mr-3">'+
																		'<div class="font-weight-bold mb-1">You</div>'+ msg +
																	'</div>'+
																'</div>';

									var res = jQuery.parseJSON(response);
									if(res.status == 200){
										$('#chat-messages').append(message)
										$("#chat-messages").scrollTop($("#chat-messages")[0].scrollHeight);
										$("#msg").val("");
									}
								}
							});
						});
					</script>
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
		<!-- Custom js for this page-->
		<script src="../template/js/jquery.cookie.js" type="text/javascript"></script>
		<script src="../template/js/dashboard.js"></script>
		<script src="chat/chat.js"></script>

		<!-- End custom js for this page-->
</body>

</html>