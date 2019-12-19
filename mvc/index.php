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
                listChapters();
            }
            else {
                throw new Exception('Aucun identifiant de chapitre envoyé');
            }
        }
        elseif ($_GET["action"] == "addComment")
        {
            if (isset($_GET["id"]) && $_GET["id"] > 0) 
            {
                if (!empty($_POST['pseudo']) && !empty($_POST['comment'])) {
                    addComment($_GET['id'], $_POST['pseudo'], $_POST['comment']);//vérifier les parametres
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
        elseif ($_GET["action"] == "login")
        {    
            logIn($_POST["adminLogin"], $_POST["adminPassword"]);
        }
        elseif ($_GET["action"] == "logout")
        {
            logOut();
        }
        /* LOG */

        /* DISPLAY PAGES */
        elseif ($_GET["action"] == "admin")
        { 
            displayAdminLoginPage();
        }
        elseif ($_GET["action"] == "adminChapter")
        {
            if (isset($_SESSION["adminLogin"]))
            {
                displayAdminChapter();
            }
            else
            {
                throw new Exception('Connexion requise pour acceder a cette page');
            }                
        }
        elseif ($_GET["action"] == "adminComments")
        {
            if (isset($_SESSION["adminLogin"]))
            {
                displayAdminComments(); 
            }
            else
            {
                throw new Exception('Connexion requise pour acceder a cette page');
            }                
        }
        /* DISPLAY PAGES */
        
        /* CHAPTERS */
        elseif ($_GET["action"] == "addChapter")
        {
            if (isset($_POST["title"]) && isset($_POST["chapter"]))
            {
                addChapter($_POST["title"],$_POST["chapter"]);
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
