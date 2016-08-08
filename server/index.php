<?php
header( 'content-type: text/html; charset=utf-8' );

require 'class/PdoManage.php';
require 'class/DBconnect.php';

require_once __DIR__.'/vendor/autoload.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

$app = new Silex\Application();
$db = DBconnect::getPDO();
$dbManage = new PdoManage($db);

$app->get('api/card', function() use ($dbManage){
    $card = $dbManage->getCard();

    return json_encode($card, JSON_PRETTY_PRINT);
});

$app->post('api/create/user', function(Request $user) use ($dbManage){
    $login = $user->post('pseudo');
    $mdp = trim(htmlspecialchars(addslashes($user->get('password'))));
    $confirmation = $dbManage->createUser($login, $mdp);

    return $login;
});

$app->run();
