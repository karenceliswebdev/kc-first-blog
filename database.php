<?php

$db = connectDb('root','','first_blog_kc');


function connectDb(string $user, string $pass, string $db, string $host = 'localhost'): PDO {
   
    try {
        
        $connection = new PDO("mysql:host={$host};dbname={$db}", $user, $pass);
        return $connection;

    } 
    catch (Exception $exception) {
        
        echo $exception->getMessage();
    }
}


function getPost(PDO $db): array {

    $res = $db->query('SELECT * FROM posts WHERE deleted_at IS NULL');
    return $res->fetchAll(); 

}






?>