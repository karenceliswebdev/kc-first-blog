<?php

declare(strict_types=1);

include '../helpers/database.php';
include '../helpers/functions.php';

$sessionExist = checkSessionExists($db);
$posts = getAllPostsFromUser($db);
?>
<?php include "./components/head.php"?>

    <?php include "./components/nav.php"?>

    <?php if($sessionExist===true) : ?>
        <a href="./add-post.php"><button>Add post</button></a>
    <?php endif; ?>

    <!--recent posts (6)-->
    <div class="allUserPosts">
        <?php if(!(count($posts) === 0)) : ?>
            <?php foreach($posts as $posts) : ?>
                <?php include "./components/post-teaser.php"?>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

<?php include "./components/footer.php" ?>
