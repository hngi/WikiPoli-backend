<?php


require_once('../autoloader.php');
use Helper\Database as DB;
use Helper\Jwt_client as jwt;






if($_SERVER['REQUEST_METHOD'] == 'POST'){

	if(isset($_POST['token']) && !empty($_POST['token'])){
		
		$arr=jwt::decode($_POST['token']);
		//print_r($arr['data']->id);
		$conn=DB::db_connect();
		if(DB::confirm_id($conn,$arr['data']->id)){

			if(isset($_POST["comment"])  && !empty($_POST["comment"]) && isset($_POST["postId"])  && !empty($_POST["postId"]) ){

				
				$comment=$_POST["comment"];
				$post_id=$_POST["postId"];
				$id=$arr['data']->id;


				if(DB::check_post($conn,$post_id) && DB::insert_comment($conn,$id,$post_id,$comment)){

					$data=[
						'res'=>'Comment Added',
						'status'=>200
					];
						
					
					echo json_encode($data);
				}else{

					$data=[
						'res'=>'Comment Not Sent',
						'status'=>404
					];
						
					
					echo json_encode($data);
				}
			}else{

			$data=[
				'res'=>'Comment Not Sent',
				'status'=>404
			];
				
			
			echo json_encode($data);
		}

		}else{

			$data=[
				'res'=>'Invalid User',
				'status'=>404
			];
				
			//http_response_code(404); 
			echo json_encode($data);
		}

	}else{

		$data=[
			'res'=>'No token was sent',
			'status'=>404
		];
	
		//http_response_code(404); 
		echo json_encode($data);
	}


}else{

	$data=[
		'res'=>'Invalid Request Method',
		'status'=>404
	];

	//http_response_code(404); 
	echo json_encode($data);
}


?>

