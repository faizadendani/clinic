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
    /* Global Styles */
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      background-color: #121212; /* Fond sombre */
      color: #e0e0e0; /* Texte clair */
    }
    
    .container {
      width: 90%;
      margin: auto;
      max-width: 1200px;
    }
    
    /* Header */
    .header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 20px 0;
    }
    
    .header h1 {
      font-size: 2rem;
      color: #007bff; /* Couleur du titre */
    }
    
    .btn {
      background-color: #14476B; /* Couleur du bouton */
      color: white;
      border: none;
      padding: 10px 20px;
      border-radius: 5px;
      cursor: pointer;
    }
    
    .btn:hover {
      background-color: #14476B;; /* Couleur au survol */
    }
    
    /* Stats Section */
    .stats {
      display: flex;
      justify-content: space-between;
      margin: 20px 0;
    }
    
    .stat-card {
      background-color: #1e1e1e; /* Fond des cartes statistiques */
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
      text-align: center;
      width: 30%;
    }
    
    .stat-card h2 {
      font-size: 1.2rem;
      margin-bottom: 10px;
    }
    
    .stat-card p {
      font-size: 1.5rem;
      color: ##14476B;; /* Couleur des chiffres */
    }
    
    /* Table Section */
    .table-section {
      background-color: #1e1e1e; /* Fond de la section table */
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
    }
    
    table {
      width: 100%;
      border-collapse: collapse;
    }
    
    thead {
      background-color: #14476B;; /* Couleur du header de la table */
      color: white;
    }
    
    thead th {
      padding: 10px;
      text-align: left;
    }
    
    tbody tr:nth-child(even) {
      background-color: #2a2a2a; /* Lignes paires de la table */
    }
    
    tbody td {
      padding: 10px;
    }
    
    .status {
      padding: 5px 10px;
      border-radius: 5px;
      font-size: 0.9rem;
      font-weight: bold;
    }
    
    .in-stock {
      background-color: #0d98162c; /* Couleur pour "En Stock" */
      color: white; /* Texte pour "En Stock" */
    }
    
    .low-stock {
      background-color: #98730d85; /* Couleur pour "Faible" */
      color: white; /* Texte pour "Faible" */
    }
    
    .out-of-stock {
      background-color: #721c258b; /* Couleur pour "Rupture" */
      color: white; /* Texte pour "Rupture" */
    }
    
    /* Buttons in Table */
    .btn-edit {
        background-color: #007bff; /* Couleur du bouton Modifier */
        border: none;
        padding: 5px 10px;
        color: white;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s ease; 
     }

     .btn-edit:hover {
        background-color:#007bff; /* Couleur au survol pour Modifier*/
     }

     .btn-delete {
        background-color:#dc3546b6; /* Couleur du bouton Supprimer */
        border:none; 
        padding :5px 10px ;
        color:white ;
        border-radius :5px ;
        cursor:pointer ;
        transition :background-color 0.3s ease ; 
     }

     .btn-delete:hover{
         background-color:#c8233378 ;/*Couleur au survol pour Supprimer*/
     } 
  </style>
</head>
<body>
<div class="container">
<!-- Header -->
<header class="header">
<h1>Gestion de Stock</h1>
 <button class="btn" onclick="window.location.href='ajout_article.php'">+ Ajouter un Article</button>
</header>

<!-- Dashboard Stats -->
<section class="stats">
<div class="stat-card">
<h2>Total Articles</h2>
<p><?php echo $result->num_rows; ?></p>
</div>
<div class="stat-card">
<h2>Proches de Rupture</h2>
<p>12</p>
</div>
<div class="stat-card">
<h2>Articles Expirés</h2>
<p>4</p>
</div>
</section>

<!-- Table Section -->
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
                <a href='?delete=" . $row['id'] . "' class='btn-delete'>Supprimer</a>
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