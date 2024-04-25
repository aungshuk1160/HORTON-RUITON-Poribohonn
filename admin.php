<?php
// Include the database connection file
include 'dbconnect.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check which form is submitted
    if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['address']) && isset($_POST['phone']) && isset($_POST['password'])) {
        // Process Add Passenger form submission
        $name = $_POST['name'];
        $email = $_POST['email'];
        $address = $_POST['address'];
        $phone = $_POST['phone'];
        $password = $_POST['password'];

        // Prepare and execute SQL query to insert data into passenger table
        $sql = "INSERT INTO passenger (name, email, address, phone_no, password) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssss", $name, $email, $address, $phone, $password);
        
        if ($stmt->execute()) {
            // Data inserted successfully
            echo "<script>alert('Passenger added successfully');</script>";
        } else {
            // Error occurred while inserting data
            echo "<script>alert('Error: " . $stmt->error . "');</script>";
        }

        // Close the prepared statement
        $stmt->close();
    } elseif (isset($_POST['bkashNo'])) {
        // Process Make Refund form submission
        $bkashNo = $_POST['bkashNo'];

        // Prepare and execute SQL query to insert data into refund table
        $sql = "INSERT INTO refund (bkash_no) VALUES (?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $bkashNo);
        
        if ($stmt->execute()) {
            // Data inserted successfully
            echo "<script>alert('Refund processed successfully');</script>";
        } else {
            // Error occurred while inserting data
            echo "<script>alert('Error: " . $stmt->error . "');</script>";
        }

        // Close the prepared statement
        $stmt->close();
    } elseif (isset($_POST['busRegNo']) && isset($_POST['departureTime']) && isset($_POST['arrivalTime'])) {
        // Process Change Schedule form submission
        $busRegNo = $_POST['busRegNo'];

        // Prepare and execute SQL query to delete the row from schedule table
        $sql = "DELETE FROM schedule WHERE bus_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $busRegNo);
        
        if ($stmt->execute()) {
            // Row deleted successfully
            echo "<script>alert('Schedule updated successfully');</script>";
        } else {
            // Error occurred while deleting row
            echo "<script>alert('Error: " . $stmt->error . "');</script>";
        }

        // Close the prepared statement
        $stmt->close();
    }
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin Panel</title>
<style>
  body {
    background-image: url('buses.jpg');
    background-size: cover;
    background-position: center;
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
  }
  .container {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    height: 100vh;
  }
  .form-wrapper {
    background-color: rgba(255, 255, 255, 0.5); /* Semi-transparent white background */
    padding: 20px;
    border-radius: 10px;
    margin-bottom: 20px;
    text-align: center;
  }
  button {
    padding: 15px 30px; /* Increase button size */
    margin: 10px;
    border: none;
    border-radius: 10px;
    background-color: #4CAF50;
    color: white;
    cursor: pointer;
    font-size: 20px; /* Increase font size */
  }
  h1 {
    background-color: blue; /* Set background color of "Welcome Admin" text */
    padding: 10px;
    border-radius: 10px;
    color: white;
  }
  form {
    background-color: rgba(255, 255, 255, 0.9); /* Semi-transparent white background */
    padding: 30px;
    border-radius: 10px;
    margin-bottom: 20px;
    text-align: center;
    display: none;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.2); /* Add shadow for depth */
  }
  input, button {
    margin-bottom: 15px;
    padding: 10px;
    border-radius: 5px;
    border: 1px solid #ccc;
    width: 100%;
    box-sizing: border-box;
  }
  input:focus, button:focus {
    outline: none;
    border-color: #4CAF50;
  }
  input[type="submit"] {
    background-color: #4CAF50;
    color: white;
    cursor: pointer;
    transition: background-color 0.3s;
  }
  input[type="submit"]:hover {
    background-color: #45a049;
  }
</style>
</head>
<body>
<div class="container">
  <div class="form-wrapper">
    <h1>Welcome Admin</h1>
    <!-- Buttons -->
    <button onclick="toggleForm('addPassengerForm')">Add Passenger</button>
    <button onclick="toggleForm('makeRefundForm')">Make Refund</button>
    <button onclick="toggleForm('changeScheduleForm')">Change Schedule</button>
  </div>
  <div id="forms">
    <!-- Add Passenger Form -->
    <form id="addPassengerForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
      <input type="text" name="name" placeholder="Name" required><br>
      <input type="email" name="email" placeholder="Email" required><br>
      <input type="text" name="address" placeholder="Address" required><br>
      <input type="tel" name="phone" placeholder="Phone number" required><br>
      <input type="password" name="password" placeholder="Password" required><br>
      <button type="submit">Submit</button>
    </form>
    <!-- Make Refund Form -->
    <form id="makeRefundForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
      <input type="text" name="bkashNo" placeholder="Bkash no/card no" required><br>
      <button type="submit">Submit</button>
    </form>
    <!-- Change Schedule Form -->
    <form id="changeScheduleForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
      <input type="text" name="busRegNo" placeholder="Bus reg no" required><br>
      <input type="text" name="departureTime" placeholder="Departure time" required><br>
      <input type="text" name="arrivalTime" placeholder="Arrival time" required><br>
      <button type="submit">Submit</button>
    </form>
  </div>
</div>

<script>
function toggleForm(formId) {
  var forms = document.querySelectorAll('#forms form');
  for (var i = 0; i < forms.length; i++) {
    if (forms[i].id === formId) {
      forms[i].style.display = 'block';
    } else {
      forms[i].style.display = 'none';
    }
  }
}
</script>

</body>
</html>
