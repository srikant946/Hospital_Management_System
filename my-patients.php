<?php

// session_start();
// var_dump($_SESSION);
require 'common/_dbconnect.php';

require 'common/header.php';
require 'common/doc_login_check.php';
?>
<!DOCTYPE html> 
<html lang="en">
	
<head>
		<meta charset="utf-8">
		<title>Patient List</title>
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
									<li class="breadcrumb-item active" aria-current="page">My Patients</li>
								</ol>
							</nav>
							<h2 class="breadcrumb-title">My Patients</h2>
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
                        // var_dump($pat_id);
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
							<div class="row row-grid">

							<?php
							// Storing the Session Variable that was declared in 'doc-login.php' in Another variable
							$docid = $_SESSION['id'];
							// var_dump($docid);
							$sql=mysqli_query($conn,"select distinct user_id from appointment where doctor_id = '$docid'");
							$cnt=1;
							while($row=mysqli_fetch_array($sql))
							{
								$user_id=$row["user_id"];
								$sql1=mysqli_query($conn,"select * from patient_tbl where id='$user_id' ");
								$row1=mysqli_fetch_array($sql1);
							?>
								<div class="col-md-6 col-lg-4 col-xl-3">
									<div class="card widget-profile pat-widget-profile">
										<div class="card-body">
											<div class="pro-widget-content">
												<div class="profile-info-widget">
													<a href="#" class="booking-doc-img">
													<!-- Below LOC For BLOB Image Retrieval -->
													<?php // echo '<img src = "data:image/jpeg;base64, '.base64_encode($row['image1']) .'" height="100" width="100" alt="User Image"/>'; ?>
													<img src = "assets/img/patients/<?php echo $row1['image_name']; ?>.jpg" alt = "Patient Image">
													</a>
													<div class="profile-det-info">
														<h3><a href="patient-profile.html"><?php echo $row1['patient_name'];?></a></h3>
														
														<div class="patient-details">
															<h5><b>Patient ID :</b> <?php echo $row1['id'];?> </h5>
															<h5 class="mb-0"><i class="fas fa-map-marker-alt"></i><?php echo $row1['patient_address'];?></h5>
														</div>
													</div>
												</div>
											</div>
											<div class="patient-info">
												<ul>
													<li>Phone <span><?php echo $row1['patient_contact_no'];?></span></li>
													<li>Age <span><?php echo $row1['patient_age'];?></span></li>
													<li>Gender <span><?php echo $row1['patient_gender'];?></span></li>
												</ul>
											</div>
										</div>
									</div>
								</div>
								
							<?php 
							$cnt=$cnt+1;
							}
							?>
					
								
							</div>	
						</div>
						

					</div>

				</div>

			</div>		
			<!-- /Page Content -->
   
			<?php require 'common/footer.php' ?>
		   
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
		
		<!-- Custom JS -->
		<script src="assets/js/script.js"></script>
		
	</body>

</html>