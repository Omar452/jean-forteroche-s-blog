<?php

require_once('models/CommentsManager.php');
require_once('models/AdminManager.php');
require_once('models/ChaptersManager.php');


/* LOG */
function displayAdminLoginView(){

    require("views/backend/adminLoginView.php");
}

function logIn($login, $password){

    $adminManager = new AdminManager();
    $data = $adminManager->getLogins($login);
    $isPasswordCorrect = password_verify($password, $data["passwd"]);
    if ($isPasswordCorrect)
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

/* CHAPTERS */
function displayAdminChapterView(){

    $chaptersManager = new ChaptersManager();
    $allChaptersQuery = $chaptersManager->getAllChapters();

    require('views/backend/adminChaptersView.php');
}

function displayUpdateChaptersView(){
    $_SESSION["id"] = $_GET["id"];
    require("views/backend/updateChaptersView.php");
}

function addChapters(){

    $chaptersManager = new ChaptersManager();
    $affectedLines = $chaptersManager->createChapter($_POST["title"],$_POST["chapter"]);

    if ($affectedLines == false) 
    {
        throw new Exception('Impossible d\'ajouter le chapitre !');
    }
    else
    {
        header('Location: index.php?action=adminChapter');
    } 
}

function deleteChapters(){
    $chaptersManager = new ChaptersManager();
    $affectedChapter = $chaptersManager->deleteChapter($_GET["id"]);

    $commentsManager = new CommentsManager();
    $affectedComments = $commentsManager->deleteAllChapterComments($_GET["id"]);

    header('Location: index.php?action=adminChapter');
}

function updateChapters(){
    $chaptersManager = new ChaptersManager();
    $affectedChapter = $chaptersManager->updateChapter($_SESSION["id"],$_POST["title"],$_POST["chapter"]);
    unset($_SESSION["id"]);

    header('Location: index.php?action=adminChapter');
}
/* CHAPTERS */


/* COMMENTS */
function displayAdminCommentView(){
    $commentsManager = new CommentsManager();
    $commentsQuery = $commentsManager->getSignaledComments();
    require("views/backend/adminCommentView.php");
}

function allowComment(){
    $commentsManager = new CommentsManager();
    $affectedComment = $commentsManager->allowComment($_GET["id"]);

    header('Location: index.php?action=adminComment');
}

function deleteComment(){
    $commentsManager = new CommentsManager();
    $affectedComment = $commentsManager->deleteComment($_GET["id"]);

    header('Location: index.php?action=adminComment');

}
/* COMMENTS */







