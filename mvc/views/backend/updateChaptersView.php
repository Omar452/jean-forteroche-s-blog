<?php
$title = "Page de modification des chapîtres - Jean Forteroche : Billet simple pour l'Alaska.";
$description = "Page réservée à l'administrateur du site";
?>

<?php ob_start(); ?>

<div id="admin-chapter-div" class="row">

<div id="addChapter-div" class="xs-12-col offset-md-2 md-6-col container p-2">
    <div>
        <form  class="col-md-4 text-center"  method="post" action='index.php?action=updateChapters'>
            <input id="title" type="text" class="form-control" name="title" placeholder="Titre du chapitre" required><br>
            <textarea rows=30 id="chapter" class="form-control" name="chapter" ></textarea><br>
            <input class="btn btn-primary" type="submit" value="Valider">
        </form>
    </div>
</div>

</div>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>