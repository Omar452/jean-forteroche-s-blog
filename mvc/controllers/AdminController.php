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

        $_SESSION["succes"] = "login";

        $adminManager = new AdminManager();
        $data = $adminManager->getLogins($login);
        $isPasswordCorrect = password_verify($password, $data["passwd"]);

        $chaptersManager = new ChaptersManager();
        $firstChapterId = $chaptersManager->getFirstChapterId();

        if ($isPasswordCorrect)
        {
            $_SESSION["adminLogin"] = $login;
            header('Location: index.php?action=adminChapter&id=' . $firstChapterId);
        }
        else
        {
            $_SESSION["error"] = true;
            header('Location: index.php?action=admin');
        }
    }

    public function logOut(){

        unset($_SESSION["adminLogin"]);

        $chaptersController = new ChaptersController();
    
        $chaptersController->displayHomePage();
    }
}