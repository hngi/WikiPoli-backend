<?php

    
    namespace Helper;
    
    use Helper\Config as Config;

    class Database{

        public static function db_connect(){

            $all=Config::all_config();
            $con = mysqli_connect($all['DB_HOST'],$all['DB_USERNAME'],$all['DB_PASSWORD'],$all['DB_NAME']);

            if (mysqli_connect_errno())
            {
                throw new Exception("Database is not connected".mysqli_connect_error());
            }else{

                return $con;
            }
        }

        public static function check_users($conn,$email){
            $sql = "SELECT * FROM users WHERE email='".$email."'";
            
            $result = mysqli_query($conn, $sql);
            
            if(mysqli_num_rows($result) > 0){

                return TRUE;
            }else{
                return FALSE;
            }
            
        }


        public static function check_post($conn,$id){
            $checkpost="SELECT * FROM posts WHERE post_id='$id'";
            $result = mysqli_query($conn, $checkpost);
            
            if(mysqli_num_rows($result) > 0){

                return TRUE;
            }else{
                return FALSE;
            }
            
        }

        public static function get_comment($conn,$post_id){
            
            $checkpost="SELECT * FROM comments WHERE post_id='$post_id'";
            $result = mysqli_query($conn, $checkpost);
            
            if(mysqli_num_rows($result) > 0){

                $result=mysqli_fetch_assoc($result);
                return $result;
            }else{
                $arr=[];
                return $arr;
            }
        }

        public static function confirm_id($conn,$id){

            $checkpost="SELECT * FROM users WHERE user_id='$id'";
            $result = mysqli_query($conn, $checkpost);
            
            if(mysqli_num_rows($result) > 0){

                return TRUE;
            }else{
                return FALSE;
            }
            
        }

        public static function register_user($conn,$email,$password,$name){

                $param="0123456789".time();
                $letters = str_split($param);
                $str = "";
                for ($i=0; $i<=10; $i++) {
                    $str .= $letters[rand(0, count($letters)-1)];
                };
                

            $sql = "INSERT INTO users (user_id,name,email,password,admin,super_admin) VALUES ('$str', '$name', '$email','$password',0,0)";
            $result = mysqli_query($conn, $sql);

            if($result){

                return true;

            }else{
                return false;
            }
        }


        public static function insert_comment($conn,$id,$post_id,$comment){

            $insertComments = "INSERT INTO comments (comment, post_id, user_id ) VALUES ( '$comment', '$post_id', '$id')";
            
           

            if( mysqli_query($conn, $insertComments)){
                return TRUE;
            }else{

                 die("database error: ". mysqli_error($conn));
            }

        }

        public static function login_user($conn,$email,$password){

            $sql="SELECT * FROM users WHERE email='{$email}' AND password='{$password}'";
            $result = mysqli_query($conn, $sql);

            if(mysqli_num_rows($result)>0){

                $result=mysqli_fetch_array($result,MYSQLI_ASSOC);
                return $result;
                mysqli_free_result($result);
           }else{
                return FALSE;
           }
        }

        public static function getAllUsers(){
            if(isset($_GET['name'])){
                $name = $_GET['name'];
                $sql = 'SELECT * FROM users WHERE name LIKE "%' .$name. '%"';
            } else {
                $sql = 'SELECT * FROM users';
            }
            $result = mysqli_query($conn,$sql);
                if($result != 0){
                    $result = array('success'=>1);
                    return $result;
                }
            
        }

        public static function addAdmin(){
            if(isset($_POST['name'])){
                $name = htmlspecialchars($_POST['name']);;
                $email = '';
                $password = '';
                if(isset($_POST['email'])){
                    $email = htmlspecialchars($_POST['email']);
                }
                if(isset($_POST['password'])){
                    $password = md5(htmlspecialchars($_POST['password']));
                }	
                $sql = "insert into users (name,email,password) values ('" . $name ."','". $email ."','" . $password ."')";
                $result = mysqli_query($conn,$sql);
                if($result != 0){
                    $result = array('success'=>1);
                    return $result;
                }
            }
        }

        public function deleteAdmin(){
            if(isset($_GET['id'])){
                $id = $_GET['id'];
                $sql = 'DELETE FROM users WHERE user_id = '.$id;
                $result = mysqli_query($conn,$sql);
                if($result != 0){
                    $result = array('success'=>1);
                    return $result;
                }
            }
        }

        public function editAdmin(){
            if(isset($_POST['name']) && isset($_GET['id'])){
                $name = $_POST['name'];
                $email = $_POST['email'];
                $sql = "UPDATE users SET name = '".$name."', email ='". $email ."' WHERE user_id = ".$_GET['id'];
                $result = mysqli_query($conn,$sql);
                if($result != 0){
                    $result = array('success'=>1);
                    return $result;
                }
            }
            
        }

        public static function makeAdmin(){
            if(isset($_POST['makeAdmin']) && isset($_GET['id'])){
                $sql = "UPDATE users SET admin = '1' WHERE user_id = ".$_GET['id'];
                $result = mysqli_query($conn,$sql);
                if($result != 0){
                $result = array('success'=>1);
                return $result;
                }
            }
            
        }

        }

        
    
?>