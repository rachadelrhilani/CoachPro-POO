<?php
require_once '../includes/check_auth.php';
checkRole('sportif');

require_once '../classes/Reservation.php';
require_once '../classes/Sportif.php';

$id_seance = $_GET['id'] ?? null;

$sportifObj = new Sportif();
$id_sportif = $sportifObj->loadByUserId($_SESSION['id_user']);

$reservation = new Reservation();
$reservation->reserver($id_seance, $id_sportif);

header('Location: mes_reservations.php');
exit;
