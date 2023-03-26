<?php

include_once('../Models/DB.php');

class Post extends Models\DB {

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
    
        $res = $this->connect()->prepare('SELECT * FROM posts WHERE id = :id');
        $res->bindParam('id', $id);
        $res->execute();

        $post = $res->fetchObject('Post');

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

        $res = $this->connect()->prepare('INSERT INTO posts SET user_id = :id, title = :title, body = :body, created_at= :now');
        $addPostStatement->bindParam(':userd', $this->userId);
        $addPostStatement->bindParam(':title', $this->title);
        $addPostStatement->bindParam(':body', $this->body);
        $addPostStatement->bindParam(':now', $now);
        $addPostStatement->execute();

        $this->id = $this->connect()->lastInsertId(); 

        return $this->id;
    }



}