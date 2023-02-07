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

    $num = ($_POST['postId']);
    
    //postId doorgekregen na tik readmore button
    $post = getPostDetailPage($db, (int)$num);

    //nu even checken sessie id uit cookie en naam user slaan we op en vergelijken met naam user postid van readmore
    $user = getUser($db);

    //dan aanpassingen updaten
}


//doel 1 hoop blogposts maken en deze weergeven op homepage

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
</head>
<body>


   <!--nav-->
   <ul>
        <li><a href="./user_posts.php">your posts</a></li>
        <li><a href="./liked_posts.php">liked posts</a></li>
        <li><a href="./login.php">log out</a></li>
    </ul>

    <!--edit possibility-->
    <?php if($post['user_id']===$user['id']) : ?>
        <form action="./edit_post.php" method="post">
            <input type="hidden" name="postId" value="<?= $post['id']; ?>"/>
            <button>Edit</button>
        </form>
    <?php endif; ?>

    <!--post-->
    <div class="post">
        <h2><?= $post['title']; ?></h2>
        <img src="./pictures/pic_default.png" alt="">
        <p><?= $post['body']; ?></p>     
    </div>

    <!--like-->
        <form action="./functions.php" method="post">
            <input type="hidden" name="postId" value="<?= $post['id']; ?>"/>
            <button style="height:50px; width:50px;">
                <img src = "<?= empty($like['user_id']) ? './pictures/heart-empty.svg' : './pictures/heart-full.svg'; ?>" alt="heart">            
            </button>
        </form>

</body>
</html>
