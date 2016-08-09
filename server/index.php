<?php
/*
    Route API REST
*/
header( 'content-type: text/html; charset=utf-8' );

require 'class/PdoManage.php';
require 'class/DBconnect.php';

require_once __DIR__.'/vendor/autoload.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

$app = new Silex\Application();
$db = DBconnect::getPDO();
$dbManage = new PdoManage($db);


/////////////////////////* GET *///////////////////////////////////
//Renvois données pour les card
$app->get('api/card', function() use ($dbManage){
    $card = $dbManage->getCard();
    return json_encode($card, JSON_PRETTY_PRINT);
});

//Renvois liste d'utilisateur
$app->get('api/user', function() use ($dbManage){
    $user = $dbManage->getUser();
    return json_encode($user, JSON_PRETTY_PRINT);
});

//Renvois Article complet sur un simplonien correspondant à l'id
$app->get('api/ArticleSimplonien/{id}', function($id) use ($dbManage){
    $id = trim(htmlspecialchars(addslashes($id)));
    $articleSimplonien = $dbManage->getArticleSimplonien($id);

    return json_encode($articleSimplonien, JSON_PRETTY_PRINT);
});

/////////////////////////* POST *///////////////////////////////////
//Ajoute un utilisateur dans la bdd
$app->post('api/create/user', function(Request $user) use ($dbManage){
    $data = json_decode($user->getContent(), true);
    $user->request->replace(is_array($data) ? $data : array());
    $data = $user->request->all();
    // Sécurité sur les entrées utilisateur
    foreach ($data as $key => $value) {
        $data[$key] = trim(htmlspecialchars(addslashes($value)));
    }

    $confirmation = $dbManage->createUser($data);
    return $confirmation;
});

//Ajoute une fiche simplonien dans la bdd
$app->post('api/create/simplonien', function(Request $article) use ($dbManage){
   $data = json_decode($article->getContent(), true);
   $article->request->replace(is_array($data) ? $data : array());
   $data = $article->request->all();

   $info = [];
   $champs = ['prenom', 'nom', 'age', 'ville', 'photo', 'tags', 'description', 'sexe', 'domaine', 'specialite1', 'specialite2', 'specialite3', 'github', 'linkedin', 'portfolio', 'cV', 'twitter', 'stack', 'mail', 'contrat', 'datePromo'];

   foreach ($champs as $key => $value) {
       if (!empty($data[$value])) {
           $info[$value] = trim(htmlspecialchars(addslashes($data[$value])));
       } else {
           $info[$value] = '';
       }
   }
   $confirmation = $dbManage->createSimplonien($info);

   return $confirmation;

});

/////////////////////////* DELETE *///////////////////////////////////
//Supprime un utilisateur de la bdd
$app->delete('api/delete/user/{id}', function($id) use ($dbManage){

    $id = trim(htmlspecialchars(addslashes($id)));
    $deleteUser = $dbManage->deleteUser($id);
    return $deleteUser;
});

/////////////////////////* PUT *///////////////////////////////////
//Modifie la fiche article d'un simplonien
$app->put('api/modify/ArticleSimplonien', function(Request $article) use ($dbManage){
    // $id = trim(htmlspecialchars(addslashes($id)));
    $data = json_decode($article->getContent(), true);
    $article->request->replace(is_array($data) ? $data : array());
    $data = $article->request->all();

    $info = [];
    $champs = ['prenom', 'nom', 'age', 'ville', 'photo', 'tags', 'description', 'sexe', 'domaine', 'specialite1', 'specialite2', 'specialite3', 'github', 'linkedin', 'portfolio', 'cV', 'twitter', 'stack', 'mail', 'contrat', 'datePromo'];
    //Sécurité sur les entrées reçus
    foreach ($champs as $key => $value) {
        return json_encode($data);
        if (!empty($data[$value])) {
            $info[$value] = trim(htmlspecialchars(addslashes($data[$value])));
        } else {
            $info[$value] = '';
        }
    }

    $modifySimplonien = $dbManage->modifySimplonien($id, $info);
    return $modifySimplonien;
});

$app->run();
