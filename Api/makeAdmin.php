<?php
    require_once('../autoloader.php');
    
    use Helper\Database as DB;
    use Helper\Jwt_client as jwt;

    if($_SERVER['REQUEST_METHOD']=='POST'){ 

        if(isset($_POST['token'])&& !empty($_POST['token'])){
    
            $arr=jwt::decode($_POST['token']);
    
            $conn=DB::db_connect();
    
            if(DB::confirm_id($conn,$arr['data']->id)){
    
                if(DB::confirm_super_admin($conn,$arr['data']->id)){
    
                    if(isset($_POST['user_id'])&& !empty($_POST['user_id'])){
                        $user_id=$_POST['user_id'];
                        
                        if(DB::confirm_id($conn,$user_id)){


                            if(DB::makeAdmin($conn,$user_id)){
    
                                $data=[
                                    'res'=>'User Successfully Made Admin',
                                    'status'=>200
                                ];
                                    
                                
                                echo json_encode($data);
        
        
                            }else{
        
                                $data=[
                                    'res'=>'Operation not successfull',
                                    'status'=>500
                                ];
                                    
                                
                                echo json_encode($data);
                            }

                        }else{

                            $data=[
                                'res'=>'User not Found',
                                'status'=>404
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