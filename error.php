<?php
// Démarrer la session pour afficher les messages d'erreur
session_start();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Erreur d'inscription</title>
</head>
<body>
    <h2>Erreur d'inscription</h2>
    <p><?php echo $_SESSION['error']; ?></p>
    <a href="inscription.php">Retour à l'inscription</a>
</body>
</html>

<?php
// Nettoyer l'erreur après affichage
unset($_SESSION['error']);
?>