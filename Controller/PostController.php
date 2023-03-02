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
    
    public function showLikes(int $postId): void {
        $this->showLikes($postId); 
    }
    
    public function addLike(int $postId): void {
        $this->addLikePost($postId);
    }
    
    public function deleteLike(int $postId): void {   
        $this->deleteLikePost($postId);
    }
}