<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Faculty Homepage</title>
</head>

<body>
    <table id="stuTable">
        <caption style="caption-side:bottom;">Requests from student about name changing</caption>
        <thead>
            <tr>
                <th>ID</th>
                <th>date</th>
                <th>name</th>
                <th>status</th>
                <th>options</th>
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
                $sql = "SELECT * FROM requests";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr><td>".$row["enrollment"]."</td><td>".$row["date"]."</td><td>".$row["name"]."</td><td>".$row["status"]."</td><td><button>Approve</button>
                        <button>Disapprove</button></td></tr>";
                    }
                } else {
                    echo "<tr><td colspan='3'>No results found</td></tr>";
                }
?>
        </tbody>
    </table>
</body>

</html>