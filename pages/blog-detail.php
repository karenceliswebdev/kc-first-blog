<?php

declare(strict_types=1);

include '../Models/User.php';
include '../Models/Post.php';

use Models\User;
use Models\Post;

if($_SERVER['REQUEST_METHOD'] === 'POST') {

    $post = new Post((int)$_POST['postId']);
}

$user = new User();

?>
<?php include "./components/head.php"?>
    
    <?php include "./components/nav.php"?>

    <?php include "./components/feedback.php"?>

    <?php if(isset($_SESSION['sessionId'])) : ?>
        <?php if($post->getUserId()===$user->getId()) : ?>
            <!--edit possibility-->
            <form action="./edit-post.php" method="post">
                <input type="hidden" name="postId" value="<?= $post->getId(); ?>"/>
                <button>Edit</button>
            </form>
            <!--delete possibility-->
            <form action="../actions/delete-post-action.php" method="post">
                <input type="hidden" name="postId" value="<?= $post->getId(); ?>"/>
                <button>Delete</button>
            </form>
        <?php endif; ?>
    <?php endif; ?>

    <!--post-->
    <div class="post" style="width: 50%; word-wrap: break-word;">
        <h2><?= $post->getTitle(); ?></h2>
        <img src="../pictures/pic-default.png" alt="">
        <p><?= $post->getBody(); ?></p>     
    </div>

    <!--like possibility-->
    <form action="../actions/like-action.php" method="post">
        <input type="hidden" name="postId" value="<?= $post->getId(); ?>"/>
        <button style="height:50px; width:50px;">
            <img src="<?= $user->checkLikePost($post->getId()) ? '../pictures/heart-full.svg' : '../pictures/heart-empty.svg'; ?>" alt="heart">            
        </button>
    </form>
    
    <p><?= $post->findLikes(); ?></p>

    <?php include "./components/feedback.php"?>

<?php include "./components/footer.php"?>
