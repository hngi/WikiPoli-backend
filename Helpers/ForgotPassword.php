<?php

// Author: @titaro

// Helper namespace
namespace Helper;
use Helper\Database as DB;

// Create the class
final class ForgotPassword
{
 /*
  * Begin The Methods
  */

 /*
  * Method for generating new password for users
  */
 public static function random_char($lenght = 6, $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ')
 {
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

/*
 * Create the update password method
 */
public static function update_password($email)
{
 // Connect to the database
 $db = DB::db_connect();
 
 // New Generated password
 $new = self::random_char();
 // Sanitize and decode
 $np = htmlspecialchars(md5($new));
 $update_sql = "UPDATE users SET password = '$np' WHERE email = '$email'";
 $update = mysqli_query($db, $update_sql);
  
 if($update)
 {
  return $new;
 }
  else
 {
  return false;
 }
}

/*
 * Create the method for sending mail to user
 */
public static function send_email($email)
{
 // Connect to the database
 $db = DB::db_connect();
  
 $sql = "SELECT * FROM users WHERE email = '$email'";
 $query = mysqli_query($db, $sql);
 while($info = mysql_fetch_array($query))
 {
  $name = $info['name'];
  $email = $info['email'];
 }

 // Users new password
 $new_pass = self::update_password($email);
 $to = $email; 
 $from = 'WIKIPOLI'; 
 $fromName = 'Wikipoli Team'; 
 $subject = "Your Wikipoli Account New Password"; 
 
 $htmlContent = "
    <html> 
    <head> 
    <title>New Wikipoli Password</title> 
    </head> 
    <body>
    <h1>Your Wikipoli Account Details</h1>
    <table cellspacing='0' style='border: 2px dashed #FB4314; width: 100%;'> 
    <tr> 
    <td>Name:</td>
    <td>$name</td> 
    </tr>
    <tr> 
    <td>Email:</td>
    <td>$email</td> 
    </tr>
    <tr> 
    <td>New Password:</td>
    <td>$new_pass</td> 
    </tr> 
    </table> 
    </body> 
    </html>"; 
 
 // Set content-type header for sending HTML email 
 $headers = "MIME-Version: 1.0" . "\r\n"; 
 $headers .= "Content-type: text/html;charset=UTF-8" . "\r\n"; 
 
 // Additional headers 
 $headers .= "From: ".$fromName."<".$from.">" . "\r\n"; 
 $headers .= "Cc: ".$email."" . "\r\n";
 $headers .= "Bcc: ".$email."" . "\r\n";  
 
 if(mail($to, $subject, $htmlContent, $headers))
 { 
  return true;
 }
  else
 {
  return false;
 }
}
}

?>
