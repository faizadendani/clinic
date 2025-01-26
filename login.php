<?php
require 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);
    
    // Préparer et exécuter la requête
    $sql = 'SELECT * FROM utilisateurs WHERE email = :email';
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['email' => $email]);
    $user = $stmt->fetch();
    
    if ($user && password_verify($password, $user['mot_de_passe'])) {
        // Connexion réussie
        session_start();
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['nom'];
        header("Location: dashboard.php");
        exit();
    } else {
        // Informations d'identification incorrectes
        echo "Email ou mot de passe incorrect.";
    }
} else {
    header("Location: index.php");
    exit();
}
?>