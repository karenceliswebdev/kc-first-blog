<?php

include './database.php';

//feedback geven

if($_SERVER['REQUEST_METHOD'] === 'POST') {

    if(empty($_POST['title'])) {

        header('Location: ./add_post.php');
        die;
    }

    if(empty($_POST['body'])) {
        
        header('Location: ./add_post.php');
        die;
    }
    
    //voeg post toe

    addNewPost($db, $_POST['title'], $_POST['body']);

    //Redirect to page met gebruiker naam in hoek
    
    header('Location: ./user_posts.php');

}

?>