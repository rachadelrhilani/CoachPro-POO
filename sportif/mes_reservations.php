<?php
require_once '../includes/check_auth.php';
checkRole('sportif');

require_once '../classes/Reservation.php';
require_once '../classes/Sportif.php';

$sportif = new Sportif();
$id_sportif = $sportif->getIdSportifByUserId($_SESSION['id_user']);

$reservationModel = new Reservation();

// Annulation
if (isset($_POST['cancel'])) {
    $reservationModel->cancel($_POST['id_reservation'], $id_sportif);
}

$reservations = $reservationModel->getBySportif($id_sportif);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Mes réservations</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex min-h-screen bg-gray-50">

<?php include '../includes/aside_sportif.php'; ?>

<main class="flex-1 lg:ml-72 p-6 md:p-10">

    <h1 class="text-3xl font-bold mb-6">Mes réservations</h1>

    <?php if (empty($reservations)): ?>
        <div class="bg-white p-6 rounded-xl shadow text-gray-500">
            Aucune réservation pour le moment.
        </div>
    <?php else: ?>

    <div class="grid gap-6">
        <?php foreach ($reservations as $r): ?>
            <div class="bg-white p-6 rounded-xl shadow flex justify-between items-center">

                <div>
                    <h3 class="text-lg font-semibold">
                        <?= htmlspecialchars($r['discipline']) ?>
                    </h3>

                    <p class="text-sm text-gray-600">
                        Coach : <?= htmlspecialchars($r['prenom'].' '.$r['nom']) ?>
                    </p>

                    <p class="text-sm text-gray-500">
                        <?= $r['date_seance'] ?> à <?= $r['heure'] ?> • <?= $r['duree'] ?> min
                    </p>
                </div>

                <div class="flex items-center gap-4">
                    <span class="px-3 py-1 rounded-full text-sm
                        <?= $r['statut'] === 'reservee'
                            ? 'bg-emerald-100 text-emerald-700'
                            : 'bg-gray-100 text-gray-600' ?>">
                        <?= ucfirst($r['statut']) ?>
                    </span>

                    <form method="POST" onsubmit="return confirm('Annuler cette réservation ?');">
                        <input type="hidden" name="id_reservation" value="<?= $r['id_reservation'] ?>">
                        <button name="cancel"
                            class="text-red-600 hover:text-red-800 text-sm font-semibold">
                            Annuler
                        </button>
                    </form>
                </div>

            </div>
        <?php endforeach; ?>
    </div>

    <?php endif; ?>

</main>
</body>
</html>
