<?php
// Démarrer la session pour gérer les informations
session_start();

// Simuler des informations de patient pour l'exemple
// Normalement, ces données proviendraient d'une base de données
$patients = [
    ['nom' => 'Dupont', 'prenom' => 'Jean', 'telephone' => '0123456789', 'email' => 'jean.dupont@example.com'],
    ['nom' => 'Durand', 'prenom' => 'Marie', 'telephone' => '0987654321', 'email' => 'marie.durand@example.com'],
];

if (isset($_GET['patient'])) {
    $patient = $_GET['patient'];
    // Stocker les informations du patient sélectionné dans la session
    $_SESSION['patientNom'] = $patients[$patient]['nom'];
    $_SESSION['patientPrenom'] = $patients[$patient]['prenom'];
    $_SESSION['patientTelephone'] = $patients[$patient]['telephone'];
    $_SESSION['patientEmail'] = $patients[$patient]['email'];

    // Rediriger vers la page des détails
    header("Location: details_patient.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Patients</title>
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
        .patient {
            margin: 15px 0;
            padding: 10px;
            background: #3c3c3c;
            border-radius: 4px;
        }
        .btn {
            padding: 10px;
            background-color: #14476B;
            color: white;
            text-decoration: none;
            border-radius: 4px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Liste des Patients</h2>
        <?php foreach ($patients as $index => $patient): ?>
            <div class="patient">
                <p><strong>Nom:</strong> <?php echo $patient['nom']; ?></p>
                <p><strong>Prénom:</strong> <?php echo $patient['prenom']; ?></p>
                <a href="?patient=<?php echo $index; ?>" class="btn">Voir Détails</a>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>