<?php

declare(strict_types=1);

session_start();


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

//voor posts te tonen homepage
function getPost(PDO $db): array {

    $res = $db->query('SELECT * FROM posts WHERE deleted_at IS NULL');
    return $res->fetchAll(); 

}

function getPostDetailPage(PDO $db, int $postId): array {
    
    $res = $db->prepare('SELECT * FROM posts WHERE id = :postId');
    $res->bindParam(':postId', $postId);
    $res->setFetchMode(PDO::FETCH_ASSOC);
    $res->execute();

    return $res->fetch();
}

function getAllPostsFromUser(PDO $db, int $userId): array {
    
    $res = $db->prepare('SELECT * FROM posts WHERE user_id = :userId');
    $res->bindParam(':userId', $userId);
    $res->setFetchMode(PDO::FETCH_ASSOC);
    $res->execute();

    return $res->fetchAll();
}



function checkEmailExists(PDO $db, string $email): array {
           
    $res = $db->prepare('SELECT * FROM users WHERE email = :email');
    $res->bindParam(':email', $email);
    $res->setFetchMode(PDO::FETCH_ASSOC);
    $res->execute();

    $user = $res->fetch();

    //anders kreeg ik steeds: error moet een array zijn maar krijg bool terug;
    if(!$user) {
        $user = [];
    }

    return $user;
}

//sessie id in db stoppen
function updateSessionId(PDO $db, string $userSessionId, string $email): void {

    $updateUserSessionIdStatement = $db->prepare('UPDATE users SET session_id = :sessionId WHERE email = :email');
    $updateUserSessionIdStatement->bindParam(':sessionId', $userSessionId);
    $updateUserSessionIdStatement->bindParam(':email', $email);
    $updateUserSessionIdStatement->execute();

}

function checkSessionStillExists(PDO $db): void {

    $res = $db->prepare('SELECT * FROM users WHERE session_id = :sessionId');
    $res->bindParam(':sessionId', $_COOKIE['auth']);
    $res->setFetchMode(PDO::FETCH_ASSOC);
    $res->execute();

    $user = $res->fetch();

    if(!$user) {

        header('Location: ./login.php');
        die;
    }

}

//voeg user toe die zich heeft geregistreerd
function addNewUser(PDO $db, string $email, string $password): void {

    $hashPassword = password_hash($password, PASSWORD_DEFAULT);

    $addUserStatement = $db->prepare('INSERT INTO users SET email = :email, hash = :password');
    $addUserStatement->bindParam(':email', $email);
    $addUserStatement->bindParam(':password', $hashPassword);
    $addUserStatement->execute();

}




?>