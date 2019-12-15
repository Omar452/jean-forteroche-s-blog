<!DOCTYPE html>

<html lang="en">

<head>
    <?php include("inclusions/head.php");?>
    <link rel="stylesheet" href="css/style-chapter.css">
</head>

    <body>

        <header><?php include("inclusions/header.php");?></header>

        <div id="main-img">
            <img id="photo-alaska" src="https://millionmilesecrets.com/wp-content/uploads/shutterstock_1150411130.jpg" alt="photo alaska">
        </div>

        <div id="main">

            <div id="main-chapter">
                <?php
                try
                {
                    $db = new PDO("mysql:host=localhost;dbname=projet4;charset=utf8", "root", "");
                }
                catch(Exception $e)
                {
                    die('Erreur :  '. $e->getMessage());
                }

                if(isset($_GET['id']))
                {
                    $req = $db->prepare('SELECT id, title, chapter FROM chapters WHERE id=?');
                    $req->execute(array($_GET['id']));
                    while($data = $req->fetch())
                    {
                ?>
                        <h2> <?php echo htmlspecialchars($data["title"]);?> </h2>
                        <p> <?php echo htmlspecialchars($data["chapter"]);?> </p>
                <?php
                    }    
                }
                else
                {
                    $req = $db->query('SELECT id, title, chapter FROM chapters WHERE id=1');
                    while($data = $req->fetch())
                    {
                ?>
                        <h2> <?php echo htmlspecialchars($data['title']);?> </h2>
                        <p> <?php echo htmlspecialchars($data['chapter']);?> </p>
                <?php
                    }                
                }
                $req->closeCursor();
                ?>   
            </div>

            <aside>
                <?php
                $req2 = $db->query('SELECT * FROM chapters');
                while($data2 = $req2->fetch())
                {
                ?>
                    <a href='chapters.php?id=<?php echo $data2["id"]?>'><?php echo htmlspecialchars($data2['title']); ?> </a> <br>
                <?php
                }
                $req2->closeCursor();
                ?>
                
            </aside>

        </div>

        <div id="comments">
            <h3>Commentaires:</h3>
        <?php
            $req3 = $db->prepare('SELECT id, chapter_id, pseudo, comment, DATE_FORMAT(date_creation, "%d/%m/%Y") AS date_fr  FROM comments WHERE chapter_id =?');
            $req3->execute(array($_GET['id']));
            while ($data3 = $req3->fetch())
            {
            ?>
                <div class="commentaires">
                    <p>Posté par : <?php echo htmlspecialchars($data3["pseudo"]);?>, le <?php echo $data3["date_fr"];?></p> <br>
                    <p><?php echo htmlspecialchars($data3["comment"]);?></p> <br>
                    <a href="backend/signal_comment.php?id=<?php echo $data3["id"]?>">Signaler le commentaire !</a>
                </div>
                
            <?php
            }
            $req3->closeCursor();
            ?>
        </div>

        
        <form id="comment-form" method="post" action='backend/add_comment.php?id=<?php echo $_GET["id"];?>'>
            <p>Ajouter votre commentaire</p>
            <label for="pseudo">Votre pseudo:</label>
            <input id="pseudo" type="text" name="pseudo"><br>
            <label for="comment">Votre commentaire:</label>
            <textarea id="comment" name="comment" rows=10></textarea><br>
            <input id="submit" type="submit">
        </form>
        

        <footer> <?php include('inclusions/footer.php');?> </footer>
    </body>
</html>