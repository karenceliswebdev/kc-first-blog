<?php

declare(strict_types=1);

include '../helpers/database.php';
include '../helpers/functions.php';

$sessionExist = checkSessionExists($db);
$likedPosts = getAllLikedPostsFromUser($db);

?>
<?php include "./components/head.php"?>
    
    <?php include "./components/nav.php"?>

    <h1>Liked posts</h1>

    <!--recent posts (6)-->
    <div class="recentPosts">
        <?php if(!(count($likedPosts) === 0)) : ?>
            <?php foreach($likedPosts as $likedPosts) : ?>
                <?php $post = getPostDetailPage($db, $likedPosts['post_id']); ?>
                <?php if(empty($post['deleted-at'])) : ?>
                    <?php include "./components/post-teaser.php"?>
                <?php endif; ?>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

<?php include "./components/footer.php"?>
