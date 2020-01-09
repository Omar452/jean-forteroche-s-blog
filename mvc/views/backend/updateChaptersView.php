<?php
$title = "Page de modification des chapîtres - Jean Forteroche : Billet simple pour l'Alaska.";
$description = "Page réservée à l'administrateur du site";
?>

<?php ob_start(); ?>


<div id="addChapter-div" class="xs-12-col container-fluid p-5">
    <div>
        <form  class="col-md-12 text-center"  method="post" action='index.php?action=updateChapters'>
            <?php
            while($data = $chapterQuery->fetch()){
            ?>
                <input id="title" type="text" class="form-control" name="title" value="<?= $data["title"]?>" required><br>
                <textarea rows=30 id="chapter" class="form-control" name="chapter" ><?= $data["chapter"] ?></textarea><br>
                <input class="btn btn-primary" type="submit" value="Valider">
            <?php
            }
            ?>
            
        </form>
    </div>
</div>


<?php $content = ob_get_clean(); ?>

<?php require('views/template.php'); ?>