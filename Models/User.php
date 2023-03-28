<?php
include_once '../Models/DB.php';

session_start();

class User {

    private int $id;
    private string $email;
    private string $hash;
    private string $sessionId;

    private string $password;

    public function __construct(int $id = null) {

        if(!empty($id)) {

            $this->find($id);
        }

    }

    public function find(int $id): User {  
    
        $res = DB::connect()->prepare('SELECT * FROM users WHERE id = :id');
        $res->bindParam('id', $id);
        $res->execute();

        $user = $res->fetchObject('User');//steek het erin als object

        if(!empty($user))
        {
            $this->id = $user->id;
            $this->email = $user->email;
            $this->hash = $user->hash;
            $this->sessionId= $user->session_id;
        }

        return $this;
    }

    public function findSession(): User {  //

        $res = DB::connect()->prepare('SELECT * FROM users WHERE session_id = :sessionId');
        $res->bindParam(':sessionId', $_SESSION['sessionId']);
        $res->execute();

        $user = $res->fetchObject('User');

        if(!empty($user))
        {
            $this->id = $user->id;
            $this->email = $user->email;
            $this->hash = $user->hash;
            $this->sessionId= $user->session_id;
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
        $res = DB::connect()->prepare('INSERT INTO users SET email = :email, hash = :hash');
        $res->bindParam(':email', $this->email);
        $res->bindParam(':hash', $this->hash);
        $res->execute();

        $this->id = DB::connect()->lastInsertId(); 

        return $this->id; //heeft dit eig nut dit stuk zonder this in checkemail werkt het ni
    }

    function update(): int  {

        if(empty($this->id)) {

            throw new \Excemption('No user found');
        }

        $_SESSION['sessionId'] = uniqid(); 
        $this->sessionId =  $_SESSION['sessionId'];

        $res = DB::connect()->prepare('UPDATE users SET email = :email, hash = :hash, session_id = :sessionId WHERE id = :id');
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

        $hash = password_hash($this->password, PASSWORD_DEFAULT);//
        $this->hash = $hash;
    }

    function checkEmailExist(): bool {
        
        $res = DB::connect()->prepare('SELECT * FROM users WHERE email = :email');
        $res->bindParam(':email', $this->email); //of $this er nog voor?
        $res->setFetchMode(PDO::FETCH_ASSOC);
        $res->execute();
    
        $user = $res->fetchObject('User'); //verandert ervoor Models/User

        //anders kreeg ik steeds: error moet een array zijn maar krijg bool terug;
        if($user) {

            $this->id = $user->id;//belangrijk voor login
            return true;
            die;
        }
    
        return false;
    }

    function checkPasswordCorrect(): bool {
    
        $res = DB::connect()->prepare('SELECT * FROM users WHERE email = :email');
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

    function checkLikePost(int $postId): bool {

        if(empty($_SESSION['sessionId'])) {
            return false;
            die;
        }

        $res = DB::connect()->prepare('SELECT * FROM likes WHERE user_id = :userId AND post_id = :postId');
        $res->bindParam(':userId', $this->id);
        $res->bindParam(':postId', $postId);
        $res->setFetchMode(PDO::FETCH_ASSOC);
        $res->execute();

        $likes = $res->fetch();

        if(!empty($likes)) {

            return true;
            die;
        }
    
        return false;
    } 
    
    public function getId(): int{

        return $this->id;
    }

}