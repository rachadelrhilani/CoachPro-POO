<?php 
class Reservation
{
    private $conn;

    public function __construct()
    {
        $this->conn = (new Database())->getConnection();
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
}
