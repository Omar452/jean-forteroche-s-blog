<?php

require_once('models/CommentsManager.php');
require_once('models/AdminManager.php');
require_once('models/ChaptersManager.php');

class ChaptersController
{
    public function displayHomePage(){
        require('views/frontend/homeView.php');
    }

    public function displayChaptersView(){
        $chaptersManager = new ChaptersManager();
        $chapterQuery = $chaptersManager->getOneChapter($_GET["id"]);
        $allChaptersQuery = $chaptersManager->getAllChapters();

        $commentsManager = new CommentsManager();
        $commentsQuery = $commentsManager->getComments($_GET["id"]);

        require('views/frontend/chaptersView.php');
    }

    public function displayAdminChapterView(){

        $chaptersManager = new ChaptersManager();
        $chapterQuery = $chaptersManager->getOneChapter($_GET["id"]);
        $allChaptersQuery = $chaptersManager->getAllChapters();
    
        $commentsManager = new CommentsManager();
        $commentsQuery = $commentsManager->getSignaledComments();
    
        require('views/backend/adminChaptersView.php');
    }
    
    public function displayUpdateChaptersView(){
        $_SESSION["id"] = $_GET["id"];
        require("views/backend/updateChaptersView.php");
    }
    
    public function addChapters(){
        $_POST["title"] = htmlspecialchars($_POST["title"]);
        $chaptersManager = new ChaptersManager();
        $affectedLines = $chaptersManager->createChapter($_POST["title"],$_POST["chapter"]);
    
        if ($affectedLines == false) 
        {
            throw new Exception('Impossible d\'ajouter le chapitre !');
        }
        else
        {
            header('Location: index.php?action=adminChapter&amp;id=1');
        } 
    }
    
    public function deleteChapters(){
        $chaptersManager = new ChaptersManager();
        $affectedChapter = $chaptersManager->deleteChapter($_GET["id"]);
    
        $commentsManager = new CommentsManager();
        $affectedComments = $commentsManager->deleteAllChapterComments($_GET["id"]);
    
        header('Location: index.php?action=adminChapter&amp;id=1');
    }
    
    public function updateChapters(){
        $_POST["title"] = htmlspecialchars($_POST["title"]);
        $chaptersManager = new ChaptersManager();
        $affectedChapter = $chaptersManager->updateChapter($_SESSION["id"],$_POST["title"],$_POST["chapter"]);
        unset($_SESSION["id"]);
    
        header('Location: index.php?action=adminChapter&amp;id=1');
    }
}