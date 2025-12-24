<?php
class Reservation
{
    private $conn;

    public function __construct()
    {
        $this->conn = (new Database())->getConnection();
    }
    /* annuler la reservation */
    public function cancel($id_reservation, $id_sportif)
    {
        // récupérer la séance liée
        $stmt = $this->conn->prepare("
            SELECT id_seance FROM reservation
            WHERE id_reservation = ? AND id_sportif = ?
        ");
        $stmt->execute([$id_reservation, $id_sportif]);
        $id_seance = $stmt->fetchColumn();

        if (!$id_seance) return false;


        $this->conn->prepare(
            "DELETE FROM reservation WHERE id_reservation = ?"
        )->execute([$id_reservation]);


        $this->conn->prepare(
            "UPDATE seance SET statut = 'disponible' WHERE id_seance = ?"
        )->execute([$id_seance]);

        return true;
    }
    public function reserver($id_seance, $id_sportif)
    {
        $this->conn->beginTransaction();

        $stmt = $this->conn->prepare(
            "INSERT INTO reservation (id_seance, id_sportif) VALUES (?, ?)"
        );
        $stmt->execute([$id_seance, $id_sportif]);

        $stmt2 = $this->conn->prepare(
            "UPDATE seance SET statut='reservee' WHERE id_seance=?"
        );
        $stmt2->execute([$id_seance]);

        $this->conn->commit();
        return true;
    }
    public function isSeanceReserved($id_seance)
    {
        $stmt = $this->conn->prepare(
            "SELECT COUNT(*) FROM reservation WHERE id_seance = ?"
        );
        $stmt->execute([$id_seance]);
        return $stmt->fetchColumn() > 0;
    }
    public function getBySportif($id_sportif)
    {
        $stmt = $this->conn->prepare("
            SELECT r.id_reservation, r.date_reservation,
                   s.date_seance, s.heure, s.duree, s.statut,
                   c.nom, c.prenom, c.discipline
            FROM reservation r
            JOIN seance s ON s.id_seance = r.id_seance
            JOIN coach c ON c.id_coach = s.id_coach
            WHERE r.id_sportif = :id_sportif
            ORDER BY s.date_seance DESC
        ");
        $stmt->execute(['id_sportif' => $id_sportif]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function countBySportif($id_sportif)
    {
        $stmt = $this->conn->prepare(
            "SELECT COUNT(*) FROM reservation WHERE id_sportif = ?"
        );
        $stmt->execute([$id_sportif]);
        return $stmt->fetchColumn();
    }
    public function countAVenir($id_sportif)
    {
        $stmt = $this->conn->prepare("
        SELECT COUNT(*)
        FROM reservation r
        JOIN seance s ON r.id_seance = s.id_seance
        WHERE r.id_sportif = ?
        AND CONCAT(s.date_seance, ' ', s.heure) >= NOW()
    ");
        $stmt->execute([$id_sportif]);
        return $stmt->fetchColumn();
    }
    public function countTerminees($id_sportif)
    {
        $stmt = $this->conn->prepare("
        SELECT COUNT(*)
        FROM reservation r
        JOIN seance s ON r.id_seance = s.id_seance
        WHERE r.id_sportif = ?
        AND CONCAT(s.date_seance, ' ', s.heure) < NOW()
    ");
        $stmt->execute([$id_sportif]);
        return $stmt->fetchColumn();
    }
}
