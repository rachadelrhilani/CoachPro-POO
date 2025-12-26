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

<body class="min-h-screen flex items-center justify-center bg-gradient-to-br from-indigo-600 via-purple-600 to-pink-500 p-4">
    <!-- Decorative circles -->
    <div class="absolute top-10 left-10 w-72 h-72 bg-white/10 rounded-full blur-3xl"></div>
    <div class="absolute bottom-10 right-10 w-96 h-96 bg-white/10 rounded-full blur-3xl"></div>
    
    <div class="bg-white/95 backdrop-blur-xl p-10 rounded-3xl shadow-2xl w-full max-w-lg relative z-10 border border-white/20">
        <!-- Header with icon -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-br from-indigo-600 to-purple-600 rounded-2xl mb-4 shadow-lg">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                </svg>
            </div>
            <h1 class="text-3xl font-bold bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">Créer un compte</h1>
            <p class="text-gray-500 mt-2">Rejoignez notre communauté sportive</p>
        </div>

        <?php if (!empty($error)): ?>
            <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 rounded-lg mb-6 flex items-start">
                <svg class="w-5 h-5 mr-2 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                </svg>
                <span><?= $error ?></span>
            </div>
        <?php endif; ?>
        
        <?php if (!empty($success)): ?>
            <div class="bg-green-50 border-l-4 border-green-500 text-green-700 p-4 rounded-lg mb-6 flex items-start">
                <svg class="w-5 h-5 mr-2 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                </svg>
                <span><?= $success ?></span>
            </div>
        <?php endif; ?>

        <form method="POST" class="space-y-5">
            <div class="grid grid-cols-2 gap-4">
                <div class="relative">
                    <input type="text" name="nom" placeholder="Nom" class="input peer" required>
                    <div class="input-focus-line"></div>
                </div>
                <div class="relative">
                    <input type="text" name="prenom" placeholder="Prénom" class="input peer" required>
                    <div class="input-focus-line"></div>
                </div>
            </div>

            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path>
                    </svg>
                </div>
                <input type="email" name="email" placeholder="Email" class="input pl-12 peer" required>
                <div class="input-focus-line"></div>
            </div>

            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                    </svg>
                </div>
                <input type="password" name="password" placeholder="Mot de passe" class="input pl-12 peer" required>
                <div class="input-focus-line"></div>
            </div>

            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                    </svg>
                </div>
                <select name="role" class="input pl-12 peer appearance-none cursor-pointer" required>
                    <option value="">Choisir un rôle</option>
                    <option value="coach">🏆 Coach</option>
                    <option value="sportif">⚡ Sportif</option>
                </select>
                <div class="input-focus-line"></div>
                <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none">
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </div>
            </div>

            <div id="coachFields" class="hidden space-y-4 pt-2 animate-fadeIn">
                <div class="bg-gradient-to-r from-indigo-50 to-purple-50 p-5 rounded-2xl border border-indigo-100">
                    <h3 class="text-sm font-semibold text-indigo-900 mb-4 flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                        </svg>
                        Informations Coach
                    </h3>
                    <div class="space-y-3">
                        <div class="relative">
                            <input type="text" name="discipline" placeholder="Discipline (ex: Fitness, Yoga...)" class="input-coach peer">
                            <div class="input-focus-line"></div>
                        </div>
                        <div class="relative">
                            <input type="number" name="annees_experience" placeholder="Années d'expérience" class="input-coach peer" min="0">
                            <div class="input-focus-line"></div>
                        </div>
                        <div class="relative">
                            <textarea name="description" placeholder="Parlez-nous de votre expérience..." class="input-coach peer h-24 resize-none"></textarea>
                            <div class="input-focus-line"></div>
                        </div>
                    </div>
                </div>
            </div>

            <button type="submit" class="w-full bg-gradient-to-r from-indigo-600 to-purple-600 text-white py-3.5 rounded-xl font-semibold hover:from-indigo-700 hover:to-purple-700 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                S'inscrire
            </button>
        </form>

        <div class="mt-8 pt-6 border-t border-gray-200">
            <p class="text-center text-sm text-gray-600">
                Déjà un compte ?
                <a href="login.php" class="text-indigo-600 font-semibold hover:text-purple-600 transition-colors ml-1">Se connecter</a>
            </p>
        </div>
    </div>

    <style>
        .input {
            width: 100%;
            padding: 14px 16px;
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            transition: all 0.3s ease;
            background: white;
            font-size: 15px;
        }
        
        .input:focus {
            outline: none;
            border-color: #6366f1;
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
        }

        .input-coach {
            width: 100%;
            padding: 12px 14px;
            border: 2px solid #e0e7ff;
            border-radius: 10px;
            transition: all 0.3s ease;
            background: white;
            font-size: 14px;
        }
        
        .input-coach:focus {
            outline: none;
            border-color: #6366f1;
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
        }

        .input-focus-line {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0;
            height: 2px;
            background: linear-gradient(to right, #6366f1, #a855f7);
            transition: width 0.3s ease;
        }

        .input:focus ~ .input-focus-line,
        .input-coach:focus ~ .input-focus-line {
            width: 100%;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fadeIn {
            animation: fadeIn 0.3s ease-out;
        }

        select option {
            padding: 10px;
        }
    </style>

    <script>
        document.querySelector('select[name="role"]').addEventListener('change', e => {
            const coachFields = document.getElementById('coachFields');
            if (e.target.value === 'coach') {
                coachFields.classList.remove('hidden');
            } else {
                coachFields.classList.add('hidden');
            }
        });
    </script>
</body>

</html>