<?php

require 'common/_dbconnect.php';

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

if($docloggedin)
{   
    $doc_id = $_SESSION['id'];
    // var_dump($pat_id);
    $sql=mysqli_query($conn,"select * from doctor_tbl where id = '$doc_id'");
    while($row=mysqli_fetch_array($sql))
    {
    ?>      
    <ul class="nav header-navbar-rht">
        <li class="nav-item dropdown has-arrow logged-item">
        <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
            <span class="user-img">
                <img class="rounded-circle" src="assets/img/doctors/<?php echo $row["doctor_image_name"]; ?>.jpg" width="31" alt="Doctor Image">
            </span>
        </a>
        <div class="dropdown-menu dropdown-menu-right">
            <div class="user-header">
                <div class="avatar avatar-sm">
                    <img src="assets/img/doctors/<?php echo $row["doctor_image_name"]; ?>.jpg" alt="Doctor Image" class="avatar-img rounded-circle">
                </div>
                <div class="user-text">
                    <h6><?php echo $row["doctor_name"]; ?></h6>
                    <p class="text-muted mb-0">Doctor</p>
                </div>
            </div>
            <a class="dropdown-item" href="doctor-dashboard.php">Dashboard</a>
            <a class="dropdown-item" href="doc-profile-settings.php">Profile Settings</a>
            <a class="dropdown-item" href="logout.php">Logout</a>
        </div>
        </li>
    </ul>

    <?php 
    }
    }
    ?>
        
<?php
if($patloggedin)
    {       
    $pat_id = $_SESSION['p_id'];
    // var_dump($pat_id);
    $sql=mysqli_query($conn,"select * from patient_tbl where id = '$pat_id'");
    while($row=mysqli_fetch_array($sql))
    {
    ?>      
    <ul class="nav header-navbar-rht">
        <li class="nav-item dropdown has-arrow logged-item">
        <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
            <span class="user-img">
                <img class="rounded-circle" src="assets/img/patients/<?php echo $row["image_name"]; ?>.jpg" width="31" alt="Darren Elder">
            </span>
        </a>
        <div class="dropdown-menu dropdown-menu-right">
            <div class="user-header">
                <div class="avatar avatar-sm">
                    <img src="assets/img/patients/<?php echo $row["image_name"]; ?>.jpg" alt="User Image" class="avatar-img rounded-circle">
                </div>
                <div class="user-text">
                    <h6><?php echo $row["patient_name"]; ?></h6>
                    <p class="text-muted mb-0">Patient</p>
                </div>
            </div>
            <a class="dropdown-item" href="patient-dashboard.php">Dashboard</a>
            <a class="dropdown-item" href="pat-profile-settings.php">Profile Settings</a>
            <a class="dropdown-item" href="logout.php">Logout</a>
        </div>
        </li>
    </ul>

    <?php 
    }
    }
    ?>
