<?php

// session_start();
// var_dump($_SESSION);
require 'common/_dbconnect.php';

require 'common/header.php';

?>
<!DOCTYPE html> 
<html lang="en">
	
<head>
		<meta charset="utf-8">
		<title>Doctor Invoices</title>
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
									<li class="breadcrumb-item active" aria-current="page">Invoices</li>
								</ol>
							</nav>
							<h2 class="breadcrumb-title">Invoices</h2>
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
                        <div class="card">
                            <div class="card-body pt-0">

                                <!-- Tab Menu -->
                                <nav class="user-tabs mb-4">
                                    <ul class="nav nav-tabs nav-tabs-bottom nav-justified">
                                        
                                        <li class="nav-item">
                                            <a class="nav-link" href="#pat_invoices" data-toggle="tab">Invoices</a>
                                        </li>
                                    </ul>
                                </nav>
                                <!-- /Tab Menu -->

                                <!-- Tab Content -->
                                <div class="tab-content pt-0">

                                    <!-- Invoices Tab -->

                                    <div id="pat_invoices" class="tab-pane fade">
                                        <div class="card card-table mb-0">
                                            <div class="card-body">
                                                <div class="table-responsive">
                                                    <table class="table table-hover table-center mb-0">
                                                        <thead>
                                                            <tr>
                                                                <th>Invoice No</th>
                                                                <th>Patient</th>
                                                                <th>Amount</th>
                                                                <th>Issued On</th>
                                                                <th></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                        <?php
							            // Storing the Session Variable that was declared in 'pat-login.php' in Another variable
							            $doc_id = $_SESSION['id'];
                                        
                                        // var_dump($pt_inv_id);
                                        
                                        // The Session Variable Would be Compared with the 'patient_id' column values of the 'Invoice' Table and if matched then only the Data would be shown 
                                        $sql=mysqli_query($conn,"select * from invoice_tbl where doctor_id = '$doc_id'");
                                      
                                        $cnt=1;
                                        
                                        // Data Displaying
							            while($row=mysqli_fetch_array($sql))
							            {
                                        ?>
                                        <tr>
                                            <td>
                                                <!-- Displaying Invoice Number Dynamically -->
                                                <?php echo $row['invoice_id'];?>
                                            </td>

                                            <td>

                                            <?php
                                                // Separate Query for fetching the Doctor Details because they Dont Exist Independently in the 'Invoice' Table
                                                // The 'where' clause however is set to 'Invoice' Table's doctor Id because after the FIRST Query Execution, only those rows are left whose Patient-Id = Id of Currently logged in user, so Doctor Id's can be fetched from those Rows only and thus we need not run any other query just for Extracting the Doctor Id's belonging to this Patient-Id Separately.
                                                // The '$row[doctor_id]' value is of doctor_id column in 'invoice_tbl'
                                                $sql2 = mysqli_query($conn,"select * from patient_tbl where id = $row[patient_id] ");
                                                
                                                $cnt2 = 1;

                                                // Displaying Data 
                                                while($row2 = mysqli_fetch_array($sql2))
                                                {
                                                    // var_dump($row2['doctor_name']);
                                            ?>

                                                <!-- Data fetched as 'echo row2' because that variable points to the Query Executed for Obtaining the Doctor Data --> 
                                                <h2 class="table-avatar">
                                                    <a href="#"
                                                        class="avatar avatar-sm mr-2">
                                                        <img class="avatar-img rounded-circle"
                                                            src="assets/img/patients/<?php echo $row2["image_name"]; ?>.jpg" width="20" alt="Patient Image">
                                                    </a>
                                                    <?php echo $row2['patient_name'];?><br> Id: <?php echo $row2['id'];?>
                                                </h2>

                                            <?php
                                                $cnt2 = $cnt2 +1;    
                                                }
                                            ?>

                                            </td>

                                            <!-- 'echo $row' would fetch the Data because 'row' points to the FIRST Query i.e Invoice Table Data -->
                                            <td><?php echo $row['amount'];?></td>
                                            <td><?php echo $row['invoice_issue_date'];?></td>
                                            
                                            <td class="text-right">
                                                <div class="table-action">

                                                    <a href="pat-invoice-view.php?id=<?php echo $row['invoice_id'] ?>"
                                                    class="btn btn-sm bg-info-light">
                                                        <i class="far fa-eye"></i> View
                                                    </a>

                                                </div>
                                            </td>
                                            </tr>

                                            <?php 
                                            $cnt=$cnt+1;
                                            }?>
                                                
                                        </tbody>
                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div> 
                                </div>
                                <!-- /Invoices Tab -->
            <!-- Tab Content -->

                            </div>
                        </div>
                    </div>

        <!-- /Page Content -->
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