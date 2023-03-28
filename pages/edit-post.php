<?php

declare(strict_types=1);

include '../Models/User.php';
include '../Models/Post.php';

use Models\User;
use Models\Post;

if(empty($_SESSION['sessionId'])) {
    header('Location: ./login.php');
    die;
} 

if($_SERVER['REQUEST_METHOD'] === 'POST') {

    if(empty($_POST['postId'])) {
        header('Location: ./blog-detail.php');
        die;
    }
}

$post = new Post((int)$_SESSION['postId']);
$user = new User();
?>
<?php include "./components/head.php"?>

    <?php include "./components/nav.php"?>

    <h1>Edit post</h1>

    <?php include "./components/feedback.php"?>

     <!--edit post-->
    <form method="post" action="../actions/edit-post-action.php">
        <div class="newPost">
            <label for="title">Title:</label><br>
            <input type="text" name ="title" id="title" value="<?= $post['title'];?>"/><br>
            <img src="../pictures/pic-default.png" alt=""><br>
            <label for="body">Content:</label><br>
            <textarea name="body" id="body" rows="50" cols="100"><?= $post['body'];?></textarea><br>
            <input type="hidden" name="postId" value="<?= $post['id']; ?>"/>
            <button>save</button> 
        </div>
    </form>
    
    <form action="./blog-detail.php" method="post">
        <input type="hidden" name="postId" value="<?= $post['id']; ?>"/>
        <button>cancel</button>
    </form>

<?php include "./components/footer.php"?>
