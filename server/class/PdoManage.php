<?php
/**
 *  Class gestion database
 *
*/
class PdoManage {

    protected $db;

    /**
     *  Constructeur charge l'objet PDO dans db
     *  @param $dp = objet pdo
    */
    public function __construct(PDO $bdd){
        $this->db = $bdd;
    }

    /**
     *  Function verification de connection et envois du niveau de permission
     *  @param $pseudo = STRING pseudo de tentative de connection
     *  @param $password = STRING password hash de tentative de connection
    */
    public function connection($pseudo, $password){
        $verif = $this->db->prepare('SELECT id, password, permission FROM user WHERE pseudo = :pseudo');
        $verif->bindParam('pseudo', $pseudo, PDO::PARAM_STR);
        $verif->execute();

        $infoUser = $verif->fetch();
        $infoPermision = [];

        if (password_verify($password, $infoUser['password'])){
            $infoPermision['pseudo'] = $pseudo;
            $infoPermision['permission'] = $infoUser['permission'];
        } else {
            $infoPermision['permission'] = false;
        }

        return $infoPermision;
    }


    /**
     *  Function affiche info card
    */
    public function getCard(){
        $card = $this->db->query('SELECT id, Photo, SpecialiteUn, SpecialiteDeux, SpecialiteTrois, Nom, Prenom, Ville, Contrat FROM Students ORDER BY id');
        $data = [];

        while ($donnees = $card->fetch()) {
            array_push($data, [
                "id" => $donnees['id'],
                "nom" => $donnees['Nom'],
                "prenom" => $donnees['Prenom'],
                "nomPrenom" => $donnees['Nom'].' '.$donnees['Prenom'],
                "ville" => $donnees['Ville'],
                "photo" => $donnees['Photo'],
                "specialite1" => $donnees['SpecialiteUn'],
                "specialite2" => $donnees['SpecialiteDeux'],
                "specialite3" => $donnees['SpecialiteTrois'],
                "contrat" => $donnees['Contrat']
            ]);
        }
        return $data;
    }

    /**
     *  Function affiche user
    */
    public function getUser(){
        $user = $this->db->query('SELECT id, pseudo, permission FROM user ORDER BY id');
        $data = [];

        while ($donnees = $user->fetch()) {
            array_push($data, [
                "id" => $donnees['id'],
                "pseudo" => $donnees['pseudo'],
                "permission" => $donnees['permission']
            ]);
        }
        return $data;
    }

    /**
     *  Function liste les articles simplonien
    */
    public function getListeArticle(){
        $listeArticle = $this->db->query('SELECT id, prenom, nom, age, ville FROM Students ORDER BY id');
        $data = [];

        while ($donnees = $listeArticle->fetch()) {
            array_push($data, [
                "id" => $donnees['id'],
                "prenom" => $donnees['prenom'],
                "nom" => $donnees['nom'],
                "age" => $donnees['age'],
                "ville" => $donnees['ville']
            ]);
        }

        return $data;
    }

