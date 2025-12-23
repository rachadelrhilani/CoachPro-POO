<?php
require_once '../classes/Utilisateur.php';
require_once '../classes/Coach.php';
require_once '../classes/Sportif.php';

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role'];
    $discipline = $_POST['discipline'];
    $annees_experience=$_POST['annees_experience'];
    $description=$_POST['description'];

    $user = new Utilisateur();
    if ($user->register($email, $password, $role)) {
        // id_user est maintenant dans $user->id_user via l’héritage
        if ($role === 'coach') {
            $coach = new Coach();
            $coach->setIdUser($user->getIdUser()); // utilise le setter
            $coach->create($nom, $prenom, $discipline, $annees_experience, $description);
        } elseif ($role === 'sportif') {
            $sportif = new Sportif();
            $sportif->setIdUser($user->getIdUser());
            $sportif->create($nom, $prenom);
        }
        $success = "Inscription réussie ! Vous pouvez vous connecter.";
    } else {
        $error = "Cet email est déjà utilisé.";
    }
}
?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Inscription</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen flex items-center justify-center bg-gradient-to-br from-indigo-600 to-indigo-800">
    <div class="bg-white p-8 rounded-2xl shadow-xl w-full max-w-lg">
        <h1 class="text-2xl font-bold text-center mb-6 text-indigo-600">Inscription</h1>

        <?php if (!empty($error)): ?>
            <div class="bg-red-100 text-red-600 p-3 rounded mb-4 text-sm"><?= $error ?></div>
        <?php endif; ?>
        <?php if (!empty($success)): ?>
            <div class="bg-green-100 text-green-600 p-3 rounded mb-4 text-sm"><?= $success ?></div>
        <?php endif; ?>

        <form method="POST" class="space-y-4">
            <div class="grid grid-cols-2 gap-4">
                <input type="text" name="nom" placeholder="Nom" class="input" required>
                <input type="text" name="prenom" placeholder="Prénom" class="input" required>
            </div>

            <input type="email" name="email" placeholder="Email" class="input" required>
            <input type="password" name="password" placeholder="Mot de passe" class="input" required>

            <select name="role" class="input" required>
                <option value="">Choisir un rôle</option>
                <option value="coach">Coach</option>
                <option value="sportif">Sportif</option>
            </select>

            <div id="coachFields" class="hidden space-y-3">
                <input type="text" name="discipline" placeholder="Discipline" class="input">
                <input type="number" name="annees_experience" placeholder="Années d'expérience" class="input">
                <textarea name="description" placeholder="Description" class="input"></textarea>
            </div>

            <button class="w-full bg-indigo-600 text-white py-3 rounded-xl hover:bg-indigo-700 transition">S'inscrire</button>
        </form>

        <p class="text-center text-sm text-gray-500 mt-6">
            Déjà un compte ?
            <a href="login.php" class="text-indigo-600 font-semibold hover:underline">Connexion</a>
        </p>
    </div>

    <style>
        .input {
            width: 100%;
            padding: 12px;
            border: 1px solid #e5e7eb;
            border-radius: 12px;
        }
    </style>

    <script>
        document.querySelector('select[name="role"]').addEventListener('change', e => {
            document.getElementById('coachFields')
                .classList.toggle('hidden', e.target.value !== 'coach');
        });
    </script>
</body>

</html>