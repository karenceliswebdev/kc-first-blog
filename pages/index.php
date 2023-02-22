<?php

declare(strict_types=1);

include '../helpers/database.php';
include '../helpers/functions.php';

$posts = getPosts($db);
$sessionExist = checkSessionExists($db);

?>
<?php include "../templates/nav.php"?>

    <h1>Recent posts</h1>

    <!--recent posts (6)-->
    <div class="recentPosts">
        <?php if(!(count($posts) === 0)) : ?>
            <?php foreach($posts as $posts) : ?>
                <h2><?= $posts['title']; ?></h2>
                <img src="../pictures/pic_default.png" alt="">
                <p><?= readMore($posts['body']); ?></p>

                <form action="./blog_detail.php" method="post">
                    <input type="hidden" name="postId" value="<?= $posts['id']; ?>"/>
                    <button>Read More</button>
                </form>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

<?php include "../templates/footer.php"?>
