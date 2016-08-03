<?php
header( 'content-type: text/html; charset=utf-8' );

require 'class/PdoManage.php';
require 'class/DBconnect.php';

require_once __DIR__.'/vendor/autoload.php';



$app = new Silex\Application();
$db = DBconnect::getPDO();
$dbManage = new PdoManage($db);

$app->get('api/card', function () use ($dbManage){
    $card = $dbManage->getCard();

    return json_encode($card, JSON_PRETTY_PRINT);
});

$app->get('api/hello/', function ($name) use ($app) {
    return 'Hello ' . $app->escape($name);
});

$app->run();
