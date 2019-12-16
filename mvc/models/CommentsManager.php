<?php

require_once('Manager.php');

class CommentsManager extends Manager
{
    public function getComments($chapter_id)
    {
        $comments = $db->prepare('SELECT id, chapter_id, pseudo, comment, DATE_FORMAT(date_creation, "%d/%m/%Y") AS date_fr  FROM comments WHERE chapter_id =?');
        $comments->execute(array($chapter_id));
        return $comments;
    }

    public function createComment($chapter_id,$pseudo,$content)
    {
        $comment = $db->prepare('INSERT INTO comments(chapter_id,pseudo,comment,date_creation,signal_comment) VALUES 
        (:chapter_id,:pseudo,:comment,CURDATE(),NULL)');
        $comment->execute(array(
            "chapter_id" => htmlspecialchars($chapter_id),
            "pseudo" => htmlspecialchars($pseudo),
            "comment" => htmlspecialchars($content),
        ));
        return $comment;
    }

    public function signalComment($comment_id)
    {
        $signaledComment = $db->prepare('UPDATE comments SET signal_comment = true WHERE id = ?');
        $signaledComment->execute(array($comment_id));
        return $signaledComment;
    }

    public function moderateComment($comment_id)
    {
        $moderatedComment = $db->prepare('UPDATE comments SET signal_comment = false WHERE id = ?');
        $moderatedComment->execute(array($comment_id));
        return $moderatedComment;
    }

    public function getSignaledComments()
    {
        $signaledComments = $db->prepare('SELECT id, chapter_id, pseudo, comment, DATE_FORMAT(date_creation, "%d/%m/%Y") AS date_fr  FROM comments WHERE signal_comment=?');
        $signaledComments->execute(array(true));
        return $signaledComments;
    }

    public function deleteChapter($comment_id)
    {
        $deletedComment = $db->prepare('DELETE FROM comments WHERE id=?');
        $deletedComment->execute(array($comment_id));
        return $deletedComment;    
    }
}