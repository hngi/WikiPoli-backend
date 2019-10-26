<?php


require_once('../autoloader.php');
use Helper\Database as DB;
use Helper\Jwt_client as jwt;


if($_SERVER['REQUEST_METHOD'] == 'GET'){

    $conn=DB::db_connect();

    if(isset($_GET['user_id']) && !empty($_GET['user_id'])){
        $id=$_GET['user_id'];

        if (DB::check_users_id($conn,$id)) {
           
            $res=DB::showUserById($conn,$id);
            $data=[
                'res'=>' User Retrieved',
                'status'=>200,
                'data'=>$res
            ];
        
            //http_response_code(404); 
            echo json_encode($data);
        }else{

            $data=[
                'res'=>'Invalid Parameter',
                'status'=>200 
            ];
        
            //http_response_code(404); 
            echo json_encode($data);
        }
    }else{

        $res=DB::showAllUsers($conn);

        $data=[
            'res'=>'All Users Retrieved',
            'status'=>200,
            'data'=>$res,
            
        ];
    
        //http_response_code(404); 
        echo json_encode($data);
    }
	

}
?>

