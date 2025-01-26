<?php
include 'db_connection.php';

// Vérifier si l'ID de l'employé est passé en paramètre
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Récupérer les informations de l'employé
    $sql = "SELECT * FROM employes WHERE id = $id";
    $result = $conn->query($sql);
    $employe = $result->fetch_assoc();
}

// Vérifier si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $telephone = $_POST['telephone'];
    $email = $_POST['email'];
    $adresse = $_POST['adresse'];
    $specialite = $_POST['specialite'];

    // Mettre à jour les informations de l'employé
    $update_sql = "UPDATE employes SET nom='$nom', prenom='$prenom', telephone='$telephone', email='$email', adresse='$adresse', specialite='$specialite' WHERE id=$id";

    if ($conn->query($update_sql) === TRUE) {
        header("Location: index.php"); // Rediriger vers la liste des employés
    } else {
        echo "Erreur: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier l'employé</title>
 <link rel="stylesheet" href="edit.css">
</head>
<body>
    <div class="container">
        <h2>Modifier les informations de l'employé</h2>

        <form method="post">
            <label for="nom">Nom :</label>
            <input type="text" name="nom" value="<?php echo $employe['nom']; ?>" required><br>

            <label for="prenom">Prénom :</label>
            <input type="text" name="prenom" value="<?php echo $employe['prenom']; ?>" required><br>

            <label for="telephone">Téléphone :</label>
            <input type="text" name="telephone" value="<?php echo $employe['telephone']; ?>" required><br>

            <label for="email">Email :</label>
            <input type="email" name="email" value="<?php echo $employe['email']; ?>" required><br>

            <label for="adresse">Adresse :</label>
            <input type="text" name="adresse" value="<?php echo $employe['adresse']; ?>" required><br>

            <label for="specialite">Spécialité :</label>
            <input type="text" name="specialite" value="<?php echo $employe['specialite']; ?>" required><br>

            <button type="submit">Mettre à jour</button>
        </form>
    </div>
</body>
<link rel="stylesheet" href="edit.js">
</html>

<?php
$conn->close();
?>