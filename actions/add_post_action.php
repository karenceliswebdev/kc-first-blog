<?php

include '../helpers/database.php';

//feedback geven
if($_SERVER['REQUEST_METHOD'] === 'POST') {

    if(empty($_POST['title'])) {
        $_SESSION['feedback'] = 'Please fill in all input fields';
        //gaat die nog weten welke post ik edit
        header('Location: ../pages/add_post.php');
        die;
    }

    if(empty($_POST['body'])) {
        $_SESSION['feedback'] = 'Please fill in all input fields';
        header('Location: ../pages/add_post.php');
        die;
    }
    
    //voeg post toe
    addNewPost($db, $_POST['title'], $_POST['body']);

    //Redirect to page met gebruiker naam in hoek
    header('Location: ../pages/user_posts.php');
}
?>