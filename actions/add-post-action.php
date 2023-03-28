<?php

declare(strict_types=1);

include '../Models/User.php';
include '../Models/Post.php';

use Models\User;
use Models\Post;

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
    
    $_SESSION['feedbackColor'] = 'green';
    $_SESSION['feedback'] = 'new post added';
    addNewPost($db, $_POST['title'], $_POST['body']);

    header('Location: ../pages/user-posts.php');
}
?>