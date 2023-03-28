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
    
    if(empty($_POST['postId'])) {
        $_SESSION['feedback'] = 'no post selected';//
        header('Location: ./blog-detail.php');
        die;
    }
    
    $post = new Post((int)$_POST['postId']);//
    $user = new User();
    $user->findSession();

    if($user->getId() !== $post->getUserId()) {
        $_SESSION['feedback'] = "You can only edit your own post";
        header('Location: ../pages/index.php');
        die;
    }

    $post->setTitle($_POST['title']);
    $post->setBody($_POST['body']);
    $post->save();

    $_SESSION['feedbackColor'] = 'green';
    $_SESSION['feedback'] = 'post edited';

    header('Location: ../pages/blog-detail.php');
}
?>