-- Création de la base de données
CREATE DATABASE gestion_cabinet_dentaire;
USE gestion_cabinet_dentaire;

-- Table des utilisateurs
CREATE TABLE utilisateurs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(255) NOT NULL,
    prenom VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    mot_de_passe VARCHAR(255) NOT NULL,
    role ENUM('administrateur', 'dentiste', 'assistant', 'patient') NOT NULL
);

-- Table des fournisseurs
CREATE TABLE fournisseurs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(255) NOT NULL,
    contact VARCHAR(255) NOT NULL
);

-- Table des produits (stocks)
CREATE TABLE produits (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(255) NOT NULL,
    description TEXT,
    quantite INT NOT NULL,
    date_expiration DATE,
    fournisseur_id INT,
    FOREIGN KEY (fournisseur_id) REFERENCES fournisseurs(id)
);

-- Table des bons d'achat
CREATE TABLE bon_achat (
    id INT AUTO_INCREMENT PRIMARY KEY,
    produit_id INT,
    quantite INT NOT NULL,
    date_achat DATE NOT NULL,
    fournisseur_id INT,
    FOREIGN KEY (produit_id) REFERENCES produits(id),
    FOREIGN KEY (fournisseur_id) REFERENCES fournisseurs(id)
);

-- Table de déstockage
CREATE TABLE bon_destockage (
    id INT AUTO_INCREMENT PRIMARY KEY,
    produit_id INT,
    quantite INT NOT NULL,
    date_destockage DATE NOT NULL,
    FOREIGN KEY (produit_id) REFERENCES produits(id)
);

-- Table des prothèses
CREATE TABLE protheses (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(255) NOT NULL,
    description TEXT,
    etat ENUM('en cours', 'terminé', 'livré') NOT NULL,
    paiement DECIMAL(10, 2),
    prothesiste_id INT,
    FOREIGN KEY (prothesiste_id) REFERENCES fournisseurs(id)
);

-- Table des événements du calendrier
CREATE TABLE calendrier (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titre VARCHAR(255) NOT NULL,
    description TEXT,
    date_debut DATETIME NOT NULL,
    date_fin DATETIME NOT NULL,
    utilisateur_id INT,
    FOREIGN KEY (utilisateur_id) REFERENCES utilisateurs(id)
);

-- Table des rôles et permissions
CREATE TABLE roles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(255) NOT NULL
);

CREATE TABLE permissions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(255) NOT NULL
);

CREATE TABLE role_permissions (
    role_id INT,
    permission_id INT,
    PRIMARY KEY (role_id, permission_id),
    FOREIGN KEY (role_id) REFERENCES roles(id),
    FOREIGN KEY (permission_id) REFERENCES permissions(id)
);

CREATE TABLE utilisateur_roles (
    utilisateur_id INT,
    role_id INT,
    PRIMARY KEY (utilisateur_id, role_id),
    FOREIGN KEY (utilisateur_id) REFERENCES utilisateurs(id),
    FOREIGN KEY (role_id) REFERENCES roles(id)
);