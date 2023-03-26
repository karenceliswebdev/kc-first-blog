<?php

declare(strict_types=1);

include '../Models/User.php';

use Models\DB;

if($_SERVER['REQUEST_METHOD'] === 'POST') {

    if(empty($_POST['email'])) {
        $_SESSION['feedbackColor'] = 'red';
        $_SESSION['feedback'] = 'incorrect registration details';
        header('Location: ../pages/sign-up.php');
        die;
    }

    if(empty($_POST['password'])) {
        $_SESSION['feedbackColor'] = 'red';
        $_SESSION['feedback'] = 'incorrect registration details';
        header('Location: ../pages/sign-up.php');
        die;
    }

    $user = new User();
    $user->setEmail($_POST['email']);
    $user->setPassword($_POST['password']);
    $emailExists = $user->checkEmailExist();

    if($emailExists) {
        $_SESSION['feedbackColor'] = 'red';
        $_SESSION['feedback'] = 'User already exist, go to login';
        header('Location: ../pages/sign-up.php');
        die;
    }

    $user->save();  
    header('Location: ../pages/login.php');
}
?>

