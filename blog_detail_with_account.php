<?php

declare(strict_types=1);

include './database.php';
include './functions.php';

//checken sessie nog geldig anders redirect to login page
checkSessionStillExists($db);

if($_SERVER['REQUEST_METHOD'] === 'POST') {

    $num = ($_POST['postId']);
    
    $post = getPostDetailPage($db, (int)$num);
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
    <form action="./edit_user_post.php" method="post">
        <input type="hidden" name="postId" value="<?= $posts['id']; ?>"/>
        <button>Edit</button>
    </form>

    <!--post-->
    <div class="post">
        <h2><?= $post['title']; ?></h2>
        <img src="./pictures/pic_default.png" alt="">
        <p><?= $post['body']; ?></p>     
    </div>

</body>
</html>
