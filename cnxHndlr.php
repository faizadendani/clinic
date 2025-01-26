<?php
session_start(); // Démarre la session pour l'utilisateur

// Connexion à la base de données (ajustez les paramètres selon votre configuration)
$host = 'localhost';
$db = 'votre_base_de_donnees';
$user = 'votre_utilisateur';
$pass = 'votre_mot_de_passe';

try {
    // Création de la connexion PDO
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}

// Vérifier si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Nettoyage des entrées
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];

    // Vérification si l'email est valide
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo '<script>alert("L\'email n\'est pas valide !"); window.location.href = "connexion.php";</script>';
        exit;
    }

    // Préparer et exécuter la requête pour récupérer l'utilisateur par email
    $stmt = $pdo->prepare('SELECT id, email, password FROM utilisateurs WHERE email = :email');
    $stmt->execute(['email' => $email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Vérifier si l'utilisateur existe et si le mot de passe est correct
    if ($user && password_verify($password, $user['password'])) {
        // Authentification réussie
        $_SESSION['user_id'] = $user['id']; // Stocker l'ID de l'utilisateur dans la session
        $_SESSION['email'] = $user['email']; // Stocker l'email dans la session

        // Rediriger vers une page sécurisée (par exemple, tableau de bord)
        echo '<script>alert("Connexion réussie !"); window.location.href = "dashboard.php";</script>';
    } else {
        // Mot de passe ou email incorrect
        echo '<script>alert("Email ou mot de passe incorrect !"); window.location.href = "connexion.php";</script>';
    }
}
?>