    /**
     *  Function affiche article simplonien
     *  @param $id = INT id de l'article
    */
    public function getArticleSimplonien($id){
        $simplonien = $this->db->prepare('SELECT Prenom, Nom, Age, Ville, Photo, Tags, Description, Sexe, Domaine, SpecialiteUn, SpecialiteDeux, SpecialiteTrois, Github, Linkedin, Portfolio, CV, Twitter, StackOverFlow, Mail, Contrat, DatePromo FROM Students WHERE id = :id');
        $simplonien->bindParam('id', $id, PDO::PARAM_INT);
        $simplonien->execute();

        $data = [];
        $donnees = $simplonien->fetch();
        if (!empty($donnees['Prenom'])) {
            array_push($data, [
                'Prenom' => $donnees['Prenom'],
                'Nom' => $donnees['Nom'],
                'Age' => $donnees['Age'],
                'Ville' => $donnees['Ville'],
                'Photo' => $donnees['Photo'],
                'Tags' => $donnees['Tags'],
                'Description' => $donnees['Description'],
                'Sexe' => $donnees['Sexe'],
                'Domaine' => $donnees['Domaine'],
                'Specialite1' => $donnees['SpecialiteUn'],
                'Specialite2' => $donnees['SpecialiteDeux'],
                'Specialite3' => $donnees['SpecialiteTrois'],
                'Github' => $donnees['Github'],
                'Linkedin' => $donnees['Linkedin'],
                'Portfolio' => $donnees['Portfolio'],
                'CV' => $donnees['CV'],
                'Twitter' => $donnees['Twitter'],
                'StackOverFlow' => $donnees['StackOverFlow'],
                'Mail' => $donnees['Mail'],
                'Contrat' => $donnees['Contrat'],
                'DatePromo' => $donnees['DatePromo']
            ]);
        } else {
            $data = 'Article Simplonien innexistant';
        }

        return $data;
    }


    /**
     *  Function  créer utilisateur
     *  @param $data = Array contient pseudo et password du nouvel utilisateur
    */
    public function createUser(Array $data){
        //Verification que le pseudo est disponible
        $verifPseudo = $this->db->prepare('SELECT id FROM user WHERE pseudo = :pseudo');
        $verifPseudo->bindParam('pseudo', $data['pseudo'], PDO::PARAM_STR);
        $verifPseudo->execute();
        $testPseudo = $verifPseudo->fetch();

        if (isset($testPseudo['id'])) {
            return 'pseudo déjà existant';
        } else {
            $password = password_hash($data['password'], PASSWORD_DEFAULT);

            $addUser = $this->db->prepare("INSERT INTO user(pseudo, password, permission) VALUES (:pseudo, :password, :permission) ");
            $addUser->execute(array(
                'pseudo' => $data['pseudo'],
                'password' => $password,
                'permission' => 'visiteur'
            ));

            return 'Ça roule ma poule';
        }
    }

    /**
     *  Function créer fiche simplonien
     *  @param $data = Array contient les info de l'article simplonien
    */
    public function createSimplonien(Array $info){
       //verification que simplonien n'existe pas déjà
       $verifSimplonien = $this->db->prepare('SELECT id FROM Students WHERE prenom = :prenom && nom = :nom && age = :age');
       $verifSimplonien->bindParam('prenom', $info['prenom'], PDO::PARAM_STR);
       $verifSimplonien->bindParam('nom', $info['nom'], PDO::PARAM_STR);
       $verifSimplonien->bindParam('age', $info['age'], PDO::PARAM_INT);
       $verifSimplonien->execute();
       $testSimplonien = $verifSimplonien->fetch();

       if ($testSimplonien['id']) {
           return 'Simplonien d"jà existant';
       } else {
           $addSimplonien = $this->db->prepare("INSERT INTO Students(Prenom, Nom, Age, Ville, Photo, Tags, Description, Sexe, Domaine, SpecialiteUn, SpecialiteDeux, SpecialiteTrois, Github, Linkedin, Portfolio, CV, Twitter, StackOverFlow, Mail, Contrat, DatePromo) VALUES (:Prenom, :Nom, :Age, :Ville, :Photo, :Tags, :Description, :Sexe, :Domaine, :SpecialiteUn, :SpecialiteDeux, :SpecialiteTrois, :Github, :Linkedin, :Portfolio, :CV, :Twitter, :StackOverFlow, :Mail, :Contrat, :DatePromo) ");
           $addSimplonien->execute(array(
               'Prenom' => $info['prenom'],
               'Nom' => $info['nom'],
               'Age' => $info['age'],
               'Ville' => $info['ville'],
               'Photo' => $info['photo'],
               'Tags' => $info['tags'],
               'Description' => $info['description'],
               'Sexe' => $info['sexe'],
               'Domaine' => $info['domaine'],
               'SpecialiteUn' => $info['specialite1'],
               'SpecialiteDeux' => $info['specialite2'],
               'SpecialiteTrois' => $info['specialite3'],
               'Github' => $info['github'],
               'Linkedin' => $info['linkedin'],
               'Portfolio' => $info['portfolio'],
               'CV' => $info['cV'],
               'Twitter' => $info['twitter'],
               'StackOverFlow' => $info['stack'],
               'Mail' => $info['mail'],
               'Contrat' => $info['contrat'],
               'DatePromo' => $info['datePromo']
           ));

           return $info['prenom'];
       }
   }
    /**
     *  Function supprime utilisateur
     *  @param $id = INT id de l'utilisateur à supprimer
    */
    public function deleteUser($id){
        $delete = $this->db->prepare('DELETE FROM user WHERE id = :id');
        $delete->execute(array('id' => $id));

        return 'utilisateur '.$id.' supprimé';
    }

