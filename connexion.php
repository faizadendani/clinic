<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <style>
        body {
            color: beige;
            font-family: Arial, sans-serif;
            background-image: url(home.jpg);
            padding: 20px;
        }
        .container {
            max-width: 400px;
            margin: auto;
            background: #1d1d1d;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px black;
        }
        h2 {
            color: #007bff;
            text-align: center;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
        }
        .form-group input {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
        }
        button {
            width: 100%;
            padding: 10px;
            background-color: #14476B;
            color: white;
            border: none;
            cursor: pointer;
        }
        button:hover {
            background-color: #14476B;
        }
        .but {
            color: #007bff;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Connexion</h2>
        <form id="connexion" method="POST" action="connexion_handler.php">
            <div class="form-group">
                <label for="email">Email :</label>
                <input type="email" name="email" id="email" required placeholder="Entrer votre email">
            </div>
            <div class="form-group">
                <label for="password">Mot de passe :</label>
                <input type="password" name="password" id="password" required placeholder="..........">
            </div>
            <button type="submit">Se connecter</button>
        </form>
        <p>Pas encore de compte ? <a href="inscription.php" class="but">Inscrivez-vous ici</a>.</p>
    </div>
</body>
</html>

<?php
// connexion_handler.php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    // Exemple de vérification basique (à remplacer par une vérification en base de données)
    if ($email === 'user@example.com' && $password === 'password123') {
        echo '<script>alert("Connexion réussie !");</script>';
    } else {
        echo '<script>alert("Email ou mot de passe incorrect !");</script>';
    }
}
?>