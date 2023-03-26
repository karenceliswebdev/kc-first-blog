<?php

include_once('../Models/DB.php');

class Post extends Models\DB {

    private int $id;
    private int $userId; 
    private string $title;
    private string $body;
    
    

}