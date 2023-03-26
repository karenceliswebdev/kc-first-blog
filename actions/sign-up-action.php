<?php

declare(strict_types=1);

include '../Models/User.php';

use Models\DB;//moest db zijn

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

    //zien email nog niet ingenomen
    $emailExists = checkEmailExists($db, $_POST['email']);

    if($emailExists) {
        $_SESSION['feedbackColor'] = 'red';
        $_SESSION['feedback'] = 'User already exist, go to login';
        header('Location: ../pages/sign-up.php');
        die;
    }
      
    addNewUser($db, $_POST['email'], $_POST['password']);

    header('Location: ../pages/login.php');
}
?>

