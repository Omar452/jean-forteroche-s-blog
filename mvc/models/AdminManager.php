<?php

require_once('Manager.php');

class AdminManager extends Manager
{
    public function getLogins($userName){
        $logins = $db->prepare('SELECT *  FROM connexion WHERE identifiant=?');
        $logins->execute(array($_POST[$userName]));
        return $logins;
    } 
}