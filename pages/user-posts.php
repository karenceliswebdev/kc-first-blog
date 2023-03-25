<?php

declare(strict_types=1);

include '../helpers/database.php';
include '../helpers/functions.php';

$sessionExist = checkSessionExists($db);

if($sessionExist==false) {
    header('Location: ./login.php');
    die;
}

$posts = getAllPostsFromUser($db);
?>
<?php include "./components/head.php"?>

    <?php include "./components/nav.php"?>

    <a href="./add-post.php"><button>Add post</button></a>

    <!--recent posts (6)-->
    <?php include "./components/display-posts-teaser.php"?>

<?php include "./components/footer.php" ?>
