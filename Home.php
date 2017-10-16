<?php
	
	include('config.php');
	include('authClass.php');

	$authority = new authClass();

	$errMsgLogin ='';

	if(!empty($_POST['Login'])){
		$fuserid=$_POST['userid'];
		$fpass=$_POST['password'];

		if((strlen(trim($fuserid))>1)&&(strlen(trim($fpass))>1)){
			$uid = $authority->authLogin($fuserid,$fpass);

			

			if($uid){
				
				$url = "Authority.php";
				header("Location:$url");
			}
			else{
				$errMsgLogin="Enter valid details... ";
			}
		}
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
	<a href="Home.html"><div class="tab">
		Home
	</div></a>
	<a href="Collection.html"><div class="tab hide-small">
		Collection
	</div></a>
	<a href=""><div class="tab hide-small">
		Services
	</div></a>
	<a href="bookSearch.php"><div class="tab hide-small">	
		Book Search
	</div></a>
	<a href=""><div class="tab hide-small">	
		Membership
	</div></a>
	<a href=""><div class="tab hide-small">	
		Contact
	</div>	</a>
	<div class="hide-large tab" style="position:absolute;right: 30px;padding: 10px;color: white" onclick="navigation()"><i class="fa fa-bars"></i></div>
</div>
<div id="navmenu" class="menu hide-large">
	<a href="Collection.html"><div class="tab">
		Collection
	</div></a>
	<a href=""><div class="tab">
		Services
	</div></a>
	<a href=""><div class="tab">	
		Book Search
	</div></a>
	<a href=""><div class="tab">	
		Membership
	</div></a>
	<a href=""><div class="tab">	
		Contact
	</div>	</a>
</div>
<div class="flexed">
<div class="main">
	<div class="slide-img">
		<img width="55%" height="auto" src="lib.jpg" class="slide1">
		<img width="55%" height="auto" src="library.jpg" class="slide2">
		<img width="55%" height="auto" src="libraries.jpg" class="slide3">
	</div>
	<div class="intro">
		<h2>Introduction</h2><hr>
		<p>The Central Library, SVNIT Surat is one amongst major technological libraries in the area of science, engineering and technology. The Library was established in 1968. It has completed nearly 49 years and has built a large collection of books, journals and non-book materials. It also has a rich collection of resources in electronic media available locally on the Institute Intranet and accessible on the Web. It caters to the needs of large groups of users including more than 2000 students, 200 faculty, 150 research scholars and equally large number of supporting staff. It has computerized all its house-keeping activities using a global software that is being maintained and updated regularly. It also facilitates industries, individual consultants and corporates to access online database and journals. It uses state-of-the-art technology in its functioning and services.Not only having a very good reference section, Library has been subscribed to access INDEST by MHRD.</p>
	</div>
	<div class="collection">
		<h2>Collection</h2><hr>
		<p>The Library subscribes to 156 current journals. The Library has a rich collection of books on science and technology including chemistry, mathematics, physics, chemical engineering, civil engineering, mechanical and production engineering, computer science, electrical and electronics engineering, biochemical and biomedical engineering. Besides, Library also has a good collection in the areas of humanities and social sciences. Besides General Collection, the Library has segregated specialized collection having separate collection codes.The Library also accommodates a literary section having a good collection of novels, philosophy and history related books.</p>
	</div>
</div>
<div class="sidebar">
	<div class="authority">
	<h3>Authority Login</h3>
	<form method="post" action="" name="authlogin">
		<div style="color: red"><?php echo $errMsgLogin;?></div>
		<label for="userid">User ID</label><br>
		<input type="text" name="userid"><br><br>
		<label for="password">Password</label><br>
		<input type="password" name="password"><br><br>
			<input class="button" type="submit" name="Login" value="Login">
			<input class="button" type="reset" name="reset" value="Reset">
	</form>
	<hr>
	<div class="time">
		<br><b>Service-time :</b><br><i class="fa fa-clock-o" aria-hidden="true" style="margin: 1em;"></i>9:00 AM - 8:00 PM<br><br>
	</div>
</div>
</div>
</div>
<div class="footer">
	@Developers
	<div id="top" onclick="goTop()" class="top"><i style="color: white;background-color: red;border-radius: 25px;padding: 5px;" class="fa fa-arrow-up fa-2x" aria-hidden="true"></i></div>
</div>
</body>
</html>