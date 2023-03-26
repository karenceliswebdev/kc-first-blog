<?php
declare(strict_types=1);

//include '../helpers/database.php';
include '../Models/User.php';

use Models\DB;//moest db zijn

$session = new User();

?>
<?php include "./components/head.php"?>

    <?php include "./components/nav.php"?>

    <h1>Sign up</h1>

    <?php include "./components/sign-up-form.php"?>

    <?php include "./components/feedback.php"?>
    
<?php include "./components/footer.php"?>