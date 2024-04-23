<?php
session_start(); // Start the session to access session variables

// Check if the user is logged in
if(!isset($_SESSION['email'])) {
    // Redirect to the login page if the user is not logged in
    header("Location: /WP_Project/Login_Page/login.html");
    exit(); // Stop further execution
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Student Home Page</title>
  <link rel="stylesheet" href="studentHomePage.css">
</head>

<body>
  <div class="navbar">
    <img src="GECG Logo.jpeg" alt="GECG Logo">
    <a href="#home">Home</a>
    <a href="#bonafied" onclick="applyForCertificate('Bonafied Certificate')">Bonafied Certificate</a>
    <a href="#character" onclick="applyForCertificate('Character Certificate')">Character Certificate</a>
    <a href="#studentTransfer" onclick="applyForStudentTransfer()">Student Transfer</a>
  </div>


  <div class="container">
    <div class="profile">
      <h1>Student Profile</h1>
      <table>
        <?php

          $servername = "localhost";
          $username = "root";
          $password = "";
          $dbname = "wp";

          $conn = new mysqli($servername, $username, $password, $dbname);

          if ($conn->connect_error) {
              die("Connection failed: " . $conn->connect_error);
          }
          $email = $_SESSION['email'];
          $sql = "SELECT * FROM student where email = '$email'";
          $result = $conn->query($sql);

          if ($result->num_rows > 0) {
              $row = $result->fetch_assoc();
              echo "<tr><td><img src='data:image/jpeg;base64," . base64_encode($row['pic']) . "' width='100'></td></tr>";
              echo "<tr><td>" . $row["enrollment"] . "</td></tr>";
              echo "<tr><td>" . $row["name"] . "</td></tr>";
              echo "<tr><td>" . $row["branch"] . "</td></tr>";
              echo "<tr><td>" . $row["sem"] . "</td></tr>";
              echo "<tr><td>" . $row["class"] . "</td></tr>";
          } else {
              echo "<tr><td colspan='6'>No data found</td></tr>";
          }

          $conn->close();
        ?>

    </table>
    </div>
    <div class="actions">
      <h2>Actions</h2>
      <!-- <button onclick="viewProfile()">View Profile</button> -->
      <!-- <button onclick="applyForCertificate('Bonafied Certificate')"></button> -->
      <!-- <button onclick="applyForCertificate('Character Certificate')"></button> -->
      <button onclick="applyForNameCorrection()">Apply for Name Correction</button>
      <button id="redirect-btn">Go to Another Page</button>
    </div>
  </div>

  <?php

    // if(isset($_POST['submit'])) {
    //   session_start();

    //   $servername = "localhost";
    //   $username = "root";
    //   $password = "";
    //   $database = "wp";

    //   $conn = new mysqli($servername, $username, $password, $database);

    //   if ($conn->connect_error) {
    //       die("Connection failed: " . $conn->connect_error);
    //   }
    // }

    // $email = $_SESSION['email'];
    // $sql = "SELECT * FROM student where email = '$email'";
    // $result = $conn->query($sql);


  ?>

  <script src="studentHomePage.js"></script>
</body>

</html>