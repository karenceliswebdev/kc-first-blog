<?php

include './database.php';

$num = $_POST['postId'];

if($_SERVER['REQUEST_METHOD'] === 'POST') {

    if(empty($_POST['postId'])) {

        header('Location: ./blog_detail_with_account.php');
        die;
    }
    
    $num = $_POST['postId'];

    //check user post geliked heeft
    $userLikedPost = checkUserLikedPost($db, (int)$num);

    if($userLikedPost) {

        //bestaat -> verwijderen
        deleteLikePost($db, (int)$num);

        header('Location: ./blog_detail_with_account.php');
        die;
    }   

    //niet bestaat -> toevoegen
    addLikePost($db, (int)$num);   

    //Redirect to detail page
    header('Location: ./blog_detail_with_account.php');

}

?>