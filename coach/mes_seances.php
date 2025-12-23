<?php
require_once '../includes/check_auth.php';
checkRole('coach');
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Mes Séances</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex min-h-screen">

    <?php include '../includes/aside_coach.php'; ?>

    <main class="flex-1 lg:ml-72 p-6 md:p-10">
        <h1 class="text-3xl font-bold mb-6">Mes séances</h1>
        <!-- Liste des séances du coach -->
    </main>

</body>
</html>
