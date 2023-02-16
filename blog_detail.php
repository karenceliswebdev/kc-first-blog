<?php

declare(strict_types=1);

include './database.php';
include './functions.php';

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    //werken met sessies anders als je terug redirect van action weet ni meer welke postid ah ja geen post dan gebeurt
    $_SESSION['postId'] = $_POST['postId'];
}

$post = getPostDetailPage($db, (int)$_SESSION['postId']);
$sessionExist = checkSessionExists($db);

if($sessionExist===false) {
    $user = [''];
    $userLikedPost = false;
}

if($sessionExist===true) {
    $user = getUser($db);
    $userLikedPost = checkUserLikedPost($db, (int)$_SESSION['postId']);
}

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
        <?php if($sessionExist===false) : ?>
            <li><a href="./login.php">log in</a></li>
        <?php endif; ?>

        <?php if($sessionExist===true) : ?>
            <li><a href="./user_posts.php">your posts</a></li>
            <li><a href="./liked_posts.php">liked posts</a></li>
            <li><a href="./login.php">log out</a></li>
        <?php endif; ?>
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

    <!--like mss iets doen like tikt zonder user alert login/regi-->
    <form action="./like_action.php" method="post">
        <input type="hidden" name="postId" value="<?= $post['id']; ?>"/>
        <button style="height:50px; width:50px;">
            <img src = "<?= $userLikedPost ? './pictures/heart-full.svg' : './pictures/heart-empty.svg'; ?>" alt="heart">            
        </button>
    </form>

</body>
</html>
