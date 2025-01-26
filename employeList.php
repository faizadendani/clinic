<?php
// Démarrer la session pour gérer les informations
session_start();

// Simuler des informations d'employé pour l'exemple
// Normalement, ces données viendraient d'une base de données
$employes = [
    ['nom' => 'Dupont', 'prenom' => 'Jean', 'telephone' => '0123456789', 'email' => 'jean.dupont@example.com', 'adresse' => '1 Rue Exemple', 'specialite' => 'Médecin'],
    ['nom' => 'Durand', 'prenom' => 'Marie', 'telephone' => '0987654321', 'email' => 'marie.durand@example.com', 'adresse' => '2 Rue Exemple', 'specialite' => 'Dentiste'],
];

if (isset($_GET['employe'])) {
    $employe = $_GET['employe'];
    // Stocker les informations de l'employé sélectionné dans la session
    $_SESSION['employeNom'] = $employes[$employe]['nom'];
    $_SESSION['employePrenom'] = $employes[$employe]['prenom'];
    $_SESSION['employeTelephone'] = $employes[$employe]['telephone'];
    $_SESSION['employeEmail'] = $employes[$employe]['email'];
    $_SESSION['employeAdresse'] = $employes[$employe]['adresse'];
    $_SESSION['employeSpecialite'] = $employes[$employe]['specialite'];

    // Rediriger vers la page des détails
    header("Location: details_employe.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Employés</title>
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
        .employe {
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
        <h2>Liste des Employés</h2>
        <?php foreach ($employes as $index => $employe): ?>
            <div class="employe">
                <p><strong>Nom:</strong> <?php echo $employe['nom']; ?></p>
                <p><strong>Prénom:</strong> <?php echo $employe['prenom']; ?></p>
                <a href="?employe=<?php echo $index; ?>" class="btn">Voir Détails</a>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>