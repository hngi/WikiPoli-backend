<?php

// Author: @titaro

// Load autoloader
require_once('../autoloader.php');
use Helper\ForgotPassword as FP;

// Confirm if request method is POST
if($_SERVER['REQUEST_METHOD'] == 'POST')
{
 if(isset($_POST["email"]))
 {
  $email = $_POST["email"];
  
  // Lets check email if it exists
  $email_exists = FP::email_check($email);
  if($email_exists == true)
  {
   // Update password
   $update = FP::update_password($email);
  if($update != false)
  {
   // Send user an email
   $send = FP::send_email($email);
   if($send == true)
   {
    $data = [
       'res' => 'New Password Sent Successfully To Your Email.',
       'status' => 200,
       'data' => $email
     ];
   }
    else
   {
    $data = [
      'res' => 'Unable To Send New Password To Your Email.',
      'status' => 404
       ];
  }
 }
   else
 {
  $data = [
    'res' => 'Unable To Update Password To Database.',
    'status' => 404
     ];
}
}
 else
{
 $data = [
   'res' => 'Email Does Not Exists In Our Database.',
   'status' => 404
    ];
}
}
 else
{
 $data = [
   'res' => 'Invalid Input Data.',
   'status' => 404
    ];
}
}
 else
{
 $data = [
   'res' => 'Invalid Request Method.',
   'status' => 404
    ];
}

// Output json
echo json_encode($data);

?>
