<?php

declare(strict_types=1);

include '../helpers/database.php';

$sessionExist = checkSessionExists($db);

if($_SERVER['REQUEST_METHOD'] === 'POST') {

    if(empty($_POST['postId'])) {
        header('Location: ./blog-detail.php');
        die;
    }
    //postID nodig voor te zien welke post we moeten aanpassen
    $_SESSION['postId'] = $_POST['postId'];
}

$post = getPostDetailPage($db, (int)$_SESSION['postId']);
?>
<?php include "./components/head.php"?>

    <?php include "./components/nav.php"?>

    <h1>Edit post</h1>

    <?php include "./components/feedback.php"?>

    <form method="post" action="../actions/edit-post-action.php">
        <div class="newPost">
            <label for="title">Title:</label><br>
            <input type="text" name ="title" id="title" value="<?= $post['title'];?>"/><br>
            <img src="../pictures/pic-default.png" alt=""><br>
            <label for="body">Content:</label><br>
            <textarea name="body" id="body" rows="50" cols="100"><?= $post['body'];?></textarea><br>
            <input type="hidden" name="postId" value="<?= $post['id']; ?>"/>
            <button>save</button> 
        </div>
    </form>
    
    <form action="./blog-detail.php" method="post">
        <input type="hidden" name="postId" value="<?= $post['id']; ?>"/>
        <button>cancel</button>
    </form>

<?php include "./components/footer.php"?>
