
/* =====================================================
   DATABASE
===================================================== */
/* DROP DATABASE IF EXISTS coach_platform;
CREATE DATABASE coach_platform CHARACTER SET utf8mb4; */
USE coach_platform;

/* =====================================================
  challanges 1
===================================================== */

/* 1 */ SELECT count(*) AS nombretotalseance,coach_id FROM seances GROUP BY coach_id;
/* 2 */ SELECT count(*) AS nombretotalseance,coach_id FROM seances WHERE statut="reservee" GROUP BY coach_id;
/* 3 */ SELECT 
    u.nom,
    u.prenom,
    (COUNT(r.id) / COUNT(s.id)) * 100, 2 AS taux_reservation_pct
FROM 
    coachs c
    INNER JOIN users u ON c.user_id = u.id
    INNER JOIN seances s ON c.user_id = s.coach_id
    LEFT JOIN reservations r ON s.id = r.seance_id
GROUP BY 
    c.user_id, u.nom, u.prenom;
/* 4 */ SELECT count(*) AS nombretotalseance,coach_id FROM seances GROUP BY coach_id HAVING nombretotalseance >= 3; 
/* =====================================================
  challanges 2
===================================================== */
/* 1 */SELECT 
    u.nom,
    u.prenom
FROM users u
JOIN sportifs s ON u.id = s.user_id
JOIN reservations r ON r.sportif_id = s.user_id
GROUP BY u.id;
/* 2 */
SELECT 
    u.nom,
    u.prenom,
    COUNT(r.id) AS nombre_reservations,
    MONTH(r.reserved_at) AS mois,
    YEAR(r.reserved_at) AS annee
FROM users u
JOIN sportifs s ON u.id = s.user_id
JOIN reservations r ON r.sportif_id = s.user_id
GROUP BY u.id, mois, annee;
/* 3 */
SELECT 
    MONTH(reserved_at) AS mois,
    YEAR(reserved_at) AS annee,
    COUNT(*) AS total_reservations
FROM reservations
GROUP BY mois, annee;
/* 4 */
SELECT 
    u.nom,
    u.prenom,
    COUNT(r.id) AS total_reservations,
    MONTH(r.reserved_at) AS mois,
    YEAR(r.reserved_at) AS annee
FROM users u
JOIN sportifs s ON u.id = s.user_id
JOIN reservations r ON r.sportif_id = s.user_id
GROUP BY u.id, mois, annee
ORDER BY total_reservations DESC;
