<?php
// Inclure le fichier d'en-tête
include('header.php');
?>

<div class="sidebar">
  <div class="logo-details">
    <div class="logo">
      <img src="image-removebg-preview (2).png" alt="">
    </div>
    <i class='bx bx-menu' id="btn"></i>
  </div>
  <li>
    <i class='bx bx-search'></i>
    <input type="text" placeholder="Search...">
    <span class="tooltip">Search</span>
  </li>
  <li>
    <a href="chart.php" class="load-page">
      <i class='bx bx-grid-alt'></i>
      <span class="links_name">Dashboard</span>
    </a>
    <span class="tooltip">Dashboard</span>
  </li>
  <li>
    <a href="patient.php" class="load-page">
      <i class='bx bx-user'></i>
      <span class="links_name">Patients</span>
    </a>
    <span class="tooltip">Patients</span>
  </li>
  <li>
    <a href="stock2.php" class="load-page">
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
      <img src="./images/profile.png" alt="profileImg">
      <div class="name_job">
        <div class="name">const Genius</div>
        <div class="job">Web Developer</div>
      </div>
    </div>
    <i class='bx bx-log-out' id="log_out"></i>
  </li>
</div>

<section class="home-section">
  <div id="content-area"></div>
</section>

<?php
// Inclure le fichier du pied de page
include('footer.php');
?>