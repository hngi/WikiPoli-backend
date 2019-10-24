<?php


require_once('../autoloader.php');
use Helper\Database as DB;
use Helper\Jwt_client as jwt;






if($_SERVER['REQUEST_METHOD'] == 'POST'){

	if(isset($_POST['token']) && !empty($_POST['token'])){
		
		$arr=jwt::decode($_POST['token']);
        //print_r($arr['data']->id);
        $conn=DB::db_connect();

        if(DB::confirm_super_admin($conn,$arr['data']->id)){

            if(isset($_POST['name']) && isset($_POST['email']) && isset($_POST['password']) && !empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['password'])){

                $password=md5(htmlspecialchars($_POST['password']));
                $name= htmlspecialchars($_POST['name']);
                $email=htmlspecialchars($_POST['email']);
    
               
    
                $result=DB::check_users($conn,$email);
    
                if($result==FALSE){
    
                    $res=DB::addAdmin($conn,$email,$password,$name);
    
                    if($res){
    
                        $data=[
                            'res'=>'Admin Created Successfully',
                            'status'=>200
                        ];
                
                        //http_response_code(404); 
                        echo json_encode($data);
    
                    }else{
    
                        $data=[
                            'res'=>'Error in Adding Admin',
                            'status'=>404
                        ];
                
                        //http_response_code(404); 
                        echo json_encode($data);
                    }
        
    
                }else{
    
                    $data=[
                        'res'=>'User already Exists',
                        'status'=>404
                    ];
            
                    //http_response_code(404); 
                    echo json_encode($data);
    
                }
    
    
            }else{
    
                $data=[
                    'res'=>'Invalid Credentials',
                    'status'=>404
                ];
        
                //http_response_code(404); 
                echo json_encode($data);
    
            }

        }else{

            $data=[
                'res'=>'Invalid ID',
                'status'=>404,
                'err'=>mysqli_error($conn)
            ];
    
            //http_response_code(404); 
            echo json_encode($data);
        }

    }else{

        $data=[
            'res'=>'Token not Sent',
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