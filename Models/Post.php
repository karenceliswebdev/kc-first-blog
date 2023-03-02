<?php

declare(strict_types=1);

session_start();
    
class Post extends DB {
    
    //voor posts te tonen homepage
    protected function getPosts(): array { //post
        
        $res = $this->connect()->query('SELECT * FROM posts WHERE deleted_at IS NULL ORDER BY created_at DESC;');
        return $res->fetchAll(); 
    
    }
    
    protected function getPostDetailPage(int $postId): array { //post
        
        $res = $this->connect()->prepare('SELECT * FROM posts WHERE id = :postId');
        $res->bindParam(':postId', $postId);
        $res->setFetchMode(PDO::FETCH_ASSOC);
        $res->execute();
    
        return $res->fetch();
    }
    
    protected function updatePost(string $title, string $body, int $postId): void {    //post
    // string en title html
        
        $newTitle = htmlspecialchars($title, ENT_QUOTES);
        $newBody = htmlspecialchars($body, ENT_QUOTES);
    
        $now = date('Y-m-d H:i:s');
    
        $updatePostStatement = $this->connect()->prepare('UPDATE posts SET title = :title, body = :body, updated_at = :now WHERE id = :postId');
        $updatePostStatement->bindParam(':title', $newTitle);
        $updatePostStatement->bindParam(':body', $newBody);
        $updatePostStatement->bindParam(':postId', $postId);
        $updatePostStatement->bindParam(':now', $now);
        $updatePostStatement->execute();
    
    }
    
    //zoek eerst user via sessie id (cookie) in db dan voeg je die mee in de query
    protected function addNewPost(string $title, string $body): void { //post
        
        $newTitle = htmlspecialchars($title, ENT_QUOTES);
        $newBody = htmlspecialchars($body, ENT_QUOTES);
    
        $res = $this->connect()->prepare('SELECT * FROM users WHERE session_id = :sessionId');
        $res->bindParam(':sessionId', $_SESSION['sessionId']);
        $res->setFetchMode(PDO::FETCH_ASSOC);
        $res->execute();
    
        $user = $res->fetch();
    
        $now = date('Y-m-d H:i:s');
    
        $addPostStatement = $this->connect()->prepare('INSERT INTO posts SET user_id = :userId, title = :title, body = :content, created_at= :now');
        $addPostStatement->bindParam(':userId', $user['id']);
        $addPostStatement->bindParam(':title', $newTitle);
        $addPostStatement->bindParam(':content', $newBody);
        $addPostStatement->bindParam(':now', $now);
        $addPostStatement->execute();
    
    }
    
    protected function deletePost(int $postId): void {
        
        $now = date('Y-m-d H:i:s');
    
        $deletePostStatement = $this->connect()->prepare('UPDATE posts SET deleted_at = :now WHERE id = :postId');
        $deletePostStatement->bindParam(':now', $now);
        $deletePostStatement->bindParam(':postId', $postId);
        $deletePostStatement->execute();
    }
    
    protected function showLikes(int $postId): void {
        
        $res = $this->connect()->prepare('SELECT id FROM likes WHERE post_id = :postId');
        $res->bindParam(':postId', $postId);
        $res->setFetchMode(PDO::FETCH_ASSOC);
        $res->execute();
        $count = $res->fetchAll();
    
        echo count($count);
    }
    
    protected function addLikePost(int $postId): void {
        
        $getUserStatement = $this->connect()->prepare('SELECT * FROM users WHERE session_id = :sessionId');
        $getUserStatement->bindParam(':sessionId', $_SESSION['sessionId']);
        $getUserStatement->setFetchMode(PDO::FETCH_ASSOC);
        $getUserStatement->execute();
    
        $user = $getUserStatement->fetch();
    
        $res = $this->connect()->prepare('INSERT INTO likes SET user_id = :userId, post_id = :postId');
        $res->bindParam(':userId', $user['id']);
        $res->bindParam(':postId', $postId);
        $res->setFetchMode(PDO::FETCH_ASSOC);
        $res->execute();
    
    }
    
    protected function deleteLikePost(int $postId): void {   
    //doe gwn getuser eerst en sttek mee in parameter
        
        $getUserStatement = $this->connect()->prepare('SELECT * FROM users WHERE session_id = :sessionId');
        $getUserStatement->bindParam(':sessionId', $_SESSION['sessionId']);
        $getUserStatement->setFetchMode(PDO::FETCH_ASSOC);
        $getUserStatement->execute();
    
        $user = $getUserStatement->fetch();
    
        //
    
        $res = $this->connect()->prepare('DELETE FROM likes WHERE user_id = :userId AND post_id = :postId');
        $res->bindParam(':userId', $user['id']);
        $res->bindParam(':postId', $postId);
        $res->setFetchMode(PDO::FETCH_ASSOC);
        $res->execute();
    }
}
?>