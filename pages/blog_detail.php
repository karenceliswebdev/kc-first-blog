<?php

declare(strict_types=1);

include '../helpers/database.php';
include '../helpers/functions.php';

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    //werken met sessies anders als je terug redirect van action weet ni meer welke postid ah ja geen post dan gebeurt
    $_SESSION['postId'] = $_POST['postId'];
}

$post = getPostDetailPage($db, (int)$_SESSION['postId']);
$sessionExist = checkSessionExists($db);

if($sessionExist===false) {
    $userLikedPost = false;
}

if($sessionExist===true) {
    $user = getUser($db);
    $userLikedPost = checkUserLikedPost($db, (int)$_SESSION['postId']);
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
            <form action="./delete_post_action.php" method="post">
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

    <!--like mss iets doen like tikt zonder user alert login/regi-->
    <form action="../actions/like_action.php" method="post">
        <input type="hidden" name="postId" value="<?= $post['id']; ?>"/>
        <button style="height:50px; width:50px;">
            <img src = "<?= $userLikedPost ? '../pictures/heart-full.svg' : '../pictures/heart-empty.svg'; ?>" alt="heart">            
        </button>
    </form>

    <?php if(!empty($_SESSION['feedback'])) : ?>
        <p><?=$_SESSION['feedback']; ?></p>
        <?php unset($_SESSION['feedback']); ?>
    <?php endif; ?>

<?php include "../templates/footer.php"?>
