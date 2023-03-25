<?php
declare(strict_types=1);

include '../helpers/database.php';

$sessionExist = checkSessionExists($db);
?>
<?php include "./components/head.php"?>

    <?php include "./components/nav.php"?>

    <h1>Sign up</h1>

    <?php include "./components/feedback.php"?>
    
    <form method="post" action="../actions/sign-up-action.php">
        <label for="email">email</label><br>
        <input type="text" name ="email" id="email"></input><br>
        <label for="password">password</label><br>
        <input type="password" name ="password" id="password"></input><br>
        <button>sign up</button>
    </form>

    <p><a href="./login.php">log in</a></p>
    
<?php include "./components/footer.php"?>