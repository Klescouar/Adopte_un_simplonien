<?php

/**
 *  Class connection à la base de donnée
*/
class DBconnect{

    public static function getPDO(){
        $db = new PDO('mysql:host=localhost;dbname=SimplonTest;charset=utf8', 'root', 'root');
        return $db;
    }
}
