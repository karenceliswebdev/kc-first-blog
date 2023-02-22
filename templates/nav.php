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
            <li><a href="./index.php">recent posts</a></li>
            <li><a href="./login.php">log in</a></li>
        <?php endif;?>

        <?php if($sessionExist===true) : ?>
            <li><a href="./index.php">recent posts</a></li>
            <li><a href="./user_posts.php">your posts</a></li>
            <li><a href="./liked_posts.php">liked posts</a></li>
            <li><a href="../actions/logout_action.php">log out</a></li>
        <?php endif;?>
    </ul>