<?php

require_once('Manager.php');

class Admin extends Manager
{
    public function getLogins($userName){
        $logins = $db->prepare('SELECT *  FROM connexion WHERE identifiant=?');
        $logins->execute(array($_POST[$userName]));
        return $logins;
    } 
}