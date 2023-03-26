<?php
declare(strict_types=1);
namespace Models;
use PDO;
session_start();

class DB {

    private $host_name;
    private $db_name;
    private $username;
    private $password;
    private $conn;

    protected function connect(): object
    {
        $host_name = 'localhost';
        $db_name = 'first_blog_kc';
        $username = 'root';
        $password = 'root';

        if(!($this->conn)) {

            try {
                $this->conn = new PDO("mysql:host=$host_name;dbname=$db_name", $username, $password);
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (Exception $exception) {
                echo $exception->getMessage();
            }
        }
        return $this->conn;
    }       
}


