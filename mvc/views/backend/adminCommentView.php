<?php
$title = "Page de gestion des commentaires - Jean Forteroche : Billet simple pour l'Alaska.";
$description = "Page réservée à l'administrateur du site";
?>

<?php ob_start(); ?>

<div id="admin-comment-div" class="row">

<?php
while($data = $commentsQuery->fetch())
{
?>
    <div class="commentaires">
        <p>Posté par : <?php echo htmlspecialchars($data["pseudo"]);?>, le <?php echo $data["date_fr"];?></p> <br>
        <p><?php echo htmlspecialchars($data["comment"]);?></p> <br>
        <p style="color: red;">Ce commentaire a été signalé <?= $data["signal_number"]?> fois.</p>
        <a href="index.php?action=allowComment&amp;id=<?=$data["id"]?>">Modérer</a>
        <a href="index.php?action=deleteComment&amp;id=<?=$data["id"]?>">Supprimer</a>      
    </div>
    <?php    
}
$commentsQuery->closeCursor();
?>
</div>

<?php $content = ob_get_clean();?>

<?php require('template.php');?>