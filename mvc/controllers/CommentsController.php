<?php

require_once('models/CommentsManager.php');
require_once('models/AdminManager.php');
require_once('models/ChaptersManager.php');
require_once('controllers/ChaptersController.php');

class CommentsController
{
    public function addComment(){

        $_POST["pseudo"] = htmlspecialchars($_POST["pseudo"]);
        $_POST["comment"] = htmlspecialchars($_POST["comment"]);
    
        $commentsManager = new CommentsManager();
        $affectedLines = $commentsManager->createComment($_GET['id'], $_POST['pseudo'], $_POST['comment']);

        $chaptersController = new ChaptersController();
    
        if ($affectedLines == false) {
            throw new Exception('Impossible d\'ajouter le commentaire !');
        }
        else {
            header('Location: index.php?action=chapters&id=' . $_GET['id']);
        } 
    }
    
    public function signalComments(){
    
        $commentsManager = new CommentsManager();
        $affectedComment = $commentsManager->signalComment($_GET["comment_id"]);

        $chaptersController = new ChaptersController();
    
        if ($affectedComment == false) {
            throw new Exception('Impossible de signaler le commentaire !');
        }
        else {
            $chaptersController->displayChaptersView($_GET["id"]);
        } 
    }

    public function allowComment(){
        $commentsManager = new CommentsManager();
        $affectedComment = $commentsManager->allowComment($_GET["id"]);
    
        header('Location: index.php?action=adminChapter&amp;id=1');
    }
    
    public function deleteComment(){
        $commentsManager = new CommentsManager();
        $affectedComment = $commentsManager->deleteComment($_GET["id"]);
    
        header('Location: index.php?action=adminChapter&amp;id=1');
    
    }

}