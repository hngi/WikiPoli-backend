<?php


/* 

    This is the Config Class 
*/

    namespace Helper;

    class Config{
        
        protected static $config=[

            'DB_HOST'=>'localhost',
            'DB_USERNAME'=>'ubuntu',
            'DB_PASSWORD'=>'6yt5^YT%',
            'DB_NAME'=>'wikipool',
            'Jwt_secret'=>'3ED661F6C66B3D1E9D1033B8CE07FEAD13D32BCE2AC8FEF497AC5B950F33DA6D'
        ];


        public static function get_config($key){

            $config= self::$config;
            return $config[$key];
        }

        public static function all_config(){
            $config= self::$config;
            return $config;
        }

        
    }
?>
