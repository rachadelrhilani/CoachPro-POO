<?php
require_once '../includes/check_auth.php';
checkRole('sportif');

require_once '../classes/Reservation.php';
require_once '../classes/Sportif.php';

if (!isset($_GET['id'])) {
    header('Location: dashboard.php');
    exit;
}

$reservation = new Reservation();
$id_seance = $_GET['id'];

$sportif = new Sportif();
$id_sportif = $sportif->getIdSportifByUserId($_SESSION['id_user']);

// protection double réservation
if ($reservation->isSeanceReserved($id_seance)) {
    die(" Cette séance est déjà réservée.");
}

// reservation
$reservation->reserver($id_seance, $id_sportif);

header('Location: mes_reservations.php');
exit;
