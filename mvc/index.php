<?php
session_start();
require('controllers/frontendController.php');
require('controllers/backendController.php');

try
{
    
    if (isset($_GET["action"]))
    {

        /* FRONTEND */
        if ($_GET["action"] == "home")
        {
            displayHomePage();
        }
        elseif ($_GET["action"] == "chapters")
        {
            if (isset($_GET["id"]) && $_GET["id"] > 0) 
            {
                displayChaptersView($_GET["id"]);
            }
            else {
                throw new Exception('Aucun identifiant de chapitre envoyé');
            }
        }
        elseif ($_GET["action"] == "addComment")
        {
            if (isset($_GET["id"]) && $_GET["id"] > 0)
            {
                if (isset($_POST['pseudo']) && isset($_POST['comment'])) {
                    addComment($_GET['id'], $_POST['pseudo'], $_POST['comment']);
                }
                else {
                    throw new Exception('Tous les champs ne sont pas remplis !');
                }
            }
        }
        elseif ($_GET["action"] == "signalComment")
        {
            if (isset($_GET["id"]) && $_GET["id"] > 0 && isset($_GET["comment_id"]) && $_GET["comment_id"] > 0 ) 
            {
                signalComments($_GET["comment_id"]);
            }
            else
            {
                throw new Exception('Aucun identifiant de chapitre ou de commentaire envoyé');
            }
        }
        /* FRONTEND */



        /* BACKEND */

        /* LOG */
        elseif ($_GET["action"] == "admin")
        { 
            displayAdminLoginView();
        }
        elseif ($_GET["action"] == "login")
        {    
            logIn($_POST["adminLogin"], $_POST["adminPassword"]);
        }
        elseif ($_GET["action"] == "logout")
        {
            logOut();
        }
        /* LOG */
        
        /* CHAPTERS */
        elseif ($_GET["action"] == "adminChapter")
        {
            if (isset($_SESSION["adminLogin"]))
            {
                displayAdminChapterView();
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
                addChapters($_POST["title"],$_POST["chapter"]);
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
                displayUpdateChaptersView($_GET["id"]);               
            }
            elseif  (isset($_SESSION["adminLogin"]) && isset($_SESSION["id"]) && isset($_POST["title"]) && isset($_POST["chapter"])) 
            {
                updateChapters($_SESSION["id"], $_POST["title"],$_POST["chapter"]);               
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
                deleteChapters($_GET["id"]);               
            }
            else
            {
                throw new Exception('Tous les champs ne sont pas remplis !');
            }
        }
        /* CHAPTERS */

        /* COMMENTS */
        elseif ($_GET["action"] == "adminComment")
        {
            if (isset($_SESSION["adminLogin"]))
            {
                displayAdminCommentView();
            }
            else
            {
                throw new Exception('Connexion requise pour acceder a cette page');
            }
        }
        elseif ($_GET["action"] == "allowComment")
        {
            if (isset($_SESSION["adminLogin"]) && isset($_GET["id"]) && $_GET["id"] > 0 )
            {
                allowComment($_GET["id"]);
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
                deleteComment($_GET["id"]);
            }
            else
            {
                throw new Exception('Tous les champs ne sont pas renseignés !');
            }
        }

        /* COMMENTS */


        /* BACKEND */
    }
    else
    {
        displayHomePage();
    } 
}
catch(Exception $e) {
    echo 'Erreur : ' . $e->getMessage();
}
