<?php
require_once '../classes/Utilisateur.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $user = new Utilisateur();
    if ($user->login($email, $password)) {
        session_start();
        $_SESSION['user_id'] = $user->getIdUser();
        $_SESSION['role'] = $user->getRole();

        // Redirection selon le rôle
        switch ($user->getRole()) {
            case 'coach':
                header('Location: ../coach/dashboard.php');
                break;
            case 'sportif':
                header('Location: ../sportif/dashboard.php');
                break;
            case 'admin':
                header('Location: ../admin/dashboard.php');
                break;
        }
        exit;
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
</head>
<body class="min-h-screen flex items-center justify-center bg-gradient-to-br from-indigo-600 to-indigo-800">
<div class="bg-white p-8 rounded-2xl shadow-xl w-full max-w-md">
    <h1 class="text-2xl font-bold text-center mb-6 text-indigo-600">Connexion</h1>

    <?php if (!empty($error)): ?>
        <div class="bg-red-100 text-red-600 p-3 rounded mb-4 text-sm"><?= $error ?></div>
    <?php endif; ?>

    <form method="POST" class="space-y-4">
        <input type="email" name="email" placeholder="Email"
               class="w-full px-4 py-3 border rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500"
               required>
        <input type="password" name="password" placeholder="Mot de passe"
               class="w-full px-4 py-3 border rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500"
               required>
        <button class="w-full bg-indigo-600 text-white py-3 rounded-xl hover:bg-indigo-700 transition">Se connecter</button>
    </form>

    <p class="text-center text-sm text-gray-500 mt-6">
        Pas encore de compte ? 
        <a href="registre.php" class="text-indigo-600 font-semibold hover:underline">Inscription</a>
    </p>
</div>
</body>
</html>
