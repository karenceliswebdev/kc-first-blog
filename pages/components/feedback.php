<?php if(!empty($_SESSION['feedback'])) : ?>
    <p style="color: red;"><?= $_SESSION['feedback']; ?></p>
    <?php unset($_SESSION['feedback']); ?>
<?php endif; ?>