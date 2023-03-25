<?php
declare(strict_types=1);

include '../helpers/database.php';
include '../helpers/functions.php'; //readmore

$posts = getPosts($db);
$sessionExist = checkSessionExists($db);
?>
<?php include "./components/head.php"?>
    
    <?php include "./components/nav.php"?>

    <h1>Recent posts</h1>

    <!--recent posts (6)-->
    <div class="recentPosts">
        <?php if(!(count($posts) === 0)) : ?>
            <?php foreach($posts as $posts) : ?>
                <h2><?= $posts['title']; ?></h2>
                <img src="../pictures/pic-default.png" alt="">
                <p><?= readMore($posts['body']); ?></p>
                <form action="./blog-detail.php" method="post">
                    <input type="hidden" name="postId" value="<?= $posts['id']; ?>"/>
                    <button>Read More</button>
                </form>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

<?php include "./components/footer.php"?>
