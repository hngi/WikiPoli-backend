<?php

    namespace Helper;

    use Helper\Config as Config;

    class Database{

    public $conn;
    public $all;
    public function __construct(){

      $this->all=Config::all_config();
        // Create connection
        $this->conn = new \mysqli($this->all['DB_HOST'], $this->all['DB_USERNAME'], $this->all['DB_PASSWORD'],  $this->all['DB_NAME']);

        // Check connection
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
        //echo "Connection was successfully established!";
  }



    public function query($sql) {
        if ($this->conn->query($sql) === true) {
            return true;
        }
        return false;
    }

  public function select($sql) {
        $result = $this->conn->query($sql);

        if ($result->num_rows > 0) {
            $resultToReturn = [];
            while ($row = $result->fetch_assoc()) {
                array_push($resultToReturn, $row);
            }
            return $resultToReturn;
        }
        return false;
    }


  public function close() {
    $this->conn->close();
  }


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

        public static function create_post($conn,$user_id,$content,$topic){
            
            $year=date('Y');
            $param="0123456789".time();
                $letters = str_split($param);
                $str = "";
                for ($i=0; $i<=8; $i++) {
                    $str .= $letters[rand(0, count($letters)-1)];
                };

                $sql = "INSERT INTO posts (post_id,post,post_author,post_date,post_topic) VALUES ('$str', '$content', '$user_id','$year','$topic')";
                $result = mysqli_query($conn, $sql);
    
                if($result){
    
                    return true;
    
                }else{
                    return false;
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
                for ($i=0; $i<=8; $i++) {
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
    
    

        public static function get_all_posts($conn){

            $checkpost="SELECT * FROM posts";
            
            $query=mysqli_query($conn, $checkpost);
            
            if(mysqli_num_rows($query) > 0){
                $res=[];
                
                
                while($result=mysqli_fetch_array($query,MYSQLI_ASSOC)){
                    $res[]=$result;
                }
                
                return $res;
            }else{
                $arr=[];
                return $arr;
            }
        }


        public static function get_post_by_id($conn,$id){

            $checkpost="SELECT * FROM posts WHERE post_id='$id'";
            $result = mysqli_query($conn, $checkpost);
            
            if(mysqli_num_rows($result) > 0){

                $result=mysqli_fetch_assoc($result);
                return $result;
            }else{
                $arr=[];
                return $arr;
            }
        }

        public static function user_blocked($conn,$id){

            $checkpost="SELECT * FROM blocked_users WHERE user_id='$id'";
            $result = mysqli_query($conn, $checkpost);
            
            if(mysqli_num_rows($result) > 0){

                

                    return TRUE;
               
                
            }else{
                return FALSE;
            }
        }


        public static function user_unblocked($conn,$id){

            $checkpost="DELETE FROM  blocked_users WHERE user_id='$id'";
            
            
            if($result = mysqli_query($conn, $checkpost)){

                

                return TRUE;
               
                
            }else{
                return FALSE;
            }
        }

        public static function block_user($conn,$user_id){

            $sql = "INSERT INTO blocked_users (user_id) VALUES ('$user_id')";
            $result = mysqli_query($conn, $sql);

            if($result){

                return true;

            }else{
                return false;
            }

        }


        public static function confirm_admin($conn,$id){

            $checkpost="SELECT * FROM users WHERE user_id='$id'";
            $result = mysqli_query($conn, $checkpost);
            
            if(mysqli_num_rows($result) > 0){

                $result=mysqli_fetch_assoc($result);

                if($result['admin']==1 || $result['super_admin']==1 ){

                    return TRUE;
                }
                
            }else{
                return FALSE;
            }

        }


        public function delete_post($conn,$post_id){

            $sql = "DELETE FROM posts WHERE post_id='$post_id'";

            if (mysqli_query($conn, $sql)) {
                return TRUE;
            } else {
                return FALSE;
            }
        }
        
        public static function unblock_user($con, $uid)
        {
        if(isset($uid))
        {
        $sql = "UPDATE users SET status = 0 WHERE user_id = $uid";
        mysqli_query($con, $sql);
        
        return true;
        }
        else
        {
        return false;
        }
    }


        public static function addAdmin($conn,$email,$password,$name){


            $param="0123456789".time();
            $letters = str_split($param);
            $str = "";
            for ($i=0; $i<=8; $i++) {
                $str .= $letters[rand(0, count($letters)-1)];
            };
                

            $sql = "INSERT INTO users (user_id,name,email,password,admin,super_admin) VALUES ('$str', '$name', '$email','$password',1,0)";
            $result = mysqli_query($conn, $sql);

            if($result){

                return true;

            }else{
                return false;
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