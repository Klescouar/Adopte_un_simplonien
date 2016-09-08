<?php

/**
 *  Class connection à la base de donnée
*/
class DBconnect{

    public static function getPDO(){
        $db = new PDO('mysql:host=jeanandrnzbdd.mysql.db;dbname=jeanandrnzbdd;charset=utf8', 'jeanandrnzbdd', 'JeanKev1');
        return $db;
    }
}
