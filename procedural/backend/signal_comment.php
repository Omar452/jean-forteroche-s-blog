<?php
try
{
    $db = new PDO("mysql:host=localhost;dbname=projet4;charset=utf8", "root", "");
}
catch(Exception $e)
{
    die('Erreur :  '. $e->getMessage());
}

$req = $db->prepare('UPDATE comments SET signal_comment = true WHERE id = ?');
$req->execute(array($_GET["id"]));
$req->closeCursor();
$chapter_id = $_GET["chapter_id"];
header('Location: ../chapters.php?id='.$chapter_id);
