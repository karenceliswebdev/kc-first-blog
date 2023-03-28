<?php
declare(strict_types=1);

include '../Models/User.php';
include '../Models/Post.php';
include '../helpers/functions.php'; 

use Models\User;
use Models\Post;

$user = new User(); 
$post = new Post();
$posts = $post->get();

?>
<?php include "./components/head.php"?>

    <?php include "./components/nav.php"?>

    <?php include "./components/feedback.php"?>

    <h1>Recent posts</h1>

    <?php include "./components/display-posts-teaser.php"?>

<?php include "./components/footer.php"?>
