<?php
// Start the session to access session variables
session_start();

// Add the database connection
require_once 'database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = isset($_POST['title']) ? trim($_POST['title']) : '';
    $ok = true;

    if (empty($title)) {
        $ok = false;
        echo '<p>Title cannot be empty</p>';
    }
    if (!isset($_FILES['image']) || $_FILES['image']['error'] != 0) {
        $ok = false;
        echo '<p>Please upload an image</p>';
    } else {
        // Validate the image file type (allowing only JPEG, PNG, or GIF)
        $allowedTypes = [IMAGETYPE_JPEG, IMAGETYPE_PNG, IMAGETYPE_GIF];
        $detectedType = exif_imagetype($_FILES['image']['tmp_name']);
        if (!in_array($detectedType, $allowedTypes)) {
            $ok = false;
            echo '<p>Invalid image type. Only JPEG, PNG, or GIF files are allowed.</p>';
        }
    }

    if ($ok) {
        // Ensure the session has the userId, else use a valid default or redirect to login
        if (!isset($_SESSION['userId'])) {
            die('<p>No valid user found. Please log in.</p>');
        }
        $userId = $_SESSION['userId'];
        $imageData = file_get_contents($_FILES['image']['tmp_name']);

        $sql = "INSERT INTO posts (userId, title, image) VALUES (:userId, :title, :image)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
        $stmt->bindParam(':title', $title, PDO::PARAM_STR);
        $stmt->bindParam(':image', $imageData, PDO::PARAM_LOB);

        if ($stmt->execute()) {
            header("Location: ../frontEnd/home.php");
            exit;
        } else {
            echo '<p>Error adding post.</p>';
        }
    }
}
?>
