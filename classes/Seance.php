<?php
require_once '../config/Database.php';

class Seance
{
    private $conn;

    public function __construct()
    {
        $this->conn = (new Database())->getConnection();
    }
    // 
    public function getAvailableByCoach($id_coach)
    {
        $stmt = $this->conn->prepare("
        SELECT * FROM seance 
        WHERE id_coach = ? AND statut = 'disponible'
        ORDER BY date_seance
    ");
        $stmt->execute([$id_coach]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getByCoach($id_coach)
    {
        $sql = "SELECT * FROM seance WHERE id_coach = :id_coach ORDER BY date_seance DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id_coach' => $id_coach]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function delete($id_seance, $id_coach)
    {
        $sql = "DELETE FROM seance WHERE id_seance = :id_seance AND id_coach = :id_coach";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            'id_seance' => $id_seance,
            'id_coach' => $id_coach
        ]);
    }
    public function countAllByCoach($id_coach)
    {
        $stmt = $this->conn->prepare(
            "SELECT COUNT(*) FROM seance WHERE id_coach = :id_coach"
        );
        $stmt->execute(['id_coach' => $id_coach]);
        return $stmt->fetchColumn();
    }

    public function countByStatus($id_coach, $statut)
    {
        $stmt = $this->conn->prepare(
            "SELECT COUNT(*) FROM seance WHERE id_coach = :id_coach AND statut = :statut"
        );
        $stmt->execute([
            'id_coach' => $id_coach,
            'statut' => $statut
        ]);
        return $stmt->fetchColumn();
    }

    public function countSportifs($id_coach)
    {
        $stmt = $this->conn->prepare("
            SELECT COUNT(DISTINCT r.id_sportif)
            FROM reservation r
            JOIN seance s ON s.id_seance = r.id_seance
            WHERE s.id_coach = :id_coach
        ");
        $stmt->execute(['id_coach' => $id_coach]);
        return $stmt->fetchColumn();
    }

    private function getCoachId($id_user)
    {
        $stmt = $this->conn->prepare(
            "SELECT id_coach FROM coach WHERE id_user = ?"
        );
        $stmt->execute([$id_user]);
        return $stmt->fetchColumn();
    }

    public function create($date, $heure, $duree, $id_user)
    {
        $id_coach = $this->getCoachId($id_user);
        $stmt = $this->conn->prepare(
            "INSERT INTO seance (date_seance, heure, duree, id_coach)
         VALUES (?, ?, ?, ?)"
        );
        return $stmt->execute([$date, $heure, $duree, $id_coach]);
    }

    public function getById($id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM seance WHERE id_seance = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($id, $date, $heure, $duree)
    {
        $stmt = $this->conn->prepare(
            "UPDATE seance SET date_seance=?, heure=?, duree=? WHERE id_seance=?"
        );
        return $stmt->execute([$date, $heure, $duree, $id]);
    }
}
