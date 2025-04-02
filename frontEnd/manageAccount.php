<?php
session_start();
include 'navigation.php';
include '../backEnd/database.php';

if (!isset($_SESSION['userId'])) {
  header("Location: ../backEnd/login.php");
  exit();
}

$userId = $_SESSION['userId'];
$msg = "";

// Update user account
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
  $firstName = $_POST['firstName'];
  $email = $_POST['email'];
  $username = $_POST['username'];
  $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

  $updateQuery = $conn->prepare("UPDATE users SET firstName = ?, email = ?, username = ?, password = ? WHERE userId = ?");
  $updateQuery->execute([$firstName, $email, $username, $password, $userId]);

  $msg = "Account updated successfully!";
}

// Delete user account
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete'])) {
  $conn->prepare("DELETE FROM posts WHERE userId = ?")->execute([$userId]);
  $conn->prepare("DELETE FROM users WHERE userId = ?")->execute([$userId]);

  session_destroy();
  header("Location: ../backEnd/login.php");
  exit();
}

// Load user info
$userQuery = $conn->prepare("SELECT firstName, email, username FROM users WHERE userId = ?");
$userQuery->execute([$userId]);
$user = $userQuery->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Manage Account</title>
  <link rel="stylesheet" href="../css/style.css" />
</head>
<body class="manageAccount">
  <main class="manage-account-wrapper">
    <h2>Manage Your Account</h2>

    <?php if ($msg): ?>
      <p class="status-message"><?= htmlspecialchars($msg) ?></p>
    <?php endif; ?>

    <form method="POST">
      <label>First Name:</label>
      <input type="text" name="firstName" value="<?= htmlspecialchars($user['firstName']) ?>" required>

      <label>Email:</label>
      <input type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required>

      <label>Username:</label>
      <input type="text" name="username" value="<?= htmlspecialchars($user['username']) ?>" required>

      <label>New Password:</label>
      <input type="password" name="password" required>

      <button type="submit" name="update">Update Account</button>
    </form>

    <form method="POST" onsubmit="return confirm('Are you sure you want to delete your account? This cannot be undone.');">
      <button type="submit" name="delete" class="delete-account-btn">Delete Account</button>
    </form>
  </main>
</body>
<footer>
    <?php include 'footer.php'; ?>
</footer>
</html>