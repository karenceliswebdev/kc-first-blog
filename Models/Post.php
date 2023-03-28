<?php

Namespace Models;
use PDO;
use Models\DB;

class Post {

    private int $id;
    private int $userId; 
    private string $title;
    private string $body;

    public function __construct(int $id = null) {

        if(!empty($id)) {

            $this->find($id);
        }
    }

    public function find(int $id): Post {  
    
        $res = DB::connect()->prepare('SELECT * FROM posts WHERE id = :id');
        $res->bindParam('id', $id);
        $res->execute();

        $post = $res->fetchObject('Models\Post');

        if(!empty($post))
        {
            $this->id = $post->id;
            $this->userId = $post->user_id;
            $this->title = $post->title;
            $this->body = $post->body;
        }

        return $this;
    }

    public function save(): int { 

        if(!empty($this->id)) {

            return $this->update();
        }

        return $this->add();
    }

    private function add(): int
    {
        $now = date('Y-m-d H:i:s');

        //nog checken ik wel owner van post

        $res = DB::connect()->prepare('INSERT INTO posts SET user_id = :userId, title = :title, body = :body, created_at= :now');
        $res->bindParam(':userId', $this->userId);
        $res->bindParam(':title', $this->title);
        $res->bindParam(':body', $this->body);
        $res->bindParam(':now', $now);
        $res->execute();

        $this->id = DB::connect()->lastInsertId(); 

        return $this->id;
    }

    function update(): int  {

        if(empty($this->id)) {

            throw new \Excemption('No post found');
        }

        $now = date('Y-m-d H:i:s');

        $res = DB::connect()->prepare('UPDATE posts SET title = :title, body = :body, updated_at = :now WHERE id = :id');
        $res->bindParam(':title', $this->title);
        $res->bindParam(':body', $this->body);
        $res->bindParam(':now', $now);
        $res->bindParam(':id', $this->id);
        $res->execute();

        return $this->id;
    }

    function setUser(int $userId): void {
        
        $this->userId = $userId;
    }

    function setTitle(string $title): void {
        
        $title = htmlspecialchars($title, ENT_QUOTES, 'UTF-8');
        $this->title = $title;
    }

    function setBody(string $body): void {
        
        $body = htmlspecialchars($body, ENT_QUOTES, 'UTF-8');
        $this->body = $body;
    }

    public function get(): array
    {
        $res = DB::connect()->query('SELECT * FROM posts WHERE deleted_at IS NULL ORDER BY created_at DESC;');
        return $res->fetchAll(PDO::FETCH_CLASS, "Models\Post");
    }

    public function getPostsUser(int $userId): array {

        $res = DB::connect()->prepare('SELECT * FROM posts WHERE deleted_at IS NULL AND user_id = :userId ORDER BY created_at DESC;');
        $res->bindParam(':userId', $userId);
        $res->execute();
        return $res->fetchAll(PDO::FETCH_CLASS, "Models\Post"); 
    }

    public function getId(): int {

        return $this->id;
    }

    public function getUserId(): int {

        return $this->userId;
    }

    public function getTitle(): string {

        return $this->title;
    }

    public function getBody(): string {

        return $this->body;
    }

    public function findLikes(): int {
        
        $res = DB::connect()->prepare('SELECT id FROM likes WHERE post_id = :postId');
        $res->bindParam(':postId', $this->id);
        $res->setFetchMode(PDO::FETCH_ASSOC);
        $res->execute();
        $count = $res->fetchAll();
    
        return count($count);
    }

    function addLike(int $userId): void {
    
        $res = DB::connect()->prepare('INSERT INTO likes SET user_id = :userId, post_id = :postId');
        $res->bindParam(':userId', $userId);
        $res->bindParam(':postId', $this->id);
        $res->setFetchMode(PDO::FETCH_ASSOC);
        $res->execute();
    
    }

    public function deleteLike(int $userId): void {
        
        $res = DB::connect()->prepare('DELETE FROM likes WHERE user_id = :userId AND post_id = :postId');
        $res->bindParam(':userId', $userId);
        $res->bindParam(':postId', $this->id);
        $res->setFetchMode(PDO::FETCH_ASSOC);
        $res->execute();
    }
}