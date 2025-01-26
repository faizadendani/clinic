<?php
// Démarrer la session pour récupérer les informations
session_start();

// Vérifier si les informations sont disponibles dans la session
if (!isset($_SESSION['patientNom']) || !isset($_SESSION['patientPrenom'])) {
    // Rediriger l'utilisateur s'il n'y a pas d'informations
    header("Location: patient_list.php"); // Remplacez par la page de la liste des patients
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
        <h2>Détails du Patient</h2>
        <p><strong>Nom:</strong> <?php echo $_SESSION['patientNom']; ?></p>
        <p><strong>Prénom:</strong> <?php echo $_SESSION['patientPrenom']; ?></p>
        <p><strong>Téléphone:</strong> <?php echo $_SESSION['patientTelephone']; ?></p>
        <p><strong>Email:</strong> <?php echo $_SESSION['patientEmail']; ?></p>

        <a href="patient_list.php" class="btn">Retour à la liste des patients</a>
    </div>

    <?php
    // Optionnel : Supprimer les informations de session après affichage si nécessaire
    // unset($_SESSION['patientNom']);
    // unset($_SESSION['patientPrenom']);
    // unset($_SESSION['patientTelephone']);
    // unset($_SESSION['patientEmail']);
    ?>
</body>
</html>