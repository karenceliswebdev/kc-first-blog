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



}