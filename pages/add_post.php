<?php

declare(strict_types=1);

//doel 1 hoop blogposts maken en deze weergeven op homepage

include '../Models/DB.php';
include '../Models/Post.php';
include '../Models/User.php';
include '../Controller/UserController.php';
include '../Controller/PostController.php';

$newUserController = new UserController();
$sessionExist = $newUserController->checkSession();

?>
<?php include "../templates/nav.php"?>

    <h1>Add new post</h1>

    <?php include "../templates/feedback.php"?>
    
    <!--new post-->
    <form method="post" action="../actions/add_post_action.php">
        <div class="newPost">
            <label for="title">Title:</label><br>
            <input type="text" name ="title" id="title"></input><br>
            
            <img src="../pictures/pic_default.png" alt=""><br>
            
            <label for="body">Content:</label><br>
            <textarea name="body" id="body" rows="50" cols="100"></textarea><br>

            <button>save</button> 
        </div>
    </form>
    
    <a href="./user_posts.php"><button>cancel</button></a>   
    
<?php include "../templates/footer.php"?>