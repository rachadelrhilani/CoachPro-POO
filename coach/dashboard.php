<?php
require_once '../includes/check_auth.php';
checkRole('coach');

require_once '../classes/Coach.php';
require_once '../classes/Seance.php';

$coach = new Coach();
$id_coach = $coach->getIdCoachByUserId($_SESSION['id_user']);

$seance = new Seance();

$totalSeances = $seance->countAllByCoach($id_coach);
$seancesReservees = $seance->countByStatus($id_coach, 'reservee');
$seancesDisponibles = $seance->countByStatus($id_coach, 'disponible');
$totalSportifs = $seance->countSportifs($id_coach);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Coach</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex min-h-screen bg-gray-50">

<?php include '../includes/aside_coach.php'; ?>

<main class="flex-1 lg:ml-72 p-6 md:p-10 space-y-8">

    <div>
        <h1 class="text-3xl font-bold text-gray-800">
            Bonjour <?= $_SESSION['user_name'] ?> 👋
        </h1>
        <p class="text-gray-500">Voici vos statistiques réelles</p>
    </div>

    <!-- STATS RÉELLES -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

        <div class="bg-white p-6 rounded-2xl shadow">
            <p class="text-sm text-gray-500">Total séances</p>
            <p class="text-3xl font-bold text-indigo-600 mt-2">
                <?= $totalSeances ?>
            </p>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow">
            <p class="text-sm text-gray-500">Séances réservées</p>
            <p class="text-3xl font-bold text-green-600 mt-2">
                <?= $seancesReservees ?>
            </p>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow">
            <p class="text-sm text-gray-500">Séances disponibles</p>
            <p class="text-3xl font-bold text-blue-600 mt-2">
                <?= $seancesDisponibles ?>
            </p>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow">
            <p class="text-sm text-gray-500">Sportifs inscrits</p>
            <p class="text-3xl font-bold text-purple-600 mt-2">
                <?= $totalSportifs ?>
            </p>
        </div>

    </div>

</main>
</body>
</html>
