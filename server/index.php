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

$app->post('api/create/simplonien', function(Request $article) use ($dbManage){
    $champs = ['prenom', 'nom', 'age', 'ville', 'photo', 'tags', 'description', 'sexe', 'domaine', 'specialite1', 'specialite2', 'specialite3', 'github', 'linkedin', 'portfolio', 'cV', 'twitter', 'stack', 'mail', 'contrat', 'datePromo'];

    foreach ($champs as $key => $value) {
        if (!empty($article->get($value))) {
            $info[$value] = trim(htmlspecialchars(addslashes($article->get($value))));
        } else {
            $info[$value] = '';
        }
    }
    $confirmation = $dbManage->createSimplonien($info);

    return $confirmation;

});

$app->run();
