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
    public function checkPassword(string $email, string $password): bool {
        return $this->checkUserPasswordCorrect($email, $password);  
    }
    
    //vind user via session id
    public function get(): array {
        return $this->getUser();  
    }

    //voeg user toe die zich heeft geregistreerd
    public function add(string $email, string $password): void {
        $this->addNewUser($email, $password);
    }
    
    public function checkLikedPost(int $postId): bool {
        return $this->checkUserLikedPost($postId); 
    }
    
    public function getLikesPost(): array {
        return $this->getAllLikedPostsFromUser(); 
    }
}