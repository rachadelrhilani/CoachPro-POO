
/* =====================================================
   DATABASE
===================================================== */
/* DROP DATABASE IF EXISTS coach_platform;
CREATE DATABASE coach_platform CHARACTER SET utf8mb4; */
USE coach_platform;

/* =====================================================
  Top coach par taux de réservation
===================================================== */

/* 1 */ SELECT count(*) AS nombretotalseance,coach_id FROM seances GROUP BY coach_id;
/* 2 */ SELECT count(*) AS nombretotalseance,coach_id FROM seances WHERE statut="reservee" GROUP BY coach_id;
/* 3 */ SELECT count(*) AS nombretotalreserve,count(*) AS nombretotalseance FROM seances WHERE statut="reservee"
/* 4 */ SELECT count(*) AS nombretotalseance,coach_id FROM seances GROUP BY coach_id HAVING nombretotalseance >= 3; 