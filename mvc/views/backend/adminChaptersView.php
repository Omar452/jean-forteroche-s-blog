<?php
$title = "Page de gestion des chapîtres - Jean Forteroche : Billet simple pour l'Alaska.";
$description = "Page réservée à l'administrateur du site";
?>

<?php ob_start(); ?>

<?php
    if (isset($_SESSION["succes"]))
    {
    ?>
        <div id="succesMessage" class="text-center alert alert-success alert-link m-3 p-3" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <?php
                switch($_SESSION["succes"])
                {
                    case "login":
                        echo "<p>Bienvenue M. Forteroche.</p>";
                        break;
                    case "addChapter":
                        echo "<p>Chapitre ajouté avec succès!</p>";
                        break;
                    case "updateChapter":
                        echo "<p>Chapitre modifié avec succès!</p>";
                        break;
                    case "deleteChapter":
                        echo "<p>Chapitre supprimé avec succès!</p>";
                        break;
                    case "allowComment":
                        echo "<p>Ce commentaire a été retiré des commentaires signalés!</p>";
                        break;
                    case "deleteComment":
                        echo "<p>Commentaire supprimé avec succès!</p>";
                        break;
                }
            ?>
        </div> 
    <?php
    unset($_SESSION["succes"]);
    }
?>

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
                <p>Chapitre associé: <?php echo $data3["title"];?></p> 
                <p><?php echo htmlspecialchars($data3["comment"]);?></p> <br>
                <p class="text-danger">Ce commentaire a été signalé <?= $data3["signal_number"]?> fois.</p>
                <a  class="badge badge-info text-white" href="index.php?action=allowComment&amp;id=<?=$data3["commentsid"]?>">Modérer</a>
                <a  class="badge badge-danger text-white" href="index.php?action=deleteComment&amp;id=<?=$data3["commentsid"]?>">Supprimer</a>      
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