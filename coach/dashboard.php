<?php
require_once '../includes/auth_check.php';
checkRole('coach');
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Coach</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex min-h-screen">

    <?php include '../includes/aside_coach.php'; ?>

    <main class="flex-1 lg:ml-72 p-6 md:p-10">
        <h1 class="text-3xl font-bold mb-6">Dashboard Coach</h1>
        <p>Bienvenue <?= $_SESSION['user_name'] ?? 'Coach' ?> !</p>
        <!-- Contenu du dashboard -->
    </main>

</body>
</html>
