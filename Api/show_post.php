<?php


require_once('../autoloader.php');
use Helper\Database as DB;
use Helper\Jwt_client as jwt;


if($_SERVER['REQUEST_METHOD'] == 'GET'){

    $conn=DB::db_connect();

    if(isset($_GET['post_id']) && !empty($_GET['post_id'])){
        $id=$_GET['post_id'];

        if (DB::check_post($conn,$id)) {
           
            $res=DB::get_post_by_id($conn,$id);
            $data=[
                'res'=>'Single Post Retrieved',
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

        $res=DB::get_all_posts($conn);

        $data=[
            'res'=>'All Posts Gotten',
            'status'=>200,
            'data'=>$res
        ];
    
        //http_response_code(404); 
        echo json_encode($data);
    }
	

}
?>

