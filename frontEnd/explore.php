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
<body class="home-page">
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
          <label for="account-burger" class="account-label">My Account</label>
          <input id="account-burger" type="checkbox" />
          <ul class="account-dropdown">
            <li><a href="#">My Profile</a></li>
            <li><a href="#">Favourites</a></li>
            <li><a href="#">Upload</a></li>
            <li><a href="#">Manage Account</a></li>
            <li><a href="#">Logout</a></li>
          </ul>
        </li>
      </ul>
    </nav>
  </header>

  <nav class="scrolled-header">
    <div class="top-icons">
      <a href="home.php"><img src="../img/IconOnly_Transparent_NoBuffer.png" alt="Logo" /></a>
      <a href="explore.php"><img src="../img/eye.png" alt="Explore" /></a>
      <a href="upload.php"><img src="../img/plus.png" alt="Upload" /></a>
      <a href="favourites.php"><img src="../img/heart.png" alt="Favourites" /></a>
    </div>
    <div class="bottom-icons">
      <a href="My Profile.php"><img src="../img/profile.png" alt="My Profile" /></a>
      <a href="#"><img src="../img/logout.png" alt="Logout" /></a>
    </div>
  </nav>


  <main class="explore-wrapper">
    <h2 class="explore-title">Popular</h2>
    <div class="gallery-grid">
      <img src="../img/desks/desk1.jpg" alt="Gaming Desk Setup">
      <img src="../img/desks/desk2.jpg" alt="Minimalist Desk">
      <img src="../img/desks/desk3.jpg" alt="Luxury Office Desk">
      <img src="../img/desks/desk4.jpg" alt="Productivity Setup">
      <img src="../img/desks/desk5.jpg" alt="Cozy Corner Desk">
      <img src="../img/desks/desk6.jpg" alt="Streaming Setup">
    </div>
  </main>
</body>
</html>