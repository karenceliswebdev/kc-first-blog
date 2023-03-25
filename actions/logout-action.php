<?php

declare(strict_types=1);

include '../helpers/database.php';

$userSessionId = uniqid();
session_destroy();

header("Location: ../pages/index.php");
?>