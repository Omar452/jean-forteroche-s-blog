<?php

$title = "Chapitres - Jean Forteroche : Billet simple pour l'Alaska.";
$description = "Page présentant les chapitres du roman Billet simple pour l'Alaska de Jean Forteroche.";
$adminNav = null;
$login = '<i class="fas fa-sign-in-alt"></i> Connexion';

?>


<?php ob_start(); ?>



<div id="chapter-div" class="container-fluid">
    <div class="row">
        <!-- affiche la liste de tous les chapitres -->
        <aside class="wrapper p-4 bg-black">
        <?php
        while($data = $allChaptersQuery->fetch())
        {
        ?>
            <a href='index.php?action=chapters&amp;id=<?php echo $data['id'];?>'><?php echo $data['title'];?></a> <br> 
        <?php
        }
        $allChaptersQuery->closeCursor();
        ?> 
        </aside> 
        <!-- affiche le chapitre demandé -->
        <?php
        while($data2 = $chapterQuery->fetch())
        {
        ?>
            <div class="container text-justify py-4 col-md-9">
                <h2> <?php echo htmlspecialchars($data2["title"]);?> </h2>
                <p> <?php echo htmlspecialchars($data2["chapter"]);?> </p>
            </div>      
        <?php
        }
        $chapterQuery->closeCursor();
        ?>
        <!-- affiche les commentaires en fonction du chapitre -->
        <div class="offset-md-2 md-6-col container p-2">
        <button id="comment-btn"  class="btn btn-primary">Voir les commentaires</button>
        
        <?php
        while($data3 = $commentsQuery->fetch())
        {
        ?>
            <div class="commentaires">
                <p>Posté par : <?php echo htmlspecialchars($data3["pseudo"]);?>, le <?php echo $data3["date_fr"];?></p> <br>
                <p><?php echo htmlspecialchars($data3["comment"]);?></p> <br>
                <a href="index.php?comment_id=<?php echo $data3["id"]?>">Signaler le commentaire !</a>
            </div>
        <?php
        }
        $commentsQuery->closeCursor();
        ?>
        </div>

        <div class="xs-12-col offset-md-2 md-6-col container p-2">
        <button id="form-btn"  class="btn btn-primary">Laisser un commentaire</button>
        <form id="comment-form" class="col-md-4 text-center"  method="post" action='index.php?action=addComment&amp;id=<?php echo $_GET["id"];?>'>
            <div class="form-group">
                <label for="pseudo">Votre pseudo:</label><br>
                <input id="pseudo" type="text" name="pseudo">
            </div>
            <div class="form-group">
                <label class="align-top" for="comment">Votre commentaire:</label><br>
                <textarea id="comment" name="comment" rows=10></textarea>
            </div>
            <input class="btn btn-primary" id="submit" type="submit">
        </form> 
        </div>
    </div>     
</div>


<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>