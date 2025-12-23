<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Inscription</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen flex items-center justify-center bg-gradient-to-br from-indigo-600 to-indigo-800">

<div class="bg-white p-8 rounded-2xl shadow-xl w-full max-w-lg">
    <h1 class="text-2xl font-bold text-center mb-6 text-indigo-600">
        Inscription
    </h1>

    <?php if (!empty($error)): ?>
        <div class="bg-red-100 text-red-600 p-3 rounded mb-4 text-sm">
            <?= $error ?>
        </div>
    <?php endif; ?>

    <form method="POST" class="space-y-4">
        <div class="grid grid-cols-2 gap-4">
            <input type="text" name="nom" placeholder="Nom"
                   class="input" required>
            <input type="text" name="prenom" placeholder="Prénom"
                   class="input" required>
        </div>

        <input type="email" name="email" placeholder="Email"
               class="input" required>

        <input type="password" name="password" placeholder="Mot de passe"
               class="input" required>

        <select name="role" class="input" required>
            <option value="">Choisir un rôle</option>
            <option value="coach">Coach</option>
            <option value="sportif">Sportif</option>
        </select>

        <!-- Champs coach uniquement -->
        <div id="coachFields" class="hidden space-y-3">
            <input type="text" name="discipline" placeholder="Discipline"
                   class="input">
            <input type="number" name="annees_experience"
                   placeholder="Années d'expérience" class="input">
            <textarea name="description" placeholder="Description"
                      class="input"></textarea>
        </div>

        <button
            class="w-full bg-indigo-600 text-white py-3 rounded-xl hover:bg-indigo-700 transition">
            S'inscrire
        </button>
    </form>

    <p class="text-center text-sm text-gray-500 mt-6">
        Déjà un compte ?
        <a href="/login" class="text-indigo-600 font-semibold hover:underline">
            Connexion
        </a>
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
