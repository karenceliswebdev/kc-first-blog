<?php

include_once('../Models/DB.php');

class Post extends Models\DB {

    private int $id;
    private string $userId;
    private string $title;
    private string $body;
    
    public function __construct(int $id = null) {

        if(!empty($id)) {

            $this->find($id);
        }
    }

}