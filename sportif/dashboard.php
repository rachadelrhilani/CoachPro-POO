<?php
require_once '../includes/check_auth.php';
checkRole('sportif');

require_once '../classes/Sportif.php';
require_once '../classes/Reservation.php';

$idUser = $_SESSION['id_user'];
$sportif = new Sportif();
$idSportif = $sportif->getIdSportifByUserId($idUser);
$reservation = new Reservation();

$total       = $reservation->countBySportif($idSportif);
$aVenir      = $reservation->countAVenir($idSportif);
$terminees   = $reservation->countTerminees($idSportif);
$prochaine   = $reservation->getProchaineReservation($idSportif);


?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Sportif</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex min-h-screen bg-gray-100">

<?php include '../includes/aside_sportif.php'; ?>

<main class="flex-1 lg:ml-72 p-6 md:p-10 space-y-8">

    <div>
        <h1 class="text-3xl font-bold">Dashboard</h1>
        <p class="text-gray-600 mt-1">
            Bienvenue <?= htmlspecialchars($_SESSION['user_name'] ?? 'Sportif') ?> 
        </p>
    </div>

    
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white p-6 rounded-xl shadow">
            <p class="text-gray-500">Séances réservées</p>
            <p class="text-3xl font-bold text-indigo-600"><?= htmlspecialchars($total) ?></p>
        </div>

        <div class="bg-white p-6 rounded-xl shadow">
            <p class="text-gray-500">Séances à venir</p>
            <p class="text-3xl font-bold text-green-600"><?= htmlspecialchars($aVenir) ?></p>
        </div>

        <div class="bg-white p-6 rounded-xl shadow">
            <p class="text-gray-500">Séances terminées</p>
            <p class="text-3xl font-bold text-gray-700"><?= htmlspecialchars($terminees) ?></p>
        </div>
    </div>

    
    <div class="bg-white rounded-xl shadow p-6">
        <h2 class="text-xl font-semibold mb-4">Prochaine séance</h2>

        <?php if ($prochaine): ?>
            <div class="flex items-center justify-between">
                <div>
                    <p class="font-semibold">
                        <?= htmlspecialchars($prochaine['nom']) ?>
                        <?= htmlspecialchars($prochaine['prenom']) ?>
                    </p>
                    <p class="text-gray-600">
                        <?= date('d/m/Y', strtotime($prochaine['date_seance'])) ?>
                        à <?= $prochaine['heure'] ?>
                    </p>
                </div>

                <span class="px-3 py-1 rounded-full bg-green-100 text-green-700 text-sm">
                    À venir
                </span>
            </div>
        <?php else: ?>
            <p class="text-gray-500">Aucune séance programmée</p>
        <?php endif; ?>
    </div>

</main>
</body>
</html>
