<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Faculty Homepage</title>
</head>

<body>
    <table id="stuTable">
        <caption style="caption-side:bottom;">Requests from students about name changing</caption>
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
            session_start(); // Start the session

            $servername = "localhost";
            $username = "root";
            $password = "";
            $database = "wp";

            $conn = new mysqli($servername, $username, $password, $database);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Check if a request has been approved or disapproved
            if (isset($_POST['approve']) && !isset($_SESSION['approved'])) {
                $approvedEnrollment = $_POST['approve'];

                // Update the status of the approved request in the database
                $sql = "UPDATE requests SET status = 'Approved' WHERE enrollment = $approvedEnrollment";
                $conn->query($sql);

                $_SESSION['approved'] = true; // Set approved flag in session
            } elseif (isset($_POST['disapprove']) && !isset($_SESSION['disapproved'])) {
                $disapprovedEnrollment = $_POST['disapprove'];

                // Update the status of the disapproved request in the database
                $sql = "UPDATE requests SET status = 'Disapproved' WHERE enrollment = $disapprovedEnrollment";
                $conn->query($sql);

                $_SESSION['disapproved'] = true; // Set disapproved flag in session
            }

            // Fetch and display requests
            $sql = "SELECT * FROM requests WHERE status != 'Approved' AND status != 'Disapproved'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr><td>" . $row["enrollment"] . "</td><td>" . $row["date"] . "</td><td>" . $row["name"] . "</td><td>" . $row["status"] . "</td><td><form method='POST'><button name='approve' value='" . $row["enrollment"] . "'>Approve</button><button name='disapprove' value='" . $row["enrollment"] . "'>Disapprove</button></form></td></tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No pending requests</td></tr>";
            }

            // Reset session variables
            unset($_SESSION['approved']);
            unset($_SESSION['disapproved']);

            // Delete approved/disapproved requests older than 3 days
            $sql = "DELETE FROM requests WHERE (status = 'Approved' OR status = 'Disapproved') AND date < DATE_SUB(NOW(), INTERVAL 3 DAY)";
            $conn->query($sql);

            $conn->close();
        ?>

        </tbody>
    </table>
</body>

</html>