<?php

include('header.php');

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sidebar</title>

  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <style>
    /* Votre CSS ici */
  </style>
  <link rel="stylesheet" href="css.css">
</head>

<body>
  <div class="sidebar">
    <div class="logo-details">
      <div class="logo">
        <!-- Vous pouvez ajouter une image dynamique ici si nécessaire -->
        <img src="<?php echo 'image-removebg-preview (2).png'; ?>" alt="">
      </div>
      <i class='bx bx-menu' id="btn"></i>
    </div>
    <li>
      <i class='bx bx-search'></i>
      <input type="text" placeholder="Search...">
      <span class="tooltip">Search</span>
    </li>
    <li>
      <a href="dash.php" class="load-page">
        <i class='bx bx-grid-alt'></i>
        <span class="links_name">Dashboard</span>
      </a>
      <span class="tooltip">Dashboard</span>
    </li>
    <li>
      <a href="Patient.php" class="load-page">
        <i class='bx bx-user'></i>
        <span class="links_name">Patients</span>
      </a>
      <span class="tooltip">Patients</span>
    </li>
    <li>
      <a href="employe.php" class="load-page">
        <i class='bx bx-user'></i>
        <span class="links_name">Employé</span>
      </a>
      <span class="tooltip">Employé</span>
    </li>
    <li>
      <a href="stock.php" class="load-page">
        <i class='bx bx-pie-chart-alt-2'></i>
        <span class="links_name">Stock</span>
      </a>
      <span class="tooltip">Stock</span>
    </li>
    <li>
      <a href="rendezvous.php" class="load-page">
        <i class='bx bx-folder'></i>
        <span class="links_name">Rendez-vous</span>
      </a>
      <span class="tooltip">Rendez-vous</span>
    </li>
    <li class="profile">
      <div class="profile-details">
        <img src="<?php echo './images/profile.png'; ?>" alt="profileImg">
        <div class="name_job">
          <div class="name">const Genius</div>
          <div class="job">Web Developer</div>
        </div>
      </div>
      <i class='bx bx-log-out' id="log_out"></i>
    </li>
    </ul>
  </div>
  <section class="home-section">

    <div id="content-area"></div>
  </section>


  <script>
    let sidebar = document.querySelector(".sidebar");
    let closeBtn = document.querySelector("#btn");
    let searchBtn = document.querySelector(".bx-search");

    closeBtn.addEventListener("click", () => {
      sidebar.classList.toggle("open");
      menuBtnChange();
    })

    searchBtn.addEventListener("click", () => {
      sidebar.classList.toggle("open");
      menuBtnChange();
    })

    function menuBtnChange() {
      if (sidebar.classList.contains("open")) {
        closeBtn.classList.replace("bx-menu", "bx-menu-alt-right");
      } else {
        closeBtn.classList.replace("bx-menu-alt-right", "bx-menu");
      }
    }

    menuBtnChange();
  </script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="js.js"></script>

</body>

</html>

 
<?php
// Exemple de footer ou autres inclusions PHP si nécessaire
include('footer.php');
?>