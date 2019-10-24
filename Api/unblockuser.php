<?php

require_once('../autoloader.php');
use Helper\Database as DB;
use Helper\Jwt_client as jwt;

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
 if(isset($_POST['token']) && !empty($_POST['token']))
 {
  $array = jwt::decode($_POST['token']);
  // DB connection
  $db = DB::db_connect();
  
  if(DB::confirm_id($db, $array['data']->id))
  {
     if(DB::confirm_admin($db, $array['data']->id)){
    if(isset($_POST["uid"]) && !empty($_POST["uid"])){
     $uid = $_POST["uid"];
     $unblock = DB::unblock_user($db, $uid);
     if($unblock == true){
       $data = [
         'res' => 'User Unblocked Successfully.',
         'status' => 200
       ];

       echo json_encode($data);
     }
      else{
      $data = [
         'res' => 'An Error Occured.',
         'status' => 404
       ];

       echo json_encode($data);
     }
    }
      else{
          $data = [
              'res' => 'Unauthorized Access',
                'status' => 403
          ];
          
          echo json_encode($data);
        }
    }
    else{
        $data = [
         'res'=>'Invalid User',
         'status'=>404
     ];

     echo json_encode($data);
    }
  }
   else{
     $data = [
        'res' => 'No token was sent',
        'status' => 404
    ];

    echo json_encode($data);
  }
 }
  else
 {
    $data = [
     'res' => 'Invalid Request Method',
    'status'=>404
    ];

    echo json_encode($data);
  } 
}
?>