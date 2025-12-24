<?php
require_once '../includes/check_auth.php';
checkRole('sportif');
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Sportif</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex min-h-screen">

<?php include '../includes/aside_sportif.php'; ?>

<main class="flex-1 lg:ml-72 p-6 md:p-10">
    <h1 class="text-3xl font-bold mb-4">Dashboard</h1>
    <p class="text-gray-600">
        Bienvenue <?= $_SESSION['user_name'] ?? 'Sportif' ?> 👋
    </p>
</main>

</body>
</html>
