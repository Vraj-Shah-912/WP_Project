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
          $enrollment = $_SESSION['enrollment'];
          $sql = "SELECT * FROM student where email = '$email'";
          $sql2 = "SELECT * FROM requests where enrollment = '$enrollment'";
          $result = $conn->query($sql);
          $result2 = $conn->query($sql2);

          if($result2->num_rows > 0){
            echo "<script>";
            echo "let enrollment = '" . $_SESSION['enrollment'] . "';";
            echo "</script>";
          }

          if ($result->num_rows > 0) {
              $row = $result->fetch_assoc();
              echo "<tr><td><img src='data:image/jpeg;base64," . base64_encode($row['pic']) . "' width='100' style='width: 150px;height: auto;border-radius: 50%;position: relative;left: 220px;bottom: 15px;'></td></tr>";
              echo "<tr><td style='position: relative;left: 150px;bottom: 0px;font-size: 20px;'><b>Enrollment No. :</b>&emsp;" . $row["enrollment"] . "</td></tr>";
              echo "<tr><td style='position: relative;left: 200px;bottom: -9px;font-size: 20px;'><b>Name :</b>&emsp;" . $row["name"] . "</td></tr>";
              echo "<tr><td style='position: relative;left: 230px;bottom: -18px;font-size: 20px;'><b>Branch :</b>&emsp;" . $row["branch"] . "</td></tr>";
              echo "<tr><td style='position: relative;left: 230px;bottom: -26px;font-size: 20px;'><b>Semester :</b>&emsp;" . $row["sem"] . "</td></tr>";
              echo "<tr><td style='position: relative;left: 255px;bottom: -33px;font-size: 20px;'><b>Class :</b>&emsp;" . $row["class"] . "</td></tr>";
          } else {
              echo "<tr><td colspan='6'>No data found</td></tr>";
          }

          $conn->close();
        ?>

    </table>
    </div>
    <div class="actions">
      <h2>Actions</h2>
      <button class="nameCorrection" id="nameCorrection" onclick="applyForNameCorrection()">Apply for Name Correction</button>
      <form action="requests.php" method="post">
        <button class="req">Previous Requests</button>
      </form>
    </div>
  </div>

  <script src="studentHomePage.js"></script>
  <script>
      document.addEventListener('DOMContentLoaded', function() {
      let btn = document.getElementById('nameCorrection');
      if (enrollment) {
        btn.disabled = true;
      } else {
        btn.disabled = false;
        window.location.href = "http://localhost/WP_Project/Name_Correction/nameCorrection.html";
      }});
  </script>
</body>

</html>