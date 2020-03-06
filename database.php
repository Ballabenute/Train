<?php
	
	class DataBase{
		function OpenCon($db){
			$dbhost = "localhost";
			$dbuser = "root";
			$dbpass = "";
			$conn = new mysqli($dbhost, $dbuser, $dbpass,$db) or die("Connect failed: %s\n". $conn -> error);
	 
			return $conn;
		}
	 
		function CloseCon($conn){
			$conn -> close();
		}

		function RespIntoObject($resp,$col){
			$count = 0;

			while ($row = $resp->fetch_row()){
				for ($c=0; $c <sizeof($col) ; $c++) { 
					$return[$count][$col[$c]] = $row[$c];
				}
				$count++;
			}
			return $return;
		}
	}
   
?>