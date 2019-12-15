<?php
try
{
    $db = new PDO("mysql:host=localhost;dbname=projet4;charset=utf8", "root", "");
}
catch(Exception $e)
{
    die('Erreur :  '. $e->getMessage());
}

$req = $db->prepare('UPDATE chapters SET title = :title, chapter = :chapter WHERE id = :id');
$req->execute(array(
    "title" => $_POST["title"],
    "chapter" => $_POST["chapter"],
    "id" => $_GET["id"]
));
$req->closeCursor();
$chapter_id = $_GET["id"];
header('Location: ../chapters.php?id='.$chapter_id);