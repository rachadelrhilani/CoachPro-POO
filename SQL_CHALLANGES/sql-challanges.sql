
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
/* =====================================================
  challanges 3
===================================================== */
/* 1 */
SELECT 
    u.nom AS coach,
    s1.date_seance,
    s1.heure AS heure_debut,
    ADDTIME(s1.heure, SEC_TO_TIME(s1.duree * 60)) AS heure_fin,
    s1.id AS id_seance

FROM seances s1
JOIN seances s2
    ON s1.coach_id = s2.coach_id
    AND s1.date_seance = s2.date_seance
    AND s1.id <> s2.id  

JOIN users u 
    ON u.id = s1.coach_id

WHERE
    s1.heure < ADDTIME(s2.heure, SEC_TO_TIME(s2.duree * 60))
    AND s2.heure < ADDTIME(s1.heure, SEC_TO_TIME(s1.duree * 60))

ORDER BY u.nom, s1.date_seance, s1.heure;
/* 2 */
SELECT DISTINCT
    u.nom AS coach,
    s1.date_seance,
    s1.heure AS heure_debut,
    ADDTIME(s1.heure, SEC_TO_TIME(s1.duree * 60)) AS heure_fin,
    s1.id AS id_seance
FROM seances s1
JOIN seances s2
    ON s1.coach_id = s2.coach_id
    AND s1.date_seance = s2.date_seance
    AND s1.id <> s2.id
JOIN users u
    ON u.id = s1.coach_id
WHERE
    s1.heure < ADDTIME(s2.heure, SEC_TO_TIME(s2.duree * 60))
    AND s2.heure < ADDTIME(s1.heure, SEC_TO_TIME(s1.duree * 60))
ORDER BY coach, s1.date_seance, s1.heure;
