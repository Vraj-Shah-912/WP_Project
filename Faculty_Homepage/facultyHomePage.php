<?php
session_start();

if(!isset($_SESSION['fac_email'])) {
    header("Location: /WP_Project/Login_Page/login.html");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Faculty Homepage</title>
    <link rel="stylesheet" href="facultyHomePage.css">
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
      <h1>Faculty profile</h1>
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
          $email = $_SESSION['fac_email'];
          $sql = "SELECT * FROM faculty where email = '$email'";
          $result = $conn->query($sql);

          if ($result->num_rows > 0) {
              $row = $result->fetch_assoc();
              echo "<tr><td><img src='data:image/jpeg;base64," . base64_encode($row['pic']) . "' width='100' style='width: 160px;height: 140px;border-radius: 50%;position: relative;left: 45%;bottom: 110px;'></td></tr>";
              echo "<tr><td style='position: relative;left: 48%;bottom: 120px;'>" . $row["name"] . "</td></tr>";
              echo "<tr><td style='position: relative;left: 49.8%;bottom: 135px;'>" . $row["branch"] . "</td></tr>";
              echo "<tr><td style='position: relative;left: 50.1%;bottom: 150px;'>" . $row["sem"] . "</td></tr>";
              echo "<tr><td style='position: relative;left: 50%;bottom: 165px;'>" . $row["class"] . "</td></tr>";
          } else {
              echo "<tr><td colspan='6'>No data found</td></tr>";
          }

          $conn->close();
        ?>

    </table>
    </div>
    <table id="stuTable">
        <caption style="caption-side:bottom;" font-type="Sa">Requests from students about name changing</caption>
        <thead>
            <tr>
                <th>ID</th>
                <th>Date</th>
                <th>Name</th>
                <th>Status</th>
                <th>Options</th>
            </tr>
        </thead>
        <tbody>
        <?php

            $servername = "localhost";
            $username = "root";
            $password = "";
            $database = "wp";

            $conn = new mysqli($servername, $username, $password, $database);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            if (isset($_POST['approve']) && !isset($_SESSION['approved'])) {
                $approvedEnrollment = $_POST['approve'];

                $sql = "UPDATE requests SET status = 'Approved' WHERE enrollment = $approvedEnrollment";
                $conn->query($sql);

                $_SESSION['approved'] = true;
            } elseif (isset($_POST['disapprove']) && !isset($_SESSION['disapproved'])) {
                $disapprovedEnrollment = $_POST['disapprove'];

                $sql = "UPDATE requests SET status = 'Disapproved' WHERE enrollment = $disapprovedEnrollment";
                $conn->query($sql);

                $_SESSION['disapproved'] = true;
            }

            $sql = "SELECT * FROM requests WHERE status != 'Approved' AND status != 'Disapproved'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr><td>" . $row["enrollment"] . "</td><td>" . $row["date"] . "</td><td>" . $row["name"] . "</td><td>" . $row["status"] . "</td><td><form method='POST'><button name='approve' class='approve' value='" . $row["enrollment"] . "'>Approve</button><button name='disapprove' class='disapprove' value='" . $row["enrollment"] . "'>Disapprove</button></form></td></tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No pending requests</td></tr>";
            }

            unset($_SESSION['approved']);
            unset($_SESSION['disapproved']);
            $conn->close();
        ?>

        </tbody>
    </table>
</body>
<script src="facultyHomePage.js"></script>
</html>