<!DOCTYPE html>
<html>
<head>
	<title>Checkout Page</title>
	<link href="assets/img/favicon.png" rel="icon">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="assets/css/bootstrap.min.css">
		
		<!-- Fontawesome CSS -->
		<link rel="stylesheet" href="assets/plugins/fontawesome/css/fontawesome.min.css">
		<link rel="stylesheet" href="assets/plugins/fontawesome/css/all.min.css">
		
		<!-- Main CSS -->
		<link rel="stylesheet" href="assets/css/style.css">

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

			<style type="text/css">
				.razorpay-payment-button {
						background-color: #09e5ab;
						border: 4px solid #09e5ab;
						border-radius: 10px;
						color: #fff;
						width: 10rem;
						font-size: 17px;
						height: 2.5rem;
				}
				.razorpay-payment-button:hover {
					background-color: #09dca4;
					border-color: #09dca4;
				}
			</style>


		  <script type="text/javascript">

			$(document).ready(function () {
			
				$(".razorpay-payment-button").click(function () 
				{
					document.cookie = "fname= "+$(".fname").val();
					document.cookie="lname= "+$(".lname").val();	
				})


			})
		</script>

</head>
<body>
	
	<?php 

	$name=$_COOKIE['doc_name'];

	$conn = new mysqli("localhost","root","","hospital_db");

	$select= "select doctor_specialization,doctor_name,doctor_address,doctor_fees,doctor_contact_no,doctor_email,doctor_image_name from doctor_tbl where doctor_name='$name' ";

	$result=$conn->query($select);
	  $row = $result->fetch_assoc();
	  $doctor_image_name=$row["doctor_image_name"];
	  $doctor_address=$row["doctor_address"];
	  $doctor_specialization=$row["doctor_specialization"];
	  $doctor_fees=$row["doctor_fees"];
	  $str=explode("-", $doctor_fees);
	  $st=str_ireplace("$","",$str[0]);           // If $ exists in the Table then that is replaced by ""
	  $a=(intval($st)+10);                        // Add 10 to the Amount
	  
	  setcookie("amount",$a);

	$day=$_COOKIE["day"];
	$date=$_COOKIE["date"];
	$time=$_COOKIE["time"];


	?>

	<div class="content">
				<div class="container">

					<div class="row">
						<div class="col-md-7 col-lg-8">
							<div class="card">
								<div class="card-body">
								
									<!-- Checkout Form -->
									<form method="POST" action="booking-success.php">
									
										<!-- Personal Information -->
										<div class="info-widget">
											<h4 class="card-title">Personal Information</h4>
											<div class="row">
												<div class="col-md-6 col-sm-12">
													<div class="form-group card-label">
														<label>First Name</label>
														<input class="form-control fname" type="text" name="fname" required>
													</div>
												</div>
												<div class="col-md-6 col-sm-12">
													<div class="form-group card-label">
														<label>Last Name</label>
														<input class="form-control lname" type="text" name="lname" required>
													</div>
												</div>
												<div class="col-md-6 col-sm-12">
													<div class="form-group card-label">
														<label>Email</label>
														<input class="form-control email" type="email" name="email" required>
													</div>
												</div>
												<div class="col-md-6 col-sm-12">
													<div class="form-group card-label">
														<label>Phone</label>
														<input class="form-control phone" type="text" name="phone_no" required>
													</div>
												</div>
											</div>
										</div>
										<!-- /Personal Information -->
										
										<div class="payment-widget">
											
											<!-- Terms Accept -->
											<div class="terms-accept">
												<div class="custom-checkbox">
												   <input type="checkbox" id="terms_accept">
												   <label for="terms_accept">I have read and accepted <a href="#">Terms &amp; Conditions</a></label>
												</div>
											</div>
											<!-- /Terms Accept -->
											
											<!-- Submit Section -->
											<div class="submit-section mt-4">
												
							<!-- <button type="submit" class="btn btn-primary submit-btn">Confirm and Pay</button>
 -->											</div>
											<!-- /Submit Section -->
											
										</div>
										<script  src="https://checkout.razorpay.com/v1/checkout.js"    

											data-key="rzp_test_7gx07N8s4We3AE" 
											data-amount="<?php echo $a*100; ?>" 
											data-currency="USD"   
											data-buttontext="Confirm and Pay"    
											data-name="Appointment Payment"    
											data-description="Payment for booking an appointment"
											data-image="https://example.com/your_logo.jpg"
											data-theme.color="#1f6f8b">
													
										</script>

									</form>
									<!-- /Checkout Form -->
									
								</div>
							</div>
							
						</div>
						
						<div class="col-md-5 col-lg-4 theiaStickySidebar">
						
							<!-- Booking Summary -->
							<div class="card booking-card">
								<div class="card-header">
									<h4 class="card-title">Booking Summary</h4>
								</div>
								<div class="card-body">
								
									<!-- Booking Doctor Info -->
									<div class="booking-doc-info">
										<a href="doctor-profile.html" class="booking-doc-img">
											<img src="assets/img/doctors/<?php echo $row['doctor_image_name'];?>.jpg" alt="User Image">
										</a>
										<div class="booking-info">
											<h4><a href="doctor-profile.html"><?php echo $name; ?></a></h4>
											<div class="specialization">
											<p class="text-muted mb-1"><i class="fas fa-user-md"></i> <?php echo $doctor_specialization; ?>
											</div>
											<div class="clinic-details">
											<p class="doc-location"><i class="fas fa-map-marker-alt"></i>
												<?php echo $row["doctor_address"] ?>
											</p>
											</div>
										</div>
									</div>
									<!-- Booking Doctor Info -->
									
									<div class="booking-summary">
										<div class="booking-item-wrap">
											<ul class="booking-date">
												<li>Date <span><?php echo "$date $day"?></span></li>
												<li>Time <span><?php echo $time ?></span></li>
											</ul>
											<ul class="booking-fee">
												<li>Consulting Fee <span><?php echo $str[0] ?></span></li>
												<li>Booking Fee <span>$10</span></li>
											</ul>
											<div class="booking-total">
												<ul class="booking-total-list">
													<li>
														<span>Total</span>
														<span class="total-cost">
														<?php 
														echo "$ $a"; ?></span>
													</li>
												</ul>
											</div>
										</div>
									</div>
								</div>
							</div>
							<!-- /Booking Summary -->
							
						</div>
					</div>

				</div>

				
			</div>		
			<!-- /Page Content -->


</body>
</html>