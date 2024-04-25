<?php
// Start the session
session_start();

// Include the database connection file
require_once "dbconnect.php";

// Check if the form is submitted and passenger ID is set in the session
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['date']) && isset($_SESSION['passenger_id'])) {
    // Extract data from the form
    $journey_date = $_GET['date'];

    // Retrieve passenger ID from session
    $passenger_id = $_SESSION['passenger_id'];

    // Prepare and execute SQL query to update the ticket information in the database
    $sql = "INSERT INTO ticket (journey_date, tpassenger_id) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);

    // Check if the statement is prepared successfully
    if ($stmt) {
        // Bind parameters and execute the statement
        $stmt->bind_param("si", $journey_date, $passenger_id);
        if ($stmt->execute()) {
            // Redirect to the next page after successful booking
            header("Location: select_seat.php");
            exit(); // Ensure that no more output is sent
        } else {
            echo "Error: " . $stmt->error;
        }
    } else {
        echo "Error: Unable to prepare SQL statement.";
    }

    // Close statement
    $stmt->close();
}

// Close database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Book Ticket</title>
<style>
  body {
    background-image: url('bus_wall.jpg');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
    padding: 0;
  }
  
  /* CSS for seat layout */
  .seat {
    width: 40px;
    height: 40px;
    background-color: #ccc;
    border: 1px solid #888;
    margin: 5px;
    display: inline-block;
    cursor: pointer;
  }
  .selected {
    background-color: red;
  }

  /* Style for options */
  #dateForm {
    text-align: center;
    margin-bottom: 20px;
  }

  #journeyDate {
    width: 200px;
    padding: 10px;
    font-size: 18px;
    border-radius: 5px;
    border: none;
  }

  button[type="submit"] {
    padding: 15px 30px; /* Increased padding */
    margin-top: 10px;
    border: none;
    border-radius: 10px; /* Increased border-radius */
    background-color: #4CAF50;
    color: white;
    cursor: pointer;
    font-size: 24px; /* Increased font size */
  }

  button[type="submit"]:hover {
    opacity: 0.8;
  }
</style>
</head>
<body>
  <form id="dateForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="get">
    <input type="date" id="journeyDate" name="date" required>
    <button type="submit">Submit</button>
  </form>

  <div id="seatLayout">
    <!-- Seat layout will be displayed here -->
  </div>

  <script>
    // JavaScript code remains the same
  </script>
</body>
</html>
