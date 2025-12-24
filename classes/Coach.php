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

    public function getNom()
    {
        return $this->nom;
    }

    public function getPrenom()
    {
        return $this->prenom;
    }
    public function getDiscipline()
    {
        return $this->discipline;
    }

    public function getAnneesExperience()
    {
        return $this->annees_experience;
    }

    public function getDescription()
    {
        return $this->description;
    }
    public function getAll()
    {
        $stmt = $this->conn->query("SELECT * FROM coach");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
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
    public function getIdCoachByUserId($id_user)
    {
        $stmt = $this->conn->prepare(
            "SELECT id_coach FROM coach WHERE id_user = :id_user"
        );
        $stmt->execute(['id_user' => $id_user]);
        return $stmt->fetchColumn();
    }
    public function updateProfile($nom, $prenom, $discipline, $annees, $description, $id_user)
    {
        $stmt = $this->conn->prepare(
            "UPDATE coach 
         SET nom=?, prenom=?, discipline=?, annees_experience=?, description=?
         WHERE id_user=?"
        );
        return $stmt->execute([
            $nom,
            $prenom,
            $discipline,
            $annees,
            $description,
            $id_user
        ]);
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
