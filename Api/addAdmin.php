<?php
    require_once('../autoloader.php');
    
    use Helper\Database as DB;
    use Helper\Jwt_client as jwt;

    if($_SERVER['REQUEST_METHOD']=='POST'){

            if(isset($_POST['token']) && !empty($_POST['token'])){
            
                $arr=jwt::decode($_POST['token']);

                if(isset($_POST['name']) && isset($_POST['email']) && isset($_POST['password']) && !empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['password'])){

                //$password=md5(htmlspecialchars($_POST['password']));
                //$name= htmlspecialchars($_POST['name']);
                //$email=htmlspecialchars($_POST['email']);

                    $conn=DB::db_connect();

                    if($result==FALSE){

                        $res=DB::addAdmin();

                        if($res){

                            $data=[
                                'res'=>'Admin Created Successfully',
                                'status'=>200
                            ];
                    
                            //http_response_code(404); 
                            return json_encode($data);

                        }else{

                            $data=[
                                'res'=>'Error Creating Admin',
                                'status'=>404
                            ];
                    
                            //http_response_code(404); 
                            return json_encode($data);
                        }
            

                    }else{

                        $data=[
                            'res'=>'Admin already Exists',
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
                    'res'=>'token not set',
                    'status'=>404
                ];
                
                return json_encode($data);
            }
    
}

?>