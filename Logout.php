<?php 
	
	include("config.php");

	$session_id='';
	$_SESSION['id']='';

	if(empty($session_id)&&empty($_SESSION['id'])){
		$url = 'Home.php';
		header("Location: $url");
	}
 ?>