<?php

    session_start();
    
    // Add the database connection
    require_once 'database.php';

    // Set up variables
    $firstName = $_POST['firstName'];
    $email     = $_POST['email'];
    $username  = $_POST['username'];
    $password  = $_POST['password'];
    $confirm   = $_POST['confirm'];

    // Validate the inputs
    $ok = true;

    if (empty($firstName)) {
        $ok = false;
	    echo '<p>First name cannot be empty</p>';
    }
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $ok = false;
        echo '<p>Email cannot be empty</p>';    
    }
    if (empty($username)) {
        $ok = false;
        echo '<p>Username cannot be empty</p>';    
    }
    if (empty($password)) {
        $ok = false;
        echo '<p>Password cannot be empty</p>';    
    }
    if ((empty($password)) || ($password != $confirm)) {
        $ok = false;
        echo '<p>Password invalid</p>';    
    }

    // If no errors occur
    if($ok){

        // Securely hash the password 
        $password = hash('sha512', $password);

        // Insert the user data into the database 
        $sql = "INSERT INTO users (firstName, email, username, password) VALUES ('$firstName', '$email', '$username', '$password')";

        $conn -> exec($sql);

        $conn = null;

        // After account made, redirect to login page
        header("Location: login.php");
        exit;        

    }
    
?>
