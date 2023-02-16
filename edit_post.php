<?php

declare(strict_types=1);

include './database.php';

//checken sessie nog geldig anders redirect to login page
$sessionExist = checkSessionExists($db);

if($_SERVER['REQUEST_METHOD'] === 'POST') {

    if(empty($_POST['postId'])) {
        
        header('Location: ./blog_detail.php');
        die;
    }

    //postID nodig voor te zien welke post we moeten aanpassen
    $_SESSION['postId'] = $_POST['postId'];
}

$post = getPostDetailPage($db, (int)$_SESSION['postId']);

//ge gaat array ophalen in vb steken van post rij en dan array[titel], pic en content in inputvelden steken 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <!--nav-->
    <ul>
        <?php if($sessionExist===false) : ?>
            <li><a href="./login.php">log in</a></li>
        <?php endif; ?>

        <?php if($sessionExist===true) : ?>
            <li><a href="./user_posts.php">your posts</a></li>
            <li><a href="./liked_posts.php">liked posts</a></li>
            <li><a href="./login.php">log out</a></li>
        <?php endif; ?>
    </ul>

    <form method="post" action="./edit_post_action.php">
        <div class="newPost">
            <label for="title">Title:</label><br>
            <input type="text" name ="title" id="title" value="<?= $post['title'];?>"/><br>
            
            <img src="./pictures/pic_default.png" alt=""><br>
            
            <label for="body">Content:</label><br>
            <textarea name="body" id="body" rows="50" cols="100"><?= $post['body'];?></textarea><br>

            <input type="hidden" name="postId" value="<?= $post['id']; ?>"/>
            
            <button>save</button> 
        </div>
    </form>
    
    <form action="./blog_detail.php" method="post">
        <input type="hidden" name="postId" value="<?= $post['id']; ?>"/>
        <button>cancel</button>
    </form>

</body>
</html>
