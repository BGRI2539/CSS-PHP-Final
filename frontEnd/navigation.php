<?php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <meta name="description" content="WireFrame - Share your ultimate desk setup!" />
  <title>WireFrame - Welcome</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="../js/scripts.js"></script>
  <link rel="stylesheet" href="../css/style.css" />
</head>
<header>
  <nav class="default-nav">
    <div class="logo-container">
      <a href="home.php">
        <img src="../img/FullLogo_Transparent.png" alt="Header Logo" />
      </a>
    </div>
    <ul class="header-right-menu">
      <li><a href="home.php">Home</a></li>
      <li><a href="explore.php">Explore</a></li>
      <li>
        <label for="account-burger" class="account-label">
          My Account<?= isset($_SESSION['firstName']) ? ' (' . htmlspecialchars($_SESSION['firstName']) . ')' : '' ?>
        </label>
        <input id="account-burger" type="checkbox" />
        <ul class="account-dropdown">
          <li><a href="myProfile.php">My Profile</a></li>
          <li><a href="create_post.php">Upload</a></li>
          <li><a href="manageAccount.php">Manage Account</a></li>
          <?php if (isset($_SESSION['firstName']) && $_SESSION['firstName'] === 'admin'): ?>
            <li><a href="admin.php">Admin Panel</a></li>
          <?php endif; ?>
          <li><a href="../backEnd/logout.php">Logout</a></li>
        </ul>

      </li>
    </ul>
  </nav>
</header>

<nav class="scrolled-header">
  <div class="top-icons">
    <a href="home.php"><img src="../img/IconOnly_Transparent_NoBuffer.png" alt="Logo" /></a>
    <a href="explore.php"><img src="../img/eye.png" alt="Explore" /></a>
    <a href="create_post.php"><img src="../img/plus.png" alt="Upload" /></a>
  </div>
  <div class="bottom-icons">
    <a href="myProfile.php"><img src="../img/profile.png" alt="My Profile" /></a>
    <a href="../backEnd/logout.php"><img src="../img/logout.png" alt="Logout" /></a>
  </div>
</nav>