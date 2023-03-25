<?php
declare(strict_types=1);

//doel 1 hoop blogposts maken en deze weergeven op homepage
include '../helpers/database.php';
include '../helpers/functions.php';

//checken sessie nog geldig anders redirect to login page
$sessionExist = checkSessionExists($db);

if($sessionExist===false) {
    header('Location: ./login.php');
    die;
}

?>
<?php include "./components/head.php"?>

    <?php include "./components/nav.php"?>

    <h1>Add new post</h1>

    <?php include "./components/feedback.php"?>
    
    <!--new post-->
    <form method="post" action="../actions/add-post-action.php">
        <div class="newPost">
            <label for="title">Title:</label><br>
            <input type="text" name ="title" id="title"></input><br>
            <img src="../pictures/pic-default.png" alt=""><br>
            <label for="body">Content:</label><br>
            <textarea name="body" id="body" rows="50" cols="100"></textarea><br>
            <button>save</button> 
        </div>
    </form>
    
    <a href="./user-posts.php"><button>cancel</button></a> 
      
<?php include "./components/footer.php"?>