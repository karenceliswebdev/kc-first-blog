<?php

declare(strict_types=1);

session_start();


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <h1>Login</h1>

    <form method="post" action="./login_action.php">
        <label>email</label><br>
        <input type="text" name ="email" id="email"></input><br>

        <label for="password">password</label><br>
        <input type="password" name ="password" id="password"></input><br>

        <button>login</button>
    </form>

    <p><a href="./sign_up.php">sign up</a></p>

</body>
</html>