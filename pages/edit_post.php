<?php

declare(strict_types=1);

include '../helpers/database.php';

//checken sessie nog geldig anders redirect to login page
$sessionExist = checkSessionExists();

if($_SERVER['REQUEST_METHOD'] === 'POST') {

    if(empty($_POST['postId'])) {
        header('Location: ./blog_detail.php');
        die;
    }
    //postID nodig voor te zien welke post we moeten aanpassen
    $_SESSION['postId'] = $_POST['postId'];
}

$post = getPostDetailPage((int)$_SESSION['postId']);

//ge gaat array ophalen in vb steken van post rij en dan array[titel], pic en content in inputvelden steken 
?>
<?php include "../templates/nav.php"?>

    <h1>Edit post</h1>

    <?php include "../templates/feedback.php"?>

    <form method="post" action="../actions/edit_post_action.php">
        <div class="newPost">
            <label for="title">Title:</label><br>
            <input type="text" name ="title" id="title" value="<?= $post['title'];?>"/><br>
            <img src="../pictures/pic_default.png" alt=""><br>
            <label for="body">Content:</label><br>
            <textarea name="body" id="body" rows="50" cols="100"><?= $post['body'];?></textarea><br>
            <input type="hidden" name="postId" value="<?= $post['id']; ?>"/>
            <button>save</button> 
        </div>
    </form>
    
    <form action="./blog_detail.php" method="post">
        <input type="hidden" name="postId" value="<?= $post['id']; ?>"/>
        <button>cancel</button>
    </form>

<?php include "../templates/footer.php"?>
