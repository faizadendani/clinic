<?php
// Démarrer la session pour récupérer les informations
session_start();

// Exemple d'article pour la démonstration (dans une vraie application, les données viendraient de la base de données)
$article = [
    'name' => 'Aspirine',
    'category' => 'Médicaments',
    'quantity' => 100,
    'supplier' => 'PharmaCorp',
    'expiry' => '2025-12-31'
];

// Vérifier si le formulaire est soumis
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Récupérer les données du formulaire
    $name = $_POST['name'];
    $category = $_POST['category'];
    $quantity = $_POST['quantity'];
    $supplier = $_POST['supplier'];
    $expiry = $_POST['expiry'];

    // Ici, vous pouvez ajouter une logique pour enregistrer les données dans la base de données
    // Par exemple : mettre à jour l'article dans la base de données

    // Afficher un message de succès (ici, pour la démo)
    echo "<p>Les modifications ont été enregistrées avec succès !</p>";
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Modifier un Article</title>
  <style>
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
      max-width: 600px;
      padding: 20px;
      background-color: #1e1e1e;
      border-radius: 10px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
    }

    h1 {
      text-align: center;
      color: #007bff;
    }

    label {
      display: block;
      margin: 10px 0 5px;
    }

    input, select {
      width: 100%;
      padding: 10px;
      margin-bottom: 15px;
      border-radius: 5px;
      border: none;
      background-color: rgba(250, 235, 215, 0.524);
    }

    .btn {
      display: block;
      width: 100%;
      padding: 10px;
      background-color:#0056b3;
      color: white;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      text-align: center;
    }

    .btn:hover {
      background-color: #0056b3;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>Modifier un Article</h1>
    <form method="POST" action="modifier_article.php">
      <label for="name">Nom de l'article</label>
      <input type="text" id="name" name="name" value="<?php echo $article['name']; ?>" required>

      <label for="category">Catégorie</label>
      <select id="category" name="category" required>
        <option value="Médicaments" <?php echo ($article['category'] == 'Médicaments') ? 'selected' : ''; ?>>Médicaments</option>
        <option value="Hygiène" <?php echo ($article['category'] == 'Hygiène') ? 'selected' : ''; ?>>Hygiène</option>
        <option value="Produits" <?php echo ($article['category'] == 'Produits') ? 'selected' : ''; ?>>Produits</option>
      </select>

      <label for="quantity">Quantité</label>
      <input type="number" id="quantity" name="quantity" value="<?php echo $article['quantity']; ?>" required>

      <label for="supplier">Fournisseur</label>
      <input type="text" id="supplier" name="supplier" value="<?php echo $article['supplier']; ?>" required>

      <label for="expiry">Date de Péremption</label>
      <input type="date" id="expiry" name="expiry" value="<?php echo $article['expiry']; ?>" required>

      <button type="submit" class="btn">Enregistrer les Modifications</button>
    </form>
  </div>
</body>
</html>