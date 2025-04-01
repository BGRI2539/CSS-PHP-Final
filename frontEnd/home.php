<!DOCTYPE html>

<html lang="en">

<head>

  <!-- Meta Data -->
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="wireFrame - Share your ultimate desk setup!">
  <title>WireFrame - Welcome</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="../js/scripts.js"></script>
  <link rel="stylesheet" href="../css/style.css">

</head>

<body class="home-page">

  <header>

    <!-- Default Top Header -->
    <nav class="default-nav">

      <div class="logo-container">
        <a href="home.php"><img src="../img/FullLogo_Transparent.png" alt="header logo"></a>
      </div>

      <menu class="header-right-menu">
        <li><a href="#">Home</a></li>
        <li><a href="#">Explore</a></li>
        <li>
          <label for="account-burger" class="account-label">My Account</label>
          <input id="account-burger" type="checkbox">
          <ul class="account-dropdown">
            <li><a href="#">My Profile</a></li>
            <li><a href="#">Favourites</a></li>
            <li><a href="#">Upload</a></li>
            <li><a href="#">Manage Account</a></li>
            <li><a href="#">Logout</a></li>
          </ul>
        </li>
      </menu>

    </nav>

  </header>

  <!-- Scrolled Sidebar Menu (placed inside body) -->
  <nav class="scrolled-header">

    <div class="top-icons">
      <a href="home.php"><img src="../img/IconOnly_Transparent_NoBuffer.png" alt="Logo"></a>
      <a href="explore.php"><img src="../img/eye.png" alt="Explore"></a>
      <a href="./create_post.php"><img src="../img/plus.png" alt="Upload"></a>
      <a href="favourites.php"><img src="../img/heart.png" alt="Favourites"></a>
    </div>

    <div class="bottom-icons">
      <a href="My Profile.php"><img src="../img/profile.png" alt="My Profile"></a>
      <a href="../backEnd/logout.php"><img src="../img/logout.png" alt="Logout"></a>
    </div>

  </nav>

  <section class="post-container">

    <div class="post-card">Post #1</div>
    <div class="post-card">Post #2</div>
    <div class="post-card">Post #3</div>
    <div class="post-card">Post #4</div>
    <div class="post-card">Post #5</div>
    <div class="post-card">Post #6</div>
    <div class="post-card">Post #7</div>
    <div class="post-card">Post #8</div>
    <div class="post-card">Post #9</div>
    <div class="post-card">Post #10</div>
    <div class="post-card">Post #11</div>
    <div class="post-card">Post #12</div>

  </section>

</body>

</html>