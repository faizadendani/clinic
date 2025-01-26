<?php
// Traitement des données du formulaire si le formulaire est soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $service = $_POST['service'];
    $date = $_POST['date'];

    // Vous pouvez ajouter la logique pour enregistrer les données dans une base de données
    $confirmationMessage = "Merci, $name ! Votre rendez-vous pour $service a été confirmé pour le $date.";
} else {
    $confirmationMessage = '';
}

$monthNames = ["Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Décembre"];
$currentMonth = date("n") - 1; // Le mois courant (0-11)
$currentYear = date("Y");
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Demande de rendez-vous</title>
    <style>
        /* Votre style CSS reste inchangé */
        /* ... */
    </style>
</head>
<body>
    <div class="form-container">
        <div class="form">
            <h1>Demande de rendez-vous</h1>
            <div class="tabs">
                <div class="tab active" data-tab="contact">Informations de contact</div>
                <div class="tab" data-tab="service">Choix du service</div>
                <div class="tab" data-tab="date">Choix du date</div>
            </div>
            <form method="POST">
                <div class="form-section active" id="contact">
                    <div class="form-group">
                        <input type="text" name="name" placeholder="Entrez votre nom et prénom" required>
                    </div>
                    <div class="form-group">
                        <input type="email" name="email" placeholder="Entrez votre email" required>
                    </div>
                    <div class="form-group">
                        <input type="text" name="phone" placeholder="Entrez votre numéro de portable" required>
                    </div>
                    <button type="button" class="next">Étape suivante</button>
                </div>
                <div class="form-section" id="service">
                    <div class="form-group">
                        <select name="service" required>
                            <option value="">Choisissez un service</option>
                            <option value="implant">Implant</option>
                            <option value="facette">Facette</option>
                            <option value="blanchiment">Blanchiment</option>
                            <option value="orthodontie">Orthodontie</option>
                            <option value="soin">Soin</option>
                            <option value="prothese">Prothèse fixe</option>
                            <option value="radiologie">Radiologie</option>
                            <option value="autre">Autre</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <textarea name="comment" placeholder="Commentaire ou note additionnelle"></textarea>
                    </div>
                    <button type="button" class="prev">Étape précédente</button>
                    <button type="button" class="next">Étape suivante</button>
                </div>
                <div class="form-section" id="date">
                    <p>Sélectionnez une date disponible dans le calendrier.</p>
                    <div class="calendar-container">
                        <div class="calendar-header">
                            <button id="prevMonth"> < </button>
                            <h2 id="monthDisplay"><?= $monthNames[$currentMonth] . " " . $currentYear ?></h2>
                            <button id="nextMonth"> > </button>
                        </div>
                        <div class="calendar-days">
                            <div class="day">Lun</div><div class="day">Mar</div><div class="day">Mer</div><div class="day">Jeu</div>
                            <div class="day">Ven</div><div class="day">Sam</div><div class="day">Dim</div>
                        </div>
                        <div class="calendar-grid" id="calendar"></div>
                        <p id="confirmationMessage"><?= $confirmationMessage ?></p>
                    </div>
                    <button type="button" class="prev">Étape précédente</button>
                    <button type="submit" id="confirmButton">Confirmer</button>
                </div>
            </form>
        </div>
        <div class="cta">
            <h2>Prenez votre <span>rendez-vous</span> en ligne</h2>
            <hr>
        </div>
    </div>
    <div id="confirmationMessage" class="form-section"></div>

    <script>
       const monthNames = ["Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Décembre"];
const calendar = document.getElementById("calendar");
const monthDisplay = document.getElementById("monthDisplay");
const confirmationMessage = document.getElementById("confirmationMessage");
const confirmButton = document.getElementById('confirmButton');

let currentSection = 0; 
let selectedDate = null;
let currentMonth = new Date().getMonth();
let currentYear = new Date().getFullYear();
const reservations = {};

function renderCalendar() {
    calendar.innerHTML = "";
    const firstDayOfMonth = new Date(currentYear, currentMonth, 1).getDay();
    const daysInMonth = new Date(currentYear, currentMonth + 1, 0).getDate();

    monthDisplay.textContent = `${monthNames[currentMonth]} ${currentYear}`;

    // Créer les cases vides avant le premier jour du mois
    for (let i = 0; i < firstDayOfMonth; i++) {
        const emptyCell = document.createElement("div");
        calendar.appendChild(emptyCell);
    }

    // Créer les jours du mois
    for (let day = 1; day <= daysInMonth; day++) {
        const dateCell = document.createElement("div");
        dateCell.textContent = day;
        dateCell.classList.add("date");

        const dayOfWeek = new Date(currentYear, currentMonth, day).getDay();
        const dateKey = `${currentYear}-${String(currentMonth + 1).padStart(2, '0')}-${String(day).padStart(2, '0')}`;

        // Gérer les week-ends et les dates complètes
        if (dayOfWeek === 5 || dayOfWeek === 6) {
            dateCell.classList.add("weekend", "occupied");
            dateCell.title = "Date occupée (week-end)";
        } else if (reservations[dateKey] && reservations[dateKey] >= 10) {
            dateCell.classList.add("occupied");
            dateCell.title = "Date complète (10 réservations atteintes)";
        } else {
            dateCell.addEventListener("click", () => selectDate(day, dateKey));
        }

        calendar.appendChild(dateCell);
    }
}

