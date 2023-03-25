<?php

declare(strict_types=1);

include '../helpers/database.php';
include '../helpers/functions.php';

$sessionExist = checkSessionExists($db);

if($sessionExist==false) {
    header('Location: ./login.php');
    die;
}

$posts = getAllLikedPostsFromUser($db);

?>
<?php include "./components/head.php"?>
    
    <?php include "./components/nav.php"?>

    <h1>Liked posts</h1>

    <!--recent posts (6)-->
    
    <?php include "./components/display-posts-teaser.php"?>

<?php include "./components/footer.php"?>
