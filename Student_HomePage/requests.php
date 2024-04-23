<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All requests</title>
    <link rel="stylesheet" href="requests.css">
</head>
<body>
    <div class="navbar">
        <img src="GECG Logo.jpeg" class="logo" alt="GECG Logo">
        <a href="#home">Home</a>
        <a href="#bonafied" onclick="applyForCertificate('Bonafied Certificate')">Bonafied Certificate</a>
        <a href="#character" onclick="applyForCertificate('Character Certificate')">Character Certificate</a>
        <a href="#studentTransfer" onclick="applyForStudentTransfer()">Student Transfer</a>
      </div>
<table id="stuTable">
        <thead>
            <tr>
                <th>Date</th>
                <th>Name</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
        <?php
            session_start();

            $servername = "localhost";
            $username = "root";
            $password = "";
            $database = "wp";

            $conn = new mysqli($servername, $username, $password, $database);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $enrollment = $_SESSION['enrollment'];
            $sql = "SELECT * FROM requests WHERE enrollment = '$enrollment'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr><td style='text-align: center;'>" . $row["date"] . "</td><td style='text-align: center;'>" . $row["name"] . "</td><td style='text-align: center;'>" . $row["status"] . "</td></tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No pending requests</td></tr>";
            }

            $conn->close();
        ?>

        </tbody>
    </table>
</body>
<script src="requests.js"></script>
</html>