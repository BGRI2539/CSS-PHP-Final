<?php
session_start();

include '../frontEnd/navigation.php';

// For testing purposes only: manually set the session username
$_SESSION['username'] = 'admin';

require_once '../backEnd/database.php';

// Check if the logged-in user is the admin
if (!isset($_SESSION['username']) || $_SESSION['username'] !== "admin") {
    echo "Access denied. You do not have permission to access this page.";
    exit;
}

// Process deletion if a delete parameter is present
if (isset($_GET['delete'])) {
    $deleteId = intval($_GET['delete']);
    
    $sqlDelete = "DELETE FROM users WHERE userId = :userId";
    $stmt = $conn->prepare($sqlDelete);
    $stmt->bindParam(':userId', $deleteId, PDO::PARAM_INT);
    $stmt->execute();

    // Redirect to avoid resubmission
    header('Location: admin.php');
    exit;
}

// Fetch users (only the fields we need for display)
$sql = "SELECT userId, firstName, email, avatar FROM users";
$stmt = $conn->prepare($sql);
$stmt->execute();

$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/style.css" />
    <title>Admin Panel</title>
    <style>
        table { border-collapse: collapse; width: 80%; margin: 20px auto; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: center; }
        th { background-color: #f2f2f2; }
        .avatar { max-width: 50px; max-height: 50px; }
    </style>
</head>
<body>
    <h1>Admin Panel</h1>
    <table>
        <tr>
            <th>First Name</th>
            <th>Email</th>
            <th>Avatar</th>
            <th>Action</th>
        </tr>
        <?php foreach ($users as $user): ?>
        <tr>
            <td><?php echo htmlspecialchars($user['firstName']); ?></td>
            <td><?php echo htmlspecialchars($user['email']); ?></td>
            <td>
                <?php if (!empty($user['avatar'])): ?>
                    <?php $imgData = base64_encode($user['avatar']); ?>
                    <img class="avatar" src="data:image/jpeg;base64,<?php echo $imgData; ?>" alt="Avatar">
                <?php else: ?>
                    No Avatar
                <?php endif; ?>
            </td>
            <td>
                <a href="admin.php?delete=<?php echo $user['userId']; ?>" 
                   onclick="return confirm('Are you sure you want to delete this account?');">
                   Delete
                </a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>

<?php
include '../frontEnd/footer.php';
// Close the PDO connection
$conn = null;
?>
