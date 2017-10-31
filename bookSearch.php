<?php
	
	include('config.php');
	define('rowperpage', 2);
	try{
	 $db=getdb();
	 
	 $book='';$author='';$input="";$searchby="";
	 if(!empty($_POST['query'])){
	 	$input=$_POST['query'];
	 	if($_POST['searchby']=="Book Name"){
	 			$searchby="Book Name";
	 			$book='%'.$_POST['query'].'%';
	 			$sql="SELECT * FROM books WHERE name LIKE :bookname";
	 			$stmt=$db->prepare($sql);
	 			$stmt->bindParam(':bookname',$book,PDO::PARAM_STR);
	 	}
	 	else if($_POST['searchby']=="Author Name"){
	 			$searchby="Author Name";
	 			$author='%'.$_POST['query'].'%';
	 			$sql="SELECT * FROM books WHERE author LIKE :authorname";
	 			$stmt=$db->prepare($sql);
	 			$stmt->bindParam(':authorname',$author,PDO::PARAM_STR);
	 	}
	 	
	 }

	 else{
	 	$sql="SELECT * FROM books";
	 	$stmt=$db->prepare($sql);
	 }
	 
	 	$stmt->execute();
	 	$rows=$stmt->rowCount();
	 	$pagetab_html="";
	 	$page=1;
	 	$start=0;
	 	if(!empty($_POST['page'])){
	 		$page=$_POST['page'];
	 		$start=($page-1)*rowperpage;
	 	}

	 	
	 	if($rows>0){
	 		$pagetab_html="<div style='text-align:center;margin:20px 0px;'>";
	 		$pagecount=ceil($rows/rowperpage);
	 		if($pagecount>1){
	 			for($i=1;$i<=$pagecount;$i++){
	 				if($i==$page){
	 					$pagetab_html.='<input type="submit" name="page" value="' . $i . '" class="btn-page current" />';
	 				}
	 				else{
		 				$pagetab_html.='<input type="submit" name="page" value="' . $i . '" class="btn-page" />';
	 				}
	 			}
	 		}
	 		$pagetab_html.='</div>';
	 	}
	 	

	 	$que=$sql." LIMIT ".$start.",".rowperpage;
	 	$stmtperpage=$db->prepare($que);
	 	if($book!='')$stmtperpage->bindParam(':bookname',$book,PDO::PARAM_STR);
	 	if($author!='')$stmtperpage->bindParam(':authorname',$author,PDO::PARAM_STR);
	 	$stmtperpage->execute();
	 
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
<body onload="alterInput()">
<div class="header" id="header">
	<div class="img-container">
		<img src="logo1.png" height="100px" width="100px">
	</div>
	
	<div>
		<h1>Central Library</h1>
	</div>
</div>
<div class="navbar">
	<a href="Home.php"><div class="tab">
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
		<form name="sform" method="post" action="">
			<table align="center">
				<tr>
					<td><label for="searchby">Search By : </label></td>
					<td><input type="radio" name="searchby" value="Book Name" onclick="alterInput()" <?php if($searchby!="Author Name")echo "checked"; ?>>Book Name</td>
				</tr>
				<tr>
					<td></td>
					<td><input type="radio" onclick="alterInput()" name="searchby" value="Author Name" <?php if($searchby=="Author Name")echo "checked"; ?>>Author Name</td>
				</tr>
				<tr>
					<td><label id="searchTag">Book Name : </label></td>
					<td><input type="text" name="query" value="<?php echo $input;?>"></td>
				</tr>
				<tr>
					<td></td>
					<td><input type="submit" name="Search" value="Search"></td>
				</tr>
			</table>
		
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
				
					while($row=$stmtperpage->fetch(PDO::FETCH_BOTH)){
						echo '<tr>
						<td>'.$row['bookid'].'</td>
						<td>'.$row['name'].'</td>
						<td>'.$row['author'].'</td>
						<td>'.$row['language'].'</td>
						<td>'.$row['classification'].'</td>
						<td>'.$row['status'].'</td>
						</tr>';
					}
				
				?>
			</tbody>
		</table>
		<?php echo $pagetab_html; ?></form>
	</div>
</div>

<div class="footer">
	@Developers
	<div id="top" onclick="goTop()" class="top"><i style="color: white;background-color: red;border-radius: 25px;padding: 5px;" class="fa fa-arrow-up fa-2x" aria-hidden="true"></i></div>
</div>
</body>
</html>
