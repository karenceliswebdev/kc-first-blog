<div class="recentPosts">
    <?php if(!(count($posts) === 0)) : ?>
        <?php foreach($posts as $nr => $post) : ?>
            <?php include "./components/post-teaser.php"?>
        <?php endforeach; ?>
    <?php endif; ?>
</div>