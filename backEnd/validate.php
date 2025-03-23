<?php
    //store the user inputs in variables and hash the password
    $username = $_POST['username'];
    $password = hash("sha512", $_POST['password']);
    //connect to db
    require_once 'database.php';
    //set up and run the query
    $sql = "SELECT userId FROM users WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($sql);
    //store the number of results in a variable
    $count = $result -> rowCount();
    //check if any matches found
    if($count == 1){
        echo "Logged in Successfully";
        foreach($result as $row){
        // access the existing session to created automatically by the server
            session_start();
            // take the user id from the database and store it in the session variable
            $_SESSION['user_id'] = $row['user_id'];
            //redirect the user
            Header('Location: ../frontEnd/home.php');
        }
    } else{
        echo "Invalid Login";
    }
    $conn = null;
?>

