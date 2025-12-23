<?php
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['id_user'])) {
    header('Location: ../auth/login.php');
    exit;
}

function checkRole($role) {
    if ($_SESSION['role'] !== $role) {
        // accès interdit
        header('HTTP/1.0 403 Forbidden');
        echo "Accès interdit.";
        exit;
    }
}
