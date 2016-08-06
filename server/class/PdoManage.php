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
        $card = $this->db->query('SELECT id, photo, specialite, nom, prenom, ville FROM Students ORDER BY id');
        $data = [];

        while ($donnees = $card->fetch()) {
            array_push($data, [
                "id" => $donnees['id'],
                "nom" => $donnees['nom'],
                "prenom" => $donnees['prenom'],
                "nomPrenom" => $donnees['nom'].' '.$donnees['prenom'],
                "ville" => $donnees['ville'],
                "photo" => $donnees['photo'],
                "specialite" => $donnees['specialite']
            ]);
        }
        return $data;
    }

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
}
