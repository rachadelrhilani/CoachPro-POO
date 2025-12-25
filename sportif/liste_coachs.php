<?php
require_once '../includes/check_auth.php';
checkRole('sportif');

require_once '../classes/Coach.php';
$coachObj = new Coach();
$coachs = $coachObj->getAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Liste des coachs</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="flex min-h-screen bg-gray-100">
<?php include '../includes/aside_sportif.php'; ?>

<main class="flex-1 lg:ml-72 p-6">
<h1 class="text-3xl font-bold mb-6">Coachs disponibles</h1>

<div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
<?php foreach ($coachs as $coach): ?>
<div class="bg-white p-5 rounded-xl shadow">
    <h2 class="text-xl font-semibold">
        <?= htmlspecialchars($coach['nom']) ?> <?= htmlspecialchars($coach['prenom']) ?>
    </h2>
    <p class="text-sm text-gray-500"><?= htmlspecialchars($coach['discipline']) ?></p>
    <p class="mt-2 text-gray-600"><?= htmlspecialchars($coach['description']) ?></p>

    <a href="detail_coach.php?id=<?= htmlspecialchars($coach['id_coach']) ?>"
       class="inline-block mt-4 text-indigo-600 font-semibold">
       Voir séances →
    </a>
</div>
<?php endforeach; ?>
</div>

</main>
</body>
</html>
