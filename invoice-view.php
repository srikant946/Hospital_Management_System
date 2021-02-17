<?php

session_start();
require 'common/_dbconnect.php' ;

?>

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

		<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.js"></script>
				<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<style type="text/css">
			@media (min-width: 768px) {
    			.wmin-md-400 {
        min-width: 400px !important
    }
}
		</style>

		<script type="text/javascript">
			$(document).ready(function () {

				$(".submit-btn").click(function () {
					const invoice = $("#invoice").html();
            console.log(invoice);
            console.log("hello");
            var opt = {
                 margin: 1,
                 filename: 'myfile.pdf',
                 image: { type: 'jpeg', quality: 0.98 },
                 html2canvas: { scale: 10 },
                 jsPDF: { unit: 'in', format: 'letter', orientation: 'portrait' }
             };
             html2pdf().from(invoice).set(opt).save();

				 })
			})
		</script>
</head>
<body>
	<?php 

	$name=$_COOKIE['doc_name'];
	
	$pat_id = $_SESSION['p_id'];

	$conn = new mysqli("localhost","root","","hospital_db");


	$sql = "select patient_name, patient_address, patient_contact_no, patient_email from patient_tbl where id = '$pat_id'";
	$pat_result=$conn->query($sql);
	$pat = $pat_result->fetch_assoc();

	$pat_email = $pat["patient_email"];
	$pat_name = $pat["patient_name"];
	$pat_ctc = $pat["patient_contact_no"];
	$pat_addr = $pat["patient_address"];


	$select= "select doctor_specialization,doctor_name,doctor_address,doctor_fees,doctor_contact_no,doctor_email,doctor_image_name from doctor_tbl where doctor_name='$name' ";

	$result=$conn->query($select);
	
	  $row = $result->fetch_assoc();
	  $email=$row["doctor_email"];
	  $specialization=$row["doctor_specialization"];
	  $doc_ctc=$row["doctor_contact_no"];
	  $docFees=$row["doctor_fees"];
	  $str=explode("-", $docFees);
	  $val=intval($str[0]);
	  $fetch_id="select id from doctor_tbl where doctor_name='$name'";
	  $result=$conn->query($fetch_id);
	  $row=$result->fetch_assoc();
	  $id=$row["id"];
	  $docFees=$_COOKIE["amount"];
	  $date=$_COOKIE["date"];
	  $time=$_COOKIE["time"];

	$pat_id = $_SESSION["p_id"];
 	$insert_into_appointments="insert into appointment(doctor_id,user_id,consultancyFees,appointmentDate,appointmentTime) values($id,$pat_id,$docFees,'$date','$time')";
 	$result=$conn->query($insert_into_appointments);
 
	?>
	<div class="content">
				<div class="container-fluid">

					<div class="row" id="invoice">
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
												<strong>Order:</strong> #00124 <br>
												<strong>Issued:</strong> <?php echo date("d/m/Y"); ?>
											</p>
										</div>
									</div>
								</div>
								
								<!-- Invoice Item -->
								<div class="invoice-item">
									<div class="row">
										<div class="col-md-6">
											<div class="invoice-info">
												<strong class="customer-text">Invoice From</strong>
												<p class="invoice-details invoice-details-two">
													 <?php echo $_COOKIE["doc_name"]; ?><br>
													<?php echo $specialization; ?> <br>
													<?php echo $doc_ctc; ?> <br>
													<strong>Email at:</strong> <?php echo $email; ?>
												</p>
											</div>
										</div>


										<div class="col-md-6">
											<div class="invoice-info invoice-info2">
												<strong class="customer-text">Invoice To</strong>
												<p class="invoice-details">
												<?php echo $pat_name; ?><br>
												<?php echo $pat_addr; ?><br>
												<?php echo $pat_ctc; ?><br>
												<?php echo $pat_email; ?><br>
												</p>
											</div>
										</div>
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
															<td class="text-right"><?php echo $_COOKIE["amount"]; ?></td>
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
														<th>Subtotal:</th>
														<td><span><?php $subtotal = $_COOKIE['amount']; echo $subtotal + ($subtotal*0.05); $subtotal = $subtotal + ($subtotal*0.05); ?></span></td>
													</tr>
													<tr>
														<th>Discount:</th>
														<td><span>-10%</span></td>
													</tr>
													<tr>
														<th>Total Amount:</th>
														<td><span><?php echo $subtotal - ($subtotal*0.1); $final_subtotal = $subtotal - ($subtotal*0.1); ?></span></td>
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
									<p class="text-muted mb-0"> A $25 service fee will be charged for any checks returned. Physician charges will be billed separately by the Medical College of Wisconsin. Our commitment is to your health. We appreciate your confidence in Doccure Hospital.</p> </div>
								<!-- /Invoice Information -->
								
							</div>
						</div>
					</div>

				</div>
				<div class="submit-section proceed-btn text-center">
					<button onclick = "window.print()" class="btn btn-primary submit-btn">Print</button>
				</div>

				<div class="submit-section proceed-btn text-center">
					<a class="btn btn-primary submit-btn" href="patient-dashboard.php">Back To Dashboard</a>
				</div>

			</div>		
			<!-- /Page Content -->

			<?php

				$insert_into_invoice="insert into invoice_tbl (doctor_id,patient_id,amount) values ($id,$pat_id,$final_subtotal)";
				$result1 = $conn->query($insert_into_invoice);

			?>
</body>
</html>