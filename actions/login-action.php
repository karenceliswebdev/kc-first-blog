<?php

declare(strict_types=1);

include '../Models/User.php';

use Models\DB;

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
    
    $emailExists = checkEmailExists($db, $_POST['email']);

    if($emailExists===false) {
        $_SESSION['feedbackColor'] = 'red';
        $_SESSION['feedback'] = 'User does not exist, got to sign up';
        header('Location: ../pages/login.php');
        die;
    }

    //Check input na hashing hetzelfd is als opgeslagen hash in db
    $passwordIsCorrect = checkUserPasswordCorrect($db, $_POST['email'], $_POST['password']);

    if($passwordIsCorrect===false) {
        $_SESSION['feedbackColor'] = 'red';
        $_SESSION['feedback'] = 'incorrect login details';
        header('Location: ../pages/login.php');
        die;
    }

    $userSessionId = uniqid();
    $_SESSION['sessionId'] = $userSessionId;
    updateSessionId($db, $_POST['email']);

    $_SESSION['feedbackColor'] = 'green';
    $_SESSION['feedback'] = 'logged in';

    header('Location: ../pages/index.php');
}
?>

