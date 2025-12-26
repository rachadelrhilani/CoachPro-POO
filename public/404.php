<?php http_response_code(404); ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Page introuvable | Coach & Sportif</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen flex items-center justify-center bg-gradient-to-br from-indigo-700 via-purple-700 to-pink-600 text-white">

    <div class="text-center px-6">
        
        <div class="mx-auto mb-6 w-28 h-28 bg-white/20 rounded-full flex items-center justify-center shadow-lg">
            <svg class="w-14 h-14 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M9.172 16.172a4 4 0 005.656 0M12 10v.01M15 10v.01M9 10v.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
        </div>

        <h1 class="text-6xl font-extrabold mb-4">404</h1>
        <p class="text-xl text-white/90 mb-2">
            Oups ! Cette page n’existe pas.
        </p>
        <p class="text-white/70 mb-8">
            La page que vous cherchez a peut-être été déplacée ou supprimée.
        </p>

        <div class="flex flex-col sm:flex-row gap-4 justify-center">

            <a href="/Coachpro(POO)/auth/login.php"
               class="px-6 py-3 bg-indigo-600 text-white font-semibold rounded-xl shadow hover:bg-indigo-700 transition">
                 Connexion
            </a>
        </div>
    </div>

</body>
</html>
