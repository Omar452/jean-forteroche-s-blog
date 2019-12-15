<?php
    session_start();
    if (isset($_SESSION["identifiant"]) AND isset($_SESSION["passwd"]))
    {
        try
        {
            $db = new PDO("mysql:host=localhost;dbname=projet4;charset=utf8", "root", "");
        }
        catch(Exception $e)
        {
            die('Erreur :  '. $e->getMessage());
        }
        
        $_POST["title"] = htmlspecialchars($_POST["title"]);
        $_POST["chapter"] = htmlspecialchars($_POST["chapter"]);

        $req = $db->prepare("INSERT INTO chapters(title, chapter) VALUES(:title, :chapter)");
        $req->execute(array(
            "title" => $_POST["title"],
            "chapter" => $_POST["chapter"]
        ));

        $req->closeCursor();

        header('Location: ../author.php');
    }
    else
    {
        echo "<p style='color:red; text-align:center;'>Accès refusé !</p>";
        header('Location: ../admin.php');
    }
    