function selectDate(day, dateKey) {
    if (!reservations[dateKey]) reservations[dateKey] = 0;
    if (reservations[dateKey] >= 10) return;

    reservations[dateKey] += 1;
    selectedDate = `${currentYear}-${String(currentMonth + 1).padStart(2, '0')}-${String(day).padStart(2, '0')}`;
    
    document.querySelectorAll(".date").forEach(date => date.classList.remove("selected"));
    event.target.classList.add("selected");

    confirmationMessage.textContent = `Merci ! Vous avez demandé un rendez-vous pour le ${selectedDate}. Nous vous contacterons pour confirmer.`;
    
    renderCalendar();
}

// Gérer le mois précédent
document.getElementById("prevMonth").addEventListener("click", () => {
    currentMonth = currentMonth === 0 ? 11 : currentMonth - 1;
    currentYear = currentMonth === 11 ? currentYear - 1 : currentYear;
    renderCalendar(); // Rafraîchir le calendrier
});

// Gérer le mois suivant
document.getElementById("nextMonth").addEventListener("click", () => {
    currentMonth = currentMonth === 11 ? 0 : currentMonth + 1;
    currentYear = currentMonth === 0 ? currentYear + 1 : currentYear;
    renderCalendar(); // Rafraîchir le calendrier
});

renderCalendar();

// Gestion des tabs (sections du formulaire)
const tabs = document.querySelectorAll('.tab');
const sections = document.querySelectorAll('.form-section');
const nextButtons = document.querySelectorAll('.next');
const prevButtons = document.querySelectorAll('.prev');

tabs.forEach((tab, index) => {
    tab.addEventListener('click', () => {
        activateSection(index);
    });
});

nextButtons.forEach(button => {
    button.addEventListener('click', () => {
        const currentIndex = getActiveSectionIndex();
        if (currentIndex < sections.length - 1) {
            activateSection(currentIndex + 1);
        }
    });
});

prevButtons.forEach(button => {
    button.addEventListener('click', () => {
        const currentIndex = getActiveSectionIndex();
        activateSection(currentIndex - 1);
    });
});

// Fonction pour activer la section
function activateSection(index) {
    sections.forEach((section, i) => {
        section.classList.toggle('active', i === index);
        tabs[i].classList.toggle('active', i === index);
    });
}

function getActiveSectionIndex() {
    return [...sections].findIndex(section => section.classList.contains('active'));
}

// Lors de la confirmation
confirmButton.addEventListener('click', () => {
    const name = document.getElementById('name').value;
    const email = document.getElementById('email').value;
    const phone = document.getElementById('phone').value;
    const service = document.getElementById('serviceSelect').value;
    const date = document.getElementById('dateSelect').value;

    // Vérifier si tous les champs sont remplis
    if (!name || !email || !phone || !service || !date) {
        alert("Veuillez remplir tous les champs.");
    } else {
        confirmationMessage.textContent = `Merci, ${name} ! Votre rendez-vous pour ${service} a été confirmé pour le ${date}.`;
        confirmationMessage.style.color = 'green';
        currentSection = 0; // Retourner à la première section après la confirmation
        showSection(currentSection);  // Afficher la première section
    }
});

// Initialiser l'affichage de la première section
showSection(currentSection);
// Données initiales
const appointments = [
            { date: '12/12/2023', treatment: 'Extraction de dent', doctor: 'Dr. Samira' }
        ];

        const payments = [
            { date: '12/12/2023', amount: '5000 DZD', for: 'Extraction dentaire' },
            { date: '10/11/2023', amount: '3000 DZD', for: 'Consultation' },
            { date: '03/10/2023', amount: '2000 DZD', for: 'Nettoyage dentaire' }
        ];

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
                appointments.push({ date, treatment, doctor });
                displayAppointments();
            }
        }

        // Ajouter un paiement
        function addPayment() {
            const date = prompt("Entrez la date du paiement");
            const amount = prompt("Entrez le montant");
            const forWhat = prompt("Entrez la raison du paiement");
            if (date && amount && forWhat) {
                payments.push({ date, amount, for: forWhat });
                displayPayments();
            }
        }

        // Afficher les rendez-vous
        function displayAppointments() {
            const pastAppointmentsTable = document.getElementById('pastAppointments');
            pastAppointmentsTable.innerHTML = '';
            appointments.forEach(appointment => {
                const row = `<tr><td>${appointment.date}</td><td>${appointment.treatment}</td><td>${appointment.doctor}</td></tr>`;
                pastAppointmentsTable.innerHTML += row;
            });
        }

        // Afficher les paiements
        function displayPayments() {
            const paymentTable = document.getElementById('paymentHistory');
            paymentTable.innerHTML = '';
            payments.forEach(payment => {
                const row = `<tr><td>${payment.date}</td><td>${payment.amount}</td><td>${payment.for}</td></tr>`;
                paymentTable.innerHTML += row;
            });
        }

        // Notifications dynamiques
        function showNotification(message) {
            const notificationDiv = document.getElementById('notification');
            notificationDiv.innerHTML = `<p><strong>${message}</strong></p>`;
        }

        // Initialisation
        displayAppointments();
        displayPayments();
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