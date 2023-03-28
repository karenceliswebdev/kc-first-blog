<?php
declare(strict_types=1);

class DB {

    private static $host_name = 'localhost';
    private static $db_name = 'first_blog_kc';
    private static $username = 'root';
    private static $password = 'root';//

    private static $conn;

    public static function connect(): object//
    {
        if(!self::$conn)
        {
            try {
            
                self::$conn = new PDO("mysql:host=" .self::$host_name. ";dbname=" .self::$db_name. ";", self::$username, self::$password);
                self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } 
            catch (Exception $exception) {
                
                echo $exception->getMessage();
            } 
        }

        return self::$conn;
    } 

}


