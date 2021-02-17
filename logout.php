<?php

session_start();              // STARTING THE SESSION..

session_unset();              // UNSETTING SESSION VARIABLES
 
session_destroy();            // DESTROYING THE SESSION..
setcookie("id2",0);
header("location: index.php");     // REDIRECTED TO LOGIN PAGE..
?>
