<?php
 
//create database connection	
	$server = "localhost";
	$username = "root";
	$password = "";
	$dbname = "dbphpsearch";

	$conn = mysqli_connect($server, $username, $password, $dbname);

if($_SERVER['REQUEST_METHOD']=='POST'){
		 if (isset($_POST['token'])) {
		 	$search = mysqli_real_escape_string($conn, $_POST['token']);
		 	//search related word from the database
		 	$sql = "SELECT * FROM article  WHERE a_title LIKE '%$search%' OR a_text LIKE '%search%' OR a_author LIKE '%search%' OR a_date LIKE '%search%'";
		 	$result = mysqli_query($conn, $sql);
 			$queryResult = mysqli_num_rows($result);

 			echo "There are"." ". $queryResult ." "."results!";

 			if ($queryResult > 0) {
 				
 				while ($row = mysqli_fetch_assoc($result)) {
 					# code..
 					$row['a_title']
						$row['a_text']
						$row['a_date']
						$row['a_author']
		          );

		          
						
					
 				}
 				echo json_encode($cat_arr);

 			}else {
 				echo "There are no result matching your search!";
 			}
		 }
	}	 
 	?>
		
	

</div>