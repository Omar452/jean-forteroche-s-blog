<?php session_start();?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include("inclusions/head.php");?>
        <link rel="stylesheet" href="css/style-author.css">

        <!--TINY MCE-->
        <link href="https://fonts.googleapis.com/css?family=PT+Sans&display=swap" rel="stylesheet">
        <script src="https://cdn.tiny.cloud/1/zxzv60b5q0gc5d3wbi9ezdafwuzak7bbql5pmuzmxut75dr8/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
        <script>
        tinymce.init({
            selector: '#chapter'
        });
        </script>
        
    </head>

    <body>
        <header><?php include("inclusions/header.php");?></header>

        <div id="main">

            <?php
            try
            {
                $db = new PDO("mysql:host=localhost;dbname=projet4;charset=utf8", "root", "");
            }
            catch(Exception $e)
            {
                die('Erreur :  '. $e->getMessage());
            }
            
            $_POST["idetifiant"] = htmlspecialchars($_POST["identifiant"]);
            $_POST["passwd"] = htmlspecialchars($_POST["passwd"]);

            $req = $db->prepare('SELECT passwd AS goodpass FROM connexion WHERE identifiant=?');
            $req->execute(array($_POST["identifiant"]));
            $data = $req->fetch();


            if ((htmlspecialchars($_POST["passwd"]) == $data["goodpass"]) OR (isset($_SESSION["identifiant"]) AND isset($_SESSION["passwd"])))
            {
                $_SESSION["identifiant"] = $_POST["idetifiant"];
                $_SESSION["passwd"] = $_POST["passwd"];
            ?>
                <div id="add-chapter-div">
                    <form method="post" action="backend/add_chapter.php">
                        <p>Ajouter un chapitre</p>
                        <label for="title">Titre du chapitre:</label>
                        <input id="input-title" type="text" name="title"><br>
                        <label for="chapter">Contenu du chapitre:</label>
                        <textarea id="chapter" name="chapter" rows=20></textarea><br>
                        <input id="submit" type="submit">
                    </form>
                </div>

            <?php
            }
            else
            {
                echo "<p style='color:red; text-align:center;'>Identifiant ou mot de passe invalide, acces refusé!</p>";
            }
            $req->closeCursor();

            if ((isset($_SESSION["identifiant"])) AND (isset($_SESSION["passwd"])))
            {
                $req2 = $db->query('SELECT * FROM chapters');
                while ($data2 = $req2->fetch())
                {
            ?>
                    <div>
                        <p><?php echo $data2["title"];?></p>
                        <a href="update_chapter_front.php?id=<?php echo $data2["id"];?>">Modifier</a>
                        <a href="backend/delete_chapter.php?id=<?php echo $data2["id"];?>">Supprimer</a>
                    </div>
            <?php
                }
                $req2->closeCursor();  

                $req3 = $db->prepare('SELECT id, chapter_id, pseudo, comment, DATE_FORMAT(date_creation, "%d/%m/%Y") AS date_fr  FROM comments WHERE signal_comment=?');
                $req3->execute(array(true));
                while ($data3 = $req3->fetch())
                {
            ?>
                    <div class="commentaires">
                    <p>Posté par : <?php echo htmlspecialchars($data3["pseudo"]);?>, le <?php echo $data3["date_fr"];?></p> <br>
                    <p><?php echo htmlspecialchars($data3["comment"]);?></p> <br>
                    <a href="backend/delete_comment.php?id=<?php echo $data3["id"]?>&amp;chapter_id=<?php echo $data3["chapter_id"]?>">Supprimer le commentaire !</a>
                    </div>
            <?php
                }
                $req2->closeCursor();
            }            
            ?>

        </div>

        <footer><?php include("inclusions/footer.php");?></footer>

    </body>

</html>