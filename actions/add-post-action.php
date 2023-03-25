<?php

declare(strict_types=1);

include '../helpers/database.php';
include "../components/head.php";

//feedback geven
if($_SERVER['REQUEST_METHOD'] === 'POST') {

    if(empty($_POST['title'])) {
        $_SESSION['feedback'] = 'Please fill in all input fields';
        //gaat die nog weten welke post ik edit
        header('Location: ../pages/add-post.php');
        die;
    }

    if(empty($_POST['body'])) {
        $_SESSION['feedback'] = 'Please fill in all input fields';
        header('Location: ../pages/add-post.php');
        die;
    }
    
    //voeg post toe
    addNewPost($db, $_POST['title'], $_POST['body']);

    //Redirect to page met gebruiker naam in hoek
    header('Location: ../pages/user-posts.php');
}
?>