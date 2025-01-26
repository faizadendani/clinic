<?php
// Connexion à la base de données
$servername = "localhost";
$username = "root"; // Remplacez avec vos informations de connexion
$password = "";
$dbname = "cabinet_dentaire"; // Nom de votre base de données

$conn = new mysqli($servername, $username, $password, $dbname);

// Vérification de la connexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Supprimer un article
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $sql = "DELETE FROM stock WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo "Article supprimé avec succès!";
    } else {
        echo "Erreur: " . $conn->error;
    }
}

// Récupérer les articles
$sql = "SELECT * FROM stock";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gestion de Stock - Cabinet Dentaire</title>
  <style>
    /* Vos styles CSS ici */
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      background-color: #121212;
      color: #e0e0e0;
    }
    .container {
      width: 90%;
      margin: auto;
      max-width: 1200px;
    }
    .header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 20px 0;
    }
    .header h1 {
      font-size: 2rem;
      color: #007bff;
    }
    .btn {
      background-color: #14476B;
      color: white;
      border: none;
      padding: 10px 20px;
      border-radius: 5px;
      cursor: pointer;
    }
    .btn:hover {
      background-color: #007bff;
    }
    /* Autres styles CSS pour la table, les cartes, etc. */
  </style>
</head>
<body>
<div class="container">
  <header class="header">
    <h1>Gestion de Stock</h1>
    <button class="btn" onclick="window.location.href='ajout_article.php'">+ Ajouter un Article</button>
  </header>

  <!-- Tableau des articles -->
  <section class="table-section">
    <table>
      <thead>
        <tr>
          <th>Nom</th>
          <th>Catégorie</th>
          <th>Quantité</th>
          <th>Fournisseur</th>
          <th>Date de Péremption</th>
          <th>État</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php
        // Affichage des articles
        while ($row = $result->fetch_assoc()) {
            $statusClass = '';
            if ($row['quantity'] > 0) {
                $statusClass = 'in-stock';
            } elseif ($row['quantity'] <= 10) {
                $statusClass = 'low-stock';
            } else {
                $statusClass = 'out-of-stock';
            }
            echo "<tr>
                    <td>" . $row['name'] . "</td>
                    <td>" . $row['category'] . "</td>
                    <td>" . $row['quantity'] . "</td>
                    <td>" . $row['supplier'] . "</td>
                    <td>" . $row['expiry'] . "</td>
                    <td><span class='status $statusClass'>" . ucfirst(str_replace('-', ' ', $statusClass)) . "</span></td>
                    <td>
                        <a href='modifier_article.php?id=" . $row['id'] . "' class='btn-edit'>Modifier</a>
                        <a href='gestion_stock.php?delete=" . $row['id'] . "' class='btn-delete'>Supprimer</a>
                    </td>
                  </tr>";
        }
        ?>
      </tbody>
    </table>
  </section>
</div>

</body>
</html>

<?php
// Fermer la connexion
$conn->close();
?>