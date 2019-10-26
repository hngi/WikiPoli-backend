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

        // Checks if user exists
        public static function check_users($conn,$email){
            $sql = "SELECT * FROM users WHERE email='".$email."'";

            $result = mysqli_query($conn, $sql);

            if(mysqli_num_rows($result) > 0){

                return TRUE;
            }else{
                return FALSE;
            }

        }

        // Checks for posts
        public static function check_post($conn,$id){
            $checkpost="SELECT * FROM posts WHERE post_id='$id'";
            $result = mysqli_query($conn, $checkpost);

            if(mysqli_num_rows($result) > 0){

                return TRUE;
            }else{
                return FALSE;
            }

        }

        // Checks for  all comments related to a post
        public static function get_comment($conn,$post_id){

            $checkpost="SELECT * FROM comments WHERE post_id='$post_id'";
            $result = mysqli_query($conn, $checkpost);

            if(mysqli_num_rows($result) > 0){

                $res=[];
                
                
                while($resp=mysqli_fetch_array($result,MYSQLI_ASSOC)){
                    $res[]=$resp;
                }
                
                return $res;
            }else{
                $arr=[];
                return $arr;
            }
        }

        // Publishing a new post
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

        // Confirming a user
        public static function confirm_id($conn,$id){

            $checkpost="SELECT * FROM users WHERE user_id='$id'";
            $result = mysqli_query($conn, $checkpost);

            if(mysqli_num_rows($result) > 0){

                return TRUE;
            }else{
                return FALSE;
            }

        }

        // Registering a new user
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

        // Publishing new comments
        public static function insert_comment($conn,$id,$post_id,$comment){

            $insertComments = "INSERT INTO comments (comment, post_id, user_id ) VALUES ( '$comment', '$post_id', '$id')";



            if( mysqli_query($conn, $insertComments)){
                return TRUE;
            }else{

                 die("database error: ". mysqli_error($conn));
            }

        }

        // loging in an existing user
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
    
        // Selects all posts
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

        // Selects posts by their ids
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

        // Selects Blocked users
        public static function user_blocked($conn,$id){

            $checkpost="SELECT * FROM blocked_users WHERE user_id='$id'";
            $result = mysqli_query($conn, $checkpost);
            
            if(mysqli_num_rows($result) > 0){
                    return TRUE;
            }else{
                return FALSE;
            }
        }

        // Unblocks users
        public static function user_unblocked($conn,$id){

            $checkpost="DELETE FROM  blocked_users WHERE user_id='$id'";
            
            if($result = mysqli_query($conn, $checkpost)){
                return TRUE;
            }else{
                return FALSE;
            }
        }

        // Deletes users
        public static function delete_user($conn,$id){

            $checkpost="DELETE FROM  users WHERE user_id='$id'";
            
            if($result = mysqli_query($conn, $checkpost)){
                return TRUE;  
            }else{
                return FALSE;
            }
        }

        // Blocks users
        public static function block_user($conn,$user_id){

            $sql = "INSERT INTO blocked_users (user_id) VALUES ('$user_id')";
            $result = mysqli_query($conn, $sql);

            if($result){
                return true;
            }else{
                return false;
            }

        }

        // Confirms an Admin
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

        // Deletes a post
        public function delete_post($conn,$post_id){

            $sql = "DELETE FROM posts WHERE post_id='$post_id'";

            if (mysqli_query($conn, $sql)) {
                return TRUE;
            } else {
                return FALSE;
            }
        }
        
        // Unblocks users
        public static function unblock_user($con, $uid){
            if(isset($uid)){
                $sql = "UPDATE users SET status = 0 WHERE user_id = $uid";
                mysqli_query($con, $sql);
                
                return true;
                }else{
                    return false;
            }
        }

        // Creates an Admin
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

        // Changing a User to Admin
        public function makeAdmin($conn,$uid){

            if(isset($uid)){
                $sql = "UPDATE users SET admin = 1 WHERE user_id = $uid";
                mysqli_query($conn, $sql);
            
                return true;
            }else{
                return false;
            }
        }

        // Confirms a Super Admin
        public static function confirm_super_admin($conn,$id){

            $checkpost="SELECT * FROM users WHERE user_id='$id'";
            $result = mysqli_query($conn, $checkpost);
            
            if(mysqli_num_rows($result) > 0){

                $result=mysqli_fetch_assoc($result);

                if($result['super_admin']==1 ){

                    return TRUE;
                }
                
            }else{
                return FALSE;
            }

        }

        // share post feature by Kazeem
        public static function getPostsToShare($conn, $post_id)
        {
            // join the table of the users and the posts so as to get the user's name where the user_id is the same as the post_author
            $query = "SELECT posts.*, users.name FROM posts INNER JOIN users ON posts.post_author = users.user_id WHERE post_id = '$post_id' ORDER BY post_id DESC";
            $result = mysqli_query($conn, $query);
            
            if(mysqli_num_rows($result) > 0){
                return $result;
            } else{
                return FALSE;
            }
        }

        public static function showAllUsers($conn){

            $user="SELECT * FROM users";
            
            $query=mysqli_query($conn, $user);
            
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

        public static function showUserById($conn,$id){

            $sql="SELECT * FROM users WHERE user_id='".$id."'";
            $result = mysqli_query($conn, $sql);
            
            if(mysqli_num_rows($result) > 0){

                $result=mysqli_fetch_assoc($result);

                return $result;
            }else{
                $arr=[];
                return $arr;
            }
        }

        public static function check_users_id($conn,$id){
            $sql = "SELECT * FROM users WHERE user_id='".$id."'";

            $result = mysqli_query($conn, $sql);

            if(mysqli_num_rows($result) > 0){

                return TRUE;
            }else{
                return FALSE;
            }
        }

    }
 
        
    
?>