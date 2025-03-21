<?php
require_once 'database.php';

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Process only when the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and trim form inputs
    $firstName = trim($_POST['firstName']);
    $email     = trim($_POST['email']);
    $username  = trim($_POST['username']);
    $password  = trim($_POST['password']);
    $confirm   = trim($_POST['confirm']);

    // Validation
    $errors = [];

    if (empty($firstName)) {
        $errors[] = "First Name is required.";
    }
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "A valid Email Address is required.";
    }
    if (empty($username)) {
        $errors[] = "Username is required.";
    }
    if (empty($password)) {
        $errors[] = "Password is required.";
    }
    if ($password !== $confirm) {
        $errors[] = "Passwords do not match.";
    }

    // If there are errors, display them
    if (!empty($errors)) {
        foreach ($errors as $error) {
            echo "<p>$error</p>";
        }
        exit;
    }

    // Securely hash the password using password_hash()
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Insert the user data into the database using a prepared statement
    try {
        $stmt = $conn->prepare("INSERT INTO users (firstName, email, username, password) VALUES (:firstName, :email, :username, :password)");

        // Bind the parameters
        $stmt->bindParam(':firstName', $firstName);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $hashedPassword);

        // Execute the statement
        $stmt->execute();

        // Optionally redirect to another page after success
        header("Location: home.php");
        exit;
    } catch (PDOException $e) {
        // Handle errors (e.g., duplicate email or username)
        if ($e->getCode() == 23000) { // Integrity constraint violation
            echo "<p>Error: Email or Username already exists.</p>";
        } else {
            echo "<p>Error: " . $e->getMessage() . "</p>";
        }
    }
}
?>
