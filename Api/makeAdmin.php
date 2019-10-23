<?php
    require_once('../autoloader.php');
    
    use Helper\Database as DB;
    if($_SERVER['REQUEST_METHOD']=='POST'){

        $conn=DB::db_connect();

        

            $res=DB::makeAdmin();

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
        

    }

?>