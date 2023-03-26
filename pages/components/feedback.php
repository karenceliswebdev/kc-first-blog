<?php if(!empty($_SESSION['feedback'])) : ?>
    <p style="color: <?= $_SESSION['feedbackColor']; ?>;"><?= $_SESSION['feedback']; ?></p>
    <?php unset($_SESSION['feedback']); ?>
<?php endif; ?>