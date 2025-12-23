<?php
require_once 'Utilisateur.php';

class Sportif extends Utilisateur {
    private $nom;
    private $prenom;

    public function __construct() {
        parent::__construct();
    }

    
    public function create($nom, $prenom) {
        if(!$this->id_user) {
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
}
