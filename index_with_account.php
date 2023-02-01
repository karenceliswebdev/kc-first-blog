<?php

declare(strict_types=1);


//doel 1 hoop blogposts maken en deze weergeven op homepage

include './database.php';
include './functions.php';

$posts = getPost($db);

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
        <li><a href="./own_posts.php">your posts</a></li>
        <li><a href="./liked_posts.php">liked posts</a></li>
        <li><a href="./login.php">log out</a></li>
    </ul>

    <h1>Recent posts</h1>

    <!--recent posts (6)-->
    <div class="recentPosts">
        <?php if(!(count($posts) === 0)) : ?>
            <?php foreach($posts as $posts) : ?>
                <h2><?= $posts['title']; ?></h2>
                <img src="./pictures/pic_default.png" alt="">
                <p><?= readMore($posts['body']); ?></p>

                <form action="./blog_detail.php" method="post">
                    <input type="hidden" name="postId" value="<?= $posts['id']; ?>"/>
                    <button>Read More</button>
                </form>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

</body>
</html>
