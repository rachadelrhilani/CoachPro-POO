<?php 
require_once '../includes/check_auth.php';
require_once '../classes/Seance.php';

checkRole('coach');

$success = 
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $date  = $_POST['date'] ?? '';
    $heure = $_POST['heure'] ?? '';
    $duree = $_POST['duree'] ?? '';

    // validation backend
    if (strtotime($date) < strtotime(date('Y-m-d'))) {
        $error = "La date doit être aujourd'hui ou ultérieure.";
    } elseif ($duree <= 0) {
        $error = "La durée doit être supérieure à 0.";
    } else {
        $seance = new Seance();
        if ($seance->create($date, $heure, $duree, $_SESSION['id_user'])) {
            $success = " Séance ajoutée avec succès.";
        } else {
            $error = " Erreur lors de l'ajout de la séance.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Ajouter une séance</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="flex min-h-screen bg-gray-100">

<?php include '../includes/aside_coach.php'; ?>

<main class="flex-1 lg:ml-72 p-6 flex justify-center items-start">

  <div class="bg-white w-full max-w-lg p-8 rounded-xl shadow-lg">
    
    <h1 class="text-2xl font-bold text-indigo-600 mb-6 text-center">
       Ajouter une séance
    </h1>

    <?php if ($success): ?>
      <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
        <?= $success ?>
      </div>
    <?php endif; ?>

    <?php if ($error): ?>
      <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
        <?= $error ?>
      </div>
    <?php endif; ?>

    <form method="POST" class="space-y-5">

      <div>
        <label class="block text-sm font-semibold mb-1">Date</label>
        <input 
          type="date" 
          name="date"
          min="<?= date('Y-m-d') ?>"
          required
          class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500"
        >
      </div>

      <div>
        <label class="block text-sm font-semibold mb-1">Heure</label>
        <input 
          type="time" 
          name="heure" 
          required
          class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500"
        >
      </div>

      <div>
        <label class="block text-sm font-semibold mb-1">Durée (minutes)</label>
        <input 
          type="number" 
          name="duree" 
          min="15"
          step="5"
          placeholder="Ex: 60"
          required
          class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500"
        >
      </div>

      <button
        class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-3 rounded-lg transition">
         Ajouter la séance
      </button>

    </form>
  </div>
</main>

</body>
</html>
