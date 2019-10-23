<?php


/* 

    This is the Jwt Class 
*/

    namespace Helper;
    use Firebase\JWT\JWT as jwt;
    use Helper\Config as Config;

    class Jwt_client{

        public static function encode(Array $array){

            if(is_array($array)){

                $key=Config::get_config('Jwt_secret');
                $jwt=jwt::encode($array,$key);
                return $jwt;


            }
            
            
        }

        public static function decode($token){

            if(!empty($token) && isset($token)){

                $key=Config::get_config('Jwt_secret');
                $jwt=jwt::decode($token,$key,['HS256']);
                $arr= (array) $jwt;
                return $arr;

            }
            
        }

    }
?>