<?php

declare(strict_types=1);

include '../Models/User.php';

use Models\User;

if($_SERVER['REQUEST_METHOD'] === 'POST') {

    if(empty($_POST['email'])) {
        $_SESSION['feedbackColor'] = 'red';
        $_SESSION['feedback'] = 'incorrect login details';
        header('Location: ../pages/login.php');
        die;
    }

    if(empty($_POST['password'])) {
        $_SESSION['feedbackColor'] = 'red';
        $_SESSION['feedback'] = 'incorrect login details';
        header('Location: ../pages/login.php');
        die;
    }

    $user = new User();
    $user->setEmail($_POST['email']);
    $user->setPassword($_POST['password']);
    $emailExists = $user->checkEmailExist();

    if($emailExists===false) {
        $_SESSION['feedbackColor'] = 'red';
        $_SESSION['feedback'] = 'User does not exist, got to sign up';
        header('Location: ../pages/login.php');
        die;
    }

    $passwordCorrect = $user->checkPasswordCorrect();

    if($passwordCorrect===false) {
        $_SESSION['feedbackColor'] = 'red';
        $_SESSION['feedback'] = 'incorrect login details';
        header('Location: ../pages/login.php');
        die;
    }

    $_SESSION['feedbackColor'] = 'green';
    $_SESSION['feedback'] = 'logged in';
    
    $user->save();

    header('Location: ../pages/index.php');
}
?>

