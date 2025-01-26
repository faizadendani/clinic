<?php
// Modifier les informations du patient (modifier_patient.php)

header('Content-Type: application/json'); // Définir le type de réponse comme JSON

// Récupérer les données envoyées en POST (format JSON)
$data = json_decode(file_get_contents('php://input'), true);

if (isset($data['nom'], $data['prenom'], $data['telephone'], $data['email'])) {
    // Connexion à la base de données
    $host = 'localhost';
    $db = 'votre_base_de_donnees';
    $user = 'votre_utilisateur';
    $pass = 'votre_mot_de_passe';

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Préparer la requête pour mettre à jour les informations du patient
        $sql = "UPDATE patients SET nom = :nom, prenom = :prenom, telephone = :telephone, email = :email WHERE id = :id";
        
        // Préparer la requête
        $stmt = $pdo->prepare($sql);

        // Lier les paramètres
        $stmt->bindParam(':nom', $data['nom']);
        $stmt->bindParam(':prenom', $data['prenom']);
        $stmt->bindParam(':telephone', $data['telephone']);
        $stmt->bindParam(':email', $data['email']);
        // Supposons que l'ID du patient est envoyé avec la requête (vous devrez l'ajouter dans le formulaire ou le récupérer via session)
        $stmt->bindParam(':id', $data['id']); // Remplacez par la variable réelle contenant l'ID du patient

        // Exécuter la requête
        $stmt->execute();

        // Répondre avec un succès
        echo json_encode(['success' => true]);

    } catch (PDOException $e) {
        // En cas d'erreur
        echo json_encode(['success' => false, 'error' => $e->getMessage()]);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Données manquantes']);
}
?>