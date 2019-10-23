<?php
    require_once('../autoloader.php');
    
    use Helper\Database as DB;
    use Helper\Jwt_client as jwt;

    if($_SERVER['REQUEST_METHOD']=='POST'){

        if(isset($_POST['token']) && !empty($_POST['token'])){
		
            $arr=jwt::decode($_POST['token']);

            $conn=DB::db_connect(); 

            if(isset($_POST["email"]) ){
                $email=$_POST["email"];

                $res=DB::makeAdmin($conn,$email);

                    if($res){

                        $data=[
                            'res'=>'Admin approved for user',
                            'status'=>200
                        ];
                
                        //http_response_code(404); 
                        return json_encode($data);

                        }else{

                            $data=[
                                'res'=>'Error approving user as admin',
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
    }

?>