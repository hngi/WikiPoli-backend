<?php

require_once('../autoloader.php');
    
use Helper\Database as DB;
use Helper\Jwt_client as jwt;


if($_SERVER['REQUEST_METHOD']=='GET'){

	if(isset($_POST['token'])&& !empty($_POST['token'])){

		$arr=jwt::decode($_POST['token']);

		$conn=DB::db_connect();

		if(DB::confirm_id($conn,$arr['data']->id)){

			if(DB::check_post($conn,$id)){

				$deletePost = "DELETE FROM posts WHERE post_id = '$id'"; 
        
   				 mysqli_query($conn, $deletePost) or die("database error: ".mysqli_error($conn));
       
      			 $message = "Post Deleted Successfully.";
					$status = array(
								"error" => 0,
								"successMessage" => $message
						
							);
			}else {
				$message = "Post not deleted. Try again!";
				$status = array(
					"error" => 1,
					"errorMessage" => $message
				);
			}
		}else{
			$data=[
				'res'=>'Invalid User',
				'status'=>404
			];
				
			
			echo json_encode($data);
		}

	}else{
		$data=[
			'res'=>'No token was sent',
			'status'=>404
		];
	
		
		echo json_encode($data);
	}
     
		
}else{
	$data=[
		'res'=>'Invalid Request Method',
		'status'=>404
	];
	
	echo json_encode($data);
} 

   echo json_encode($status,true);

?>