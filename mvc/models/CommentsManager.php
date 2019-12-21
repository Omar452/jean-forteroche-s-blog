<?php

require_once('Manager.php');

class CommentsManager extends Manager
{
    public function getComments($chapter_id)
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('SELECT id, chapter_id, pseudo, comment, DATE_FORMAT(date_creation, "%d/%m/%Y") AS date_fr  FROM comments WHERE chapter_id = :chapter_id');
        $comments->execute(array(
            "chapter_id" => $chapter_id));
        return $comments;
    }

    public function createComment($chapter_id,$pseudo,$content)
    {
        $db = $this->dbConnect();
        $comment = $db->prepare('INSERT INTO comments(chapter_id,pseudo,comment,date_creation,signal_comment,signal_number) VALUES 
        (:chapter_id,:pseudo,:comment,CURDATE(),NULL,0)');
        $comment->execute(array(
            "chapter_id" => htmlspecialchars($chapter_id),
            "pseudo" => htmlspecialchars($pseudo),
            "comment" => htmlspecialchars($content),
        ));
        return $comment;
    }

    public function signalComment($comment_id)
    {
        $db = $this->dbConnect();
        $signaledComment = $db->prepare('UPDATE comments SET signal_comment = true, signal_number = signal_number + 1 WHERE id = ?');
        $signaledComment->execute(array($comment_id));
        return $signaledComment;
    }

    public function allowComment($comment_id)
    {
        $db = $this->dbConnect();
        $moderatedComment = $db->prepare('UPDATE comments SET signal_comment = false WHERE id = ?');
        $moderatedComment->execute(array($comment_id));
        return $moderatedComment;
    }

    public function getSignaledComments()
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('SELECT id, chapter_id, pseudo, comment, 
        DATE_FORMAT(date_creation, "%d/%m/%Y") AS date_fr , signal_number FROM comments WHERE signal_comment=? ORDER BY signal_number DESC');
        $comments->execute(array(true));
        return $comments;
    }

    public function deleteComment($comment_id)
    {
        $db = $this->dbConnect();
        $deletedComment = $db->prepare('DELETE FROM comments WHERE id=?');
        $deletedComment->execute(array($comment_id));
        return $deletedComment;    
    }

    public function deleteAllChapterComments($chapter_id){

        $db = $this->dbConnect();
        $deletedComments = $db->prepare('DELETE FROM comments WHERE chapter_id=?');
        $deletedComments->execute(array($chapter_id));
        return $deletedComment; 
    }
}