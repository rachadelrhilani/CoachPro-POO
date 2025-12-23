<?php
require_once 'Utilisateur.php';

class Coach extends Utilisateur
{
    private $nom;
    private $prenom;
    private $discipline;
    private $annees_experience;
    private $description;

    public function __construct()
    {
        parent::__construct();
    }

     public function getNom() {
        return $this->nom;
    }

    public function getPrenom() {
        return $this->prenom;
    }
    public function create($nom, $prenom, $discipline, $annees_experience, $description)
    {
        if (!$this->id_user) {
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

    public function loadByUserId($id_user)
    {
        $stmt = $this->conn->prepare("SELECT * FROM coach WHERE id_user = :id_user");
        $stmt->execute(['id_user' => $id_user]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($data) {
            $this->nom = $data['nom'];
            $this->prenom = $data['prenom'];
            $this->discipline = $data['discipline'];
            $this->annees_experience = $data['annees_experience'];
            $this->description = $data['description'];
        }
    }
}
