<?php

declare(strict_types=1);

//doel 1 hoop blogposts maken en deze weergeven op homepage

include '../helpers/database.php';
include '../helpers/functions.php';

//checken sessie nog geldig anders redirect to login page
$sessionExist = checkSessionExists();

?>
<?php include "../templates/nav.php"?>

    <h1>Add new post</h1>

    <?php if(!empty($_SESSION['feedback'])) : ?>
        <p><?=$_SESSION['feedback']; ?></p>
        <?php unset($_SESSION['feedback']); ?>
    <?php endif; ?>
    
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