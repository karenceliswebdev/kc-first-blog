<?php

declare(strict_types=1);

include '../helpers/database.php';

if($_SERVER['REQUEST_METHOD'] === 'POST') {

    if(empty($_POST['postId'])) {
        header('Location: ../pages/blog_detail.php');
        die;
    }
    $_SESSION['postId'] = ($_POST['postId']);

    deletePost($db, (int)$_SESSION['postId']);

    //Redirect to page met gebruiker naam in hoek
    header('Location: ../pages/user_posts.php');
}
?>