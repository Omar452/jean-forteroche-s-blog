<?php
session_start();
    if (isset($_SESSION["identifiant"]) AND isset($_SESSION["passwd"])  AND isset($_GET["id"]))
    {
        try
        {
            $db = new PDO("mysql:host=localhost;dbname=projet4;charset=utf8", "root", "");
        }
        catch(Exception $e)
        {
            die('Erreur :  '. $e->getMessage());
        }

        $req = $db->prepare('DELETE FROM chapters WHERE id=?');
        $req->execute(array(htmlspecialchars($_GET["id"])));
        $req->closeCursor();
        $chapter_id = $_GET["id"];
        header('Location: ../chapters.php?id='.$chapter_id);
    }