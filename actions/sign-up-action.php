<?php

declare(strict_types=1);

include '../helpers/database.php';

if($_SERVER['REQUEST_METHOD'] === 'POST') {

    if(empty($_POST['email'])) {
        $_SESSION['feedback'] = 'incorrect registration details';
        header('Location: ../pages/sign-up.php');
        die;
    }

    if(empty($_POST['password'])) {
        $_SESSION['feedback'] = 'incorrect registration details';
        header('Location: ../pages/sign-up.php');
        die;
    }

    //zien email nog niet ingenomen
    $emailExists = checkEmailExists($db, $_POST['email']);

    if($emailExists) {
        $_SESSION['feedback'] = 'User already exist, go to login';
        header('Location: ../pages/sign-up.php');
        die;
    }
      
    addNewUser($db, $_POST['email'], $_POST['password']);

    header('Location: ../pages/login.php');
}
?>

