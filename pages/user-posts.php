<?php

declare(strict_types=1);

include '../helpers/functions.php';
include '../Models/User.php';

use Models\User;

if(empty($_SESSION['sessionId'])) {
    header('Location: ./login.php');
    die;
}

$user = new User();
$user->findSession();

$posts = $user->getPosts();

?>
<?php include "./components/head.php"?>

    <?php include "./components/nav.php"?>

    <?php include "./components/feedback.php"?>

    <a href="./add-post.php"><button>Add post</button></a>

    <!--recent posts (6)-->
    <?php include "./components/display-posts-teaser.php"?>

<?php include "./components/footer.php" ?>
