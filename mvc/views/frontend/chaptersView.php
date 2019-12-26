<?php

$title = "Chapitres - Jean Forteroche : Billet simple pour l'Alaska.";
$description = "Page présentant les chapitres du roman Billet simple pour l'Alaska de Jean Forteroche.";
?>


<?php ob_start(); ?>

<div id="chapter-div " class="col-sm-12 container">

<div class="dropdown show my-4">

    <a class="btn btn-info dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" 
    aria-haspopup="true" aria-expanded="false">CHAPITRES</a>
    

    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
        <?php
        while($data = $allChaptersQuery->fetch())
        {
        ?>
            <a class="dropdown-item border-bottom" href='index.php?action=chapters&amp;id=<?php echo $data['id'];?>'><?php echo $data['title'];?></a> <br> 

        <?php
        }
        $allChaptersQuery->closeCursor();
        ?> 
    </div>
    
</div>

<!-- affiche le chapitre demandé -->
<?php
while($data2 = $chapterQuery->fetch())
{
?>
    <div class="container-fluid text-justify">
        <h2> <?php echo $data2["title"];?> </h2>
        <p> <?php echo $data2["chapter"];?> </p>
    </div>      
<?php
}
$chapterQuery->closeCursor();
?>
</div> 

<!-- affiche les commentaires en fonction du chapitre -->
<div class="container-fluid">
    <button id="comment-btn"  class="btn btn-info mb-4">Voir les commentaires</button>

<?php
while($data3 = $commentsQuery->fetch())
{
?>
    <div class="commentaires">
        <p>Posté par : <?php echo htmlspecialchars($data3["pseudo"]);?>, le <?php echo $data3["date_fr"];?></p> <br>
        <p><?php echo htmlspecialchars($data3["comment"]);?></p> <br>
        <a href="index.php?action=signalComment&amp;id=<?php echo $data3["chapter_id"]?>
        &amp;comment_id=<?php echo $data3["id"]?>">Signaler le commentaire !</a>
    </div>
<?php
}
$commentsQuery->closeCursor();
?>
</div>





<div class="container-fluid">
    <button id="form-btn"  class="btn btn-info">Laisser un commentaire</button>
    <form id="comment-form" class="col-md-3 text-center"  method="post" action='index.php?action=addComment&amp;id=<?= $_GET["id"]?>'>
        <div class="form-group">
            <label for="pseudo">Votre pseudo:</label><br>
            <input id="pseudo" type="text" name="pseudo">
        </div>
        <div class="form-group">
            <label class="align-top" for="comment">Votre commentaire:</label><br>
            <textarea id="comment" name="comment" rows=5></textarea>
        </div>
        <input class="btn btn-info" id="submit" type="submit">
    </form> 
</div>
        

<?php $content = ob_get_clean(); ?>

<?php require('views/template.php'); ?>