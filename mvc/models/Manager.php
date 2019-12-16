<?php

class Manager
{
    protected function __construct(){
        $this->dbConnect();
    }

    protected function dbConnect()
    {
        $db = new PDO('mysql:host=localhost;dbname=projet4;charset=utf8','root','');
    }    
}
