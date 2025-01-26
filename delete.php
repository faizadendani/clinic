<?php
include 'db_connection.php';

// Vérifier si l'ID de l'employé est passé en paramètre
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Supprimer l'employé
    $sql = "DELETE FROM employes WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        header("Location: index.php"); // Rediriger vers la liste des employés
    } else {
        echo "Erreur: " . $conn->error;
    }
}

$conn->close();
?>