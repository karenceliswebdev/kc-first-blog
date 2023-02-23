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
    $selectUser->bindParam(':sessionId', $_SESSION['sessionId']);
    $selectUser->setFetchMode(PDO::FETCH_ASSOC);
    $selectUser->execute();

    $user = $selectUser->fetch();

    //dan alle posts selecteren die deze user_id hebben
    $res = $db->prepare('SELECT * FROM posts WHERE user_id = :userId AND deleted_at IS NULL ORDER BY created_at DESC;');
    $res->bindParam(':userId', $user['id']);
    $res->setFetchMode(PDO::FETCH_ASSOC);
    $res->execute();

    return $res->fetchAll();
}

function updatePost($db, string $title, string $body, int $postId): void {    
// string en title html

    $newTitle = htmlspecialchars($title, ENT_QUOTES);
    $newBody = htmlspecialchars($body, ENT_QUOTES);

    $now = date('Y-m-d H:i:s');

    $updatePostStatement = $db->prepare('UPDATE posts SET title = :title, body = :body, updated_at = :now WHERE id = :postId');
    $updatePostStatement->bindParam(':title', $newTitle);
    $updatePostStatement->bindParam(':body', $newBody);
    $updatePostStatement->bindParam(':postId', $postId);
    $updatePostStatement->bindParam(':now', $now);
    $updatePostStatement->execute();

}

//zoek eerst user via sessie id (cookie) in db dan voeg je die mee in de query
function addNewPost(PDO $db, string $title, string $body): void {

    $newTitle = htmlspecialchars($title, ENT_QUOTES);
    $newBody = htmlspecialchars($body, ENT_QUOTES);

    $res = $db->prepare('SELECT * FROM users WHERE session_id = :sessionId');
    $res->bindParam(':sessionId', $_SESSION['sessionId']);
    $res->setFetchMode(PDO::FETCH_ASSOC);
    $res->execute();

    $user = $res->fetch();

    $now = date('Y-m-d H:i:s');

    $addPostStatement = $db->prepare('INSERT INTO posts SET user_id = :userId, title = :title, body = :content, created_at= :now');
    $addPostStatement->bindParam(':userId', $user['id']);
    $addPostStatement->bindParam(':title', $newTitle);
    $addPostStatement->bindParam(':content', $newBody);
    $addPostStatement->bindParam(':now', $now);
    $addPostStatement->execute();

}

function deletePost(PDO $db, int $postId): void {

    $now = date('Y-m-d H:i:s');

    $deletePostStatement = $db->prepare('UPDATE posts SET deleted_at = :now WHERE id = :postId');
    $deletePostStatement->bindParam(':now', $now);
    $deletePostStatement->bindParam(':postId', $postId);
    $deletePostStatement->execute();
}

