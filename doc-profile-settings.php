<?php

require 'common/_dbconnect.php';

require 'common/header.php';
require 'common/doc_login_check.php';

?>

<!DOCTYPE html> 
<html lang="en">
	
<head>
		<meta charset="utf-8">
		<title>Doctor Profile Settings</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
		
		<!-- Favicons -->
		<link href="assets/img/favicon.png" rel="icon">
		
		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="assets/css/bootstrap.min.css">
        
		<!-- Fontawesome CSS -->
		<link rel="stylesheet" href="assets/plugins/fontawesome/css/fontawesome.min.css">
		<link rel="stylesheet" href="assets/plugins/fontawesome/css/all.min.css">
		
		<!-- Datetimepicker CSS -->
		<link rel="stylesheet" href="assets/css/bootstrap-datetimepicker.min.css">
		
		<!-- Select2 CSS -->
		<link rel="stylesheet" href="assets/plugins/select2/css/select2.min.css">
		
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
									<li class="breadcrumb-item active" aria-current="page">Profile Settings</li>
								</ol>
							</nav>
							<h2 class="breadcrumb-title">Profile Settings</h2>
						</div>
					</div>
				</div>
			</div>
            <!-- /Breadcrumb -->
            
            <!-- PHP Code For Data Updation in the Database -->
            <?php
            
            // Sweetalert CDN
            echo '<script type = "text/JavaScript" src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>';

            if (isset($_POST['submit']))
            {
                $name=$_POST['name'];
                $specialization=$_POST['specialization'];
                $fees=$_POST['fees'];
                $email=$_POST['email'];
                $contact=$_POST['contact'];
                $address=$_POST['address'];
                $bio=$_POST['bio'];

				if(!preg_match('/^[0-9]*$/',$contact))
				{
					echo '<script>
					swal("Error!! Please Enter Valid Contact Number", "", "error");
					</script>' ;
				}
				else if(!is_numeric($fees) || $fees < 0)
				{
					echo '<script>
					swal("Error!! Please Enter a Valid Fee Value", "", "error");
					</script>' ;
				}
				else if(strlen($contact) > 10)
				{
					echo '<script>
					swal("Error!! Please Enter Valid Contact Number", "", "error");
					</script>' ;
				}
				else if(strlen($address) > 200)
				{
					echo '<script>
					swal("Error!! The Address entered is too long", "", "error");
					</script>' ;
				}
				else if(strlen($bio) > 200)
				{
					echo '<script>
					swal("Error!! The Bio entered is too long", "", "error");
					</script>' ;
				}
				else if(strlen($specialization) > 50)
				{
					echo '<script>
					swal("Error!! The Specialization Info entered is too long", "", "error");
					</script>' ;
				}
				else if(!filter_var($email, FILTER_VALIDATE_EMAIL))
				{
					echo '<script>
					swal("Error!! Please Enter Valid Email Address", "", "error");
					</script>' ;
				}
				else if(!preg_match("/^[a-zA-Z\s]+$/",$name))
				{
					echo '<script>
					swal("Error!! Please Enter Valid Name", "", "error");
					</script>' ;
				}
				else
				{
                // Session Id of Currently logged-in doctor Is stored in '$doc_id' variable
                // No starting of Session is Performed here Because its already been performed in 'dashboard-tabs.php' File present in 'header.php' File which was imported earlier. 
                $doc_id = $_SESSION['id'];
                $sql = mysqli_query($conn,"Update doctor_tbl set doctor_name='$name', doctor_address='$address', doctor_fees='$fees', doctor_specialization='$specialization', doctor_email='$email', doctor_contact_no='$contact', doctor_info='$bio'  where id = $doc_id");
                if($sql)
                {
                    echo '<script>
                    swal("Data Updated Successfully!!", "", "success");
                    </script>' ;
                }

				// For Error Checking
                // if(!$sql)
				// {
				// printf("Error %s\n",mysqli_error($conn));
				// exit();
				// }
                                            
                else
                {
                    echo '<script>
                    swal("Oops!!", "Something Went Wrong", "error");
                    </script>' ;
				}
				} // 'Else' ends here
            }
            ?>
                                
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
							<div class="card">
								<div class="card-body">
                                    
                                <?php 

                                    // The 'id' column value of doctor Table is matched with Session Value Of doctor Logged in
                                    // Storing the Session Variable that was declared in 'doc-login.php' in Another variable
                                    $doc_id = $_SESSION['id'];
                                    $sql1 = mysqli_query($conn,"select * from doctor_tbl where id = $doc_id");
									while($data=mysqli_fetch_array($sql1))
									{
                                ?>
                                    
									<!-- Profile Settings Form -->
									<form method="post">
										<div class="row form-row">
											<div class="col-12 col-md-12">
												<div class="form-group">
													<h3><?php echo htmlentities($data['doctor_name']);?>'s Profile</h3>
												</div>
                                            </div>
                                            
											<div class="col-12 col-md-6">
												<div class="form-group">
													<label>Name</label>
													<input type="text" name="name" class="form-control" value="<?php echo htmlentities($data['doctor_name']);?>">
												</div>
											</div>
											
											<div class="col-12 col-md-6">
												<div class="form-group">
													<label>Specialization</label>
														<input type="text" name="specialization" class="form-control" value="<?php echo htmlentities($data['doctor_specialization']);?>">
												</div>
                                            </div>

											<div class="col-12 col-md-6">
												<div class="form-group">
													<label>Fees</label>
														<input type="number" name="fees" class="form-control" value="<?php echo htmlentities($data['doctor_fees']);?>">
												</div>
                                            </div>
                                            
											<div class="col-12 col-md-6">
												<div class="form-group">
													<label>Email ID</label>
													<input type="email" name="email" class="form-control" value="<?php echo htmlentities($data['doctor_email']);?>">
												</div>
                                            </div>
                                            
											<div class="col-12 col-md-6">
												<div class="form-group">
													<label>Contact No</label>
													<input type="text" name="contact" class="form-control" value="<?php echo htmlentities($data['doctor_contact_no']);?>" >
												</div>
                                            </div>
                                            
											<div class="col-12">
												<div class="form-group">
												<label>Address</label>
													<input type="text" name="address" class="form-control" value="<?php echo htmlentities($data['doctor_address']);?>">
												</div>
                                            </div>
                                            
                                            <div class="col-12">
												<div class="form-group">
												<label>About Me</label>
													<textarea name="bio" rows="5" class="form-control"><?php echo htmlentities($data['doctor_info']);?></textarea>
												</div>
											</div>
                                        </div>
                                        
										<div class="submit-section">
											<button type="submit" name="submit" class="btn btn-primary submit-btn">Save Changes</button>
										</div>
                                    </form>
                                    
                                <?php 
								} 
								?>
									<!-- /Profile Settings Form -->
									
								</div>
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
		
		<!-- Select2 JS -->
		<script src="assets/plugins/select2/js/select2.min.js"></script>
		
		<!-- Datetimepicker JS -->
		<script src="assets/js/moment.min.js"></script>
		<script src="assets/js/bootstrap-datetimepicker.min.js"></script>
		
		<!-- Sticky Sidebar JS -->
        <script src="assets/plugins/theia-sticky-sidebar/ResizeSensor.js"></script>
        <script src="assets/plugins/theia-sticky-sidebar/theia-sticky-sidebar.js"></script>
		
		<!-- Custom JS -->
        <script src="assets/js/script.js"></script> 
	</body>

</html>