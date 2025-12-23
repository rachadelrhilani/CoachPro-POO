<?php
require_once '../config/Database.php';

class Seance {
    private $conn;

    public function __construct() {
        $this->conn = (new Database())->getConnection();
    }
    public function getByCoach($id_coach) {
        $sql = "SELECT * FROM seance WHERE id_coach = :id_coach ORDER BY date_seance DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id_coach' => $id_coach]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function delete($id_seance, $id_coach) {
        $sql = "DELETE FROM seance WHERE id_seance = :id_seance AND id_coach = :id_coach";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            'id_seance' => $id_seance,
            'id_coach' => $id_coach
        ]);
    }
    public function countAllByCoach($id_coach) {
        $stmt = $this->conn->prepare(
            "SELECT COUNT(*) FROM seance WHERE id_coach = :id_coach"
        );
        $stmt->execute(['id_coach' => $id_coach]);
        return $stmt->fetchColumn();
    }

    public function countByStatus($id_coach, $statut) {
        $stmt = $this->conn->prepare(
            "SELECT COUNT(*) FROM seance WHERE id_coach = :id_coach AND statut = :statut"
        );
        $stmt->execute([
            'id_coach' => $id_coach,
            'statut' => $statut
        ]);
        return $stmt->fetchColumn();
    }

    public function countSportifs($id_coach) {
        $stmt = $this->conn->prepare("
            SELECT COUNT(DISTINCT r.id_sportif)
            FROM reservation r
            JOIN seance s ON s.id_seance = r.id_seance
            WHERE s.id_coach = :id_coach
        ");
        $stmt->execute(['id_coach' => $id_coach]);
        return $stmt->fetchColumn();
    }
}
