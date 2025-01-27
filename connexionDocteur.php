<?php
// Initialisation des variables pour capturer les erreurs ou les messages
$message = "";

// Connexion à la base de données
$host = 'localhost'; // عادةً localhost إذا كنت تعمل على XAMPP
$dbname = 'nom_de_ta_base_de_donnees'; // اسم قاعدة البيانات
$username = 'root'; // اسم المستخدم الافتراضي
$password = ''; // كلمة المرور الافتراضية (تكون فارغة على XAMPP)

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        // Récupération des données du formulaire
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        // Vérification dans la base de données
        $stmt = $pdo->prepare("SELECT * FROM utilisateurs WHERE email = :email");
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && $user['mot_de_passe'] === $password) {
            $message = "Connexion réussie !";
        } else {
            $message = "Email ou mot de passe incorrect.";
        }
    }
} catch (PDOException $e) {
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}
?>
