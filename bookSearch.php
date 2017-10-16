<?php
	
	include('config.php');
	try{
	 $db=getdb();

	 if(!empty($_POST['Search'])){
	 	if($_POST['searchby']=="Book Name"){
	 		if($_POST['query']!=''){
	 			$book=$_POST['query'];
	 			$stmt=$db->prepare("SELECT * FROM books WHERE name=:bookname");
	 			$stmt->bindParam(':bookname',$book);

	 		}
	 		else{
	 			$stmt=$db->prepare("SELECT * FROM books");
	 		}
	 	}
	 	else if($_POST['searchby']=="Author Name"){
	 		if($_POST['query']!=''){
	 			$author=$_POST['query'];
	 			$stmt=$db->prepare("SELECT * FROM books WHERE author=:authorname");
	 			$stmt->bindParam(':authorname',$author);
	 		}
	 		else{
	 			$stmt=$db->prepare("SELECT * FROM books");
	 		}
	 	}
	 	$stmt->execute();
	 }
	}
	catch(PDOException $e){
		echo "connection failed: ".$e->getMessage();
	}
?>
<html>
<head>
	<title>Central Library</title>
	<link rel="icon" type="image/png" sizes="96x96" href="favicon-96x96.png">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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

<div>
	<div class="search-form">
		<h2 align="center">Collection of Books</h2>
		<form name="sform" method="post" onreset="alterInput()" action="">
			<table align="center">
				<tr>
					<td><label for="searchby">Search By : </label></td>
					<td><input type="radio" name="searchby" value="Book Name" onclick="alterInput()" checked>Book Name</td>
				</tr>
				<tr>
					<td></td>
					<td><input type="radio" onclick="alterInput()" name="searchby" value="Author Name">Author Name</td>
				</tr>
				<tr>
					<td><label id="searchTag">Book Name : </label></td>
					<td><input type="text" name="query"></td>
				</tr>
				<tr>
					<td></td>
					<td><input type="submit" name="Search" value="Search"></td>
				</tr>
			</table>
		</form>
	</div>
	<div id="collection" class="data-table" align="center">
		<table>
			<thead>
				<tr>
					<th>Book Id</th>
					<th>Book Name</th>
					<th>Author Name</th>
					<th>Language</th>
					<th>Classification</th>
					<th>Status</th>
				</tr>
			</thead>
			<tbody>
				<?php
				if(!empty($_POST['Search'])){
					while($row=$stmt->fetch(PDO::FETCH_BOTH)){
						echo '<tr>
						<td>'.$row['bookid'].'</td>
						<td>'.$row['name'].'</td>
						<td>'.$row['author'].'</td>
						<td>'.$row['language'].'</td>
						<td>'.$row['classification'].'</td>
						<td>'.$row['status'].'</td>
						</tr>';
					}
				}
				?>
			</tbody>
		</table>
	</div>
</div>

<div class="footer">
	@Developers
	<div id="top" onclick="goTop()" class="top"><i style="color: white;background-color: red;border-radius: 25px;padding: 5px;" class="fa fa-arrow-up fa-2x" aria-hidden="true"></i></div>
</div>
</body>
</html>