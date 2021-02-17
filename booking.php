<?php

// session_start();
// var_dump($_SESSION);
require 'common/_dbconnect.php';

require 'common/header.php';
require 'common/pat_login_check.php';

?>

<!DOCTYPE html>
<html>
<head>
	<title>Placing an Appointment</title>

	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
		
		<!-- Fontawesome CSS -->
		<link rel="stylesheet" href="assets/plugins/fontawesome/css/fontawesome.min.css">

		<link rel="stylesheet" href="assets/plugins/fontawesome/css/all.min.css">
		
		<!-- Datetimepicker CSS -->
		<!--link rel="stylesheet" href="assets/css/bootstrap-datetimepicker.min.css"-->
		
		<!-- Select2 CSS -->
		<link rel="stylesheet" href="assets/plugins/select2/css/select2.min.css">
		
		<!-- Fancybox CSS -->
		<link rel="stylesheet" href="assets/plugins/fancybox/jquery.fancybox.min.css">
		
		<!-- Main CSS -->
		<link rel="stylesheet" href="assets/css/style.css">

		<!-- jQuery -->
		<script src="assets/js/jquery.min.js"></script>
		
		<!-- Bootstrap Core JS -->
		<script src="assets/js/popper.min.js"></script>
		<script src="assets/js/bootstrap.min.js"></script>
		
		<!-- Sticky Sidebar JS -->
        <script src="assets/plugins/theia-sticky-sidebar/ResizeSensor.js"></script>
        <script src="assets/plugins/theia-sticky-sidebar/theia-sticky-sidebar.js"></script>
		
		<!-- Custom JS -->
		<script src="assets/js/script.js"></script>

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

		<style type="text/css">
			.d

		</style>

		<script type="text/javascript">

			var time="";
			var date="";
			var day="";
			$(document).ready(function () {
				
				$(".timing").click(function () {

					if(time==="")
					{
						$(this).addClass("selected")
						time=$(this).find("span").html().trim()
						$(".submit-btn").attr("href","checkout.php")

						var val=$(this).find("span").attr("class")
						date=$(".day-slot ."+val+" .slot-date").html()
						day=$(".day-slot ."+val+" .day").html()
						console.log(date,day,time)
					}
					else if($(this).hasClass("selected")) {
						$(this).removeClass("selected")
						time=""
						$(".submit-btn").removeAttr("href")
					}

				})

				$(".submit-btn").click(function () {
					document.cookie = "day= " + day;
					document.cookie = "date= " + date;
					document.cookie = "time= " + time; 

				})
			})



		</script>

</head>
<body>
<?php 
	// Doctor Name fetched via Cookie 
	$name=$_COOKIE['doc_name'];

	$conn = new mysqli("localhost","root","","hospital_db");

	$select= "select doctor_specialization,doctor_name,doctor_address,doctor_fees,doctor_contact_no,doctor_email,doctor_image_name from doctor_tbl where doctor_name='$name' ";
		$result=$conn->query($select);
		
		  $row = $result->fetch_assoc();
		  $doctor_image_name=$row["doctor_image_name"];
		  $doctor_address=$row["doctor_address"];
		  $doctor_specialization=$row["doctor_specialization"];

	$select_time="select monday,tuesday,wednesday,thursday,friday,saturday from doctor_time where 
	docName='$name' ";

	$result1=$conn->query($select_time);
	$row1 = $result1->fetch_assoc();


