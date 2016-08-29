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
     *  Function affiche les card après filtrage
     *  @param $filtre = array contient les filtre
    */
    public function getCardFiltre($filtre){
        $card = $this->db->query('SELECT id, Photo, SpecialiteUn, SpecialiteDeux, SpecialiteTrois, Nom, Prenom, Ville, Contrat FROM Students ORDER BY id');
        $data = [];
        $language1 = $filtre['Langage'][0];
        $language2 = $filtre['Langage'][1];
        $language3 = $filtre['Langage'][2];
        $ville = $filtre['Ville'];
        $contrat1 = $filtre['Contrat'][0];
        $contrat2 = $filtre['Contrat'][1];
        $contrat3 = $filtre['Contrat'][2];
        $contrat4 = $filtre['Contrat'][3];
        $contrat5 = $filtre['Contrat'][4];

        $cardFilterDone = [];
        while ($donnees = $card->fetch()) {
            $recherche = $donnees['SpecialiteUn'].' '.$donnees['SpecialiteDeux'].' '.$donnees['SpecialiteTrois'].' '.$donnees['Ville'].' '.$donnees['Contrat'];
            if(preg_match('/^(?=.*'.$language1.')(?=.*'.$language2.')(?=.*'.$language3.')(?=.*'.$ville.')(?=.*'.$contrat1.')(?=.*'.$contrat2.')(?=.*'.$contrat3.')(?=.*'.$contrat4.')(?=.*'.$contrat5.')/s', $recherche)){
                array_push($cardFilterDone, [
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
        }

        return $cardFilterDone;
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
     *  Function liste les simplon disponible
    */
    public function getVilleSimplon(){
        $listeSimplon = $this->db->query('SELECT id, Ville, Rue, Code, Mail, Phone FROM Ville ORDER BY id');
        $data = [];

        while ($donnees = $listeSimplon->fetch()) {
            array_push($data, [
                "id" => $donnees['id'],
                "ville" => $donnees['Ville'],
                "rue" => $donnees['Rue'],
                "code" => $donnees['Code'],
                "mail" => $donnees['Mail'],
                "phone" => $donnees['Phone']
            ]);
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
                'permission' => 'user'
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
       $verifSimplonien = $this->db->prepare('SELECT id FROM Students WHERE Prenom = :prenom && Nom = :nom && Age = :age');
       $verifSimplonien->bindParam('prenom', $info['prenom'], PDO::PARAM_STR);
       $verifSimplonien->bindParam('nom', $info['nom'], PDO::PARAM_STR);
       $verifSimplonien->bindParam('age', $info['age'], PDO::PARAM_INT);
       $verifSimplonien->execute();
       $testSimplonien = $verifSimplonien->fetch();

       if ($testSimplonien['id']) {
           return 'Simplonien déjà existant';
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

           return $info['prenom'].' Créé';
       }
   }

   /**
    *  Function créer simplon
    *  @param $data = Array contient les info de l'article simplonien
   */
   public function createSimplon(Array $info){
      //verification que simplonien n'existe pas déjà
      $verifSimplon = $this->db->prepare('SELECT id FROM Students WHERE Ville = :ville && Rue = :rue');
      $verifSimplon->bindParam('ville', $info['ville'], PDO::PARAM_STR);
      $verifSimplon->bindParam('rue', $info['rue'], PDO::PARAM_STR);
      $verifSimplon->execute();
      $testSimplon = $verifSimplon->fetch();

      if ($testSimplon['id']) {
          return 'Simplon d"jà existant';
      } else {
          $addSimplon = $this->db->prepare("INSERT INTO Ville(Ville, Rue, Code, Mail, Phone) VALUES (:ville, :rue, :code, :mail, :phone) ");
          $addSimplon->execute(array(
              'ville' => $info['ville'],
              'rue' => $info['rue'],
              'code' => $info['code'],
              'mail' => $info['mail'],
              'phone' => $info['phone']
          ));

          return $info['Ville'].' Créé';
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
     *  Function supprime simplon
     *  @param $id = INT id du simplon à supprimer
    */
    public function deleteSimplon($id){
        $delete = $this->db->prepare('DELETE FROM Ville WHERE id = :id');
        $delete->execute(array('id' => $id));

        return 'simplon '.$id.' supprimé';
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
