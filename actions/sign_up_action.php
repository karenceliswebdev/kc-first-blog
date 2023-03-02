<?php

declare(strict_types=1);

include '../Models/DB.php';
include '../Models/Post.php';
include '../Models/User.php';
include '../Controller/UserController.php';
include '../Controller/PostController.php';

if($_SERVER['REQUEST_METHOD'] === 'POST') {

    if(empty($_POST['email'])) {
        $_SESSION['feedback'] = 'incorrect registration details';
        header('Location: ../pages/sign_up.php');
        die;
    }

    if(empty($_POST['password'])) {
        $_SESSION['feedback'] = 'incorrect registration details';
        header('Location: ../pages/sign_up.php');
        die;
    }

    //zien email nog niet ingenomen
    $newUserController = new UserController();
    $emailExists = $newUserController->checkEmail($_POST['email']);

    if($emailExists) {
        $_SESSION['feedback'] = 'User already exist, go to login';
        //toon: email bestaat al
        header('Location: ../pages/sign_up.php');
        die;
    }
      
    //hash password
    //bestaat niet dus kun je hem in db stoppen
    $newUserController->add($_POST['email'], $_POST['password']);

    //Redirect to page met gebruiker naam in hoek
    header('Location: ../pages/login.php');
}

//fouten:
//geen email ingevuld: toon geef email in
//geen paswoord ingevuld toon: geef paswoord in
//indien email niet herkent: toon maak een account aan
//maak een feedback cookie voor elk (email/ww/account)


?>

