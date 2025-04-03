<?php
session_start();

// Redirect if already logged in
if (isset($_SESSION['userId'])) {
    header("Location: ../frontEnd/home.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Login - WireFrame</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/style.css" />
</head>
<body class="index-page">

  <!-- Left Side: Login Form -->
  <div class="left-mainpage">
    <img class="logo" src="../img/IconOnly_Transparent_NoBuffer.png" alt="WireFrame Logo" />
    <h2>Login</h2>
    <p>Welcome Back to WireFrame!</p>

    <div class="account-form">
      <form action="validate.php" method="POST">
        <input type="text" name="username" placeholder="Username" required />
        <input type="password" name="password" placeholder="Password" required />
        <button type="submit">Login</button>
      </form>
      <p style="margin-top: 10px;">Don't have an account? <a href="create.php">Create one</a>.</p>
    </div>
  </div>

  <!-- Right Side: Single iPhone Image -->
  <div class="right-mainpage">
    <img class="iphone1" src="../img/iphone2.png" alt="Phone Display" />
  </div>

</body>
</html>


