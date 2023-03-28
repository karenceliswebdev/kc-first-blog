<?php

declare(strict_types=1);

include '../Models/User.php';
include '../Models/Post.php';

use Models\User;
use Models\Post;

if(empty($_SESSION['sessionId'])) {
    $_SESSION['feedbackColor'] = 'red';
    $_SESSION['feedback'] = 'Only logged in users can like a post';
    header('Location: ../pages/blog-detail.php');
}

if($_SERVER['REQUEST_METHOD'] === 'POST') {

    if(empty($_POST['postId'])) {
        header('Location: ../pages/blog-detail.php');
        die;
    }

    $post = new Post((int)$_SESSION['postId']);
    $user = new User();
    $user->findSession();

    if($user->checkLikePost($post->getId())) {
        //bestaat -> verwijderen
        $post->deleteLike($user->getId());

        header('Location: ../pages/blog-detail.php');
        die;
    }  
     
    //niet bestaat -> toevoegen
    $post->addLike($user->getId());   

    header('Location: ../pages/blog-detail.php');
}
?>