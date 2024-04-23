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
        <tbody>
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
                echo "<tr><td style='position: relative;left: 48%;bottom: 120px;'><b>Name :</b>&emsp;" . $row['name'] . "</td></tr>";
                echo "<tr><td style='position: relative;left: 49.8%;bottom: 135px;'><b>Branch :</b>&emsp;" . $row['branch'] . "</td></tr>";
                echo "<tr><td style='position: relative;left: 50.1%;bottom: 150px;'><b>Semester :</b>&emsp;" . $row['sem'] . "</td></tr>";
                echo "<tr><td style='position: relative;left: 50%;bottom: 165px;'><b>Class :</b>&emsp;" . $row['class'] . "</td></tr>";
            } else {
                echo "<tr><td colspan='6'>No data found</td></tr>";
            }

            $conn->close();
            ?>
        </tbody>

    </table>
    </div>
    <table id="stuTable">
        <caption style="caption-side:top;" font-type="Sa"><h2>Requests from students about name changing</h2></caption>
        <thead>
            <tr>
                <th style="text-align: center;">ID</th>
                <th style="text-align: center;">Date</th>
                <th style="text-align: center;">Name</th>
                <th style="text-align: center;">Status</th>
                <th style="text-align: center;">Options</th>
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

            $fac_sem = $_SESSION['fac_sem'];
            $fac_class = $_SESSION['fac_class'];
            $sql = "SELECT * 
                    FROM requests 
                    WHERE status != 'Approved' 
                        AND status != 'Disapproved' 
                        AND class = '$fac_class' 
                        AND sem = '$fac_sem'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr><td style='text-align: center;'>" . $row["enrollment"] . "</td><td style='text-align: center;'>" . $row["date"] . "</td><td style='text-align: center;'>" . $row["name"] . "</td><td style='text-align: center;'>" . $row["status"] . "</td><td style='text-align: center;'><form method='POST'><button name='approve' class='approve' value='" . $row["enrollment"] . "'>Approve</button><button name='disapprove' class='disapprove' value='" . $row["enrollment"] . "'>Disapprove</button></form></td></tr>";
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