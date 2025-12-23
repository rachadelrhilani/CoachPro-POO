<?php
require_once '../includes/check_auth.php';
require_once '../classes/Coach.php';

checkRole('coach');

$coach = new Coach();
$coachData = $coach->getIdCoachByUserId($_SESSION['id_user']);

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $coach->updateProfile(
        $_POST['nom'],
        $_POST['prenom'],
        $_POST['discipline'],
        $_POST['annees_experience'],
        $_POST['description'],
        $_SESSION['id_user']
    );

    $_SESSION['user_name'] = $_POST['nom'] . ' ' . $_POST['prenom'];
    $message = "Profil mis à jour avec succès ✅";

    // recharger les données
    $coachData = $coach->getIdCoachByUserId($_SESSION['user_id']);
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier mon profil</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex min-h-screen bg-gray-50">

<?php include '../includes/aside_coach.php'; ?>

<main class="flex-1 lg:ml-72 p-6 md:p-10">
    <h1 class="text-3xl font-bold mb-6">Mon profil</h1>

    <?php if ($message): ?>
        <div class="bg-green-100 text-green-700 px-4 py-3 rounded-lg mb-6">
            <?= $message ?>
        </div>
    <?php endif; ?>

    <form method="POST" class="max-w-2xl bg-white p-8 rounded-2xl shadow space-y-5">

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="text-sm text-gray-600">Nom</label>
                <input type="text" name="nom"
                       value="<?= $coachData['nom'] ?>"
                       class="input" required>
            </div>

            <div>
                <label class="text-sm text-gray-600">Prénom</label>
                <input type="text" name="prenom"
                       value="<?= $coachData['prenom'] ?>"
                       class="input" required>
            </div>
        </div>

        <div>
            <label class="text-sm text-gray-600">Discipline</label>
            <input type="text" name="discipline"
                   value="<?= $coachData['discipline'] ?>"
                   class="input" required>
        </div>

        <div>
            <label class="text-sm text-gray-600">Années d’expérience</label>
            <input type="number" name="annees_experience"
                   value="<?= $coachData['annees_experience'] ?>"
                   class="input" min="0" required>
        </div>

        <div>
            <label class="text-sm text-gray-600">Description</label>
            <textarea name="description"
                      class="input h-28 resize-none"><?= $coachData['description'] ?></textarea>
        </div>

        <button
            class="bg-indigo-600 hover:bg-indigo-700 text-white px-8 py-3 rounded-xl transition">
            Enregistrer les modifications
        </button>
    </form>
</main>

<style>
.input {
    width: 100%;
    padding: 12px;
    border-radius: 12px;
    border: 1px solid #e5e7eb;
    outline: none;
}
.input:focus {
    border-color: #6366f1;
    box-shadow: 0 0 0 2px rgba(99,102,241,.2);
}
</style>

</body>
</html>
