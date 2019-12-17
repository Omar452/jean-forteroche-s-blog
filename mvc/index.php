<?php
require('controllers/frontendController.php');
require('controllers/backendController.php');


try
{
    if (isset($_GET["action"]))
    {
        $_GET["action"] = htmlspecialchars($_GET["action"]);
        if ($_GET["action"] == "home")
        {
            displayHomePage();
        }
        elseif ($_GET["action"] == "chapters")
        {
            if (isset($_GET["id"]) && $_GET["id"] > 0) 
            {
                $_GET["id"] = htmlspecialchars($_GET["id"]);
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
                $_POST['pseudo'] = htmlspecialchars($_POST['pseudo']);
                $_POST['comment'] = htmlspecialchars($_POST['comment']);

                if (!empty($_POST['pseudo']) && !empty($_POST['comment'])) {
                    addComment($_GET['id'], $_POST['pseudo'], $_POST['comment']);//vérifier les parametres
                }
                else {
                    throw new Exception('Tous les champs ne sont pas remplis !');
                }
            }
        }
    }
    else
    {
        displayHomePage();
    } 
}
catch(Exception $e) {
    echo 'Erreur : ' . $e->getMessage();
}
