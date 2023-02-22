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
    <title>registreren</title>
</head>
<body>
    <ul>
        <li><a href="./index.php">recent posts</a></li>
    </ul>

    <h1>Sign up</h1>

    <?php if(!empty($_SESSION['feedback'])) : ?>
        <p><?=$_SESSION['feedback']; ?></p>
        <?php unset($_SESSION['feedback']); ?>
    <?php endif; ?>
    
    <form method="post" action="../actions/sign_up_action.php">
        <label>email</label><br>
        <input type="text" name ="email" id="email"></input><br>

        <label for="password">password</label><br>
        <input type="password" name ="password" id="password"></input><br>

        <button>sign up</button>
    </form>
    <p><a href="./login.php">log in</a></p>
<?php include "../templates/footer.php"?>