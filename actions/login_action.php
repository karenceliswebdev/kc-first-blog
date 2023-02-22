<?php

declare(strict_types=1);

//eerst zien email bestaat in db
//dan zien ingevulde pw na hashing overeenkomt met hash in db
//indien 1 en 2 ja verander login met username (hierop klikt krijg je: username + jouw posts + gelikte post links te zien )
//maak uniek sessie id en steek deze in db 
//steek deze sessie id in een auth cookie (vanaf nu bij iedere site gecheckt hierop (via auth cookie))

include '../helpers/database.php';

if($_SERVER['REQUEST_METHOD'] === 'POST') {

    if(empty($_POST['email'])) {

        header('Location: ../pages/login.php');
        die;
    }

    if(empty($_POST['password'])) {
        
        header('Location: ../pages/login.php');
        die;
    }
    
    $emailExist = checkEmailExists($db, $_POST['email']);

    //User does not exist cannot login. Should create an account
    if($emailExist===false) {
        
        //$_SESSION['feedback'] = 'maak een account aan';
        header('Location: ../pages/login.php');
        die;
    }

    //Check if user input in password field hashed is the same as the has from our database. If not password is incorrect
    $passwordIsCorrect = checkUserPasswordCorrect($db, $_POST['email'], $_POST['password']);

    //indien password false stuur terug login
    if($passwordIsCorrect===false) {
        
        //$_SESSION['feedback'] = 'incorrecte logingegevens';
        header('Location: ../pages/login.php');
        die;
    }

    //Create session id for user
    $userSessionId = uniqid();

    $_SESSION['sessionId'] = $userSessionId;
    
    //sessie id in db stoppen
    updateSessionId($db, $_POST['email']);

    //Redirect to page met gebruiker naam in hoek (changed index)
    header('Location: ../pages/index.php');
}


//fouten:

//geen email ingevuld: toon geef email in

//geen paswoord ingevuld toon: geef paswoord in

//indien email niet herkent: toon maak een account aan

//maak een feedback cookie voor elk (email/ww/account)


?>

