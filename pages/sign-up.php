<?php

declare(strict_types=1);

session_start();
?>
<?php include "./components/head.php"?>

    <?php include "./components/nav.php"?>

    <h1>Sign up</h1>

    <?php if(!empty($_SESSION['feedback'])) : ?>
        <p><?=$_SESSION['feedback']; ?></p>
        <?php unset($_SESSION['feedback']); ?>
    <?php endif; ?>
    
    <form method="post" action="../actions/sign-up-action.php">
        <label>email</label><br>
        <input type="text" name ="email" id="email"></input><br>

        <label for="password">password</label><br>
        <input type="password" name ="password" id="password"></input><br>

        <button>sign up</button>
    </form>

    <p><a href="./login.php">log in</a></p>
    
<?php include "./components/footer.php"?>