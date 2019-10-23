<?php

// Helper namespace
namespace Helper;
use Helper\Database as DB;

// Create the class
final class ForgotPassword
{
 /*
  * Begin the class properties
  */
 protected static $valid = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
 protected static $default = array("email", "submit");
 public static $errors = array();
 public static $response;

 /*
  * Begin The Methods
  */

 /*
  * Method for generating new password for users
  */
 public static function random_char($lenght = 6, $chars)
 {
  // Simple counter messure
  if(!isset($chars))
   {
    $chars = self::$valid;
   }

  // Get the lenght of character that are valid
  $char_length = strlen($chars);

  // Empty variable to concatenate data to later
  $random_string = '';

  // Make a loop
  for($i = 0; $i < $lenght; $i++)
   {
    $random_character = $chars[mt_rand(0, $char_length - 1)];
    $random_string .= $random_character;
   }

  // Return the random character
  return $random_string;
 }

 /*
  * Database method
  */
 public static function email_check($email)
 {
  // Connect to the database
  $db = DB::db_connect();

  // Make a query
  $q = "SELECT email FROM users WHERE email = '$email'";
  $query = mysqli_query($db, $q);
  
  // Do a simple return
  if($query)
  {
   return true;
  }
   else
  {
   return false;
  }
 }


 public static function forgot_password($input = array(), $req = true)
 {
  if(!isset($input) || !is_array($input))
   {
    $input = self::$defult;
   }

  // Lets begin the fun stuff
  if(is_array($input))
   {
    // Lets process the array
    // You may wonder why we need an array
    // This is because i have not seen the forgot password markup
    // And i don't know the name of input fields
   
    if($req == true)
     {
      // Use the POST request method
      $email = $_GET[$input[0]];
      $submit = $_GET[$input[1]];
     }
      else
     {
      // Use the POST request method
      $email = $_POST[$input[0]];
      $submit = $_POST[$input[1]];
     }

   if(isset($submit))
    {
     $echeck = self::email_check($email);
     if(!$echeck)
      {
       self::$errors[] = "Email does not exist in our database.";
       // Terminate the script
       exit();
      }
      
     if($echeck)
      {
       // New Generated password
       $np = self::random_char(6);
       $update_sql = "UPDATE users SET password = '$np' WHERE email = '$email'";
      }

    $sql = "SELECT * FROM users WHERE email = '$email'";
    $query = mysqli_query($db, $sql);
    while($info = mysql_fetch_array($query))
     {
      $name = $info['name'];
      $email = $info['email'];
     }

    $new_pass = $np;
    $to = $email; 
    $from = 'WIKIPOLI'; 
    $fromName = 'Wikipoli Team'; 
    $subject = "Your Wikipoli Account New Password"; 
 
    $htmlContent = ' 
    <html> 
    <head> 
    <title>New Wikipoli Password</title> 
    </head> 
    <body>
    <h1>Your Wikipoli Account Details</h1>
    <table cellspacing="0" style="border: 2px dashed #FB4314; width: 100%;"> 
    <tr> 
    <td>Name:</td>
    <td>'".$name."'</td> 
    </tr> 
    <tr style="background-color: #e0e0e0;"> 
    <th>Email:</th><td>contact@codexworld.com</td> 
    </tr> 
    <tr> 
    <td>Email:</td>
    <td>'".$email."'</td> 
    </tr>
    <tr> 
    <td>New Password:</td>
    <td>'".$new_pass."'</td> 
    </tr> 
    </table> 
    </body> 
    </html>'; 
 
   // Set content-type header for sending HTML email 
   $headers = "MIME-Version: 1.0" . "\r\n"; 
   $headers .= "Content-type: text/html;charset=UTF-8" . "\r\n"; 
 
   // Additional headers 
   $headers .= 'From: '.$fromName.'<'.$from.'>' . "\r\n"; 
   $headers .= 'Cc: '".$email."' . "\r\n"; 
   $headers .= 'Bcc: '".$email."' . "\r\n"; 
 
   if(mail($to, $subject, $htmlContent, $headers))
    { 
     $response = "Your New Password Has Been Sent To Your Email.";
    }
     else
    {
     self::$errors[] = "Error Sending Email.";
    }
   }
  }
 }
}

?>
