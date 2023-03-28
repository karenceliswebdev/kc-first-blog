<?php

declare(strict_types=1);

include '../helpers/functions.php';
include '../Models/User.php';
include '../Models/Post.php';

if(empty($_SESSION['sessionId'])) {
    header('Location: ./login.php');
    die;
}

$user = new User();
$user->findSession();

$post = new Post();
$posts = $post->getPostsUser($user->getId());

?>
<?php include "./components/head.php"?>

    <?php include "./components/nav.php"?>

    <h1>Your posts</h1>

    <?php include "./components/feedback.php"?>

    <a href="./add-post.php"><button>Add post</button></a>

    <!--recent posts (6)-->
    <?php include "./components/display-posts-teaser.php"?>

<?php include "./components/footer.php" ?>
