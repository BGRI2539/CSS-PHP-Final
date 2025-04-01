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

        // Check if a profile picture (avatar) was uploaded
        if (isset($_FILES['profilePicture']) && $_FILES['profilePicture']['error'] == 0) {
            // Optionally validate file type (allow only JPEG, PNG, or GIF)
            $allowedTypes = array(IMAGETYPE_JPEG, IMAGETYPE_PNG, IMAGETYPE_GIF);
            $detectedType = exif_imagetype($_FILES['profilePicture']['tmp_name']);
            if (in_array($detectedType, $allowedTypes)) {
                $avatar = file_get_contents($_FILES['profilePicture']['tmp_name']);
            } else {
                $avatar = null;
            }
        } else {
            $avatar = null;
        }

        // If an avatar was provided, include it in the INSERT query
        if($avatar !== null) {
            $avatar_escaped = $conn->quote($avatar);
            $sql = "INSERT INTO users (firstName, email, username, password, avatar) VALUES ('$firstName', '$email', '$username', '$password', $avatar_escaped)";
        } else {
            $sql = "INSERT INTO users (firstName, email, username, password) VALUES ('$firstName', '$email', '$username', '$password')";
        }

        $conn -> exec($sql);

        $conn = null;

        // After account made, redirect to login page
        header("Location: login.php");
        exit;        

    }
    
?>
