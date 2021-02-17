<!DOCTYPE html>
<html>
<head>
	<title></title>

	<link href="assets/img/favicon.png" rel="icon">
		
		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="assets/css/bootstrap.min.css">
		
		<!-- Fontawesome CSS -->
		<link rel="stylesheet" href="assets/plugins/fontawesome/css/fontawesome.min.css">
		<link rel="stylesheet" href="assets/plugins/fontawesome/css/all.min.css">
		
		<!-- Main CSS -->
		<link rel="stylesheet" href="assets/css/style.css">
		<style type="text/css">
			
		</style>

</head>
<body>
	<?php 

		$name=$_COOKIE['doc_name'];

		// $conn = new mysqli("localhost","root","","hospital_db");

		// $select= "select id,doctor_fees from doctor_tbl where doctor_name='$name' ";

		// $result=$conn->query($select);
		// $row = $result->fetch_assoc();

		// echo $row["id"];


	 ?>

		<!-- Page Content -->
			<div class="content success-page-cont">
				<div class="container-fluid">
				
					<div class="row justify-content-center">
						<div class="col-lg-6">
						
							<!-- Success Card -->
							<div class="card success-card">
								<div class="card-body">
									<div class="success-cont">
										<i class="fas fa-check"></i>
										<h3>Appointment booked Successfully!</h3>
										<p>Appointment booked with <strong>

										<?php
										$name=$_COOKIE["doc_name"]; 
										echo $name; 
										?>

										</strong><br> on <strong>

										<?php 
										$date=$_COOKIE["date"];
										$day=$_COOKIE["day"];
										echo "$date  $day";
										?>
										 </strong> <br>at <strong>

										 <?php
										 	$time=$_COOKIE["time"];
										 	echo $time;
										 ?>
										 		
										 	</strong>
										</p>
										<a href="invoice-view.php" class="btn btn-primary view-inv-btn">View Invoice</a>
									</div>
								</div>
							</div>
							<!-- /Success Card -->
							
						</div>
					</div>
					
				</div>
			</div>		
			<!-- /Page Content -->

</body>
</html>