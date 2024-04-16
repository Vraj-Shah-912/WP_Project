<?php
// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve data from form
    $field1 = $_POST['enno'];
    $field2 = $_POST['name'];
    $status = "waiting";

    // Get the current date
    $date = date('Y-m-d H:i:s');

    // Database connection details
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "wp";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare SQL statement to insert data into database
    $sql = "INSERT INTO `requests`(`enrollment`, `date`, `name`, `status`) VALUES (?, ?, ?, ?)";

    // Prepare and bind parameters
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $field1, $date, $field2, $status);

    // Execute the statement
    if ($stmt->execute() === TRUE) {
        echo "Data inserted successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
}
?>