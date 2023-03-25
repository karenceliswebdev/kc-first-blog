<?php

declare(strict_types=1);

include '../helpers/database.php';
include "../components/head.php";

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
    
    addNewPost($db, $_POST['title'], $_POST['body']);

    header('Location: ../pages/user-posts.php');
}
?>