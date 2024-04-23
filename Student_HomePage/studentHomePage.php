<?php
session_start();

if(!isset($_SESSION['email'])) {
    header("Location: /WP_Project/Login_Page/login.html");
    exit();
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
    <img src="GECG Logo.jpeg" class="logo" alt="GECG Logo">
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
              echo "<tr><td><img src='data:image/jpeg;base64," . base64_encode($row['pic']) . "' width='100' style='width: 150px;height: auto;border-radius: 50%;position: relative;left: 190px;bottom: 15px;'></td></tr>";
              echo "<tr><td style='position: relative;left: 210px;bottom: 10px;'>" . $row["enrollment"] . "</td></tr>";
              echo "<tr><td style='position: relative;left: 217px;bottom: 10px;'>" . $row["name"] . "</td></tr>";
              echo "<tr><td style='position: relative;left: 254px;bottom: 10px;'>" . $row["branch"] . "</td></tr>";
              echo "<tr><td style='position: relative;left: 260px;bottom: 10px;'>" . $row["sem"] . "</td></tr>";
              echo "<tr><td style='position: relative;left: 260px;bottom: 10px;'>" . $row["class"] . "</td></tr>";
          } else {
              echo "<tr><td colspan='6'>No data found</td></tr>";
          }

          $conn->close();
        ?>

    </table>
    </div>
    <div class="actions">
      <h2>Actions</h2>
      <button class="nameCorrection" onclick="applyForNameCorrection()">Apply for Name Correction</button>
      <form action="requests.php" method="post">
        <button class="req">Previous Requests</button>
      </form>
    </div>
  </div>

  <script src="studentHomePage.js"></script>
</body>

</html>