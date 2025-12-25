
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
/* 1 */