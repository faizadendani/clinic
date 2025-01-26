<?php
// Démarrer la session pour afficher les messages
session_start();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription réussie</title>
</head>
<body>
    <h2>Inscription réussie</h2>
    <p><?php echo $_SESSION['message']; ?></p>
    <a href="connexion.php">Connectez-vous maintenant</a>
</body>
</html>

<?php
// Nettoyer le message après affichage
unset($_SESSION['message']);
?>