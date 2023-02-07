<?php

declare(strict_types=1);

include './database.php';

//checken sessie nog geldig anders redirect to login page
$user = checkSessionExists($db);

if($user===false) {

    header('Location: ./login.php');
    die;

}

if($_SERVER['REQUEST_METHOD'] === 'POST') {

    if(empty($_POST['postId'])) {
        
        header('Location: ./add_post.php');
        die;
    }

    //postID nodig voor te zien welke post we moeten aanpassen
    $num = ($_POST['postId']);

    $post = getPostDetailPage($db, (int)$num);
 
}

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
    
    <form action="./blog_detail_with_account.php" method="post">
        <input type="hidden" name="postId" value="<?= $post['id']; ?>"/>
        <button>cancel</button>
    </form>

</body>
</html>
