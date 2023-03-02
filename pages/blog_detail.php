<?php

declare(strict_types=1);

include '../Models/DB.php';
include '../Models/Post.php';
include '../Models/User.php';
include '../Controller/UserController.php';
include '../Controller/PostController.php';

include '../helpers/functions.php';

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    //werken met sessies anders als je terug redirect van action weet ni meer welke postid ah ja geen post dan gebeurt
    $_SESSION['postId'] = $_POST['postId'];
}

$newUserController = new UserController();
$sessionExist = $newUserController->checkSession();

$newPostController = new PostController();
$post = $newPostController->getDetails((int)$_SESSION['postId']); 

if($sessionExist===false) {
    $userLikedPost = false;
}

if($sessionExist===true) {
    $user = $newUserController->get();
    $userLikedPost = $newUserController->checkLikedPost((int)$_SESSION['postId']);
}
?>
<?php include "../templates/nav.php"?>

    <!--edit possibility-->
    <?php if($sessionExist===true) : ?>
        <?php if($post['user_id']===$user['id']) : ?>
            <form action="./edit_post.php" method="post">
                <input type="hidden" name="postId" value="<?= $post['id']; ?>"/>
                <button>Edit</button>
            </form>
        <?php endif; ?>
    <?php endif; ?>

    <!--delete possibility-->
    <?php if($sessionExist===true) : ?>
        <?php if($post['user_id']===$user['id']) : ?>
            <form action="../actions/delete_post_action.php" method="post">
                <input type="hidden" name="postId" value="<?= $post['id']; ?>"/>
                <button>Delete</button>
            </form>
        <?php endif; ?>
    <?php endif; ?>

    <!--post-->
    <div class="post">
        <h2><?= $post['title']; ?></h2>
        <img src="../pictures/pic_default.png" alt="">
        <p><?= $post['body']; ?></p>     
    </div>

    <!--like possibility-->
    <form action="../actions/like_action.php" method="post">
        <input type="hidden" name="postId" value="<?= $post['id']; ?>"/>
        <button style="height:50px; width:50px;">
            <img src="<?= $userLikedPost ? '../pictures/heart-full.svg' : '../pictures/heart-empty.svg'; ?>" alt="heart">            
        </button>
    </form>

    <p><?= $newPostController->showLikes((int)$_SESSION['postId']); ?></p>

    <?php include "../templates/feedback.php"?>

<?php include "../templates/footer.php"?>
