<?php

include '../helpers/database.php';

$sessionExist = checkSessionExists($db);

if($sessionExist===false) {
    $_SESSION['feedbackColor'] = 'red';
    $_SESSION['feedback'] = 'Only loged in users can like a post';
    header('Location: ../pages/blog-detail.php');
}

if($_SERVER['REQUEST_METHOD'] === 'POST') {

    if(empty($_POST['postId'])) {
        header('Location: ../pages/blog-detail.php');
        die;
    }
    
    $_SESSION['postId'] = $_POST['postId'];

    $userLikedPost = checkUserLikedPost($db, (int)$_SESSION['postId']);

    if($userLikedPost) {
        //bestaat -> verwijderen
        deleteLikePost($db, (int)$_SESSION['postId']);

        header('Location: ../pages/blog-detail.php');
        die;
    }  
     
    //niet bestaat -> toevoegen
    addLikePost($db, (int)$_SESSION['postId']);   

    header('Location: ../pages/blog-detail.php');
}
?>