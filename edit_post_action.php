<?php

//updaten vn db functies oproepen:

//ook special chars hiervoor opletten

include './database.php';

//feedback geven

if($_SERVER['REQUEST_METHOD'] === 'POST') {

    if(empty($_POST['title'])) {

        header('Location: ./edit_post.php');
        die;
    }

    if(empty($_POST['body'])) {
        
        header('Location: ./edit_post.php');
        die;
    }
    
    //postID nodig voor te zien welke post we moeten aanpassen
    $_SESSION['postId'] = ($_POST['postId']);

    //voeg post toe

    updatePost($db, $_POST['title'], $_POST['body'], (int)$_SESSION['postId']);

    //Redirect to page met gebruiker naam in hoek
    
    header('Location: ./blog_detail.php');

}
?>