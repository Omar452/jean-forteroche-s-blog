<?php

require_once('models/ChaptersManager.php');
require_once('models/CommentsManager.php');
require_once('models/AdminManager.php');

function displayHomePage(){
    require('views/frontend/homeView.php');
}

function listChapters()
{
    $chaptersManager = new ChaptersManager();
    $chapterQuery = $chaptersManager->getOneChapter($_GET["id"]);
    $allChaptersQuery = $chaptersManager->getAllChapters();

    $commentsManager = new CommentsManager();
    $commentsQuery = $commentsManager->getComments($_GET["id"]);

    require('views/frontend/chaptersView.php');
}



