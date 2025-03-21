<?php

    // Enable error reporting for debugging
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    try {
        // Connect to the database "sitedata" using AMPPS (usually localhost)
        $conn = new PDO('mysql:host=localhost;dbname=sitedata', 'root', 'mysql');
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die("Connection Failed: " . $e->getMessage());
    }
?>
