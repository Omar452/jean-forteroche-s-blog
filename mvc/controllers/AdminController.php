<?php

require_once('models/CommentsManager.php');
require_once('models/AdminManager.php');
require_once('models/ChaptersManager.php');
require_once('controllers/ChaptersController.php');

class AdminController
{
    public function displayAdminLoginView(){

        require("views/backend/adminLoginView.php");
    }

    public function logIn($login, $password){

        $adminManager = new AdminManager();
        $data = $adminManager->getLogins($login);
        $isPasswordCorrect = password_verify($password, $data["passwd"]);

        $chaptersController = new ChaptersController();

        if ($isPasswordCorrect)
        {
            $_SESSION["adminLogin"] = $login;
            $chaptersController->displayAdminChapterView($_GET["id"]);
        }
        else
        {
            $_SESSION["error"] = true;
            require("views/backend/adminLoginView.php");
        }
    }

    public function logOut(){

        unset($_SESSION["adminLogin"]);

        $chaptersController = new ChaptersController();
    
        $chaptersController->displayHomePage();
    }
}