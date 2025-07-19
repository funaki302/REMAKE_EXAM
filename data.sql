create database emprunt ;
use emprunt;

-- Table membre
CREATE TABLE membre (
    id_membre INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100),
    date_naissance DATE,
    genre ENUM('H', 'F'),
    email VARCHAR(100) UNIQUE,
    ville VARCHAR(100),
    mdp VARCHAR(255),
    image_profil VARCHAR(255)
);

-- Table catégorie
CREATE TABLE categorie_objet (
    id_categorie INT AUTO_INCREMENT PRIMARY KEY,
    nom_categorie VARCHAR(100)
);

-- Table objet
CREATE TABLE objet (
    id_objet INT AUTO_INCREMENT PRIMARY KEY,
    nom_objet VARCHAR(100),
    id_categorie INT,
    id_membre INT,
    FOREIGN KEY (id_categorie) REFERENCES categorie_objet(id_categorie),
    FOREIGN KEY (id_membre) REFERENCES membre(id_membre)
);

-- Table images des objets
CREATE TABLE images_objet (
    id_image INT AUTO_INCREMENT PRIMARY KEY,
    id_objet INT,
    nom_image VARCHAR(255),
    FOREIGN KEY (id_objet) REFERENCES objet(id_objet)
);

-- Table emprunt
CREATE TABLE emprunt (
    id_emprunt INT AUTO_INCREMENT PRIMARY KEY,
    id_objet INT,
    id_membre INT,
    date_emprunt DATE,
    date_retour DATE,
    FOREIGN KEY (id_objet) REFERENCES objet(id_objet),
    FOREIGN KEY (id_membre) REFERENCES membre(id_membre)
);


-- Insertion des membres
INSERT INTO membre (nom, date_naissance, genre, email, ville, mdp, image_profil) VALUES
('Alice', '1995-04-12', 'F', 'alice@example.com', 'Paris', 'mdp123', 'alice.jpg'),
('Bob', '1988-11-23', 'H', 'bob@example.com', 'Lyon', 'bobpwd', 'bob.jpg'),
('Charlie', '1990-06-15', 'H', 'charlie@example.com', 'Marseille', 'charliepwd', 'charlie.jpg'),
('Diana', '1997-02-28', 'F', 'diana@example.com', 'Toulouse', 'dianapwd', 'diana.jpg');

-- Insertion des catégories
INSERT INTO categorie_objet (nom_categorie) VALUES
('Esthétique'), ('Bricolage'), ('Mécanique'), ('Cuisine');

-- Insertion des objets (10 par membre, répartis sur les catégories)
INSERT INTO objet (nom_objet, id_categorie, id_membre) VALUES
-- Alice (id_membre = 1)
('Sèche-cheveux', 1, 1), ('Perceuse', 2, 1), ('Tournevis', 2, 1), ('Casserole', 4, 1), ('Four', 4, 1),
('Pied de biche', 2, 1), ('Mixer', 4, 1), ('Miroir', 1, 1), ('Clé à molette', 3, 1), ('Trousse maquillage', 1, 1),

-- Bob (id_membre = 2)
('Pinceau', 1, 2), ('Marteau', 2, 2), ('Scie sauteuse', 2, 2), ('Presse-agrumes', 4, 2), ('Plaque de cuisson', 4, 2),
('Lime', 2, 2), ('Fer à repasser', 1, 2), ('Clé anglaise', 3, 2), ('Friteuse', 4, 2), ('Peigne', 1, 2),

-- Charlie (id_membre = 3)
('Shampoing', 1, 3), ('Perceuse sans fil', 2, 3), ('Visseuse', 2, 3), ('Blender', 4, 3), ('Grille-pain', 4, 3),
('Pelle', 2, 3), ('Brosse à cheveux', 1, 3), ('Tournevis cruciforme', 2, 3), ('Jack hydraulique', 3, 3), ('Rouleau peinture', 2, 3),

-- Diana (id_membre = 4)
('Crème visage', 1, 4), ('Scie circulaire', 2, 4), ('Four micro-onde', 4, 4), ('Plaque induction', 4, 4), ('Coffret maquillage', 1, 4),
('Pompe', 3, 4), ('Aspirateur', 4, 4), ('Rasoir', 1, 4), ('Perceuse murale', 2, 4), ('Tournevis plat', 2, 4);

-- Images d’objets (1 par objet)
INSERT INTO images_objet (id_objet, nom_image)
SELECT id_objet, CONCAT('image_', id_objet, '.jpg') FROM objet;

-- Emprunts (choix aléatoire entre objets et membres, sans emprunter ses propres objets)
INSERT INTO emprunt (id_objet, id_membre, date_emprunt, date_retour) VALUES
(1, 2, '2025-07-01', '2025-07-10'),
(2, 3, '2025-07-02', '2025-07-12'),
(3, 4, '2025-07-03', '2025-07-13'),
(11, 1, '2025-07-04', '2025-07-14'),
(12, 3, '2025-07-05', '2025-07-15'),
(21, 4, '2025-07-06', '2025-07-16'),
(31, 1, '2025-07-07', '2025-07-17'),
(32, 2, '2025-07-08', '2025-07-18'),
(35, 1, '2025-07-09', '2025-07-19'),
(40, 3, '2025-07-10', '2025-07-20');


create or replace view v_all_info_membre as
select m.id_membre, m.nom, m.date_naissance, m.genre, m.email, m.ville, m.image_profil,
e.date_emprunt, e.date_retour,o.nom_objet, c.nom_categorie,o.id_objet, i.nom_image
from membre m join emprunt e on m.id_membre = e.id_membre
join objet o on e.id_objet = o.id_objet
join images_objet i on o.id_objet = i.id_objet
join categorie_objet c on o.id_categorie = c.id_categorie; 

create or replace view v_all_info_categorie as
select c.id_categorie, c.nom_categorie, o.id_objet, o.nom_objet, m.id_membre, m.nom, i.nom_image
from categorie_objet c join objet o on c.id_categorie = o.id_categorie
join membre m on o.id_membre = m.id_membre
join images_objet i on o.id_objet = i.id_objet;

create or replace view v_all_info_objet_emprunter as
select vc.* , e.date_emprunt,e.date_retour,m.nom as emprunteur,m.id_membre as id_emprunter from v_all_info_categorie vc join emprunt e on vc.id_objet = e.id_objet
join membre m on e.id_membre = m.id_membre;