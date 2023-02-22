<?php

include '../helpers/database.php';

$sessionExist = checkSessionExists($db);

if($sessionExist===false) {
    //alert maken enkel user kunnen post liken: login cancel button
    header('Location: ../pages/blog_detail.php');
}

if($_SERVER['REQUEST_METHOD'] === 'POST') {

    if(empty($_POST['postId'])) {
        header('Location: ../pages/blog_detail.php');
        die;
    }
    
    $_SESSION['postId'] = $_POST['postId'];

    //check user post geliked heeft
    $userLikedPost = checkUserLikedPost($db, (int)$_SESSION['postId']);

    if($userLikedPost) {
        //bestaat -> verwijderen
        deleteLikePost($db, (int)$_SESSION['postId']);

        header('Location: ../pages/blog_detail.php');
        die;
    }   
    //niet bestaat -> toevoegen
    addLikePost($db, (int)$_SESSION['postId']);   

    //Redirect to detail page
    header('Location: ../pages/blog_detail.php');
}
?>