<?php

declare(strict_types=1);

include '../Models/DB.php';
include '../Models/Post.php';
include '../Models/User.php';
include '../Controller/UserController.php';
include '../Controller/PostController.php';

if($_SERVER['REQUEST_METHOD'] === 'POST') {

    if(empty($_POST['postId'])) {
        header('Location: ../pages/blog_detail.php');
        die;
    }
    $_SESSION['postId'] = ($_POST['postId']);
    $newPostController = new PostController();
    $newPostController->delete((int)$_SESSION['postId']);

    //Redirect to page met gebruiker naam in hoek
    header('Location: ../pages/user_posts.php');
}
?>