<?php

include_once('../Models/DB.php');

class User extends Models\DB {

    private int $id;
    private string $email;
    private string $hash;
    private string $sessionId;

    private string $password;

    public function __construct(int $id = null) {

        //$this->sessionId = $_SESSION['sessionId'];

        if(!empty($id)) {

            $this->find($id);
        }
    }

    public function find(int $id): User {  
    
        $res = $this->connect()->prepare('SELECT * FROM users WHERE id = :id');
        $res->bindParam('id', $id);
        $res->execute();

        $user = $res->fetchObject('User');//steek het erin als object

        if(!empty($user))
        {
            $this->id = $user->id;
            $this->email = $user->email;
            $this->hash = $user->hash;
            $this->sessionId= $user->session_id;//dan _ of sessionId
        }

        return $this;
    }
    
    public function save(): int { //id teruggeven van die save

        //heeft object id update, geen id ne nieuwe
        if(!empty($this->id)) {

            return $this->update();
        }

        return $this->add();
    }

    private function add(): int
    {
        //bij login sessie aangemaakt
        $res = $this->connect()->prepare('INSERT INTO users SET email = :email, hash = :hash');
        $res->bindParam(':email', $this->email);
        $res->bindParam(':hash', $this->hash);
        $res->execute();

        $this->id = $this->connect()->lastInsertId(); //checken connect of $this connect

        return $this->id;
    }

    function update(): int  {

        if(empty($this->id)) {

            throw new \Excemption('No user found');
        }

        $userSessionId = uniqid();
        $_SESSION['sessionId'] = $userSessionId; 
        $this->sessionId =  $_SESSION['sessionId'];

        $res = $this->connect()->prepare('UPDATE users SET email = :email, hash = :hash, session_id = :sessionId WHERE id = :id');
        $res->bindParam(':email', $this->email);
        $res->bindParam(':hash', $this->hash);
        $res->bindParam(':sessionId', $this->sessionId);
        $res->bindParam(':id', $this->id);
        $res->execute();

        return $this->id;
    }

    //sign up en login

    function setEmail(string $email): void {
        
        $email = htmlspecialchars($email, ENT_QUOTES, 'UTF-8');
        $this->email = $email;
    }

    function setPassword(string $password): void { //misschien in 1 steken
        
        $password = htmlspecialchars($password, ENT_QUOTES, 'UTF-8');
        $this->password = $password;
    }

    function checkEmailExist(): bool {

        $res = $this->connect()->prepare('SELECT * FROM users WHERE email = :email');
        $res->bindParam(':email', $this->email); 
        $res->setFetchMode(PDO::FETCH_ASSOC);
        $res->execute();
    
        $user = $res->fetch();

        if($user) {

            return true;
            die;
        }
    
        return false;
    }

    function checkPasswordCorrect(): bool {
    
        $res = $this->connect()->prepare('SELECT * FROM users WHERE email = :email');
        $res->bindParam(':email', $this->email);
        $res->setFetchMode(PDO::FETCH_ASSOC);
        $res->execute();
    
        $user = $res->fetchObject('User');
    
        if(!password_verify($this->password, $user->hash)) {
            
            return false;
            die;
        }

        return true;
    }
}