<?php

namespace Models;

include_once('./DB.php');

class User extends DB {

    private int $id;
    private string $email;
    private string $hash;
    private string $sessionId;
   
}