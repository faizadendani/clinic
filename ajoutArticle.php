<?php
// Connexion à la base de données
$servername = "localhost";
$username = "root"; // Modifier avec vos informations de connexion
$password = "";
$dbname = "cabinet_dentaire"; // Nom de votre base de données

$conn = new mysqli($servername, $username, $password, $dbname);

// Vérification de la connexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Ajouter un article
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $category = $_POST['category'];
    $quantity = $_POST['quantity'];
    $supplier = $_POST['supplier'];
    $expiry = $_POST['expiry'];

    $sql = "INSERT INTO stock (name, category, quantity, supplier, expiry) 
            VALUES ('$name', '$category', '$quantity', '$supplier', '$expiry')";

    if ($conn->query($sql) === TRUE) {
        echo "Article ajouté avec succès!";
        header('Location: gestion_stock.php'); // Rediriger après ajout
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
  <title>Ajouter un Article</title>
</head>
<body>
  <h1>Ajouter un Article</h1>
  <form method="POST">
    <label for="name">Nom de l'article :</label><br>
    <input type="text" id="name" name="name" required><br><br>

    <label for="category">Catégorie :</label><br>
    <input type="text" id="category" name="category" required><br><br>

    <label for="quantity">Quantité :</label><br>
    <input type="number" id="quantity" name="quantity" required><br><br>

    <label for="supplier">Fournisseur :</label><br>
    <input type="text" id="supplier" name="supplier" required><br><br>

    <label for="expiry">Date de péremption :</label><br>
    <input type="date" id="expiry" name="expiry" required><br><br>

    <input type="submit" value="Ajouter Article">
  </form>
</body>
</html>

<?php
// Fermer la connexion
$conn->close();
?>