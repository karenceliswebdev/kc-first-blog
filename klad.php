<?php

$arrayFalse = [];

if($arrayFalse){
    echo 'arrayfalse true';
    die;
}
else{

    echo 'arrayfalse false';
}

//krijg false

$ar = false;

if($ar===true){
    echo 'arrayfalse true';
    die;
}
else{

    echo 'arrayfalse false';
}

//krijg true


$db = connectDb('root','','first_blog_kc');

function connectDb(string $user, string $pass, string $db, string $host = 'localhost'): PDO {
   
    try {
        
        $connection = new PDO("mysql:host={$host};dbname={$db}", $user, $pass);
        return $connection;

    } 
    catch (Exception $exception) {
        
        echo $exception->getMessage();
    }
}

$session = 4;

$res = $db->prepare('SELECT * FROM users WHERE id = :sessionId');
$res->bindParam(':sessionId', $session);
$res->setFetchMode(PDO::FETCH_ASSOC);
$res->execute();

$user = $res->fetch();    //false als leeg anders array terug

echo $user;

//test like icon:

$test = true;

if($test) {

    $path = './pictures/heart-empty.svg';
}

?>

<button style="height:50px; width:50px;">
<img src = "<?php echo $path; ?>" alt="heart">    <!--echo-->       
</button>

