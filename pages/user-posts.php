<?php

declare(strict_types=1);


//doel 1 hoop blogposts maken en deze weergeven op homepage

include '../helpers/database.php';
include '../helpers/functions.php';

//all auth cookie gemaakt?

//checken sessie nog geldig anders redirect to login page
$sessionExist = checkSessionExists($db);
$posts = getAllPostsFromUser($db);
?>
<?php include "../components/head.php"?>

    <?php include "../components/nav.php"?>

    <?php if($sessionExist===true) : ?>
        <a href="./add_post.php"><button>Add post</button></a>
    <?php endif; ?>

    <!--recent posts (6)-->
    <div class="allUserPosts">
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

<?php include "../components/footer.php" ?>
