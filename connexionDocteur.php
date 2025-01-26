<?php
// Initialisation des variables pour capturer les erreurs ou les messages
$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Récupération des données du formulaire
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    // Simuler une vérification des identifiants (à remplacer par une vraie logique de vérification, comme une requête à une base de données)
    $userEmail = "exemple@mail.com"; // Exemple d'email stocké
    $userPassword = "123456";       // Exemple de mot de passe stocké

    if ($email === $userEmail && $password === $userPassword) {
        $message = "Connexion réussie !";
    } else {
        $message = "Email ou mot de passe incorrect.";
    }
}
?>

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

        .message {
            text-align: center;
            margin-bottom: 15px;
            font-size: 16px;
            color: lightgreen;
        }

        .error {
            color: red;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Connexion</h2>
        <?php if (!empty($message)): ?>
            <div class="message <?php echo ($message === "Connexion réussie !") ? '' : 'error'; ?>">
                <?php echo htmlspecialchars($message); ?>
            </div>
        <?php endif; ?>
        <form id="connexion" method="POST" action="">
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
    </div>
</body>
</html>