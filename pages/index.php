<?php
declare(strict_types=1);

include '../Models/User.php';
include '../helpers/functions.php'; 

use Models\DB;

$user = new User();

$posts = getPosts($db);
?>
<?php include "./components/head.php"?>
    
    <?php include "./components/nav.php"?>

    <?php include "./components/feedback.php"?>

    <h1>Recent posts</h1>

    <?php include "./components/display-posts-teaser.php"?>

<?php include "./components/footer.php"?>
