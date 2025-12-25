<?php
require_once '../includes/check_auth.php';
checkRole('sportif');

require_once '../classes/Seance.php';

$id_coach = $_GET['id'] ?? null;
$seanceObj = new Seance();
$seances = $seanceObj->getAvailableByCoach($id_coach);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Séances</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="flex min-h-screen bg-gray-100">
<?php include '../includes/aside_sportif.php'; ?>

<main class="flex-1 lg:ml-72 p-6">
<h1 class="text-3xl font-bold mb-6">Séances disponibles</h1>

<table class="w-full bg-white rounded-xl shadow">
<thead class="bg-gray-100">
<tr>
<th class="p-3 text-left">Date</th>
<th class="p-3 text-left">Heure</th>
<th class="p-3 text-left">Durée</th>
<th class="p-3 text-left">Action</th>
</tr>
</thead>

<tbody>
<?php foreach ($seances as $s): ?>
<tr class="border-t">
<td class="p-3"><?= htmlspecialchars($s['date_seance']) ?></td>
<td class="p-3"><?= htmlspecialchars($s['heure']) ?></td>
<td class="p-3"><?= htmlspecialchars($s['duree']) ?> min</td>
<td class="p-3">
    <a href="reserver_seance.php?id=<?= htmlspecialchars($s['id_seance']) ?>"
       class="bg-emerald-600 text-white px-4 py-1 rounded">
       Réserver
    </a>
</td>
</tr>
<?php endforeach; ?>
</tbody>
</table>

</main>
</body>
</html>
