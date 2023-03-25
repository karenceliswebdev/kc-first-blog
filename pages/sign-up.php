<?php
declare(strict_types=1);

include '../helpers/database.php';

$sessionExist = checkSessionExists($db);
?>
<?php include "./components/head.php"?>

    <?php include "./components/nav.php"?>

    <h1>Sign up</h1>

    <?php include "./components/feedback.php"?>

    <?php include "./components/sign-up-form.php"?>
    
<?php include "./components/footer.php"?>