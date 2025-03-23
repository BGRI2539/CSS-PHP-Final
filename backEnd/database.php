<?php

    // Connects to db
    try {
        $conn = new PDO('mysql:host=localhost;dbname=sitedata', 'root', 'mysql');
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die("Connection Failed: " . $e->getMessage());
    }
    
?>
