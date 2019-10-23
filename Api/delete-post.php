<?php

require_once('../autoloader.php');
    
use Helper\Database as DB;
use Helper\Jwt_client as jwt;


if($_SERVER['REQUEST_METHOD']=='GET'){

    $deletePost = "DELETE FROM posts WHERE post_id = '$id'"; 
        $conn=DB::db_connect();
    mysqli_query($conn, $deletePost) or die("database error: ".mysqli_error($conn));
       
       $message = "Post Deleted Successfully.";
		$status = array(
			"error" => 0,
			"successMessage" => $message
			
		); 
		
	} else {
		$message = "Post not deleted. Try again";
		$status = array(
			"error" => 1,
			"errorMessage" => $message
		);
	}

   echo json_encode($status,true);

?>