<?php

require_once('models/CommentsManager.php');
require_once('models/AdminManager.php');
require_once('models/ChaptersManager.php');


/* LOG */
function logIn($login, $password){

    $adminManager = new AdminManager();
    $data = $adminManager->getLogins($login);
    if ($password == $data["passwd"])
    {
        $_SESSION["adminLogin"] = $login;
        displayHomePage();
    }
    else
    {
        $_SESSION["error"] = true;
        require("views/backend/adminLoginView.php");
    }
}

function logOut(){

    unset($_SESSION["adminLogin"]);
    session_destroy();

    displayHomePage();
}
/* LOG */



/* DISPLAY PAGES */
function displayAdminLoginPage(){

    require("views/backend/adminLoginView.php");
}

function displayAdminChapter(){

    $chaptersManager = new ChaptersManager();
    $allChaptersQuery = $chaptersManager->getAllChapters();

    require('views/backend/adminChaptersView.php');
}
/* DISPLAY PAGES */



/* CHAPTERS */
function addChapter(){

    $chaptersManager = new ChaptersManager();
    $affectedLines = $chaptersManager->createChapter($_POST["title"],$_POST["chapter"]);

    if ($affectedLines == false) 
    {
        throw new Exception('Impossible d\'ajouter le chapitre !');
    }
    else
    {
        require('views/backend/adminChaptersView.php');
    } 
}

function deleteChapters(){
    $chaptersManager = new ChaptersManager();
    $affectedChapter = $chaptersManager->deleteChapter($_GET["id"]);
}
/* CHAPTERS */



/* COMMENTS */
function addComment(){
    
    $commentsManager = new CommentsManager();
    $affectedLines = $commentsManager->createComment($_GET['id'], $_POST['pseudo'], $_POST['comment']);

    if ($affectedLines == false) {
        throw new Exception('Impossible d\'ajouter le commentaire !');
    }
    else {
        header('Location: index.php?action=chapters&id=' . $_GET['id']);
    } 
}

function signalComments(){

    $commentsManager = new CommentsManager();
    $affectedComment = $commentsManager->signalComment($_GET["comment_id"]);

    if ($affectedComment == false) {
        throw new Exception('Impossible de signaler le commentaire !');
    }
    else {
        require('index.php?action=chapters&id=' . $_GET['id']);
    } 
}
/* COMMENTS */







