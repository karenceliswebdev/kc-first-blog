<?php

declare(strict_types=1);

include '../helpers/database.php';
include '../helpers/functions.php';

$sessionExist = checkSessionExists($db);
$likedPosts = getAllLikedPostsFromUser($db);

?>
<?php include "../templates/nav.php"?>

    <h1>Liked posts</h1>

    <!--recent posts (6)-->
    <div class="recentPosts">
        <?php if(!(count($likedPosts) === 0)) : ?>
            <?php foreach($likedPosts as $likedPosts) : ?>
                <?php $post = getPostDetailPage($db, $likedPosts['post_id']); ?>
                <?php if(empty($post['deleted_at'])) : ?>
                    <h2><?= $post['title']; ?></h2>
                    <img src="../pictures/pic_default.png" alt="">
                    <p><?= readMore($post['body']); ?></p>
                    <form action="./blog_detail.php" method="post">
                        <input type="hidden" name="postId" value="<?= $post['id']; ?>"/>
                        <button>Read More</button>
                    </form>
                <?php endif; ?>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

<?php include "../templates/footer.php"?>
