<?php 

require 'common/_dbconnect.php'; 

require 'common/header.php';

$did=intval($_GET['id']); // Whatever ID is passed in 'GET' Parameter, the invoice corresponding to that id is Loaded

?>

<!DOCTYPE html> 
<html lang="en">
	
<head>
		<meta charset="utf-8">
		<title>View Patient Invoice</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
		
		<!-- Favicons -->
		<link href="assets/img/favicon.png" rel="icon">
		
		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="assets/css/bootstrap.min.css">
		
		<!-- Fontawesome CSS -->
		<link rel="stylesheet" href="assets/plugins/fontawesome/css/fontawesome.min.css">
		<link rel="stylesheet" href="assets/plugins/fontawesome/css/all.min.css">
		
		<!-- Main CSS -->
		<link rel="stylesheet" href="assets/css/style.css">
		
		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
			<script src="assets/js/html5shiv.min.js"></script>
			<script src="assets/js/respond.min.js"></script>
		<![endif]-->
	
	</head>
	<body>

		<!-- Main Wrapper -->
		<div class="main-wrapper">
					
			<!-- Breadcrumb -->
			<div class="breadcrumb-bar">
				<div class="container-fluid">
					<div class="row align-items-center">
						<div class="col-md-12 col-12">
							<nav aria-label="breadcrumb" class="page-breadcrumb">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="index.php">Home</a></li>
									<li class="breadcrumb-item active" aria-current="page">Invoice View</li>
								</ol>
							</nav>
							<h2 class="breadcrumb-title">Invoice View</h2>
						</div>
					</div>
				</div>
			</div>
			<!-- /Breadcrumb -->
			
			<?php

			$conn = new mysqli("localhost","root","","hospital_db");


			$que = "select * from invoice_tbl where invoice_id = $did ";
			$sql=mysqli_query($conn,$que);
                                      
            $cnt=1;
                                        
			while($row=mysqli_fetch_array($sql))
			{
			?>


			<!-- Page Content -->
			<div class="content">
				<div class="container-fluid">
					<div class="row">
						<div class="col-lg-8 offset-lg-2">
							<div class="invoice-content">
								<div class="invoice-item">
									<div class="row">
										<div class="col-md-6">
											<div class="invoice-logo">
												<img src="assets/img/logo.png" alt="logo">
											</div>
										</div>
										<div class="col-md-6">
											<p class="invoice-details">
												<strong>Invoice No:</strong> <?php echo $row['invoice_id'] ?> <br>
												<strong>Issued On:</strong> <?php echo $row['invoice_issue_date'] ?>
											</p>
										</div>
									</div>
								</div>			

								<?php
									// Separate Query for fetching the Doctor Details because they Dont Exist Independently in the 'Invoice' Table
									// The 'where' clause however is set to 'Invoice' Table's doctor Id because after the FIRST Query Execution, only those rows are left whose Patient-Id = Id of Currently logged in user, so Doctor Id's can be fetched from those Rows only and thus we need not run any other query just for Extracting the Doctor Id's belonging to this Patient-Id Separately.
									// '$row['doctor_id]' is a value fetched from 'invoice_tbl' doctor_id column
									$sql1 = mysqli_query($conn,"select * from doctor_tbl where id = $row[doctor_id] ");
									
									$cnt1 = 1;

									// Displaying Data 
									while($row1 = mysqli_fetch_assoc($sql1))
									{
										// var_dump($row2['doctor_name']);
								?>

								<!-- Invoice Item -->
								<div class="invoice-item">
									<div class="row">
										<div class="col-md-6">
											<div class="invoice-info">
												<strong class="customer-text">Invoice From</strong>
												<p class="invoice-details invoice-details-two">
												<?php echo $row1["doctor_name"]; ?><br>
												<?php echo $row1["doctor_specialization"]; ?>,<br>
												<?php echo $row1["doctor_contact_no"]; ?><br>
												<strong>Email at:</strong> <?php echo $row1["doctor_email"]; ?>
												</p>
											</div>
										</div>
											
								<?php
									$cnt1 = $cnt1 +1;    
									}
								?>
										<?php
											// Separate Query for fetching the Doctor Details because they Dont Exist Independently in the 'Invoice' Table
											// The 'where' clause however is set to 'Invoice' Table's doctor Id because after the FIRST Query Execution, only those rows are left whose Patient-Id = Id of Currently logged in user, so Doctor Id's can be fetched from those Rows only and thus we need not run any other query just for Extracting the Doctor Id's belonging to this Patient-Id Separately.
											$sql2 = mysqli_query($conn,"select * from patient_tbl where id = $row[patient_id] ");
											
											if(!$sql2)
											 {
											 	printf("Error %s\n",mysqli_error($conn));
											 	exit();
											 }

											$cnt2 = 1;

											// Displaying Data 
											while($row2 = mysqli_fetch_assoc($sql2))
											{
												// var_dump($row2['doctor_name']);
										?>

										<div class="col-md-6">
											<div class="invoice-info invoice-info2">
												<strong class="customer-text">Invoice To</strong>
												<p class="invoice-details">
												<?php echo $row2["patient_name"]; ?><br>
												<?php echo $row2["patient_address"]; ?><br>
												<?php echo $row2["patient_contact_no"]; ?><br>
												<?php echo $row2["patient_email"]; ?>
												</p>
											</div>
										</div>
										
										<?php
											$cnt2 = $cnt2 +1;    
											}
										?>
									</div>
								</div>

								<!-- /Invoice Item -->
								<!-- Invoice Item -->
								<div class="invoice-item">
									<div class="row">
										<div class="col-md-12">
											<div class="invoice-info">
												<strong class="customer-text">Payment Method</strong>
												<p class="invoice-details invoice-details-two">
													Debit Card <br>
													XXXXXXXXXXXX-2541 <br>
													HDFC Bank<br>
												</p>
											</div>
										</div>
									</div>
								</div>
								<!-- /Invoice Item -->
								
								<!-- Invoice Item -->
								<div class="invoice-item invoice-table-wrap">
									<div class="row">
										<div class="col-md-12">
											<div class="table-responsive">
												<table class="invoice-table table table-bordered">
													<thead>
														<tr>
															<th>Description</th>
															<th class="text-center">Quantity</th>
															<th class="text-center">GST</th>
															<th class="text-right">Total</th>
														</tr>
													</thead>
													<tbody>
														<tr>
															<td>General Consultation</td>
															<td class="text-center">1</td>
															<td class="text-center">5%</td>
															<td class="text-right"><?php echo $row["amount"]; ?></td>
														</tr>
													</tbody>
												</table>
											</div>
										</div>
										<div class="col-md-6 col-xl-4 ml-auto">
											<div class="table-responsive">
												<table class="invoice-table-two table">
													<tbody>
													<tr>
														<th>Total Amount:</th>
														<td><span><?php echo $row["amount"]; ?></span></td>
													</tr>
													</tbody>
												</table>
											</div>
										</div>
									</div>
								</div>
								<!-- /Invoice Item -->
								
								<!-- Invoice Information -->
								<div class="other-info">
									<h4>Other Information</h4>
									<p class="text-muted mb-0">
									Please mail payment in full today or contact Patient Financial Services at 800-803-8155 to arrange payment. Please visit us at http://billpay.doccuret.com if you would like to make a payment online using MasterCard, Visa or Discover or if you would like to view a list of Frequently Asked Questions. </p>
									<br>
									<p class="text-muted mb-0"> A $25 service fee will be charged for any cheques returned. Physician charges will be billed separately by the Medical College of Wisconsin. Our commitment is to your health. We appreciate your confidence in Doccure Hospital.</p> </div>
								<!-- /Invoice Information -->
								
							</div>
						</div>
					</div>

				</div>

			</div>		
			<!-- /Page Content -->
			
			<?php                
			$cnt=$cnt+1;
			}
			?>

			<?php require 'common/footer.php' ?>
		   
		</div>
		<!-- /Main Wrapper -->
	  
		<!-- jQuery -->
		<script src="assets/js/jquery.min.js"></script>
		
		<!-- Bootstrap Core JS -->
		<script src="assets/js/popper.min.js"></script>
		<script src="assets/js/bootstrap.min.js"></script>
		
		<!-- Custom JS -->
		<script src="assets/js/script.js"></script>
		
	</body>

</html>