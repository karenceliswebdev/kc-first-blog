<?php

declare(strict_types=1);

include '../helpers/functions.php';
include '../Models/User.php';
include '../Models/Post.php';

use Models\User;
use Models\Post;

if(empty($_SESSION['sessionId'])) {
    header('Location: ./login.php');
    die;
} 

$user = new User();
$user->findSession();

$post = new Post();
$all = $post->get();
$posts = [];

foreach($all as $nr => $one) {

    if($user->checkLikePost($one->getId())) {
        array_push($posts, $one);
    }
}
?>
<?php include "./components/head.php"?>
    
    <?php include "./components/nav.php"?>

    <h1>Liked posts</h1>

    <?php include "./components/display-posts-teaser.php"?>

<?php include "./components/footer.php"?>
