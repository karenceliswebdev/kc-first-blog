<?php

include '../Models/DB.php';
include '../Models/Post.php';
include '../Models/User.php';
include '../Controller/UserController.php';
include '../Controller/PostController.php';

$newUserController = new UserController();
$sessionExist = $newUserController->checkSession();

if($sessionExist===false) {
    $_SESSION['feedback'] = 'Only loged in users can like a post';
    //alert maken enkel user kunnen post liken: login cancel button
    header('Location: ../pages/blog_detail.php');
}

if($_SERVER['REQUEST_METHOD'] === 'POST') {

    if(empty($_POST['postId'])) {
        header('Location: ../pages/blog_detail.php');
        die;
    }
    
    $_SESSION['postId'] = $_POST['postId'];
    $userLikedPost = $newUserController->checkLikedPost((int)$_SESSION['postId']);

    if($userLikedPost) {
        //bestaat -> verwijderen
        $newPostController = new PostController();
        $newPostController->deleteLike((int)$_SESSION['postId']);

        header('Location: ../pages/blog_detail.php');
        die;
    }   
    //niet bestaat -> toevoegen
    $newPostController = new PostController();
    $newPostController->addLike((int)$_SESSION['postId']);   

    //Redirect to detail page
    header('Location: ../pages/blog_detail.php');
}
?>