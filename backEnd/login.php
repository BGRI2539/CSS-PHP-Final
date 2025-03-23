<?php
    session_start();

    // If a user is already logged in, redirect them to the home page.
    if (isset($_SESSION['userId'])) {
        header("Location: home.php");
        exit;
    }
?>

<!DOCTYPE html>
<html lang="en">

    <head>

    <meta charset="UTF-8">
    <title>Login - Social Media</title>
    <link rel="stylesheet" href="../css/style.css">

    </head>

    <body>
        <div class="login-container">
            <h2>Login</h2>
            <form action="validate.php" method="POST">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
            </form>
            <p>Don't have an account? <a href="./create.php">Create one</a>.</p>
        </div>
    </body>
    
</html>


