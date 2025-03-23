<!DOCTYPE html>

<html lang="en">

<head>

  <!-- Meta Data -->
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Create Account - Social Media</title>
  <link rel="stylesheet" href="../css/style.css">

</head>

<body>

<!-- Basic form to create a account -->
  <div class="login-container">
    <h2>Create Account</h2>
    <form action="saveUser.php" method="POST">
      <input type="text" name="firstName" placeholder="First Name" required>
      <input type="email" name="email" placeholder="Email Address" required>
      <input type="text" name="username" placeholder="Username" required>
      <input type="password" name="password" placeholder="Password" required>
      <input type="password" name="confirm" placeholder="Confirm Password" required>
      <button type="submit">Create Account</button>
    </form>
    <!-- Redirect link to login page -->
    <p>Already have an account? <a href="login.php">Login Here</a>.</p>
  </div>

</body>

</html>
