<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All requests</title>
</head>
<body>
<table id="stuTable">
        <caption style="caption-side:bottom;">Requests</caption>
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
                    echo "<tr><td>" . $row["date"] . "</td><td>" . $row["name"] . "</td><td>" . $row["status"] . "</td></tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No pending requests</td></tr>";
            }

            $conn->close();
        ?>

        </tbody>
    </table>
</body>
</html>