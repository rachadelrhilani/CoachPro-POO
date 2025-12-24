<?php
require_once 'Utilisateur.php';

class Sportif extends Utilisateur
{
    private $nom;
    private $prenom;

    public function __construct()
    {
        parent::__construct();
    }


    public function create($nom, $prenom)
    {
        if (!$this->id_user) {
            throw new Exception("id_user non défini. Inscription échouée.");
        }

        $stmt = $this->conn->prepare("
            INSERT INTO sportif (id_user, nom, prenom) 
            VALUES (:id_user, :nom, :prenom)
        ");
        $stmt->execute([
            'id_user' => $this->id_user,
            'nom' => $nom,
            'prenom' => $prenom
        ]);

        $this->nom = $nom;
        $this->prenom = $prenom;
    }
    public function getIdSportifByUserId($id_user)
    {
        $stmt = $this->conn->prepare(
            "SELECT id_sportif 
             FROM sportif 
             WHERE id_user = ?"
        );

        $stmt->execute([$id_user]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result ? $result['id_sportif'] : null;
    }
    public function loadByUserId($id_user)
    {
        $stmt = $this->conn->prepare("SELECT * FROM sportif WHERE id_user = :id_user");
        $stmt->execute(['id_user' => $id_user]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($data) {
            $this->nom = $data['nom'];
            $this->prenom = $data['prenom'];
        }
    }
     public function getNom() {
        return $this->nom;
    }

    public function getPrenom() {
        return $this->prenom;
    }
}
