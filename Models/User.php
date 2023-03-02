<?php

declare(strict_types=1);

session_start();
    
class User extends DB {
    
    protected function getAllPostsFromUser(): array { //user
        
        //eerst user id vinden via session id
        $selectUser = $this->connect()->prepare('SELECT * FROM users WHERE session_id = :sessionId');
        $selectUser->bindParam(':sessionId', $_SESSION['sessionId']);
        $selectUser->setFetchMode(PDO::FETCH_ASSOC);
        $selectUser->execute();
    
        $user = $selectUser->fetch();
    
        //dan alle posts selecteren die deze user_id hebben
        $res = $this->connect()->prepare('SELECT * FROM posts WHERE user_id = :userId AND deleted_at IS NULL ORDER BY created_at DESC;');
        $res->bindParam(':userId', $user['id']);
        $res->setFetchMode(PDO::FETCH_ASSOC);
        $res->execute();
    
        return $res->fetchAll();
    }

    protected function checkEmailExists(string $email): bool {
               
        $newEmail = htmlspecialchars($email, ENT_QUOTES);
        
        $res = $this->connect()->prepare('SELECT * FROM users WHERE email = :email');
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

    protected function checkSessionExists(): bool {
        
        $res = $this->connect()->prepare('SELECT * FROM users WHERE session_id = :sessionId');
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

     //sessie id in db stoppen
     protected function updateSessionId(string $email): void {
    
        $newEmail = htmlspecialchars($email, ENT_QUOTES);
        
        $updateUserSessionIdStatement = $this->connect()->prepare('UPDATE users SET session_id = :sessionId WHERE email = :email');
        $updateUserSessionIdStatement->bindParam(':sessionId', $_SESSION['sessionId']);
        $updateUserSessionIdStatement->bindParam(':email', $newEmail);
        $updateUserSessionIdStatement->execute();
    }
    
    //check hash (input pp) = db hash
    protected function checkUserPasswordCorrect(string $email, string $password): bool {
        
        $newEmail = htmlspecialchars($email, ENT_QUOTES);
        $newPassword = htmlspecialchars($password, ENT_QUOTES);
    
        $res = $this->connect()->prepare('SELECT * FROM users WHERE email = :email');
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
    protected function getUser(): array {
        
        $res = $this->connect()->prepare('SELECT * FROM users WHERE session_id = :sessionId');
        $res->bindParam(':sessionId', $_SESSION['sessionId']);
        $res->setFetchMode(PDO::FETCH_ASSOC);
        $res->execute();
    
        return $user = $res->fetch();    
    }
    
    //voeg user toe die zich heeft geregistreerd
    protected function addNewUser(string $email, string $password): void {
        
        $newEmail = htmlspecialchars($email, ENT_QUOTES);
        $newPassword = htmlspecialchars($password, ENT_QUOTES);
    
        $hashPassword = password_hash($newPassword, PASSWORD_DEFAULT);
    
        $addUserStatement = $this->connect()->prepare('INSERT INTO users SET email = :email, hash = :password');
        $addUserStatement->bindParam(':email', $newEmail);
        $addUserStatement->bindParam(':password', $hashPassword);
        $addUserStatement->execute();
    
    }
    
    protected function checkUserLikedPost(int $postId): bool {
        
        $getUserStatement = $this->connect()->prepare('SELECT * FROM users WHERE session_id = :sessionId');
        $getUserStatement->bindParam(':sessionId', $_SESSION['sessionId']);
        $getUserStatement->setFetchMode(PDO::FETCH_ASSOC);
        $getUserStatement->execute();
    
        $user = $getUserStatement->fetch();
    
        $res = $this->connect()->prepare('SELECT * FROM likes WHERE user_id = :userId AND post_id = :postId');
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
    
    protected function getAllLikedPostsFromUser(): array {
        
        //eerst user id vinden via session id
        $selectUser = $this->connect()->prepare('SELECT * FROM users WHERE session_id = :sessionId');
        $selectUser->bindParam(':sessionId', $_SESSION['sessionId']);
        $selectUser->setFetchMode(PDO::FETCH_ASSOC);
        $selectUser->execute();
    
        $user = $selectUser->fetch();
    
        //dan alle posts selecteren die deze user_id hebben
        $res = $this->connect()->prepare('SELECT * FROM likes WHERE user_id = :userId');
        $res->bindParam(':userId', $user['id']);
        $res->setFetchMode(PDO::FETCH_ASSOC);
        $res->execute();
    
        return $res->fetchAll();
    }
}