<?php
$title = "Page de gestion des chapîtres - Jean Forteroche : Billet simple pour l'Alaska.";
$description = "Page réservée à l'administrateur du site";
?>

<?php ob_start(); ?>

<div id="chapter-div " class="col-sm-12 container">

    <div class="dropdown show my-4">

        <a class="btn btn-info dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" 
        aria-haspopup="true" aria-expanded="false">CHAPITRES</a>
        

        <div class="dropdown-menu " aria-labelledby="dropdownMenuLink">
            <?php
            while($data = $allChaptersQuery->fetch())
            {
            ?>
                <a class="nav-link list-item dropdown-item " href='index.php?action=adminChapter&amp;id=<?php echo $data['id'];?>'><?php echo $data['title'];?></a> <br> 

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
            <div d-flex >
                <h2> <?php echo $data2["title"];?> </h2>
                <a class="badge badge-warning text-white" href='index.php?action=updateChapters&amp;id=<?php echo $data2['id'];?>'>Modifier</a> 
                <a class="badge badge-danger" href='index.php?action=deleteChapter&amp;id=<?php echo $data2['id'];?>'>Supprimer</a>
            </div>
            
            <p> <?php echo $data2["chapter"];?> </p>
        </div>      
    <?php
    }
    $chapterQuery->closeCursor();
    ?>
    </div>

    <div class="container mb-5">
        <hr>
    </div>
    

    <div id="admin-comment-div" class="container-fluid mb-5">
        <button id="form-btn"  class="btn btn-warning mb-4 text-white">Tous les commentaires signalés</button>
        <?php
        while($data3 = $commentsQuery->fetch())
        {
        ?>
            <div class="commentaires">
                <p>Posté par : <?php echo htmlspecialchars($data3["pseudo"]);?>, le <?php echo $data3["date_fr"];?></p> <br>
                <p><?php echo htmlspecialchars($data3["comment"]);?></p> <br>
                <p class="text-danger">Ce commentaire a été signalé <?= $data3["signal_number"]?> fois.</p>
                <a  class="badge badge-info text-white" href="index.php?action=allowComment&amp;id=<?=$data3["id"]?>">Modérer</a>
                <a  class="badge badge-danger text-white" href="index.php?action=deleteComment&amp;id=<?=$data3["id"]?>">Supprimer</a>      
            </div>
            <?php    
        }
        $commentsQuery->closeCursor();
        ?>
    </div>

    <div class="container mb-5">
        <hr>
    </div>


    <div id="addChapter-div" class="container-fluid my-5">
        <button id="form-btn"  class="btn btn-info">Ajouter un chapitre</button>
        <div>
            <form  class="col-md-12 text-center p-5"  method="post" action='index.php?action=addChapter'>
                <input id="title" type="text" class="form-control" name="title" placeholder="Titre du chapitre" required><br>
                <textarea rows=30 id="chapter" class="form-control" name="chapter" ></textarea><br>
                <input class="btn btn-info" type="submit" value="Valider">
            </form>
        </div>
    </div>

</div>

<?php $content = ob_get_clean(); ?>

<?php require('views/template.php'); ?>