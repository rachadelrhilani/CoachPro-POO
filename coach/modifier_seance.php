<?php
require_once '../includes/check_auth.php';
require_once '../classes/Seance.php';

checkRole('coach');

$seanceObj = new Seance();
$id = $_GET['id'] ?? null;

if (!$id) {
    header('Location: mes_seances.php');
    exit;
}

$seance = $seanceObj->getById($id);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $seanceObj->update(
        $id,
        $_POST['date'],
        $_POST['heure'],
        $_POST['duree']
    );
    header('Location: mes_seances.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Modifier séance</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="flex min-h-screen">
<?php include '../includes/aside_coach.php'; ?>

<main class="flex-1 lg:ml-72 p-6 md:p-10 bg-gray-50 min-h-screen">

    <div class="max-w-xl bg-white rounded-2xl shadow-lg p-8">
        <h1 class="text-2xl font-bold text-indigo-600 mb-6">
            Modifier la séance
        </h1>

        <form method="POST" class="space-y-5">

            <!-- Date -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Date de la séance
                </label>
                <input
                    type="date"
                    name="date"
                    value="<?= htmlspecialchars($seance['date_seance']) ?>"
                    required
                    class="w-full px-4 py-3 border rounded-xl focus:ring-2 focus:ring-indigo-500 focus:outline-none"
                >
            </div>

            <!-- Heure -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Heure
                </label>
                <input
                    type="time"
                    name="heure"
                    value="<?= htmlspecialchars($seance['heure']) ?>"
                    required
                    class="w-full px-4 py-3 border rounded-xl focus:ring-2 focus:ring-indigo-500 focus:outline-none"
                >
            </div>

            <!-- Durée -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Durée (en minutes)
                </label>
                <input
                    type="number"
                    name="duree"
                    min="15"
                    step="15"
                    value="<?= htmlspecialchars($seance['duree']) ?>"
                    required
                    class="w-full px-4 py-3 border rounded-xl focus:ring-2 focus:ring-indigo-500 focus:outline-none"
                >
            </div>

            <!-- Boutons -->
            <div class="flex items-center gap-4 pt-4">
                <button
                    type="submit"
                    class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-6 py-3 rounded-xl transition"
                >
                    Mettre à jour
                </button>

                <a href="mes_seances.php"
                   class="text-gray-600 hover:text-indigo-600 font-medium">
                    Annuler
                </a>
            </div>

        </form>
    </div>

</main>

</body>
</html>
