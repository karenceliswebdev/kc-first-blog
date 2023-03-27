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
        $this->host_name = 'localhost';
        $this->db_name = 'first_blog_kc';
        $this->username = 'root';
        $this->password = 'root';

        if(!($this->conn)) {

            try {
                $this->conn = new PDO("mysql:host=" .$this->host_name. ";dbname=" .$this->db_name. ";", $this->username, $this->password);
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (Exception $exception) {
                echo $exception->getMessage();
            }
        }
        return $this->conn;
    }       
}


