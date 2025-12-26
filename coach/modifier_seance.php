<?php
require_once '../includes/check_auth.php';
require_once '../classes/Seance.php';

checkRole('coach');

$seanceObj = new Seance();
$error = $success = "";

$id = $_GET['id'] ?? null;
if (!$id) {
    header('Location: mes_seances.php');
    exit;
}

$seance = $seanceObj->getById($id);
if (!$seance) {
    header('Location: mes_seances.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $date  = $_POST['date'];
    $heure = $_POST['heure'];
    $duree = $_POST['duree'];

    $dateTimeSeance = strtotime($date . ' ' . $heure);

    if ($dateTimeSeance < time()) {
        $error = "❌ La date et l'heure doivent être dans le futur.";
    } elseif ($duree < 15) {
        $error = "❌ La durée minimale est de 15 minutes.";
    } else {
        $seanceObj->update($id, $date, $heure, $duree);
        $success = "✅ Séance mise à jour avec succès.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Modifier séance</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="flex min-h-screen bg-gray-100">

<?php include '../includes/aside_coach.php'; ?>

<main class="flex-1 lg:ml-72 p-6 md:p-10">

    <div class="max-w-xl mx-auto bg-white rounded-2xl shadow-lg p-8">
        <h1 class="text-2xl font-bold text-indigo-600 mb-6">
            Modifier la séance
        </h1>

        <?php if ($error): ?>
            <div class="bg-red-100 text-red-700 p-3 rounded-lg mb-4">
                <?= $error ?>
            </div>
        <?php endif; ?>

        <?php if ($success): ?>
            <div class="bg-green-100 text-green-700 p-3 rounded-lg mb-4">
                <?= $success ?>
            </div>
        <?php endif; ?>

        <form method="POST" class="space-y-5">

            <!-- Date -->
            <div>
                <label class="block font-medium text-gray-700 mb-1">Date</label>
                <input
                    type="date"
                    name="date"
                    value="<?= htmlspecialchars($seance['date_seance']) ?>"
                    required
                    class="w-full px-4 py-3 border rounded-xl focus:ring-2 focus:ring-indigo-500"
                >
            </div>

            <!-- Heure -->
            <div>
                <label class="block font-medium text-gray-700 mb-1">Heure</label>
                <input
                    type="time"
                    name="heure"
                    value="<?= htmlspecialchars($seance['heure']) ?>"
                    required
                    class="w-full px-4 py-3 border rounded-xl focus:ring-2 focus:ring-indigo-500"
                >
            </div>

            <!-- Durée -->
            <div>
                <label class="block font-medium text-gray-700 mb-1">Durée (minutes)</label>
                <input
                    type="number"
                    name="duree"
                    min="15"
                    step="15"
                    value="<?= htmlspecialchars($seance['duree']) ?>"
                    required
                    class="w-full px-4 py-3 border rounded-xl focus:ring-2 focus:ring-indigo-500"
                >
            </div>

            <div class="flex items-center gap-4 pt-4">
                <button
                    type="submit"
                    class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3 rounded-xl transition"
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
