<?php

session_start();
require_once('controllers/AdminController.php');
require_once('controllers/ChaptersController.php');
require_once('controllers/CommentsController.php');

$adminController = new AdminController();
$chaptersController = new ChaptersController();
$commentsController = new CommentsController();

try
{
    
    if (isset($_GET["action"]))
    {
        $_GET["action"] = htmlspecialchars($_GET["action"]);
        /* CHAPTERS */
        if ($_GET["action"] == "home")
        {
            $chaptersController->displayHomePage();
        }
        elseif ($_GET["action"] == "chapters")
        {
            if (isset($_GET["id"]) && $_GET["id"] > 0) 
            {
                $chaptersController->displayChaptersView($_GET["id"]);
            }
            else {
                throw new Exception('Aucun identifiant de chapitre envoyé');
            }
        }
        elseif ($_GET["action"] == "adminChapter")
        {
            if (isset($_SESSION["adminLogin"]) && isset($_GET["id"]) && $_GET["id"] > 0)
            {
                $chaptersController->displayAdminChapterView($_GET["id"]);
            }
            else
            {
                throw new Exception('Connexion requise pour acceder a cette page');
            }                
        }
        elseif ($_GET["action"] == "addChapter")
        {
            if (isset($_POST["title"]) && isset($_POST["chapter"]))
            {
                $chaptersController->addChapters($_POST["title"],$_POST["chapter"]);
            }
            else
            {
                throw new Exception('Tous les champs ne sont pas remplis !');
            }
            
        }
        elseif ($_GET["action"] == "updateChapters")
        {
            if (isset($_SESSION["adminLogin"]) && isset($_GET["id"]) && $_GET["id"] > 0) 
            {
                $chaptersController->displayUpdateChaptersView($_GET["id"]);               
            }
            elseif  (isset($_SESSION["adminLogin"]) && isset($_SESSION["id"]) && isset($_POST["title"]) && isset($_POST["chapter"])) 
            {
                $chaptersController->updateChapters($_SESSION["id"], $_POST["title"],$_POST["chapter"]);               
            }
            else
            {
                throw new Exception('Tous les champs ne sont pas remplis !');
            }
        }
        elseif ($_GET["action"] == "deleteChapter")
        {
            if (isset($_GET["id"]) && $_GET["id"] > 0) 
            {
                $chaptersController->deleteChapters($_GET["id"]);               
            }
            else
            {
                throw new Exception('Tous les champs ne sont pas remplis !');
            }
        } 
        /* CHAPTERS */
        
        /* COMMENTS */
        elseif ($_GET["action"] == "addComment")
        {
            if (isset($_GET["id"]) && $_GET["id"] > 0)
            {
                if (isset($_POST['pseudo']) && isset($_POST['comment'])) {
                    $commentsController->addComment($_GET['id'], $_POST['pseudo'], $_POST['comment']);
                }
                else {
                    throw new Exception('Tous les champs ne sont pas remplis !');
                }
            }
        }
        elseif ($_GET["action"] == "signalComment")
        {
            if (isset($_GET["id"]) && $_GET["id"] > 0 && isset($_GET["chapter_id"]) && $_GET["chapter_id"] > 0) 
            {
                $commentsController->signalComments($_GET["id"],$_GET["chapter_id"]);
            }
            else
            {
                throw new Exception('Aucun identifiant de chapitre ou de commentaire envoyé');
            }
        }
        elseif ($_GET["action"] == "allowComment")
        {
            if (isset($_SESSION["adminLogin"]) && isset($_GET["id"]) && $_GET["id"] > 0 )
            {
                $commentsController->allowComment($_GET["id"]);
            }
            else
            {
                throw new Exception('Tous les champs ne sont pas renseignés !');
            }
        }
        elseif ($_GET["action"] == "deleteComment")
        {
            if (isset($_SESSION["adminLogin"]) && isset($_GET["id"]) && $_GET["id"] > 0 )
            {
                $commentsController->deleteComment($_GET["id"]);
            }
            else
            {
                throw new Exception('Tous les champs ne sont pas renseignés !');
            }
        }
        /* COMMENTS */

        /* ADMIN */
        elseif ($_GET["action"] == "admin")
        { 
            $adminController->displayAdminLoginView();
        }
        elseif ($_GET["action"] == "login")
        {    
            $adminController->logIn($_POST["adminLogin"], $_POST["adminPassword"]);
        }
        elseif ($_GET["action"] == "logout")
        {
            $adminController->logOut();
        }
        /* ADMIN */
    }
    else
    {
        $chaptersController->displayHomePage();
    } 
}
catch(Exception $e) {
    echo 'Erreur : ' . $e->getMessage();
}
