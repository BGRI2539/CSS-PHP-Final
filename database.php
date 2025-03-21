<?php
    // Connesct to the database made
    try{
        $conn = new PDO('mysql:host=localhost;dbname=sitedata', 'root', 'mysql');
        $conn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }catch(PDOException $e){
        echo "Connection Failed: " . $e -> getMessage();
    }
?>