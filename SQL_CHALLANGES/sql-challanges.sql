
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
    u.prenom,
    (SELECT 
        CONCAT(sportifs.nom, ' ', sportifs.prenom) 
     FROM users sportifs
     JOIN reservations r2 ON r2.sportif_id = sportifs.id
     WHERE MONTH(r2.reserved_at) = MONTH(r.reserved_at) 
       AND YEAR(r2.reserved_at) = YEAR(r.reserved_at)
     GROUP BY r2.sportif_id
     ORDER BY COUNT(r2.id) DESC 
     LIMIT 1) AS sportif_plus_reservation
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
    YEAR(r.reserved_at) AS annee,
    (SELECT 
        CONCAT(sportifs.nom, ' ', sportifs.prenom)
     FROM users sportifs
     JOIN reservations r2 ON r2.sportif_id = sportifs.id
     WHERE MONTH(r2.reserved_at) = MONTH(r.reserved_at) 
       AND YEAR(r2.reserved_at) = YEAR(r.reserved_at)
     GROUP BY r2.sportif_id
     ORDER BY COUNT(r2.id) DESC 
     LIMIT 1) AS sportif_plus_reservation
FROM users u
JOIN sportifs s ON u.id = s.user_id
JOIN reservations r ON r.sportif_id = s.user_id
GROUP BY u.id, mois, annee;
/* 3 */
SELECT 
    MONTH(reserved_at) AS mois,
    YEAR(reserved_at) AS annee,
    COUNT(*) AS total_reservations,
    (SELECT 
        CONCAT(sportifs.nom, ' ', sportifs.prenom)
     FROM users sportifs
     JOIN reservations r2 ON r2.sportif_id = sportifs.id
     WHERE MONTH(r2.reserved_at) = MONTH(reserved_at) 
       AND YEAR(r2.reserved_at) = YEAR(reserved_at)
     GROUP BY r2.sportif_id
     ORDER BY COUNT(r2.id) DESC 
     LIMIT 1) AS sportif_plus_reservation
FROM reservations
GROUP BY mois, annee;
/* 4 */
SELECT 
    u.nom,
    u.prenom,
    COUNT(r.id) AS total_reservations,
    MONTH(r.reserved_at) AS mois,
    YEAR(r.reserved_at) AS annee,
    (SELECT 
        CONCAT(sportifs.nom, ' ', sportifs.prenom)
     FROM users sportifs
     JOIN reservations r2 ON r2.sportif_id = sportifs.id
     WHERE MONTH(r2.reserved_at) = MONTH(r.reserved_at) 
       AND YEAR(r2.reserved_at) = YEAR(r.reserved_at)
     GROUP BY r2.sportif_id
     ORDER BY COUNT(r2.id) DESC 
     LIMIT 1) AS sportif_plus_reservation
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
/* =====================================================
  challanges 4
===================================================== */
/* 1 */
SELECT 
    u.nom AS coach_nom,
    u.prenom AS coach_prenom
FROM users u
JOIN coachs c ON u.id = c.user_id
LEFT JOIN seances s ON s.coach_id = c.user_id
LEFT JOIN reservations r ON r.seance_id = s.id
WHERE DATEDIFF(CURDATE(), r.reserved_at) > 60 OR r.id IS NULL
ORDER BY u.nom, u.prenom;
/* 2 */
SELECT 
    u.nom AS coach_nom,
    u.prenom AS coach_prenom
FROM users u
JOIN coachs c ON u.id = c.user_id
JOIN seances s ON s.coach_id = c.user_id
JOIN reservations r ON r.seance_id = s.id
WHERE DATEDIFF(CURDATE(), r.reserved_at) <= 60
GROUP BY u.id
ORDER BY u.nom, u.prenom;
/* =====================================================
  challanges 5
===================================================== */
/* 1 */
SELECT
    discipline,
    coach_nom,
    coach_prenom,
    total_reservations,
    classement
FROM (
    SELECT
        c.discipline,
        u.nom AS coach_nom,
        u.prenom AS coach_prenom,
        COUNT(r.id) AS total_reservations,
        RANK() OVER (
            PARTITION BY c.discipline
            ORDER BY COUNT(r.id) DESC
        ) AS classement
    FROM coachs c
    JOIN users u ON u.id = c.user_id
    JOIN seances s ON s.coach_id = c.user_id
    JOIN reservations r ON r.seance_id = s.id
    GROUP BY c.discipline, c.user_id
) classement_coachs
WHERE classement <= 3
ORDER BY discipline, classement;
/* 2 */
SELECT
    discipline,
    coach_nom,
    coach_prenom,
    nombre_reservations,
    rang
FROM (
    SELECT
        c.discipline,
        u.nom AS coach_nom,
        u.prenom AS coach_prenom,
        COUNT(r.id) AS nombre_reservations,
        RANK() OVER (
            PARTITION BY c.discipline
            ORDER BY COUNT(r.id) DESC
        ) AS rang
    FROM coachs c
    JOIN users u ON u.id = c.user_id
    JOIN seances s ON s.coach_id = c.user_id
    JOIN reservations r ON r.seance_id = s.id
    GROUP BY c.discipline, c.user_id
) classement
ORDER BY discipline, rang;
/* =====================================================
  challanges 6
===================================================== */
/* 1 */