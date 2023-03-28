<?php

declare(strict_types=1);

include '../Models/User.php';
include '../Models/Post.php';

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    if(empty($_POST['postId'])) {
        $_SESSION['feedback'] = 'no post selected';//
        header('Location: ./index.php');
        die;
    }
    $_SESSION['postId'] = $_POST['postId'];//
}

$post = new Post((int)$_SESSION['postId']);
$user = new User();
$user->findSession();

?>
<?php include "./components/head.php"?>
    
    <?php include "./components/nav.php"?>

    <?php if(!empty($_SESSION['sessionId'])) : ?>
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
