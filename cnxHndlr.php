<?php
$host = 'localhost'; // Adresse du serveur (ou '127.0.0.1')
$dbname = 'nom_de_ta_base_de_donnees'; // Nom de la base de données
$username = 'nom_utilisateur'; // Nom d'utilisateur MySQL
$password = 'mot_de_passe'; // Mot de passe MySQL

try {
    // Connexion à la base de données avec PDO
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    // Activer les exceptions en cas d'erreur
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connexion réussie à la base de données.";
} catch (PDOException $e) {
    // Gestion des erreurs de connexion
    die("Erreur de connexion : " . $e->getMessage());
}
?>
