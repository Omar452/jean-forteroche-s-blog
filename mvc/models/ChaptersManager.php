<?php

require_once('Manager.php');

class ChaptersManager extends Manager
{
    public function getChapters()
    {
        $chapters = $db->prepare('SELECT id, title, chapter FROM chapters');
        return $chapters;
    }

    public function getChapter($chapter_id)
    {
        $chapter = $db->prepare('SELECT id, title, chapter FROM chapters WHERE id=?');
        $chapter->execute(array($chapter_id));
        return $chapter;
    }

    public function createChapter($chapter_title,$chapter_content)
    {
        $chapter = $db->prepare("INSERT INTO chapters(title, chapter) VALUES(:title, :chapter)");
        $chapter->execute(array(
            "title" => $chapter_title,
            "chapter" => $chapter_content
        ));
        return $chapter;
    }

    public function updateChapter($chapter_id,$chapter_title,$chapter_content)
    {
        $chapter = $db->prepare('UPDATE chapters SET title = :title, chapter = :chapter WHERE id = :id');
        $chapter->execute(array(
            "title" => $chapter_title,
            "chapter" => $chapter_content,
            "id" => $chapter_id
        ));

    }

    public function deleteChapter($chapter_id)
    {
        $chapter = $db->prepare('DELETE FROM chapters WHERE id=?');
        $chapter->execute(array($chapter_id));
    }
}