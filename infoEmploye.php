<?php
// Démarrer la session pour récupérer les informations
session_start();

// Vérifier si les informations sont disponibles dans la session
if (!isset($_SESSION['employeNom']) || !isset($_SESSION['employePrenom'])) {
    // Rediriger l'utilisateur s'il n'y a pas d'informations
    header("Location: employe_list.php"); // Remplacez par la page de la liste des employés
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails du Patient</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #121212;
            color: white;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 800px;
            margin: 30px auto;
            background: #2c2c2c;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        h2 {
            text-align: center;
            color: #007bff;
        }
        .btn {
            padding: 10px;
            background-color: #14476B;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            display: inline-block;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Détails d'employé</h2>
        <p><strong>Nom:</strong> <?php echo $_SESSION['employeNom']; ?></p>
        <p><strong>Prénom:</strong> <?php echo $_SESSION['employePrenom']; ?></p>
        <p><strong>Téléphone:</strong> <?php echo $_SESSION['employeTelephone']; ?></p>
        <p><strong>Email:</strong> <?php echo $_SESSION['employeEmail']; ?></p>
        <p><strong>Adresse:</strong> <?php echo $_SESSION['employeAdresse']; ?></p>
        <p><strong>Spécialité:</strong> <?php echo $_SESSION['employeSpecialite']; ?></p>

        <a href="employe_list.php" class="btn">Retour à la liste des employés</a>
    </div>

    <?php
    // Optionnel : Supprimer les informations de session après affichage si nécessaire
    // unset($_SESSION['employeNom']);
    // unset($_SESSION['employePrenom']);
    // unset($_SESSION['employeTelephone']);
    // unset($_SESSION['employeEmail']);
    // unset($_SESSION['employeAdresse']);
    // unset($_SESSION['employeSpecialite']);
    ?>
</body>
</html>