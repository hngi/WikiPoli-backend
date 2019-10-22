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

            $con = mysqli_connect($all['DB_HOST'],$all['DB_USERNAME'],$all['DB_PASSWORD']);

            if (mysqli_connect_errno())
            {
                throw new Exception("Database is not connected".mysqli_connect_error());
            }else{

                return $con;
            }
        }

        public static function check_users($conn,$email){
            // $sql = "SELECT * FROM users WHERE email='".$email."'";
            $sql = "SELECT COUNT(*) FROM users WHERE email='" . $email . "'";

            $result = mysqli_query($conn, $sql);
            $result=mysqli_fetch_array($result);

            if($result['COUNT(*)'] > 0){

                
                return $result;

            }else{
                return false;
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

        }
    
?>