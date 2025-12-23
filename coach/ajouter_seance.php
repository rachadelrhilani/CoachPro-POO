<?php
require_once '../includes/check_auth.php';
require_once '../classes/Seance.php';

checkRole('coach');

$success = $error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $seance = new Seance();

    if ($seance->create(
        $_POST['date'],
        $_POST['heure'],
        $_POST['duree'],
        $_SESSION['id_user']
    )) {
        $success = "Séance ajoutée avec succès.";
    } else {
        $error = "Erreur lors de l'ajout.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Ajouter séance</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="flex min-h-screen">
<?php include '../includes/aside_coach.php'; ?>

<main class="flex-1 lg:ml-72 p-6">
<h1 class="text-2xl font-bold mb-6">Ajouter une séance</h1>

<?php if ($success): ?>
<p class="text-green-600"><?= $success ?></p>
<?php endif; ?>

<?php if ($error): ?>
<p class="text-red-600"><?= $error ?></p>
<?php endif; ?>

<form method="POST" class="space-y-4 max-w-md">
<input type="date" name="date" required class="input">
<input type="time" name="heure" required class="input">
<input type="number" name="duree" placeholder="Durée (minutes)" required class="input">

<button class="bg-indigo-600 text-white px-6 py-2 rounded">Ajouter</button>
</form>
</main>
</body>
</html>

<style>
.input{width:100%;padding:10px;border:1px solid #ddd;border-radius:8px}
</style>
