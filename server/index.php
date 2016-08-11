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

//Renvois card filtré
$app->get('api/cardFiltre', function(Request $filtre) use ($dbManage){
    $data = json_decode($filtre->getContent(), true);
    $filtre->request->replace(is_array($data) ? $data : array());
    $data = $filtre->request->all();

    $champs = ['language','ville','contrat'];
    $info = [];
    $testcaca = [];

    foreach ($champs as $value) {
        if (gettype($data[$value]) == 'array'){
            foreach ($data[$value] as $keyB => $valueB) {
                $info[$value][$keyB] = trim(htmlspecialchars(addslashes($valueB)));
            }
        } else {
            $info[$value] = trim(htmlspecialchars(addslashes($data[$value])));
        }
    }

    for ($i=0; $i < 3; $i++) {
        if(empty($info['language'][$i])){
            $info['language'][$i] = '';
        }
    }

    for ($i=0; $i < 5; $i++) {
        if(empty($info['contrat'][$i])){
            $info['contrat'][$i] = '';
        }
    }

    $cardFiltre = $dbManage->getCardFiltre($info);
    return json_encode($cardFiltre, JSON_PRETTY_PRINT);
});

//Renvois liste d'utilisateur
$app->get('api/user', function() use ($dbManage){
    $user = $dbManage->getUser();
    return json_encode($user, JSON_PRETTY_PRINT);
});

//Renvois Article complet sur un simplonien correspondant à l'id
$app->get('api/simplonien/{id}', function($id) use ($dbManage){
    $id = trim(htmlspecialchars(addslashes($id)));
    $articleSimplonien = $dbManage->getArticleSimplonien($id);

    return json_encode($articleSimplonien, JSON_PRETTY_PRINT);
});

//Renvois liste des article simplonien
$app->get('api/listeSimplonien', function() use ($dbManage){
    $listeArticle = $dbManage->getListeArticle();

    return json_encode($listeArticle, JSON_PRETTY_PRINT);
});

//Renvois liste des Simplon disponible
$app->get('api/villeSimplon', function() use ($dbManage){
    $villeSimplon = $dbManage->getVilleSimplon();

    return json_encode($villeSimplon, JSON_PRETTY_PRINT);
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

//Ajoute Simplon dans la bdd
$app->post('api/create/simplon', function(Request $article) use ($dbManage){
   $data = json_decode($article->getContent(), true);
   $article->request->replace(is_array($data) ? $data : array());
   $data = $article->request->all();

   $info = [];
   $champs = ['ville', 'rue', 'code', 'mail', 'phone'];

   foreach ($champs as $key => $value) {
       if (!empty($data[$value])) {
           $info[$value] = trim(htmlspecialchars(addslashes($data[$value])));
       } else {
           $info[$value] = '';
       }
   }
   $confirmation = $dbManage->createSimplon($info);

   return $confirmation;

});

/////////////////////////* DELETE *///////////////////////////////////
//Supprime un utilisateur de la bdd
$app->delete('api/delete/user/{id}', function($id) use ($dbManage){

    $id = trim(htmlspecialchars(addslashes($id)));
    $deleteUser = $dbManage->deleteUser($id);
    return $deleteUser;
});

//Suprime l'article d'un simplonien
$app->delete('api/delete/simplonien/{id}', function($id) use ($dbManage){

    $id = trim(htmlspecialchars(addslashes($id)));
    $deleteSimplonien = $dbManage->deleteSimplonien($id);
    return $deleteSimplonien;
});

//Supprime un simplon de la bdd
$app->delete('api/delete/simplon/{id}', function($id) use ($dbManage){

    $id = trim(htmlspecialchars(addslashes($id)));
    $deleteSimplon = $dbManage->deleteSimplon($id);
    return $deleteSimplon;
});
/////////////////////////* PUT *///////////////////////////////////
//Modifie la fiche article d'un simplonien
$app->put('api/modify/simplonien/{id}', function(Request $article, $id) use ($dbManage){
    // $id = trim(htmlspecialchars(addslashes($id)));
    $data = json_decode($article->getContent(), true);
    $article->request->replace(is_array($data) ? $data : array());
    $data = $article->request->all();

    $info = [];
    $champs = ['prenom', 'nom', 'age', 'ville', 'photo', 'tags', 'description', 'sexe', 'domaine', 'specialite1', 'specialite2', 'specialite3', 'github', 'linkedin', 'portfolio', 'cV', 'twitter', 'stack', 'mail', 'contrat', 'datePromo'];
    //Sécurité sur les entrées reçus
    foreach ($champs as $key => $value) {
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
