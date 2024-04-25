<?php require_once("dbconnect.php"); ?>
<?php
// Establish database connection
$servername = "localhost";
$username = "username"; // Your MySQL username
$password = "password"; // Your MySQL password
$dbname = "bus_management_system";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare and bind parameters
$stmt = $conn->prepare("INSERT INTO rating (passenger_id, feedback, star) VALUES (?, ?, ?)");
$stmt->bind_param("iss", $passenger_id, $feedback, $star);

// Set parameters and execute
$passenger_id = $_POST['passenger_id'];
$feedback = $_POST['feedback'];
$star = $_POST['star'];
$stmt->execute();

echo "Rating submitted successfully";

$stmt->close();
$conn->close();
?>
