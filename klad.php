<?php

session_start();

$db = connectDb('root','','first_blog_kc');

$sessionExist = checkSessionExists($db);


function checkSessionExists(PDO $db): bool {

    $res = $db->prepare('SELECT * FROM users WHERE session_id = :sessionId');
    $res->bindParam(':sessionId', $_COOKIE['auth']);
    $res->setFetchMode(PDO::FETCH_ASSOC);
    $res->execute();
    $user = $res->fetch();

    if($user) {
        return true;
        die;
    }

    return false;
}

if($_SERVER['REQUEST_METHOD'] === 'POST') {

    if(empty($_POST['title'])) {

        //gaat die nog weten welke post ik edit
        header('Location: ./klad.php');
        die;
    }

    if(empty($_POST['body'])) {
        
        header('Location: ./klad.php');
        die;
    }
    
    //voeg post toe

    addNewPost($db, $_POST['title'], $_POST['body']);

    //Redirect to page met gebruiker naam in hoek
    
    header('Location: ./pages/user_posts.php');

}

function connectDb(string $user, string $pass, string $db, string $host = 'localhost'): PDO {
   
    try {
        
        $connection = new PDO("mysql:host={$host};dbname={$db}", $user, $pass);
        return $connection;

    } 
    catch (Exception $exception) {
        
        echo $exception->getMessage();
    }
}

function getUser(PDO $db): array {

    $res = $db->prepare('SELECT * FROM users WHERE session_id = :sessionId');
    $res->bindParam(':sessionId', $_COOKIE['auth']);
    $res->setFetchMode(PDO::FETCH_ASSOC);
    $res->execute();

    return $user = $res->fetch();    
}

?>

<?php include "./templates/nav.php" ?>
    
    <h1>Add new post</h1>

    <!--new post-->
    <form method="post" action="./actions/add_post_action.php">
        <div class="newPost">
            <label for="title">Title:</label><br>
            <input type="text" name ="title" id="title"></input><br>
            
            <img src="./pictures/pic_default.png" alt=""><br>
            
            <label for="body">Content:</label><br>
            <textarea name="body" id="body" rows="50" cols="100"></textarea><br>

            <button>save</button> 
        </div>
    </form>
    
    <a href="./pages/user_posts.php"><button>cancel</button></a>   

<?php include "./templates/footer.php" ?>

