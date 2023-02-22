<?php

declare(strict_types=1);

include '../helpers/database.php';

if($_SERVER['REQUEST_METHOD'] === 'POST') {

    if(empty($_POST['postId'])) {
        header('Location: ../pages/blog_detail.php');
        die;
    }
    //voeg post toe
    deletePost($db, $_POST['title'], $_POST['body']);

    //Redirect to page met gebruiker naam in hoek
    header('Location: ../pages/user_posts.php');
}
?>