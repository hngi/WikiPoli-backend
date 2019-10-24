<?php

require_once('../autoloader.php');
use Helper\Database as DB;
use Helper\Jwt_client as jwt;

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if(isset($_POST['token']) && !empty($_POST['token'])) {
      $arr=jwt::decode($_POST['token']);

      $conn=DB::db_connect();
      if(DB::confirm_id($conn,$arr['data']->id)){
        $update_array = [];
        if(isset($_POST["new_name"]) && !empty($_POST['new_name'])){
            $new_name = mysqli_real_escape_string($conn, $_POST['new_name']);
            $update_array[] = "name ='" . $new_name ."'";
        }
        
        if(isset($_POST["new_password"]) && !empty($_POST['new_password']) && isset($_POST["confirm_password"]) && !empty($_POST['confirm_password'])){         
                if(($_POST["new_password"]) != ($_POST["confirm_password"])){
                    $data=[
                        'res'=> "both password fields must match",
                        'status'=>404
                    ]; 
                    die(json_encode($data));
                }    
            $password=md5(htmlspecialchars($_POST['new_password']));
            $update_array[] = "password ='" .$password ."'";
        } else {
            $data=[
                'res'=> "password fields can't be empty",
                'status'=>404
            ]; 
            die(json_encode($data));
        }
        $email = $_POST["email"];
        $update_set = join(",", $update_array);
        $res=DB::edit_user($conn,$email,$update_set);
        if(mysqli_error($conn)){
            $data=[
                'res'=> "Error updating user",
                'status'=>404
            ];
            echo json_encode($data);
        } else {
            $data =[
                'res'=> 'User with email: '.$email . 'successfully updated',
                'status'=>200
            ];
            echo json_encode($data);
        }
      } else {
        $data=[
			'res'=>'token not verified',
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