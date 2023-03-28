<?php

declare(strict_types=1);

include '../Models/User.php';
include '../Models/Post.php';

if($_SERVER['REQUEST_METHOD'] === 'POST') {

    if(empty($_POST['postId'])) {
        $_SESSION['feedback'] = 'no post selected';//
        header('Location: ../pages/blog-detail.php');
        die;
    }

    $post = new Post((int)$_POST['postId']);//
    $user = new User();
    $user->findSession();

    if($user->getId() !== $post->getUserId()) {
        $_SESSION['feedback'] = "You can only delete your own post";
        header('Location: ../pages/index.php');
        die;
    }

    $post->delete();
    $post->save();

    $_SESSION['feedbackColor'] = 'green';
    $_SESSION['feedback'] = 'post deleted';

    header('Location: ../pages/user-posts.php');
}
?>