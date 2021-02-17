<!DOCTYPE html>
<html>
<head>
	<title></title>
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

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

		<script src="https://code.jquery.com/jquery-2.1.4.js"></script>

		<script>
			
			function senddata(doc_name) 
			{
				var temp=doc_name;
				document.cookie = "doc_name = " + doc_name 
			}	
		</script>
		
</head>
<body>

	<?php 

		$conn = new mysqli("localhost","root","","hospital_db");

		$select_all= "Select doctor_specialization,doctor_name,doctor_address,doctor_fees,doctor_contact_no,doctor_email,doctor_info,doctor_image_name from doctor_tbl";
		$result=$conn->query($select_all);

		if($result->num_rows > 0) 
		{
			while($row = $result->fetch_assoc()) 
			{ 
	 ?>

    			<div class="card">
				<div class="card-body">
					<div class="doctor-widget">
						<div class="doc-info-left">
							<div class="doctor-img">
								<a href="#">
									<img src="assets/img/doctors/<?php echo $row["doctor_image_name"]?>.jpg" class="img-fluid" alt="Doctor Image">
								</a>
							</div>
							<div class="doc-info-cont">
								<h4 class="doc-name"><a href="#" class="name"> <?php echo $row["doctor_name"] ?>
								</a></h4>
								<p class="doc-speciality">
									</p>
								<h5 class="doc-department"><?php echo $row["doctor_specialization"] ?>
								</h5>
								
								<div class="doc-bio">
									<h6><?php echo $row["doctor_info"] ?> </h6>
								</div>
							</div>
						</div>
						<div class="doc-info-right">
							<div class="clini-infos">
								<ul>
									<li><i class="fas fa-phone"></i> <?php echo $row["doctor_contact_no"] ?></li>
									<li><i class="far fa-envelope"></i> <?php echo $row["doctor_email"] ?></li>
									<li><i class="far fa-money-bill-alt"></i> 
										<?php echo $row["doctor_fees"] ?>
									</li>
								</ul>
							</div>
							<div class="clinic-booking">
								<!-- <a class="view-pro-btn" name="Profile">View Profile</a> -->
								<a class="apt-btn" name="Appointment" onclick="senddata('<?php echo $row["doctor_name"] ?>')" href="booking.php">Book Appointment</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		<!-- /Doctor Widget -->

		<?php
  		}
		}
		?>

</body>
</html>