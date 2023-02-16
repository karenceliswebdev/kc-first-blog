<?php

declare(strict_types=1);

include './database.php';

//moet weten welke user ik sessie wil verwijderen
$user = getUser($db);
 
//Create session id for user
$userSessionId = uniqid();

//in cookie stoppen
setcookie('auth', $userSessionId, time() + 3600, '', '', true);

header("Location: ./login.php");
?>