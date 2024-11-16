<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>

<nav class="navbar">
  <div class="navbar-container">
    <a href="home.php" class="brand-logo">
      <img src="../img/logo.png" alt="Brand Logo" />
    </a>
    <ul class="nav-links">
      <li><a href="home.php">Home</a></li>
      <li><a href="menu.php">Menu</a></li>
      <li><a href="specialevents.php">Special Events</a></li>
      <li><a href="promotions.php">Promotions</a></li>
      <li><a href="tableres.php">Table Resavation</a></li>
    </ul>
    <?php if (isset($_SESSION['email'])): ?>
      <a href="logout.php" class="logout-button">Logout</a>
    <?php else: ?>
      <a href="login.php" class="login-button">Login</a>
    <?php endif; ?>
  </div>
</nav>
