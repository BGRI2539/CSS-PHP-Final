<?php
session_start();
// Store the user inputs in variables and hash the password
$username = $_POST['username'];
$password = hash("sha512", $_POST['password']);

// Connect to the database
require_once 'database.php';

// Set up and run the query using a prepared statement (recommended to avoid SQL injection)
$sql = "SELECT userId FROM users WHERE username = :username AND password = :password";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':username', $username, PDO::PARAM_STR);
$stmt->bindParam(':password', $password, PDO::PARAM_STR);
$stmt->execute();

// Check if any matches found
if ($stmt->rowCount() == 1) {
    // Fetch the user row
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    // Store the user id in the session using a consistent key
    $_SESSION['userId'] = $row['userId'];
    // Redirect the user
    header('Location: ../frontEnd/home.php');
    exit;
} else {
    echo "Invalid Login";
}
$conn = null;
?>
