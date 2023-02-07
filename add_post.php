<?php

declare(strict_types=1);

//doel 1 hoop blogposts maken en deze weergeven op homepage

include './database.php';
include './functions.php';

//checken sessie nog geldig anders redirect to login page
$user = checkSessionExists($db);

if($user===false) {

    header('Location: ./login.php');
    die;

}


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

    <h1>Add new post</h1>

    <!--new post-->
    <form method="post" action="./add_post_action.php">
        <div class="newPost">
            <label for="title">Title:</label><br>
            <input type="text" name ="title" id="title"></input><br>
            
            <img src="./pictures/pic_default.png" alt=""><br>
            
            <label for="body">Content:</label><br>
            <textarea name="body" id="body" rows="50" cols="100"></textarea><br>

            <button>save</button> 
        </div>
    </form>
    
    <a href="./user_posts.php"><button>cancel</button></a>   

</body>
</html>