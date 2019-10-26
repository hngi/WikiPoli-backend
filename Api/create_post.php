<?php


require_once('../autoloader.php');
use Helper\Database as DB;
use Helper\Jwt_client as jwt;






if($_SERVER['REQUEST_METHOD'] == 'POST'){

	if(isset($_POST['token']) && !empty($_POST['token'])){
		
		$arr=jwt::decode($_POST['token']);
		
		$conn=DB::db_connect();
		if(DB::confirm_id($conn,$arr['data']->id)){

			if(isset($_POST["post"])  && !empty($_POST["post"]) && isset($_POST["topic"])  && !empty($_POST["topic"]) ){

				
				$post=$_POST["post"];
				$topic=$_POST["topic"];
				$id=$arr['data']->id;


				if(!(DB::user_blocked($conn,$id))){

					if(DB::create_post($conn,$id,$post,$topic)==TRUE){

						$data=[
							'res'=>'Post Created Successful',
							'status'=>200
						];
							
						
						echo json_encode($data);
					}else{
	
						$data=[
							'res'=>'Post Not Sent',
							'status'=>404,
							'err'=>mysqli_error($conn)
						];
							
						
						echo json_encode($data);
					}


				}else{

					$data=[
						'res'=>'Your account is currently blocked',
						'status'=>200,
						'err'=>mysqli_error($conn)
					];
						
					
					echo json_encode($data);
				}
			}else{

			$data=[
				'res'=>'Invalid Credentials',
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
