<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Create Account - Social Media</title>
  <link rel="stylesheet" href="./css/style.css">
</head>
<body>
  <div class="login-container">
    <h2>Create Account</h2>
    <?php
      // Optional: Display error messages if registration processing sets an error.
      if (isset($error)) {
          echo '<p class="error">' . htmlspecialchars($error) . '</p>';
      }
    ?>
    <form action="register.php" method="POST">
      <input type="text" name="username" placeholder="Username" required>
      <input type="email" name="email" placeholder="Email Address" required>
      <input type="password" name="password" placeholder="Password" required>
      <input type="password" name="confirm_password" placeholder="Confirm Password" required>
      <button type="submit">Create Account</button>
    </form>
    <p>Already have an account? <a href="login.php">Login Here</a>.</p>
  </div>
</body>
</html>
