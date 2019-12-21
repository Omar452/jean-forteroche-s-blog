<?php

require_once('models/ChaptersManager.php');
require_once('models/CommentsManager.php');
require_once('models/AdminManager.php');

function displayHomePage(){
    require('views/frontend/homeView.php');
}

function displayChaptersView()
{
    $chaptersManager = new ChaptersManager();
    $chapterQuery = $chaptersManager->getOneChapter($_GET["id"]);
    $allChaptersQuery = $chaptersManager->getAllChapters();

    $commentsManager = new CommentsManager();
    $commentsQuery = $commentsManager->getComments($_GET["id"]);

    require('views/frontend/chaptersView.php');
}

function addComment(){
    
    $commentsManager = new CommentsManager();
    $affectedLines = $commentsManager->createComment($_GET['id'], $_POST['pseudo'], $_POST['comment']);

    if ($affectedLines == false) {
        throw new Exception('Impossible d\'ajouter le commentaire !');
    }
    else {
        displayChaptersView();
    } 
}

function signalComments(){

    $commentsManager = new CommentsManager();
    $affectedComment = $commentsManager->signalComment($_GET["comment_id"]);

    if ($affectedComment == false) {
        throw new Exception('Impossible de signaler le commentaire !');
    }
    else {
        displayChaptersView($_GET["id"]);
    } 
}


