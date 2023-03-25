<?php

declare(strict_types=1);

include '../helpers/database.php';
include '../helpers/functions.php';

$sessionExist = checkSessionExists($db);
$posts = getAllPostsFromUser($db);
?>
<?php include "./components/head.php"?>

    <?php include "./components/nav.php"?>

    <?php if($sessionExist===true) : ?>
        <a href="./add-post.php"><button>Add post</button></a>
    <?php endif; ?>

    <!--recent posts (6)-->
    <?php include "./components/display-posts-teaser.php"?>

<?php include "./components/footer.php" ?>
