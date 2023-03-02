<?php

declare(strict_types=1);

include '../Models/DB.php';
include '../Models/Post.php';
include '../Models/User.php';
include '../Controller/UserController.php';
include '../Controller/PostController.php';

//moet weten welke user ik sessie wil verwijderen
//$newUserController = new UserController();
//$user = $newUserController->getUser();
 
//Create session id for user
//$userSessionId = uniqid();
session_destroy();

header("Location: ../pages/index.php");
?>