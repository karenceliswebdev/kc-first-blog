<?php

declare(strict_types=1);

include '../helpers/database.php';

if($_SERVER['REQUEST_METHOD'] === 'POST') {

    if(empty($_POST['postId'])) {
        header('Location: ../pages/blog-detail.php');
        die;
    }

    $_SESSION['feedbackColor'] = 'green';
    $_SESSION['feedback'] = 'post deleted';
    $_SESSION['postId'] = ($_POST['postId']);
    deletePost($db, (int)$_SESSION['postId']);

    header('Location: ../pages/user-posts.php');
}
?>