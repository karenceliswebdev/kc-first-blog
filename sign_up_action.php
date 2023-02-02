<?php


include './database.php';

$user = [];

if($_SERVER['REQUEST_METHOD'] === 'POST') {

    if(empty($_POST['email'])) {

        header('Location: ./sign_up.php');
        die;
    }

    if(empty($_POST['password'])) {
        
        header('Location: ./sign_up.php');
        die;
    }

    //zien email nog niet ingenomen

    $user = checkEmailExists($db, $_POST['email']);

    if($user) {

        //toon: email bestaat al
        header('Location: ./sign_up.php');
        die;
    }
      
    //hash password

    

    //bestaat niet dus kun je hem in db stoppen

    addNewUser($db, $_POST['email'], $_POST['password']);

    //Redirect to page met gebruiker naam in hoek
    
    header('Location: ./login.php');

    
}


//fouten:

//geen email ingevuld: toon geef email in

//geen paswoord ingevuld toon: geef paswoord in

//indien email niet herkent: toon maak een account aan

//maak een feedback cookie voor elk (email/ww/account)


?>

