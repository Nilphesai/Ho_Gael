a. Informations d’un film (id_film) : titre, année, durée (au format HH:MM) et 
réalisateur 

SELECT titre, annee_sortie, DATE_FORMAT(MAKETIME(TRUNCATE(duree/60,0),(duree%60),00),"%H:%i") AS durée, personne.nom, personne.prenom
FROM film
INNER JOIN realisateur ON film.id_realisateur = realisateur.id_realisateur
JOIN personne ON realisateur.id_personne = personne.id_personne
WHERE id_film = 2;

b. Liste des films dont la durée excède 2h15 classés par durée (du + long au + court)

SELECT titre, annee_sortie, DATE_FORMAT(MAKETIME(TRUNCATE(duree/60,0),(duree%60),00),"%H:%i") AS durée, personne.nom, personne.prenom
FROM film
INNER JOIN realisateur ON film.id_realisateur = realisateur.id_realisateur
JOIN personne ON realisateur.id_personne = personne.id_personne
WHERE duree > 135
ORDER BY duree DESC;

c. Liste des films d’un réalisateur (en précisant l’année de sortie) 

SELECT titre, annee_sortie, DATE_FORMAT(MAKETIME(TRUNCATE(duree/60,0),(duree%60),00),"%H:%i") AS durée, personne.nom, personne.prenom
FROM film
INNER JOIN realisateur ON film.id_realisateur = realisateur.id_realisateur
JOIN personne ON realisateur.id_personne = personne.id_personne
WHERE film.id_realisateur = 1
ORDER BY annee_sortie DESC;

d. Nombre de films par genre (classés dans l’ordre décroissant)

SELECT libelle, COUNT(genre.id_genre) AS nbFilm
FROM film
INNER JOIN categoriser ON film.id_film = categoriser.id_film
JOIN genre ON genre.id_genre = categoriser.id_genre
GROUP BY libelle
ORDER BY nbFilm;

e. Nombre de films par réalisateur (classés dans l’ordre décroissant)

SELECT personne.nom, personne.prenom, COUNT(realisateur.id_realisateur) AS nbFilm
FROM film
INNER JOIN realisateur ON film.id_realisateur = realisateur.id_realisateur
JOIN personne ON personne.id_personne = realisateur.id_personne
GROUP BY realisateur.id_realisateur
ORDER BY nbFilm;

f. Casting d’un film en particulier (id_film) : nom, prénom des acteurs + sexe

SELECT personne.nom, personne.prenom, personne.sexe
FROM film
INNER JOIN jouer ON jouer.id_film = film.id_film
JOIN acteur ON jouer.id_acteur = acteur.id_acteur
JOIN personne ON acteur.id_personne = personne.id_personne
WHERE film.id_film = 2;

g. Films tournés par un acteur en particulier (id_acteur) avec leur rôle et l’année de 
sortie (du film le plus récent au plus ancien)

SELECT titre, role.nom, annee_sortie
FROM film
INNER JOIN jouer ON jouer.id_film = film.id_film
JOIN role ON role.id_role = jouer.id_role
JOIN acteur ON jouer.id_acteur = acteur.id_acteur
JOIN personne ON acteur.id_personne = personne.id_personne
WHERE acteur.id_acteur = 8

h. Liste des personnes qui sont à la fois acteurs et réalisateurs

SELECT personne.nom, personne.prenom
FROM personne
INNER JOIN acteur ON personne.id_personne = acteur.id_personne
JOIN realisateur ON personne.id_personne = realisateur.id_personne
WHERE realisateur.id_personne = acteur.id_personne

i. Liste des films qui ont moins de 5 ans (classés du plus récent au plus ancien)

SELECT titre, annee_sortie, DATE_FORMAT(MAKETIME(TRUNCATE(duree/60,0),(duree%60),00),"%H:%i") AS durée
FROM film
WHERE (YEAR(CURDATE())-annee_sortie) < 5
ORDER BY annee_sortie

j. Nombre d’hommes et de femmes parmi les acteurs

SELECT sexe, COUNT(sexe)
FROM personne
INNER JOIN acteur ON acteur.id_personne = personne.id_personne
GROUP BY sexe

k. Liste des acteurs ayant plus de 50 ans (âge révolu et non révolu)



l. Acteurs ayant joué dans 3 films ou plus
