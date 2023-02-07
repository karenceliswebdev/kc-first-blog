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
function getPosts(PDO $db): array {

    $res = $db->query('SELECT * FROM posts WHERE deleted_at IS NULL ORDER BY created_at DESC;');
    return $res->fetchAll(); 

}

function getPostDetailPage(PDO $db, int $postId): array {
    
    $res = $db->prepare('SELECT * FROM posts WHERE id = :postId');
    $res->bindParam(':postId', $postId);
    $res->setFetchMode(PDO::FETCH_ASSOC);
    $res->execute();

    return $res->fetch();
}

function getAllPostsFromUser(PDO $db): array {
    
    //eerst user id vinden via session id
    $selectUser = $db->prepare('SELECT * FROM users WHERE session_id = :sessionId');
    $selectUser->bindParam(':sessionId', $_COOKIE['auth']);
    $selectUser->setFetchMode(PDO::FETCH_ASSOC);
    $selectUser->execute();

    $user = $selectUser->fetch();

    //dan alle posts selecteren die deze user_id hebben
    $res = $db->prepare('SELECT * FROM posts WHERE user_id = :userId ORDER BY created_at DESC;');
    $res->bindParam(':userId', $user['id']);
    $res->setFetchMode(PDO::FETCH_ASSOC);
    $res->execute();

    return $res->fetchAll();
}

function updatePost($db, string $title, string $body, int $postId): void {
    
    $now = date('Y-m-d H:i:s');

    $updatePostStatement = $db->prepare('UPDATE posts SET title = :title, body = :body, updated_at = :now WHERE id = :postId');
    $updatePostStatement->bindParam(':title', $title);
    $updatePostStatement->bindParam(':body', $body);
    $updatePostStatement->bindParam(':postId', $postId);
    $updatePostStatement->bindParam(':now', $now);
    $updatePostStatement->execute();

}

//zoek eerst user via sessie id (cookie) in db dan voeg je die mee in de query
function addNewPost(PDO $db, string $title, string $content): void {

    $res = $db->prepare('SELECT * FROM users WHERE session_id = :sessionId');
    $res->bindParam(':sessionId', $_COOKIE['auth']);
    $res->setFetchMode(PDO::FETCH_ASSOC);
    $res->execute();

    $user = $res->fetch();

    $now = date('Y-m-d H:i:s');

    $addPostStatement = $db->prepare('INSERT INTO posts SET user_id = :userId, title = :title, body = :content, created_at= :now');
    $addPostStatement->bindParam(':userId', $user['id']);
    $addPostStatement->bindParam(':title', $title);
    $addPostStatement->bindParam(':content', $content);
    $addPostStatement->bindParam(':now', $now);
    $addPostStatement->execute();

}


function checkEmailExists(PDO $db, string $email): bool {
           
    $res = $db->prepare('SELECT * FROM users WHERE email = :email');
    $res->bindParam(':email', $email);
    $res->setFetchMode(PDO::FETCH_ASSOC);
    $res->execute();

    $user = $res->fetch();

    //anders kreeg ik steeds: error moet een array zijn maar krijg bool terug;
    if($user) {
        
        return true;
        die;
    }

    return false;
}

//sessie id in db stoppen
function updateSessionId(PDO $db, string $userSessionId, string $email): void {

    $updateUserSessionIdStatement = $db->prepare('UPDATE users SET session_id = :sessionId WHERE email = :email');
    $updateUserSessionIdStatement->bindParam(':sessionId', $userSessionId);
    $updateUserSessionIdStatement->bindParam(':email', $email);
    $updateUserSessionIdStatement->execute();

}

function checkSessionStillExists(PDO $db): bool {

    $res = $db->prepare('SELECT * FROM users WHERE session_id = :sessionId');
    $res->bindParam(':sessionId', $_COOKIE['auth']);
    $res->setFetchMode(PDO::FETCH_ASSOC);
    $res->execute();

    $user = $res->fetch();

    if($user) {

        return true;
        die;
    }

    return false;

}

//check hash (input pp) = db hash
function checkUserPasswordCorrect($db, string $email, string $password): bool {

    $res = $db->prepare('SELECT * FROM users WHERE email = :email');
    $res->bindParam(':email', $email);
    $res->setFetchMode(PDO::FETCH_ASSOC);
    $res->execute();

    $user = $res->fetch();

    if(!password_verify($password, $user['hash'])) {
        
        return false;
        die;
    }

    return true;
}

//vind user via session id
function getUser(PDO $db): array {

    $res = $db->prepare('SELECT * FROM users WHERE session_id = :sessionId');
    $res->bindParam(':sessionId', $_COOKIE['auth']);
    $res->setFetchMode(PDO::FETCH_ASSOC);
    $res->execute();

    return $user = $res->fetch();    
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