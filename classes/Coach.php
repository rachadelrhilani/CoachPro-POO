<?php
require_once 'Utilisateur.php';

class Coach extends Utilisateur {
    private $nom;
    private $prenom;
    private $discipline;
    private $annees_experience;
    private $description;

    public function __construct() {
        parent::__construct();
    }

    public function create($nom, $prenom, $discipline, $annees_experience, $description) {
        if(!$this->id_user) {
            throw new Exception("id_user non défini. Inscription échouée.");
        }

        $stmt = $this->conn->prepare("
            INSERT INTO coach (id_user, nom, prenom, discipline, annees_experience, description) 
            VALUES (:id_user, :nom, :prenom, :discipline, :annees_experience, :description)
        ");
        $stmt->execute([
            'id_user' => $this->id_user,
            'nom' => $nom,
            'prenom' => $prenom,
            'discipline' => $discipline,
            'annees_experience' => $annees_experience,
            'description' => $description
        ]);

        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->discipline = $discipline;
        $this->annees_experience = $annees_experience;
        $this->description = $description;
    }
}
