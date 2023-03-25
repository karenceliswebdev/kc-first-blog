<ul>
    <?php if($sessionExist===false) : ?>
        <li><a href="./index.php">recent posts</a></li>
        <li><a href="./login.php">log in</a></li>
    <?php endif;?>

    <?php if($sessionExist===true) : ?>
        <li><a href="./index.php">recent posts</a></li>
        <li><a href="./user-posts.php">your posts</a></li>
        <li><a href="./liked-posts.php">liked posts</a></li>
        <li><a href="../actions/logout-action.php">log out</a></li>
    <?php endif;?>
</ul>