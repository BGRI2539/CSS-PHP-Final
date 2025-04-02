<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

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
        $allowedTypes = [IMAGETYPE_JPEG, IMAGETYPE_PNG, IMAGETYPE_GIF];
        $detectedType = exif_imagetype($_FILES['image']['tmp_name']);
        if (!in_array($detectedType, $allowedTypes)) {
            $ok = false;
            echo '<p>Invalid image type. Only JPEG, PNG, or GIF allowed.</p>';
        }
    }

    if ($ok) {
        if (!isset($_SESSION['userId'])) {
            echo '<p>No valid user found. Please log in.</p>';
            exit;
        }

        $userId = $_SESSION['userId'];

        // OPTIONAL: Confirm this userId exists in DB to avoid FK error
        $checkStmt = $conn->prepare("SELECT COUNT(*) FROM users WHERE userId = ?");
        $checkStmt->execute([$userId]);
        if ($checkStmt->fetchColumn() == 0) {
            echo '<p>Invalid userId: ' . htmlspecialchars($userId) . '</p>';
            exit;
        }

        $imageData = file_get_contents($_FILES['image']['tmp_name']);

        $description = $_POST['description'];

        $sql = "INSERT INTO posts (userId, title, image, description) VALUES (:userId, :title, :image, :description)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
        $stmt->bindParam(':title', $title, PDO::PARAM_STR);
        $stmt->bindParam(':image', $imageData, PDO::PARAM_LOB);
        $stmt->bindParam(':description', $description, PDO::PARAM_STR);

        if ($stmt->execute()) {
            header("Location: ../frontEnd/home.php");
            exit;
        } else {
            echo '<p>Error adding post. Please try again.</p>';
        }
    }
}
?>