<?php
session_start(); // Start the session to access session variables

// Check if the user is logged in
if(!isset($_SESSION['email'])) {
    // Redirect to the login page if the user is not logged in
    header("Location: /WP_Project/Login_Page/login.html");
    exit(); // Stop further execution
}
?>

<?php
// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve data from form
    $field1 = $_POST['enno'];
    $field2 = $_POST['name'];
    $status = "waiting";
    $sem = $_SESSION['sem'];
    $class = $_SESSION['class'];

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
    $sql = "INSERT INTO `requests`(`enrollment`, `date`, `name`, `status`, `sem`, `class`) VALUES (?, ?, ?, ?, ?, ?)";

    // Prepare and bind parameters
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssss", $field1, $date, $field2, $status, $sem, $class);
    try{
        $stmt->execute();
        echo "Request inserted successfully";
        $stmt->close();
        $conn->close();
        return;
    }
    catch(Exception $e){
        echo "You already have a request";
        $stmt->close();
        $conn->close();
        return;
    }
}
?>