<?php

declare(strict_types=1);


//doel 1 hoop blogposts maken en deze weergeven op homepage

include './database.php';
include './functions.php';

//all auth cookie gemaakt?

//checken sessie nog geldig anders redirect to login page
checkSessionStillExists($db);

$posts = getAllPostsFromUser($db);

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
        <li><a href="./login.php">log in</a></li>
    </ul>

    <a href="./add_post.php"><button>Add post</button></a>

    <!--recent posts (6)-->
    <div class="allUserPosts">
        <?php if(!(count($posts) === 0)) : ?>
            <?php foreach($posts as $posts) : ?>
                <h2><?= $posts['title']; ?></h2>
                <img src="./pictures/pic_default.png" alt="">
                <p><?= readMore($posts['body']); ?></p>

                <form action="./blog_detail_with_account.php" method="post">
                    <input type="hidden" name="postId" value="<?= $posts['id']; ?>"/>
                    <button>Read More</button>
                </form>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

</body>
</html>
