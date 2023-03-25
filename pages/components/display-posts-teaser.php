<div class="recentPosts">
    <?php if(!(count($posts) === 0)) : ?>
        <?php foreach($posts as $posts) : ?>
            <?php include "./components/post-teaser.php"?>
        <?php endforeach; ?>
    <?php endif; ?>
</div>