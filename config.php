<?php
	session_start();
	define('server','localhost');
	define('user','root');
	define('cpass','frog@gone');
	define('mysqldb','library');

	function getdb(){
		$servername = server;
		$username = user;
		$password = cpass;
		$database = mysqldb;

		try{
			//connect to database
			$conn = new PDO("mysql:host=$servername;dbname=$database",$username,$password);
			//set pdo error mode to exception 
			$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
			return $conn;
		
		}
		catch(PDOException $e){
			echo "Connection failed: ".$e->getMessage();
		}

	
	}
?>