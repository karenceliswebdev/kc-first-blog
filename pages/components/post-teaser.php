<h2><?= $post->getTitle(); ?></h2>
<img src="../pictures/pic-default.png" alt="">
<p><?= readMore($post->getBody()); ?></p>
<form action="./blog-detail.php" method="post">
    <input type="hidden" name="postId" value="<?= $post->getId(); ?>"/>
    <button>Read More</button>
</form>