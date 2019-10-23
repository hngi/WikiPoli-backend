<?php

require_once('../autoloader.php');
    
use Helper\Database as DB;
use Helper\Jwt_client as jwt;


if($_SERVER['REQUEST_METHOD']=='POST'){

	if(isset($_POST['token'])&& !empty($_POST['token'])){

		$arr=jwt::decode($_POST['token']);

		$conn=DB::db_connect();

		if(DB::confirm_id($conn,$arr['data']->id)){

			if(DB::confirm_admin($conn,$arr['data']->id)){

				if(isset($_POST['post_id'])&& !empty($_POST['post_id'])){

					if(DB::delete_post($conn,$_POST['post_id'])){

						$data=[
							'res'=>'Deletion Successful',
							'status'=>200
						];
							
						
						echo json_encode($data);


					}else{

						$data=[
							'res'=>'Deletion Unsuccessful',
							'status'=>500
						];
							
						
						echo json_encode($data);
					}
				}else{

					$data=[
						'res'=>'Unauthorized Access',
						'status'=>403
					];
						
					
					echo json_encode($data);
					
				}
			}else{

				$data=[
					'res'=>'Unauthorized Access',
					'status'=>403
				];
					
				
				echo json_encode($data);

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

   

?>