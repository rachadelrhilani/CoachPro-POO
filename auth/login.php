<?php
session_start();

require_once '../classes/Utilisateur.php';
require_once '../classes/Coach.php';
require_once '../classes/Sportif.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $user = new Utilisateur();
    if ($user->login($email, $password)) {
        // stocker les infos utilisateur dans la session
        $_SESSION['id_user'] = $user->getIdUser();
        $_SESSION['role'] = $user->getRole();
        $_SESSION['email'] = $email;

        // recuperer nom et prenom selon le role
        if ($user->getRole() === 'coach') {
            $coach = new Coach();
            $coach->loadByUserId($user->getIdUser());
            $_SESSION['user_name'] = $coach->getNom() . ' ' . $coach->getPrenom();
            header('Location: ../coach/dashboard.php');
            exit;
        } elseif ($user->getRole() === 'sportif') {
            $sportif = new Sportif();
            $sportif->loadByUserId($user->getIdUser());
            $_SESSION['user_name'] = $sportif->getNom() . ' ' . $sportif->getPrenom();
            header('Location: ../sportif/dashboard.php');
            exit;
        } else {
            $_SESSION['user_name'] = 'Admin';
            header('Location: ../admin/dashboard.php');
            exit;
        }

    } else {
        $error = "Email ou mot de passe incorrect.";
    }
}
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body{
            background-repeat: no-repeat;
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center bg-gradient-to-br from-indigo-700 via-indigo-600 to-indigo-800">

    <div class="bg-white w-full max-w-md p-8 rounded-2xl shadow-2xl">

        
        <div class="text-center mb-6">
            <div class="mx-auto w-16 h-16 bg-indigo-600 text-white flex items-center justify-center rounded-full text-3xl shadow-lg">
                🏋️
            </div>
            <h1 class="text-2xl font-bold mt-4 text-gray-800">SportCoach</h1>
            <p class="text-sm text-gray-500">
                Plateforme de mise en relation entre coachs et sportifs
            </p>
        </div>

        
        <?php if (!empty($error)): ?>
            <div class="bg-red-100 text-red-600 px-4 py-3 rounded-lg mb-4 text-sm text-center">
                <?= $error ?>
            </div>
        <?php endif; ?>

    
        <form method="POST" class="space-y-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Adresse e-mail</label>
                <input type="email" name="email" required
                       placeholder="exemple@email.com"
                       class="w-full px-4 py-3 border rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Mot de passe</label>
                <input type="password" name="password" required
                       placeholder="••••••••"
                       class="w-full px-4 py-3 border rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>

            <button
                class="w-full bg-indigo-600 text-white py-3 rounded-xl font-semibold hover:bg-indigo-700 transition">
                Se connecter
            </button>
        </form>

       
        <div class="text-center mt-6 text-sm text-gray-500">
            Vous n'avez pas encore de compte ?
            <a href="registre.php" class="text-indigo-600 font-semibold hover:underline">
                Créer un compte
            </a>
        </div>

    </div>

</body>
</html>
