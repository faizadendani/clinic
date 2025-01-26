<?php
// Exemple de tableau simulé pour les patients
$patients = [
    ['id' => 1, 'nom' => 'bouhadja', 'prenom' => 'yasser', 'telephone' => '0555-123456', 'email' => 'bou_yase@example.com'],
    ['id' => 2, 'nom' => 'bounatiro', 'prenom' => 'lamia', 'telephone' => '0666-654321', 'email' => 'lamiabou@example.com']
];

// Ajouter un nouveau patient
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $new_patient = [
        'id' => count($patients) + 1,
        'nom' => $_POST['nom'],
        'prenom' => $_POST['prenom'],
        'telephone' => $_POST['telephone'],
        'email' => $_POST['email']
    ];
    $patients[] = $new_patient;
}

// Supprimer un patient
if (isset($_GET['delete'])) {
    $id_to_delete = $_GET['delete'];
    $patients = array_filter($patients, fn($patient) => $patient['id'] != $id_to_delete);
    $patients = array_values($patients); // Réindexer le tableau
}

// Modifier un patient
if (isset($_GET['edit'])) {
    $id_to_edit = $_GET['edit'];
    $patient_to_edit = null;
    foreach ($patients as &$patient) {
        if ($patient['id'] == $id_to_edit) {
            $patient_to_edit = &$patient;
            break;
        }
    }
}

// Mise à jour du patient modifié (après avoir rempli un formulaire)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
    $updated_patient = [
        'id' => $_POST['id'],
        'nom' => $_POST['nom'],
        'prenom' => $_POST['prenom'],
        'telephone' => $_POST['telephone'],
        'email' => $_POST['email']
    ];
    foreach ($patients as &$patient) {
        if ($patient['id'] == $updated_patient['id']) {
            $patient = $updated_patient;
            break;
        }
    }
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Patients</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #121212;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 90%;
            margin: 30px ;
            background: #2c2c2c;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f4f4f4;
        }
        tr{
            color: white;
        }
        .btn {
            padding: 5px 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .btn-primary {
            background-color: #00ff1132;
            color: white;
        }
        .btn-warning {
            background-color: #98730d85;
            color: white;
        }
        .btn-danger {
            background-color: #721c258b;
            color: white;
        }
        .btn-success {
            background-color: #14476B;
            color: white;
        }
        .form-label {
            font-weight:normal;
            color: wheat;
        }
        .form-control {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }
        h3{
            color: #f4f4f4b8;
        }
        h2{
            color: #007bff;
        }
        .one{
            color: #14476B;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="text-center mb-4">Gestion des Patients</h2>
<br>
        <!-- Section pour afficher la liste des patients déjà inscrits -->
        <div class="card mb-4">
            <h3>Patients Inscrits</h3>
            <table>
                <thead>
                    <tr class="one">
                        <th>#</th>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Téléphone</th>
                        <th>Email</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($patients as $patient): ?>
                        <tr>
                            <td><?php echo $patient['id']; ?></td>
                            <td><?php echo $patient['nom']; ?></td>
                            <td><?php echo $patient['prenom']; ?></td>
                            <td><?php echo $patient['telephone']; ?></td>
                            <td><?php echo $patient['email']; ?></td>
                            <td>
                                <a href="?edit=<?php echo $patient['id']; ?>" class="btn btn-primary btn-sm">Voir</a>
                                <a href="?edit=<?php echo $patient['id']; ?>" class="btn btn-warning btn-sm">Modifier</a>
                                <a href="?delete=<?php echo $patient['id']; ?>" class="btn btn-danger btn-sm">Supprimer</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <!-- Section pour ajouter un nouveau patient -->
        <div class="card">
            <h3>Ajouter un Nouveau Patient</h3>
            <form method="POST">
                <label for="nom" class="form-label">Nom</label>
                <input type="text" class="form-control" name="nom" placeholder="Entrer le nom du patient" required>

                <label for="prenom" class="form-label">Prénom</label>
                <input type="text" class="form-control" name="prenom" placeholder="Entrer le prénom du patient" required>

                <label for="telephone" class="form-label">Téléphone</label>
                <input type="text" class="form-control" name="telephone" placeholder="Entrer le numéro de téléphone" required>

                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" name="email" placeholder="Entrer l'email du patient" required>

                <button type="submit" class="btn btn-success">Enregistrer</button>
            </form>
        </div>
    </div>

</body>
</html>