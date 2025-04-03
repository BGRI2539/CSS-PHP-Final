<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Create Account - WireFrame</title>
  <link rel="stylesheet" href="../css/style.css" />
</head>
<body class="index-page">

  <div class="left-mainpage">
    <img class="logo" src="../img/IconOnly_Transparent_NoBuffer.png" alt="Wire Frame Logo">
    <h2>Create Account</h2>
    <p>Join the WireFrame community today!</p>

    <div class="account-form">
      <form action="saveUser.php" method="POST" enctype="multipart/form-data">
        <input type="text" name="firstName" placeholder="First Name" required>
        <input type="email" name="email" placeholder="Email Address" required>
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <input type="password" name="confirm" placeholder="Confirm Password" required>
        <input type="file" name="profilePicture" accept="image/*">
        <button type="submit">Create Account</button>
      </form>
      <p>Already have an account? <a href="login.php">Login Here</a></p>
    </div>
  </div>

  <div class="right-mainpage">
    <img class="iphone1" src="../img/iphone1.png" alt="Iphone Mockup">
  </div>

</body>
</html>