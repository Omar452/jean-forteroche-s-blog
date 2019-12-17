<?php

require_once('models/CommentsManager.php');
require_once('models/AdminManager.php');

function addComment(){
    
    $commentsManager = new CommentsManager();

    $affectedLines = $commentsManager->createComment($_GET['id'], $_POST['pseudo'], $_POST['comment']);

    if ($affectedLines === false) {
        throw new Exception('Impossible d\'ajouter le commentaire !');
    }
    else {
        header('Location: index.php?action=chapters&id=' . $_GET['id']);
    }
    
}