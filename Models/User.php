<?php

namespace Models;

include_once('./DB.php');

class User extends DB {

    private int $id;
    private string $email;
    private string $hash;
    private string $sessionId;

    public function __construct(int $id = null) {

        $this->sessionId = $_SESSION['sessionId'];

        if(!empty($id)) {

            $this->find($id);
        }
    }

    public function find(int $id): User {  
    
        $res = $conn->prepare('SELECT * FROM users WHERE id = :id');
        $res->bindParam('id', $id);
        $res->execute();

        $user = $res->fetchObject('Models\User');//steek het erin als object

        if(!empty($user))
        {
            $this->id = $user->id;
            $this->email = $user->email;
            $this->hash = $user->hash;
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
}