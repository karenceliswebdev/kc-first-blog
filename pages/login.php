<?php
declare(strict_types=1);

include '../helpers/database.php';

$sessionExist = checkSessionExists($db);
?>
<?php include "./components/head.php"?>

    <?php include "./components/nav.php"?>

    <h1>Login</h1>

    <?php if(!empty($_SESSION['feedback'])) : ?>
        <p><?=$_SESSION['feedback']; ?></p>
        <?php unset($_SESSION['feedback']); ?>
    <?php endif; ?>

    <form method="post" action="../actions/login-action.php">
        <label for="email">email</label><br>
        <input type="text" name ="email" id="email"></input><br>
        <label for="password">password</label><br>
        <input type="password" name ="password" id="password"></input><br>
        <button>login</button>
    </form>

    <p><a href="./sign-up.php">sign up</a></p>

<?php include "./components/footer.php"?>