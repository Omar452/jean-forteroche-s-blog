<?php
$title = "Page de gestion des chapîtres - Jean Forteroche : Billet simple pour l'Alaska.";
$description = "Page réservée à l'administrateur du site";
?>

<?php ob_start(); ?>

<div id="admin-chapter-div" class="row">
<nav id="side-nav" class="col-sm-2 bg-black w-100 p-0 text-center">
    <div class="sidebar-header">
        <p class="py-3">CHAPITRES</p>
    </div>
    
    <ul class="list-group list-group-flush list-unstyled w-100">
    <?php
    while($data = $allChaptersQuery->fetch())
    {
    ?>
        <li class="list-group-item-flush w-100 py-2">
            <a href='index.php?action=chapters&amp;id=<?php echo $data['id'];?>'><?php echo $data['title'];?></a> <br>
            <div class="row">
                <a class="badge badge-warning" href='index.php?action=updateChapter&amp;id=<?php echo $data['id'];?>'>Modifier</a> 
                <a class="badge badge-danger" href='index.php?action=deleteChapter&amp;id=<?php echo $data['id'];?>'>Supprimer</a>
            </div>
        </li>
    <?php
    }
    $allChaptersQuery->closeCursor();
    ?> 
    </ul>
</nav>

<div id="addChapter-div" class="xs-12-col offset-md-2 md-6-col container p-2">
    <div>
        <form  class="col-md-4 text-center"  method="post" action='index.php?action=addChapter'>
            <input id="title" type="text" class="form-control" name="title" placeholder="Titre du chapitre" required><br>
            <textarea rows=30 id="chapter" class="form-control" name="chapter" ></textarea><br>
            <input class="btn btn-primary" type="submit" value="Valider">
        </form>
    </div>
</div>

</div>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>