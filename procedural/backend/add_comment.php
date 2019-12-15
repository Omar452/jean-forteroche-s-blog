<?php
    
try
{
    $db = new PDO("mysql:host=localhost;dbname=projet4;charset=utf8", "root", "");
}
catch(Exception $e)
{
    die('Erreur :  '. $e->getMessage());
}

$req = $db->prepare('INSERT INTO comments(chapter_id,pseudo,comment,date_creation,signal_comment) VALUES 
(:chapter_id,:pseudo,:comment,CURDATE(),NULL)');
$req->execute(array(
    "chapter_id" => htmlspecialchars($_GET["id"]),
    "pseudo" => htmlspecialchars($_POST["pseudo"]),
    "comment" => htmlspecialchars($_POST["comment"]),
));
$req->closeCursor();
$chapter_id = $_GET["id"];
header('Location: ../chapters.php?id='.$chapter_id);
