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
</head>

<style>
table {
  width: 100%;
  border-collapse: collapse;
}

thead {
  background-color: #007bff; /* Header background color */
  color: #fff; /* Header text color */
}

th, td {
  padding: 10px;
  text-align: left;
  border-bottom: 1px solid #ddd; /* Border between rows */
}

th:first-child, td:first-child {
  border-left: 1px solid #ddd; /* Border on the left side */
}

th:last-child, td:last-child {
  border-right: 1px solid #ddd; /* Border on the right side */
}

.approve{
    /* display: block;
    width: 5%;
    padding: 5px;
    margin-bottom: 10px;
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    position: absolute;
    top: 7.1%;
    left: 81%;
    font-size: 15px; */
    cursor: pointer;
    border-radius: 5px;
    margin-right: 5px;
    color: #fff;
    background-color: #007bff;    

}

.disapprove{
    /* display: block;
    width: 6%;
    padding: 5px;
    margin-bottom: 10px;
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    position: absolute;
    top: 7.1%;
    left: 87%;
    font-size: 15px; */
    cursor: pointer;
    border-radius: 5px;
    color: white;
    background-color: #007bff;
}

button:hover {
  background-color: #1954f6;
}

/* tr:hover { */
  /* background-color: #f5f5f5; Hover color for rows */
/* } */

</style>
<body>
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
              echo "<tr><td><img src='data:image/jpeg;base64," . base64_encode($row['pic']) . "' width='100'></td></tr>";
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

</html>