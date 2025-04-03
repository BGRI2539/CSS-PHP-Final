<?php
session_start();

// Store the user inputs
$username = $_POST['username'];
$password = hash("sha512", $_POST['password']);

require_once 'database.php';

// Prepare and run query
$sql = "SELECT userId, firstName FROM users WHERE username = :username AND password = :password";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':username', $username, PDO::PARAM_STR);
$stmt->bindParam(':password', $password, PDO::PARAM_STR);
$stmt->execute();

if ($stmt->rowCount() == 1) {
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $_SESSION['userId'] = $row['userId'];
    $_SESSION['firstName'] = $row['firstName']; 

    header('Location: ../frontEnd/home.php');
    exit;
} else {
    echo "Invalid Login";
}

$conn = null;
?>