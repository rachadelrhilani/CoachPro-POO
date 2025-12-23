<?php
require_once '../config/Database.php';

class Utilisateur
{
    protected $id_user;
    protected $email;
    protected $mot_de_passe;
    protected $role;
    protected $conn;

    public function __construct()
    {
        // récupérer la connexion PDO depuis Database.php
        $this->conn = (new Database())->getConnection();
    }

    public function getIdUser()
    {
        return $this->id_user;
    }

    public function setIdUser($id)
    {
        $this->id_user = $id;
    }

    public function getRole()
    {
        return $this->role;
    }

    public function register($email, $password, $role)
    {
        $stmt = $this->conn->prepare("SELECT id_user FROM utilisateur WHERE email = :email");
        $stmt->execute(['email' => $email]);
        if ($stmt->rowCount() > 0) return false;

        $hashed = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $this->conn->prepare(
            "INSERT INTO utilisateur (email, mot_de_passe, role) VALUES (:email, :mot_de_passe, :role)"
        );
        $stmt->execute([
            'email' => $email,
            'mot_de_passe' => $hashed,
            'role' => $role
        ]);

        $this->id_user = $this->conn->lastInsertId();
        $this->email = $email;
        $this->role = $role;

        return true;
    }

    public function login($email, $password)
    {
        $stmt = $this->conn->prepare("SELECT * FROM utilisateur WHERE email = :email");
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['mot_de_passe'])) {
            $this->id_user = $user['id_user'];
            $this->email = $user['email'];
            $this->role = $user['role'];
            return true;
        }
        return false;
    }
}