    /**
     *  Function supprime simplonien
     *  @param $id = INT id du simplonien à supprimer
    */
    public function deleteSimplonien($id){
        $delete = $this->db->prepare('DELETE FROM Students WHERE id = :id');
        $delete->execute(array('id' => $id));

        return 'simplonien '.$id.' supprimé';
    }

    /**
     *  Function modifie article simplonien
     *  @param $id = INT id de l'article simplonien à modifer
     *  @param $info = Array contient les info de l'article simplonien
    */
    public function modifySimplonien($id, Array $info){
        $simplonien = $this->db->prepare('SELECT Prenom, Nom, Age, Ville, Photo, Tags, Description, Sexe, Domaine, SpecialiteUn, SpecialiteDeux, SpecialiteTrois, Github, Linkedin, Portfolio, CV, Twitter, StackOverFlow, Mail, Contrat, DatePromo FROM Students WHERE id = :id');
        $simplonien->bindParam('id', $id, PDO::PARAM_INT);
        $simplonien->execute();

        $donnees = $simplonien->fetch();
        if (!empty($donnees['Prenom'])) {
            $modifySimplonien = $this->db->prepare("UPDATE Students SET Prenom = :Prenom, Nom = :Nom, Age = :Age, Ville = :Ville, Photo = :Photo, Tags = :Tags, Description = :Description, Sexe = :Sexe, Domaine = :Domaine, SpecialiteUn = :SpecialiteUn, SpecialiteDeux = :SpecialiteDeux, SpecialiteTrois = :SpecialiteTrois, Github = :Github, Linkedin = :Linkedin, Portfolio = :Portfolio, CV = :CV, Twitter = :Twitter, StackOverFlow = :StackOverFlow, Mail = :Mail, Contrat = :Contrat, datePromo = :DatePromo WHERE id = :id ");
            $modifySimplonien->execute(array(
                'id' => $id,
                'Prenom' => $info['prenom'],
                'Nom' => $info['nom'],
                'Age' => $info['age'],
                'Ville' => $info['ville'],
                'Photo' => $info['photo'],
                'Tags' => $info['tags'],
                'Description' => $info['description'],
                'Sexe' => $info['sexe'],
                'Domaine' => $info['domaine'],
                'SpecialiteUn' => $info['specialite1'],
                'SpecialiteDeux' => $info['specialite2'],
                'SpecialiteTrois' => $info['specialite3'],
                'Github' => $info['github'],
                'Linkedin' => $info['linkedin'],
                'Portfolio' => $info['portfolio'],
                'CV' => $info['cV'],
                'Twitter' => $info['twitter'],
                'StackOverFlow' => $info['stack'],
                'Mail' => $info['mail'],
                'Contrat' => $info['contrat'],
                'DatePromo' => $info['datePromo']
            ));

            $response = 'Article Simplonien modifié';
        } else {
            $response =' Article Simplonien non trouvé';
        }

        return $info['prenom'];
    }
}
