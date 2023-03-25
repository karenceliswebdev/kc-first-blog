<?php

declare(strict_types=1);

include '../helpers/database.php';

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
    
    //postID nodig voor te zien welke post we moeten aanpassen
    $_SESSION['postId'] = ($_POST['postId']);
    updatePost($db, $_POST['title'], $_POST['body'], (int)$_SESSION['postId']);

    header('Location: ../pages/blog-detail.php');
}
?>