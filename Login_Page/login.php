<?php
    // Establish a database connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "wp";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get username and password from the login form
    $user = $_POST['email'];
    $pass = $_POST['password'];

    // Query to check if the username and password exist in the database
    $sql = "SELECT * FROM student WHERE email = '$user' AND pass = '$pass'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Username and password are correct, login successful
        // Redirect to some.php page
        header("Location: /WP_Project/Student_HomePage/studentHomePage.html");
    } else {
        // Username or password is incorrect
        echo "Invalid username or password!";
    }

    $conn->close();
  ?>