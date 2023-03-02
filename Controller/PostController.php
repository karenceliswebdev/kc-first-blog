<?php

declare(strict_types=1);

session_start();
    
class PostController extends Post {

    //voor posts te tonen homepage
    public function getPosts(): array { //post
        
        
    
    }
    
    public function getPostDetailPage(int $postId): array { //post
        
        
    }
    
    public function getAllPostsFromUser(): array { //user
        
        
    }
    
    public function updatePost(string $title, string $body, int $postId): void {    //post
    // string en title html
       
    
    }
    
    //zoek eerst user via sessie id (cookie) in db dan voeg je die mee in de query
    public function addNewPost(string $title, string $body): void { //post
        
       
    
    }
    
    public function deletePost(int $postId): void {
        
    }
    
    public function checkEmailExists(string $email): bool {
               
        
    }
    
    //sessie id in db stoppen
    public function updateSessionId(string $email): void {
    
        
    }
    
    public function checkSessionExists(): bool {
        
       
    }
    
    //check hash (input pp) = db hash
    public function checkUserPasswordCorrect(string $email, string $password): bool {
        
    }
    
    //vind user via session id
    public function getUser(): array {
        
        
    }
    
    //voeg user toe die zich heeft geregistreerd
    public function addNewUser(string $email, string $password): void {
        
       
    
    }
    
    public function checkUserLikedPost(int $postId): bool {
        
       
    }
    
    public function getAllLikedPostsFromUser(): array {
        
        
    }
    
    public function showLikes(int $postId): void {
        
       
    }
    
    public function addLikePost(int $postId): void {
        
       
    
    }
    
    public function deleteLikePost(int $postId): void {   
   
        
    }
}