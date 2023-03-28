<?php

declare(strict_types=1);

include '../Models/User.php';
include '../Models/Post.php';

if(empty($_SESSION['sessionId'])) {
    $_SESSION['feedbackColor'] = 'red';
    $_SESSION['feedback'] = 'Only logged in users can add a post';
    header('Location: ../pages/index.php');
}

if($_SERVER['REQUEST_METHOD'] === 'POST') {

    if(empty($_POST['title'])) {
        $_SESSION['feedback'] = 'Please fill in all input fields';
        header('Location: ../pages/add-post.php');
        die;
    }

    if(empty($_POST['body'])) {
        $_SESSION['feedback'] = 'Please fill in all input fields';
        header('Location: ../pages/add-post.php');
        die;
    }
    
    $user = new User();
    $user->findSession();

    $post = new Post();
    $post->setUser($user->getId());
    $post->setTitle($_POST['title']);
    $post->setBody($_POST['body']);
    $post->save();

    $_SESSION['feedbackColor'] = 'green';
    $_SESSION['feedback'] = 'new post added';

    header('Location: ../pages/user-posts.php');
}
?>