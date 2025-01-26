<?php
// Connexion à la base de données (remplace les valeurs avec tes propres informations)
$servername = "localhost";
$username = "root"; // Remplace par ton nom d'utilisateur MySQL
$password = ""; // Remplace par ton mot de passe
$dbname = "clinic"; // Remplace par ton nom de base de données

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Récupérer les informations du client (exemple avec un ID)
$sql = "SELECT * FROM clients WHERE id = 1"; // Remplace 1 par l'ID du client si nécessaire
$result = $conn->query($sql);
$client = $result->fetch_assoc();

// Récupérer les rendez-vous
$appointmentsSql = "SELECT * FROM appointments WHERE client_id = 1"; // Remplace avec ton ID
$appointmentsResult = $conn->query($appointmentsSql);
$appointments = $appointmentsResult->fetch_all(MYSQLI_ASSOC);

// Récupérer les paiements
$paymentsSql = "SELECT * FROM payments WHERE client_id = 1"; // Remplace avec ton ID
$paymentsResult = $conn->query($paymentsSql);
$payments = $paymentsResult->fetch_all(MYSQLI_ASSOC);

// Fermer la connexion
$conn->close();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Client</title>
    <style>
        /* Ton code CSS ici */
    </style>
</head>
<body>

    <div class="container">
        <h1>Profil Client</h1>

        <!-- Informations Personnelles -->
        <div class="section">
            <h3>Informations Personnelles</h3>
            <table class="info-table" id="infoTable">
                <tr><th>Nom :</th><td id="name"><?= $client['name']; ?></td></tr>
                <tr><th>Date de naissance :</th><td id="dob"><?= $client['dob']; ?></td></tr>
                <tr><th>Numéro de téléphone :</th><td id="phone"><?= $client['phone']; ?></td></tr>
                <tr><th>Email :</th><td id="email"><?= $client['email']; ?></td></tr>
                <tr><th>Adresse :</th><td id="address"><?= $client['address']; ?></td></tr>
            </table>
            <button onclick="editPersonalInfo()">Modifier mes informations</button>
        </div>

        <!-- Historique des Rendez-vous -->
        <div class="section">
            <h3>Historique des Rendez-vous</h3>
            <h4>Prochain Rendez-vous :</h4>
            <table class="appointment-table" id="upcomingAppointment">
                <tr><th>Date :</th><td>05/01/2024</td></tr>
                <tr><th>Heure :</th><td>10h00</td></tr>
                <tr><th>Médecin :</th><td>Dr. Ahmed</td></tr>
                <tr><th>Traitement prévu :</th><td>Nettoyage dentaire</td></tr>
            </table>

            <h4>Rendez-vous Passés :</h4>
            <table class="appointment-table" id="pastAppointments">
                <?php foreach ($appointments as $appointment): ?>
                    <tr>
                        <td><?= $appointment['date']; ?></td>
                        <td><?= $appointment['treatment']; ?></td>
                        <td><?= $appointment['doctor']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
            <button onclick="addAppointment()">Ajouter un Rendez-vous</button>
        </div>

        <!-- Historique des Paiements -->
        <div class="section">
            <h3>Historique des Paiements</h3>
            <table class="payment-table" id="paymentHistory">
                <?php foreach ($payments as $payment): ?>
                    <tr>
                        <td><?= $payment['date']; ?></td>
                        <td><?= $payment['amount']; ?></td>
                        <td><?= $payment['for']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
            <button onclick="addPayment()">Ajouter un Paiement</button>
        </div>

        <!-- Notifications -->
        <div class="section">
            <h3>Notifications</h3>
            <div class="notification" id="notification">
                <!-- Notifications dynamiques -->
            </div>
        </div>

        <!-- Actions -->
        <div class="actions">
            <button onclick="modifyInfo()">Modifier mes informations</button>
            <button onclick="cancelAppointment()">Annuler le rendez-vous</button>
            <button onclick="bookNewAppointment()">Prendre un nouveau rendez-vous</button>
            <button onclick="contactSupport()">Contacter le support</button>
        </div>

    </div>

    <script>
        // Fonction pour modifier les informations personnelles
        function editPersonalInfo() {
            const newName = prompt("Entrez le nouveau nom", document.getElementById('name').innerText);
            if (newName) {
                document.getElementById('name').innerText = newName;
            }
            const newDob = prompt("Entrez la nouvelle date de naissance", document.getElementById('dob').innerText);
            if (newDob) {
                document.getElementById('dob').innerText = newDob;
            }
            const newPhone = prompt("Entrez le nouveau numéro de téléphone", document.getElementById('phone').innerText);
            if (newPhone) {
                document.getElementById('phone').innerText = newPhone;
            }
            const newEmail = prompt("Entrez le nouvel email", document.getElementById('email').innerText);
            if (newEmail) {
                document.getElementById('email').innerText = newEmail;
            }
            const newAddress = prompt("Entrez la nouvelle adresse", document.getElementById('address').innerText);
            if (newAddress) {
                document.getElementById('address').innerText = newAddress;
            }
        }

        // Ajouter un rendez-vous
        function addAppointment() {
            const date = prompt("Entrez la date du rendez-vous");
            const treatment = prompt("Entrez le traitement prévu");
            const doctor = prompt("Entrez le nom du médecin");
            if (date && treatment && doctor) {
                const newAppointment = { date, treatment, doctor };
                // Ajoute dynamiquement l'élément dans la table
                const table = document.getElementById('pastAppointments');
                const row = `<tr><td>${newAppointment.date}</td><td>${newAppointment.treatment}</td><td>${newAppointment.doctor}</td></tr>`;
                table.innerHTML += row;
            }
        }

        // Ajouter un paiement
        function addPayment() {
            const date = prompt("Entrez la date du paiement");
            const amount = prompt("Entrez le montant");
            const forWhat = prompt("Entrez la raison du paiement");
            if (date && amount && forWhat) {
                const newPayment = { date, amount, for: forWhat };
                // Ajoute dynamiquement l'élément dans la table
                const table = document.getElementById('paymentHistory');
                const row = `<tr><td>${newPayment.date}</td><td>${newPayment.amount}</td><td>${newPayment.for}</td></tr>`;
                table.innerHTML += row;
            }
        }

        // Notifications dynamiques
        function showNotification(message) {
            const notificationDiv = document.getElementById('notification');
            notificationDiv.innerHTML = `<p><strong>${message}</strong></p>`;
        }

        // Initialisation
        showNotification("Votre prochain rendez-vous est dans 5 jours.");

        // Actions des boutons
        function modifyInfo() {
            editPersonalInfo();
        }

        function cancelAppointment() {
            alert("Le rendez-vous a été annulé.");
        }

        function bookNewAppointment() {
            alert("Prenez un nouveau rendez-vous!");
        }

        function contactSupport() {
            alert("Contacter le support");
        }
    </script>

</body>
</html>