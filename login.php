<?php
	require_once("session.php");
	require_once("functions.php");

	if($session->is_logged_in()) { 
		if($_SESSION['user_id']==1) {
			header("Location: user_admin.php"); 
		} else {
		$id = $_SESSION['user_id'];
		//exit();
			header("Location: page_admin.php?id={$id}");
		}
	} 

	if(isset($_POST['un'])) {
		$un=trim($_POST['un']);
		$pw=trim($_POST['pw']);
		$validID = getUserId($un, $pw);
	}
	$error_msg="";
	if(isset($validID)) {
		$session->login($validID);
		header("Location: page_admin.php?id=$validID");
	} else {
		$error_msg= "Username and password not found<br />";
	}
	
	include('header.php');
	
	$un="";
	$pw="";
	echo $error_msg;
	echo "<form action='login.php' method='post'>";
	echo "<p>Username: <input type='text' name='un' value='" . htmlentities($un) . "'></p>";
	echo "<p>Password: <input type='password' name='pw' value='" .htmlentities($pw) . "'></p>";
	echo "<p><input type='submit' value='login'></p>";
	echo "</form>";
	include('footer.php');
	
?>