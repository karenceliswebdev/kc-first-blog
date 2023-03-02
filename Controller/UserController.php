<?php

declare(strict_types=1);

session_start();
    
class UserController extends User {
    
    public function getPosts(): array { //user
        return $this->getAllPostsFromUser();
    }

    public function checkEmail(string $email): bool {
        return $this->checkEmailExists($email); 
    }
    
    //sessie id in db stoppen
    public function updateSession(string $email): void {
        $this->updateSessionId($email); 
    }
    
    public function checkSession(): bool {
        return $this->checkSessionExists();   
    }
    
    //check hash (input pp) = db hash
    public function checkUserPassword(string $email, string $password): bool {
        return $this->checkUserPasswordCorrect($email, $password);  
    }
    
    //vind user via session id
    public function getUserPost(): array {
        return $this->getUser();  
    }

    //voeg user toe die zich heeft geregistreerd
    public function addNewUser(string $email, string $password): void {
        $this->addNewUser($email, $password);
    }
    
    public function checkUserLikedPost(int $postId): bool {
        return $this->checkUserLikedPost($postId); 
    }
    
    public function getAllLikedPostsFromUser(): array {
        return $this->getAllLikedPostsFromUser(); 
    }
}