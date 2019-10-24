<?php


require_once('../autoloader.php');
use Helper\Database as DB;
use Helper\Jwt_client as jwt;


if($_SERVER['REQUEST_METHOD'] == 'POST'){

	if(isset($_POST['token']) && !empty($_POST['token'])){
		
		$arr=jwt::decode($_POST['token']);
		
		$conn=DB::db_connect();
		if(DB::confirm_id($conn,$arr['data']->id)){

			if(isset($_POST["postId"])  && !empty($_POST["postId"]) ){

			
				$post_id=$_POST["postId"];
				$id=$arr['data']->id;


				if(DB::check_post($conn,$post_id)){

					$comment=DB::get_comment($conn,$post_id);
					
                    if(!empty($comment)){

                        $data=[
                            'res'=>'Comment Found',
                            'status'=>200,
                            'data'=>$comment
                        ];
                            
                        
                        echo json_encode($data);
                    }else{

                        $data=[
                            'res'=>'No Comment',
                            'status'=>404
                        ];
                            
                        
                        echo json_encode($data);
                    }
				}else{

					$data=[
						'res'=>'Incorrect Post Id',
						'status'=>404
					];
						
					
					echo json_encode($data);
				}
			}else{ 

			$data=[
				'res'=>'Post ID Not Sent',
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

