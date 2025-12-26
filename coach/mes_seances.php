<?php
require_once '../includes/check_auth.php';
checkRole('coach');

require_once '../classes/Coach.php';
require_once '../classes/Seance.php';

$coach = new Coach();
$id_coach = $coach->getIdCoachByUserId($_SESSION['id_user']);

$seanceModel = new Seance();

/* Suppression */
if (isset($_GET['delete'])) {
    $seanceModel->delete($_GET['delete'], $id_coach);
    header('Location: mes_seances.php');
    exit;
}

/* liste des séances */
$seances = $seanceModel->getByCoach($id_coach);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Mes séances</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex min-h-screen bg-gray-100">

<?php include '../includes/aside_coach.php'; ?>

<main class="flex-1 lg:ml-72 p-6 md:p-10">
    <h1 class="text-3xl font-bold mb-6">Mes séances</h1>

    <div class="bg-white rounded-xl shadow overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-indigo-600 text-white">
                <tr>
                    <th class="p-3 text-left">Date</th>
                    <th class="p-3 text-left">Heure</th>
                    <th class="p-3 text-left">Durée</th>
                    <th class="p-3 text-left">Statut</th>
                    <th class="p-3 text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($seances)): ?>
                    <tr>
                        <td colspan="5" class="p-4 text-center text-gray-500">
                            Aucune séance trouvée
                        </td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($seances as $s): ?>
                        <tr class="border-b hover:bg-gray-50">
                            <td class="p-3"><?= htmlspecialchars($s['date_seance']) ?></td>
                            <td class="p-3"><?= htmlspecialchars($s['heure']) ?></td>
                            <td class="p-3"><?= htmlspecialchars($s['duree']) ?> min</td>
                            <td class="p-3">
                                <span class="px-3 py-1 rounded-full text-xs
                                    <?= $s['statut'] === 'reservee' ? 'bg-red-100 text-red-600' : 'bg-green-100 text-green-600' ?>">
                                    <?= htmlspecialchars(ucfirst($s['statut'])) ?>
                                </span>
                            </td>
                            <td class="p-3 text-center space-x-2">
                                <a href="modifier_seance.php?id=<?= $s['id_seance'] ?>"
                                   class="text-indigo-600 font-semibold hover:underline">
                                   Modifier
                                </a>
                                <a href="?delete=<?= $s['id_seance'] ?>"
                                   onclick="return confirm('Supprimer cette séance ?')"
                                   class="text-red-600 font-semibold hover:underline">
                                   Supprimer
                                </a>
                            </td>
                        </tr>
                    <?php endforeach ?>
                <?php endif ?>
            </tbody>
        </table>
    </div>
</main>

</body>
</html>
