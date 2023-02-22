<?php

declare(strict_types=1);

include '../helpers/database.php';

//moet weten welke user ik sessie wil verwijderen
$user = getUser($db);
 
//Create session id for user
$userSessionId = uniqid();
session_destroy();

header("Location: ../pages/index.php");
?>