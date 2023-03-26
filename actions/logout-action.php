<?php

declare(strict_types=1);

include '../helpers/database.php';

session_destroy();

header("Location: ../pages/index.php");
?>