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

    public function get(): array
    {
        $res = $this->connect()->query('SELECT * FROM posts WHERE deleted_at IS NULL ORDER BY created_at DESC;');
        return $res->fetchAll(PDO::FETCH_CLASS, "Post"); //uitzoeken
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

        $res = $this->connect()->prepare('INSERT INTO posts SET user_id = :id, title = :title, body = :body, created_at= :now');
        $res->bindParam(':userd', $this->userId);
        $res->bindParam(':title', $this->title);
        $res->bindParam(':body', $this->body);
        $res->bindParam(':now', $now);
        $res->execute();

        $this->id = $this->connect()->lastInsertId(); 

        return $this->id;
    }

    function update(): int  {

        if(empty($this->id)) {

            throw new \Excemption('No post found');
        }

        $now = date('Y-m-d H:i:s');

        $res = $this->connect()->prepare('UPDATE posts SET title = :title, body = :body, updated_at = :now WHERE id = :id');
        $res->bindParam(':title', $this->title);
        $res->bindParam(':body', $this->body);
        $res->bindParam(':now', $now);
        $res->bindParam(':id', $this->id);
        $res->execute();

        return $this->id;
    }



}