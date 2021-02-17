<?php
session_start();

if(isset($_SESSION['docloggedin']) && $_SESSION['docloggedin'] == true)
{
  $docloggedin = true;          // If Yes, then this variable is set to TRUE..
}
else
{
  $docloggedin = false;         
}

if(isset($_SESSION['patloggedin']) && $_SESSION['patloggedin'] == true)
{
  $patloggedin = true;          // If Yes, then this variable is set to TRUE..
}
else
{
  $patloggedin = false;         
}

echo '<ul class="main-nav">
     <li class="active">
	<a href="index.php">Home</a>
</li>';

if($docloggedin)
{
      echo '<li class="has-submenu active">
								<a href="#">Doctors <i class="fas fa-chevron-down"></i></a>
								<ul class="submenu">
									<li class="active"><a href="doctor-dashboard.php">Doctor Dashboard</a></li>
									<li><a href="my-patients.php">Patient List</a></li>
									<li><a href="doc-invoices.php">Invoices</a></li>
								</ul>
							</li>';
}	
                            
if($patloggedin)
{
      echo '<li class="has-submenu active">
								<a href="#">Patients <i class="fas fa-chevron-down"></i></a>
								<ul class="submenu">
								<li><a href="patient-dashboard.php">Patient Dashboard</a></li>
									<li><a href="pat-invoices.php">Invoices</a></li>
								</ul>
                            </li>';
  }	
    
  echo '</ul>';

?>