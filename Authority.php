<?php
	
	include('config.php');
	include('authClass.php');
	if(empty($_SESSION['id'])){
		$url='Home.php';
		header("Location:$url");
	}
	else{
		$auth = new authClass();
		$authdetails = $auth->authDetail($_SESSION['id']);
	}
?>
<html>
<head>
	<title>Central Library</title>
	<link rel="icon" type="image/png" sizes="96x96" href="favicon-96x96.png">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<script type="text/javascript" src="js/script.js"></script>
</head>
<body>
<div class="header" id="header">
	<div class="img-container">
		<img src="logo1.png" height="100px" width="100px">
	</div>
	
	<div>
		<h1>Central Library</h1>
	</div>
</div>

<div class="navbar">
	
	<a href="Logout.php"><div class="tab hide-small">	
		Log out
	</div></a>
</div>
<div>
	HELLO <?php echo $authdetails['name']; ?> !
</div>
<div class="footer">
	@Developers
	<div id="top" onclick="goTop()" class="top"><i style="color: white;background-color: red;border-radius: 25px;padding: 5px;" class="fa fa-arrow-up fa-2x" aria-hidden="true"></i></div>
</div>

</body>
</html>