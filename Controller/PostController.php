<?php

declare(strict_types=1);

session_start();
    
class PostController extends Post {

    public function get(): array { 
        return $this->getPosts();
    }
    
    public function getDetails(int $postId): array { //post
        return $this->getPostDetailPage($postId);
    }
    
    public function getAllPostsFromUser(): array { //user
        return $this->getPostDetailPage($postId);
    }
    
    public function update(string $title, string $body, int $postId): void {    //post
        $this->updatePost($title, $body, $postId);
    }
    
    //zoek eerst user via sessie id (cookie) in db dan voeg je die mee in de query
    public function add(string $title, string $body): void { //post
        $this->addNewPost($title, $body);
    }
    
    public function deletePost(int $postId): void {
        $this->deletePost($postId);
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
    
    public function showLikes(int $postId): void {
        $this->showLikes($postId); 
    }
    
    public function addLikePost(int $postId): void {
        $this->addLikePost($postId);
    }
    
    public function deleteLikePost(int $postId): void {   
        $this->deleteLikePost($postId);
    }
}