<?php


require_once('../autoloader.php');
     
use Helper\Database as DB;
use Helper\Jwt_client as jwt;


if($_SERVER['REQUEST_METHOD']=='POST'){

    if(isset($_POST['email']) && isset($_POST['password']) && !empty($_POST['email']) && !empty($_POST['password'])){

        $password=md5(htmlspecialchars($_POST['password']));
        
        $email=htmlspecialchars($_POST['email']);
        $conn=DB::db_connect();

        $res=DB::login_user($conn,$email,$password);

        if($res==FALSE){

            $data=[
                'res'=>'Incorrect credential',
                'status'=>404
            ];
    
            //http_response_code(404); 
            echo json_encode($data);

        }else{
            
            $arr=[
                'iat'=>microtime(true),
                'exp'=>(microtime(true) * 1000)+172800,
                'data'=>[
                    'id'=>$res['user_id'],
                    'email'=>$res['email']
                ]
                
            ];
            $token=jwt::encode($arr);
            $data=[
                'res'=>'Login Successful',
                'status'=>200,
                'token'=>$token
            ];
    
            //http_response_code(404); 
            echo json_encode($data);
        }

    }

}else{

    $data=[
        'res'=>'Incorrect Request',
        'status'=>404
    ];

    //http_response_code(404); 
    echo json_encode($data);


}
?>