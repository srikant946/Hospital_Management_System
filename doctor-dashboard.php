<?php

require 'common/_dbconnect.php';

// session_start();
// var_dump($_SESSION);
require 'common/header.php';
require 'common/doc_login_check.php';

?>

<!DOCTYPE html> 
<html lang="en">
	
<head>
		<meta charset="utf-8">
		<title>Doctor Dashboard</title>
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
	
		<script type="text/javascript">
			function display_data(id,fees,date_time) {

					$(".appt-id").text("#APT000"+id);
					$(".appt-date_time").text(date_time);
					$(".appt-fees").text("$"+fees);
					console.log(fees);
			}
		</script>

			
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
									<li class="breadcrumb-item active" aria-current="page">Dashboard</li>
								</ol>
							</nav>
							<h2 class="breadcrumb-title">Dashboard</h2>
						</div>
					</div>
				</div>
			</div>
			<!-- /Breadcrumb -->
			
			<!-- Page Content -->
			<div class="content">
            <div class="container-fluid">

                <div class="row">

                    <?php
						// Storing the Session Variable that was declared in 'doc-login.php' in Another variable
                        $doc_id = $_SESSION['id'];
						// var_dump($doc_id);
						
						$sql=mysqli_query($conn,"select * from doctor_tbl where id = '$doc_id'");
						$cnt=1;
						while($row=mysqli_fetch_array($sql))
						{
                    ?>

                    <div class="col-md-5 col-lg-4 col-xl-3 theiaStickySidebar">
                        <div class="profile-sidebar">
                            <div class="widget-profile pro-widget-content">
                                <div class="profile-info-widget">
                                    <a href="#" class="booking-doc-img">
                                        <img src="assets/img/doctors/<?php echo $row['doctor_image_name']; ?>.jpg"
                                            alt="Doctor Image">
                                    </a>
                                    <div class="profile-det-info">
                                        <h3><?php echo $row['doctor_name']; ?></h3>
                                        <div class="patient-details">
                                        <h5 class="mb-2">
                                            <i class="fa fa-user-md"></i> <?php echo $row['doctor_specialization']; ?> 
                                            </h5>
                                            <h5 class="mb-2">
                                            <i class="fa fa-envelope"></i> <?php echo $row['doctor_email']; ?>
                                            </h5>
                                            <h5 class="mb-0">
                                                <i class="fas fa-map-marker-alt"></i><?php echo $row['doctor_address']; ?>
                                            </h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
						<?php 
						$cnt=$cnt+1;
							}
						?>

                            <?php require 'doc-db-widgets.html' ?>

                        </div>
                    </div>
                    <!-- / Profile Sidebar -->

					<div class="col-md-7 col-lg-8 col-xl-9">
						<div class="appointments">
								
						<!-- List of Appointments -->
							<?php 
								$conn1=new mysqli("localhost","root","","hospital_db");
								
								$doc_id = $_SESSION['id'];
								$select_appointment= "select id,user_id,consultancyFees,appointmentDate,appointmentTime from appointment where doctor_id = $doc_id";

								$result=$conn1->query($select_appointment);

								while($row = $result->fetch_assoc()) 
								{ 
									$id=$row["user_id"];       // From 'Appointment' Table
									
									$select_user="select patient_name,patient_contact_no,patient_email,patient_age,patient_address,image_name from patient_tbl where id = $id ";
									$res=$conn1->query($select_user);
									
									$patient_row=$res->fetch_assoc();
									$date=$row["appointmentDate"];           // From 'Appointment' Table
									$time=$row["appointmentTime"];           // From 'Appointment' Table
							?>

								<!-- Appointment List -->
								<div class="appointment-list">
									<div class="profile-info-widget">
										<a href="#" class="booking-doc-img">
											<img src="assets/img/patients/<?php echo $patient_row["image_name"]; ?>.jpg" alt="User Image">
										</a>
										<div class="profile-det-info">
											<h3><a href="#"><?php echo $patient_row["patient_name"]; ?> </a></h3>
											<div class="patient-details">
												<h5><i class="far fa-clock"></i> <?php echo "$date $time " ?></h5>
												<h5><i class="fas fa-map-marker-alt"></i><?php echo $patient_row["patient_address"]; ?> </h5>
												<h5><i class="fas fa-envelope"></i><?php echo $patient_row["patient_email"]; ?></h5>
												<h5 class="mb-0"><i class="fas fa-phone"></i><?php echo $patient_row["patient_contact_no"]; ?></h5>
											</div>
										</div>
									</div>
									<div class="appointment-action">
										<a href="#" class="btn btn-sm bg-info-light" data-toggle="modal" data-target="#appt_details" 
										onclick="display_data('<?php echo $row["id"]  ?>','<?php echo $row["consultancyFees"] ?>','<?php echo "$date $time " ?>')" >
										<i class="far fa-eye"></i> View
										</a>	
									</div>
								</div>
								<!-- /Appointment List -->

								<?php }
								?>
						</div>
					</div>   
						
				<!-- Elite Group  (Top 4 tags) -->	
				</div>	
			</div>

			</div>

			</div>		
			<!-- /Page Content -->
   
			<?php require 'common/footer.php' ?>
		 
			<div class="modal fade custom-modal" id="appt_details">
											<div class="modal-dialog modal-dialog-centered">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title">Appointment Details</h5>
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">&times;</span>
												</button>
											</div>
											<div class="modal-body">
												<ul class="info-details">
													<li>
														<div class="details-header">
															<div class="row">
																<div class="col-md-6">
																	<span class="title appt-id"></span>
																	<span class="text appt-date_time"></span>
																</div>
																<div class="col-md-6">
																	<div class="text-right">
																		<button type="button" class="btn bg-success-light btn-sm" id="topup_status">Completed</button>
																	</div>
																</div>
															</div>
														</div>
													</li>
													<li>
														<span class="title">Status:</span>
														<span class="text">Completed</span>
													</li>
													<li>
														<span class="title">Confirm Date:</span>
														<span class="text">23 Nov 2020</span>
													</li>
													<li>
														<span class="title">Paid Amount</span>
														<span class="text appt-fees"></span>
													</li>
												</ul>
											</div>
										</div>
									</div>
								</div>
		</div>
		<!-- /Main Wrapper -->
	  
		<!-- jQuery -->
		<script src="assets/js/jquery.min.js"></script>
		
		<!-- Bootstrap Core JS -->
		<script src="assets/js/popper.min.js"></script>
		<script src="assets/js/bootstrap.min.js"></script>
		
		<!-- Sticky Sidebar JS -->
        <script src="assets/plugins/theia-sticky-sidebar/ResizeSensor.js"></script>
        <script src="assets/plugins/theia-sticky-sidebar/theia-sticky-sidebar.js"></script>
		
		<!-- Circle Progress JS -->
		<script src="assets/js/circle-progress.min.js"></script>
		
		<!-- Custom JS -->
		<script src="assets/js/script.js"></script>
		
	</body>
</html>