<?php

require_once('Manager.php');

class AdminManager extends Manager
{
    public function getLogins($userName){
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT * FROM connexion WHERE identifiant= ?');
        $req->execute([$userName]);
        return $req->fetch();        
    }
}