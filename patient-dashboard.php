<?php

// session_start();
// var_dump($_SESSION);
require 'common/_dbconnect.php';

require 'common/header.php';
require 'common/pat_login_check.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Patient Dashboard</title>
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

        <?php 
               // require 'common/header.php';       // Commented Out because 'header.php' would be fetched just after DB Connectivity i.e _dbconnect.php file at the START of THIS Document..because it has 'dashboard-tabs.php' which runs on the basis of Session..
                                                     // Now, we even want to check for authentication i.e if user is NOT logged in then he should not be able to access specific pages and hence we would verify that a user is logged in or not via session variables.
                                                     // If 'header.php' is included AFTER the authentication verification then that would lead to restarting of a currently running session and that would result in authentication not working properly i.e even on logging in the desired page, when clicked upon would lead you to login page again.
        ?>

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
						// Storing the Session Variable that was declared in 'pat-login.php' in Another variable
                        $pat_id = $_SESSION['p_id'];
                        // var_dump($pat_id);
						$sql=mysqli_query($conn,"select * from patient_tbl where id = '$pat_id'");
						$cnt=1;
						while($row=mysqli_fetch_array($sql))
						{
                    ?>

                    <div class="col-md-5 col-lg-4 col-xl-3 theiaStickySidebar">
                        <div class="profile-sidebar">
                            <div class="widget-profile pro-widget-content">
                                <div class="profile-info-widget">
                                    <a href="#" class="booking-doc-img">
                                        <img src="assets/img/patients/<?php echo $row['image_name']; ?>.jpg"
                                            alt="Patient Image">
                                    </a>
                                    <div class="profile-det-info">
                                        <h3><?php echo $row['patient_name']; ?></h3>
                                        <div class="patient-details">
                                            <h5 class="mb-2"><i class="fas fa-phone"></i> <?php echo $row['patient_contact_no']; ?> </h5>
                                            <h5 class="mb-0"><i class="fas fa-map-marker-alt"></i><?php echo $row['patient_address']; ?> </h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <?php 
							$cnt=$cnt+1;
                             }
                            ?>

                            <?php require 'pat-db-widgets.html' ?>

                        </div>
                    </div>
                    <!-- / Profile Sidebar -->

                    <div class="col-md-7 col-lg-8 col-xl-9">
                            
                        <?php require 'search.php' ?>

                    </div>
                                
                                
                </div>
            </div>
        </div>
        
        
        <!-- Footer -->
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