<?php
    require_once('../autoloader.php');
    
    use Helper\Database as DB;
    if($_SERVER['REQUEST_METHOD']=='POST'){

        if(isset($_POST['name']) && isset($_POST['email']) && isset($_POST['password']) && !empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['password'])){

            $password=md5(htmlspecialchars($_POST['password']));
            $name= htmlspecialchars($_POST['name']);
            $email=htmlspecialchars($_POST['email']);

            $conn=DB::db_connect();

            $result=DB::check_users($conn,$email);

            if($result==FALSE){

                $res=DB::register_user($conn,$email,$password,$name);

                if($res){

                    $data=[
                        'res'=>'User Created Successfully',
                        'status'=>200
                    ];
            
                    //http_response_code(404); 
                    return json_encode($data);

                }else{

                    $data=[
                        'res'=>'Registration Error',
                        'status'=>404
                    ];
            
                    //http_response_code(404); 
                    return json_encode($data);
                }
    

            }else{

                $data=[
                    'res'=>'User already Exists',
                    'status'=>404
                ];
        
                //http_response_code(404); 
                return json_encode($data);

            }


        }else{

            $data=[
                'res'=>'Invalid Credentials',
                'status'=>404
            ];
    
            //http_response_code(404); 
            return json_encode($data);

        }

    }else{

        $data=[
            'res'=>'Page not found',
            'status'=>404
        ];

        //http_response_code(404); 
        return json_encode($data);
        
    }

?>