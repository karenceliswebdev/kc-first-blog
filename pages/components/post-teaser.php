<h2><?= $posts['title']; ?></h2>
<img src="../pictures/pic-default.png" alt="">
<p><?= readMore($posts['body']); ?></p>
<form action="./blog-detail.php" method="post">
    <input type="hidden" name="postId" value="<?= $posts['id']; ?>"/>
    <button>Read More</button>
</form>