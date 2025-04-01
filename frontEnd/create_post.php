<?php
// Include the processing logic at the top of the file
require_once '../backEnd/post.php'; 
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Create a New Post</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <h1>Create a New Post</h1>
    <form action="create_post.php" method="post" enctype="multipart/form-data">
        <div>
            <label for="title">Post Title:</label><br>
            <input type="text" id="title" name="title" required>
        </div>
        <br>
        <div>
            <label for="image">Upload Image:</label><br>
            <input type="file" id="image" name="image" accept="image/*" required>
        </div>
        <br>
        <div>
            <input type="submit" value="Submit Post">
        </div>
    </form>
</body>
</html>
