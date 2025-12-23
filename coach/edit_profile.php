<?php
require_once '../includes/check_auth.php';
checkRole('coach');

require_once '../classes/Coach.php';

$coach = new Coach();
$coach->loadByUserId($_SESSION['id_user']);

$success = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $discipline = $_POST['discipline'];
    $annees = $_POST['annees_experience'];
    $description = $_POST['description'];

    if ($coach->updateProfile($nom, $prenom, $discipline, $annees, $description, $_SESSION['id_user'])) {
        $success = "Profil mis à jour avec succès";
        $coach->loadByUserId($_SESSION['id_user']); 
        $_SESSION['user_name'] = $nom . ' ' . $prenom;
    } else {
        $error = "Erreur lors de la mise à jour";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier Profil</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex min-h-screen bg-gray-100">

<?php include '../includes/aside_coach.php'; ?>

<main class="flex-1 lg:ml-72 p-8">
    <h1 class="text-3xl font-bold mb-6">Modifier mon profil</h1>

    <?php if ($success): ?>
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4"><?= $success ?></div>
    <?php endif; ?>

    <?php if ($error): ?>
        <div class="bg-red-100 text-red-700 p-3 rounded mb-4"><?= $error ?></div>
    <?php endif; ?>

    <form method="POST" class="bg-white p-6 rounded-xl shadow max-w-xl space-y-4">

        <div class="grid grid-cols-2 gap-4">
            <input type="text" name="nom" value="<?= htmlspecialchars($coach->getNom()) ?>"
                   class="input" placeholder="Nom" required>

            <input type="text" name="prenom" value="<?= htmlspecialchars($coach->getPrenom()) ?>"
                   class="input" placeholder="Prénom" required>
        </div>

        <input type="text" name="discipline" value="<?= htmlspecialchars($coach->getDiscipline()) ?>"
               class="input" placeholder="Discipline" required>

        <input type="number" name="annees_experience"
               value="<?= htmlspecialchars($coach->getAnneesExperience()) ?>"
               class="input" placeholder="Années d'expérience" required>

        <textarea name="description" rows="4"
                  class="input"><?= htmlspecialchars($coach->getDescription()) ?></textarea>

        <button class="bg-indigo-600 text-white px-6 py-3 rounded-xl hover:bg-indigo-700">
            Enregistrer
        </button>
    </form>
</main>

<style>
.input {
    width: 100%;
    padding: 12px;
    border-radius: 12px;
    border: 1px solid #e5e7eb;
}
</style>

</body>
</html>
