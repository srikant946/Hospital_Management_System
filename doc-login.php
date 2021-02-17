<?php

require 'common/_dbconnect.php';

$login = false;
$showError = false;

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
$username = $_POST['username'];
$password = $_POST['password'];
$exists = false;

    // Sql query to be executed
    // $sql = "SELECT * FROM doctor_details WHERE username = '$username' AND password = '$password' ";
	
	// For Prevention of SQL Injection
	$sql = "SELECT * FROM doctor_details WHERE username = ? AND password = ? ";
	
	if($stmt = $conn->prepare($sql))
	{
		$stmt->bind_param('ss',$username,$password);
		$stmt->execute();
		$result = $stmt->get_result();

		// $result = mysqli_query($conn, $sql);
		// $num = mysqli_fetch_array($result);         // mysqli_num_rows DOES NOT Work Here
		// if($num > 0)

	$num = mysqli_fetch_array($result);         // mysqli_num_rows DOES NOT Work Here
    if($num > 0)
    {
        $login = true;
        // After Logging in We would START the Session..
        session_start();
        $_SESSION['id'] = $num['sno'];          // The Doctor Who is Logged in..his 'sno' value from the DB would be stored in a Session Variable.
        setcookie("id2",$num['sno']);
        $_SESSION['docloggedin'] = true;
		
		$_SESSION['checking_doc_login'] = $username;
        // $_SESSION['username'] = $username;
        header("location: index.php");        
	
	}
    else
    {
        $showError = 'Invalid Credentials Entered';
	}
	} // Ending Scope of the Validation that is done by Prepare Statement
}    
?>

<!DOCTYPE html> 
<html lang="en">
	
<head>
		<meta charset="utf-8">
		<title>Doctor Login</title>
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
	<body class="account-page">

		<!-- Main Wrapper -->
		<div class="main-wrapper">
            
    <?php

    if($login)
    {
        echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
        <strong>Success</strong> Your Account is now created and you can login now..
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
          <span aria-hidden='true'>&times;</span>
        </button>
        </div> ";
    }

    if($showError)
    {
        echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
        <strong>Error!! </strong>" . $showError . "
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
          <span aria-hidden='true'>&times;</span>
        </button>
        </div> ";
    }
    ?>

			<!-- Page Content -->
			<div class="content">
				<div class="container-fluid">
					
					<div class="row">
						<div class="col-md-8 offset-md-2">
							
							<!-- Login Tab Content -->
							<div class="account-content">
								<div class="row align-items-center justify-content-center">
									<div class="col-md-7 col-lg-6 login-left">
										<img src="assets/img/login-banner.png" class="img-fluid" alt="Doccure Image">	
									</div>
									<div class="col-md-12 col-lg-6 login-right">
										<div class="login-header">
											<h3>Doctor<span> Login</span></h3>
										</div>
										<form action="" method="post">
											<div class="form-group form-focus">
												<input type="text" class="form-control floating" id="username" name="username" required>
												<label class="focus-label">Username</label>
											</div>
											<div class="form-group form-focus" >
												<input type="password" class="form-control floating" id="password" name="password" required>
												<label class="focus-label">Password</label>
											</div>
											<button class="btn btn-primary btn-block btn-lg login-btn" type="submit">Login</button>
											</form>
									</div>
								</div>
							</div>
							<!-- /Login Tab Content -->
								
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
		
		<!-- Custom JS -->
		<script src="assets/js/script.js"></script>
		
	</body>
</html>