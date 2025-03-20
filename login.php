<?php
session_start();

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sample user credentials for demonstration
    $users = [
        "admin" => "root",
    ];
    
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Validate user credentials
    if (isset($users[$username]) && $users[$username] === $password) {
        $_SESSION["user"] = $username;
        // Redirect to a dashboard or another page after successful login
        header("Location: home.php");
        exit;
    } else {
        $error = "Invalid username or password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - WireFrame</title>
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
    <div class="login-container">
        <h2>Login to WireFrame</h2>
        <?php 
            if (isset($error)) { 
                echo '<p class="error">' . $error . '</p>'; 
            } 
        ?>
        <form action="login.php" method="POST">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>