?>
	<div class="content">
				<div class="container">
				
					<div class="row">
						<div class="col-12">
						
							<div class="card">
								<div class="card-body">
									<div class="booking-doc-info">
										<a href="#" class="booking-doc-img">
											<img src="assets/img/doctors/<?php echo $doctor_image_name ?>.jpg" alt="User Image">
										</a>
										<div class="booking-info">
											<h4> <a href="#"> <?php echo $_COOKIE['doc_name'];?></a></h4>
											<div class="specialization">
											<p class="text-muted mb-1"><i class="fas fa-user-md"></i> <?php echo $doctor_specialization; ?>
											</div>
											<p class="text-muted mb-0"><i class="fas fa-map-marker-alt"></i> <?php echo $doctor_address; ?></p>
										</div>
									</div>
								</div>
							</div>
							
							<!-- Schedule Widget -->
							<div class="card booking-schedule schedule-widget">
							
								<!-- Schedule Header -->
								<div class="schedule-header">
									<div class="row">
										<div class="col-md-12">
										
											<!-- Day Slot -->
											<div class="day-slot">
												<ul>
													
													<li class="1">
														<span class="day">Monday</span>
														<span class="slot-date">23 November 2020</span>
													</li>
													<li class="2">
														<span class="day">Tuesday</span>
														<span class="slot-date">24 November 2020</span>
													</li>
													<li class="3">
														<span class="day">Wednesday</span>
														<span class="slot-date">25 November 2020</span>
													</li>
													<li class="4">
														<span class="day">Thursday</span>
														<span class="slot-date">26 November 2020</span>
													</li>
													<li class="5">
														<span class="day">Friday</span>
														<span class="slot-date">27 November 2020</span>
													</li>
													<li class="6">
														<span class="day">Saturday</span>
														<span class="slot-date">28 November 2020</span>
													</li>
												</ul>
											</div>
											<!-- /Day Slot -->
											
										</div>
									</div>
								</div>
								<!-- /Schedule Header -->
								
								<!-- Schedule Content -->

								<div class="schedule-cont">
									<div class="row">
										<div class="col-md-12">
										
											<!-- Time Slot -->
		
											 
											<div class="time-slot">
												<ul class="clearfix">

													<li>
														<a class="timing" href="#">
														<span class="1">
														<?php echo date("g:i a", strtotime($row1["monday"]));?>
														</span>
														</a>

														<a class="timing" href="#">
														<span class="1">
														<?php echo date("g:i a", strtotime($row1["monday"])+60*60 );?>
															</span> 
														</a>
														<a class="timing" href="#">
															<span class="1">
														<?php echo date("g:i a", strtotime($row1["monday"])+60*60*2 );?>
														</span>
														</a>
													</li>

													<li>
														<a class="timing" href="#">
															<span class="2">
														<?php echo date("g:i a", strtotime($row1["tuesday"]));?>
														</span> 
														</a>
														<a class="timing" href="#">
															<span class="2">
															<?php echo date("g:i a", strtotime($row1["tuesday"])+60*60 );?>	
															</span> 
														</a>
														<a class="timing" href="#">
															<span class="2">
															<?php echo date("g:i a", strtotime($row1["tuesday"])+60*60*2 );?>
														</span> 
														</a>
													</li>
													
													<li>
														<a class="timing" href="#">
															<span class="3">
														<?php echo date("g:i a", strtotime($row1["wednesday"]));?>
															</span> 
														</a>
														<a class="timing" href="#">
															<span class="3">
														<?php echo date("g:i a", strtotime($row1["wednesday"])+60*60);?>
															</span> 
														</a>
														<a class="timing" href="#">
															<span class="3">
														<?php echo date("g:i a", strtotime($row1["wednesday"])+60*60*2);?>
															</span> 
														</a>
													</li>
													
													<li>
														<a class="timing" href="#">
															<span class="4">
														<?php echo date("g:i a", strtotime($row1["thursday"]));?>
															</span> 
														</a>
														<a class="timing" href="#">
															<span class="4">
														<?php echo date("g:i a", strtotime($row1["thursday"])+60*60);?>
															</span class="4"> 
														</a>
														<a class="timing" href="#">
															<span class="4">
														<?php echo date("g:i a", strtotime($row1["thursday"])+60*60*2);?>
															</span> 
														</a>
													</li>
													
													<li>
														<a class="timing" href="#">
															<span class="5">
														<?php echo date("g:i a", strtotime($row1["friday"]));?>
															</span> 
														</a>
														<a class="timing" href="#">
															<span class="5">
														<?php echo date("g:i a", strtotime($row1["friday"])+60*60);?>
															</span> 
														</a>
														<a class="timing" href="#">
															<span class="5">
														<?php echo date("g:i a", strtotime($row1["friday"])+60*60*2);?>
															</span> 
														</a>
													</li>
													
													<li>
														<a class="timing" href="#">
															<span class="6">
														<?php echo date("g:i a", strtotime($row1["saturday"]));?>
															</span> 
														</a>
														<a class="timing" href="#">
															<span class="6">
														<?php echo date("g:i a", strtotime($row1["saturday"])+60*60);?>
															</span> 
														</a>
														<a class="timing" href="#">
															<span class="6">
														<?php echo date("g:i a", strtotime($row1["saturday"])+60*60*2);?>
															</span> 
														</a>
													</li>
													
											<!-- /Time Slot -->
											
											
												</ul>
											</div>
											
										</div>
									</div>
								</div>
								<!-- /Schedule Content -->
								<br>
							</div>

							<!-- /Schedule Widget -->
							<div class="submit-section proceed-btn text-right">
								<a class="btn btn-primary submit-btn">Proceed to Pay</a>
							</div>
							<!-- /Submit Section -->
							
						</div>
					</div>
				</div>

			</div>		
			<!-- /Page Content -->

</body>
</html>