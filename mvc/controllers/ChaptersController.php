<?php

require_once('models/CommentsManager.php');
require_once('models/AdminManager.php');
require_once('models/ChaptersManager.php');

class ChaptersController
{
    public function displayHomePage(){
        $chaptersManager = new ChaptersManager();
        $_SESSION["firstChapter"] = $chaptersManager->getFirstChapterId();

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
        $chaptersManager = new ChaptersManager();
        $chapterQuery = $chaptersManager->getOneChapter($_GET["id"]);

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
            header('Location: index.php?action=adminChapter&id=' . $affectedLines) ;
        } 
    }
    
    public function deleteChapters(){
        $chaptersManager = new ChaptersManager();
        $affectedChapter = $chaptersManager->deleteChapter($_GET["id"]);
        $firstChapterId = $chaptersManager->getFirstChapterId();
    
        header('Location: index.php?action=adminChapter&id=' . $firstChapterId);
    }
    
    public function updateChapters(){
        $_POST["title"] = htmlspecialchars($_POST["title"]);
        $chaptersManager = new ChaptersManager();
        $affectedChapter = $chaptersManager->updateChapter($_SESSION["id"],$_POST["title"],$_POST["chapter"]);
    
        header('Location: index.php?action=adminChapter&id=' . $_SESSION["id"]);
        unset($_SESSION["id"]);
    }
}