<?php

include'../config/db.php';
include'../config/main_function.php';
$data = array("log_desc"  => "".$_SESSION['fname']." ".$_SESSION['mname']." ".$_SESSION['lname']." has signoff to the system");
insertdata("logs",$data);

	session_start();
	setcookie(session_name(), '', 100);
	session_unset();
	session_destroy();
	$_SESSION = array();
	header('location:../index.php');	
?>