<?php
	
	
	class authClass
	{
		
		public function authLogin($fuserid,$fpass){
			try{
				$db=getdb();
				$stmt = $db->prepare("SELECT id FROM authority WHERE id=:userid AND password=:pass");
				$stmt->bindParam(':userid',$fuserid);
				$stmt->bindParam(':pass',$fpass);
				$stmt->execute();
				$count = $stmt->rowCount();
				
				if($count){
					$_SESSION['id']=$fuserid;
					return true;
				}
				else
					return false;
				$db=null;

			}
			catch(PDOException $e){
				echo "connection failed: ".$e.getMessage();
			}
		}

		public function authDetail($fuserid){
			
			try{
				$db=getdb();
				$stmt = $db->prepare("SELECT * FROM authority WHERE id=:userid");
				$stmt->bindParam(':userid',$fuserid);
				
				$stmt->execute();
				$data = $stmt->fetch(PDO::FETCH_BOTH);
				$db=null;
				return $data;
			}
			catch(PDOException $e){
				echo 'connection failed : '.$e->getMessage();
			}
		}
	}
?>