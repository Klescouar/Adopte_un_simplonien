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
     *  Function verification de connection et envois du niveau de permission
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
     *  Function Create User
    */
    public function createUser($pseudo, $password){
        $verifPseudo = $this->db->prepare('SELECT id FROM user WHERE pseudo = :pseudo');
        $verifPseudo->bindParam('pseudo', $pseudo, PDO::PARAM_STR);
        $verifPseudo->execute();

        $testPseudo = $verifPseudo->fetch();

        if (isset($testPseudo['id'])) {
            return 'pseudo déjà existant';
        } else {
            $password = password_hash($password, PASSWORD_DEFAULT);

            $addUser = $this->db->prepare("INSERT INTO user(pseudo, password, permission) VALUES (:pseudo, :password, :permission) ");
            $addUser->execute(array(
                'pseudo' => $pseudo,
                'password' => $password,
                'permission' => 'visiteur'
            ));

            return 'Ça roule ma poule';
        }
    }
}
