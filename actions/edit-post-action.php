<?php

declare(strict_types=1);

include '../Models/User.php';
include '../Models/Post.php';

if($_SERVER['REQUEST_METHOD'] === 'POST') {

    if(empty($_POST['title'])) {
        $_SESSION['feedback'] = 'Please fill in all input fields';
        header('Location: ../pages/edit-post.php');
        die;
    }

    if(empty($_POST['body'])) {
        $_SESSION['feedback'] = 'Please fill in all input fields';
        header('Location: ../pages/edit-post.php');
        die;
    }
    
    $post = new Post((int)$_SESSION['postId']);
    $user = new User();
    $user->findSession();

    updatePost($db, $_POST['title'], $_POST['body'], (int)$_SESSION['postId']);

    $_SESSION['feedbackColor'] = 'green';
    $_SESSION['feedback'] = 'post edited';

    header('Location: ../pages/blog-detail.php');
}
?>