function checkEmailExists(PDO $db, string $email): bool {
           
    $newEmail = htmlspecialchars($email, ENT_QUOTES);

    $res = $db->prepare('SELECT * FROM users WHERE email = :email');
    $res->bindParam(':email', $newEmail);
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
function updateSessionId(PDO $db, string $email): void {

    $newEmail = htmlspecialchars($email, ENT_QUOTES);

    $updateUserSessionIdStatement = $db->prepare('UPDATE users SET session_id = :sessionId WHERE email = :email');
    $updateUserSessionIdStatement->bindParam(':sessionId', $_SESSION['sessionId']);
    $updateUserSessionIdStatement->bindParam(':email', $newEmail);
    $updateUserSessionIdStatement->execute();
}

function checkSessionExists(PDO $db): bool {

    $res = $db->prepare('SELECT * FROM users WHERE session_id = :sessionId');
    $res->bindParam(':sessionId', $_SESSION['sessionId']);
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

    $newEmail = htmlspecialchars($email, ENT_QUOTES);
    $newPassword = htmlspecialchars($password, ENT_QUOTES);

    $res = $db->prepare('SELECT * FROM users WHERE email = :email');
    $res->bindParam(':email', $newEmail);
    $res->setFetchMode(PDO::FETCH_ASSOC);
    $res->execute();

    $user = $res->fetch();

    if(!password_verify($newPassword, $user['hash'])) {
        
        return false;
        die;
    }

    return true;
}

//vind user via session id
function getUser(PDO $db): array {

    $res = $db->prepare('SELECT * FROM users WHERE session_id = :sessionId');
    $res->bindParam(':sessionId', $_SESSION['sessionId']);
    $res->setFetchMode(PDO::FETCH_ASSOC);
    $res->execute();

    return $user = $res->fetch();    
}

//voeg user toe die zich heeft geregistreerd
function addNewUser(PDO $db, string $email, string $password): void {

    $newEmail = htmlspecialchars($email, ENT_QUOTES);
    $newPassword = htmlspecialchars($password, ENT_QUOTES);

    $hashPassword = password_hash($newPassword, PASSWORD_DEFAULT);

    $addUserStatement = $db->prepare('INSERT INTO users SET email = :email, hash = :password');
    $addUserStatement->bindParam(':email', $newEmail);
    $addUserStatement->bindParam(':password', $hashPassword);
    $addUserStatement->execute();

}

function checkUserLikedPost(PDO $db, int $postId): bool {

    $getUserStatement = $db->prepare('SELECT * FROM users WHERE session_id = :sessionId');
    $getUserStatement->bindParam(':sessionId', $_SESSION['sessionId']);
    $getUserStatement->setFetchMode(PDO::FETCH_ASSOC);
    $getUserStatement->execute();

    $user = $getUserStatement->fetch();

    $res = $db->prepare('SELECT * FROM likes WHERE user_id = :userId AND post_id = :postId');
    $res->bindParam(':userId', $user['id']);
    $res->bindParam(':postId', $postId);
    $res->setFetchMode(PDO::FETCH_ASSOC);
    $res->execute();

    $like = $res->fetch();

    if($like) {

        return true;
        die;
    }

    return false;
}

function getAllLikedPostsFromUser(PDO $db): array {

    //eerst user id vinden via session id
    $selectUser = $db->prepare('SELECT * FROM users WHERE session_id = :sessionId');
    $selectUser->bindParam(':sessionId', $_SESSION['sessionId']);
    $selectUser->setFetchMode(PDO::FETCH_ASSOC);
    $selectUser->execute();

    $user = $selectUser->fetch();

    //dan alle posts selecteren die deze user_id hebben
    $res = $db->prepare('SELECT * FROM likes WHERE user_id = :userId');
    $res->bindParam(':userId', $user['id']);
    $res->setFetchMode(PDO::FETCH_ASSOC);
    $res->execute();

    return $res->fetchAll();
}

function showLikes(PDO $db, int $postId): void {

    $res = $db->prepare('SELECT id FROM likes WHERE post_id = :postId');
    $res->bindParam(':postId', $postId);
    $res->setFetchMode(PDO::FETCH_ASSOC);
    $res->execute();
    $count = $res->fetchAll();

    echo count($count);
}

function addLikePost(PDO $db, int $postId): void {
    
    $getUserStatement = $db->prepare('SELECT * FROM users WHERE session_id = :sessionId');
    $getUserStatement->bindParam(':sessionId', $_SESSION['sessionId']);
    $getUserStatement->setFetchMode(PDO::FETCH_ASSOC);
    $getUserStatement->execute();

    $user = $getUserStatement->fetch();

    $res = $db->prepare('INSERT INTO likes SET user_id = :userId, post_id = :postId');
    $res->bindParam(':userId', $user['id']);
    $res->bindParam(':postId', $postId);
    $res->setFetchMode(PDO::FETCH_ASSOC);
    $res->execute();

}

function deleteLikePost(PDO $db, int $postId): void {   
//doe gwn getuser eerst en sttek mee in parameter

    $getUserStatement = $db->prepare('SELECT * FROM users WHERE session_id = :sessionId');
    $getUserStatement->bindParam(':sessionId', $_SESSION['sessionId']);
    $getUserStatement->setFetchMode(PDO::FETCH_ASSOC);
    $getUserStatement->execute();

    $user = $getUserStatement->fetch();

    //

    $res = $db->prepare('DELETE FROM likes WHERE user_id = :userId AND post_id = :postId');
    $res->bindParam(':userId', $user['id']);
    $res->bindParam(':postId', $postId);
    $res->setFetchMode(PDO::FETCH_ASSOC);
    $res->execute();
}

?>