# Coach & Sportif Platform

Plateforme web permettant de mettre en relation des **coachs sportifs** et des **sportifs**.  
Les coachs peuvent proposer des séances, les sportifs peuvent les réserver et gérer leurs activités.

---

## Fonctionnalités principales

### Authentification
- Inscription (Coach / Sportif)
- Connexion sécurisée
- Gestion des rôles (admin, coach, sportif)

### Coach
- Tableau de bord personnalisé
- Création de séances
- Modification et suppression de séances
- Consultation des réservations
- Gestion de son profil

### Sportif
- Consultation des coachs disponibles
- Réservation de séances
- Annulation de réservation
- Historique des séances
- Tableau de bord personnel

### Sécurité
- Sessions sécurisées
- Protection des routes selon le rôle
- Validation des formulaires
- Protection contre les réservations multiples

---

## Structure du projet
```coach-sportif-platform/
│
├── classes/
│ ├── Utilisateur.php # Classe mère utilisateur
│ ├── Admin.php # Gestion admin
│ ├── Coach.php # Logique coach
│ ├── Sportif.php # Logique sportif
│ ├── Seance.php # Gestion des séances
│ └── Reservation.php # Réservations
│
├── auth/
│ ├── login.php # Connexion
│ ├── register.php # Inscription
│ └── logout.php # Déconnexion
│
├── coach/
│ ├── dashboard.php
│ ├── edit_profile.php
│ ├── ajouter_seance.php
│ ├── modifier_seance.php
│ └── mes_seances.php
│
├── sportif/
│ ├── dashboard.php
│ ├── liste_coachs.php
│ ├── detail_coach.php
│ ├── reserver_seance.php
│ └── mes_reservations.php
│
├── admin/
│ └── dashboard.php
│
├── includes/
│ ├── header.php
│ ├── footer.php
│ ├── navbar.php
│ └── auth_check.php
│
├── public/
│ ├── css/
│ ├── js/
│ └── images/
│
└── README.md```

---

## 🛠️ Technologies utilisées

- **PHP (POO)**
- **MySQL**
- **HTML5 / CSS3**
- **Tailwind CSS**
- **JavaScript**
- **PDO (sécurité SQL)**

---

## ⚙️ Installation

1. Cloner le projet :
```bash
git clone https://github.com/rachadelrhilani/CoachPro-POO
