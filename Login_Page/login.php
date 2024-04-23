<?php
    session_start();
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
    $sql2 = "SELECT * FROM faculty WHERE email = '$user' AND pass = '$pass'";
    $result = $conn->query($sql);
    $result2 = $conn->query($sql2);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        $_SESSION['enrollment'] = $row['enrollment'];
        $_SESSION['name'] = $row['name'];
        $_SESSION['email'] = $row['email'];
        $_SESSION['sem'] = $row['sem'];
        $_SESSION['class'] = $row['class'];
        header("Location: /WP_Project/Student_HomePage/studentHomePage.php");
    }
    elseif ($result2->num_rows > 0){
        $row = $result2->fetch_assoc();
        $_SESSION['fac_email'] = $row['email'];
        $_SESSION['fac_sem'] = $row['sem'];
        $_SESSION['fac_class'] = $row['class'];
        header("Location: /WP_Project/Faculty_HomePage/facultyHomePage.php");
    }
    else {
        echo "Invalid username or password!";
    }

    $conn->close();
  ?>