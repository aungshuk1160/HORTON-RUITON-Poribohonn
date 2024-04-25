<?php
require_once("dbconnect.php");

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $passenger_id = $_POST["passenger_id"];
    $feedback = $_POST["feedback"];
    $star = $_POST["star"];
    
    // Check if passenger_id exists in the passenger table
    $check_passenger_sql = "SELECT id FROM passenger WHERE id = ?";
    $check_stmt = $conn->prepare($check_passenger_sql);
    $check_stmt->bind_param("i", $passenger_id);
    $check_stmt->execute();
    $check_stmt->store_result();

    if ($check_stmt->num_rows > 0) {
        // Prepare and bind the SQL statement
        $insert_sql = "INSERT INTO rating (passenger_id, feedback, star) VALUES (?, ?, ?)";
        $insert_stmt = $conn->prepare($insert_sql);
        $insert_stmt->bind_param("iss", $passenger_id, $feedback, $star);

        // Execute the statement
        if ($insert_stmt->execute()) {
            $message = "Rating submitted successfully.";
            
            // Redirect to login.php
            header("Location: login.php");
            exit;
        } else {
            $error_message = "Error: " . $insert_sql . "<br>" . $conn->error;
        }

        // Close statement and database connection
        $insert_stmt->close();
    } else {
        $error_message = "Error: Passenger ID does not exist.";
    }

    // Close statement and database connection
    $check_stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rate Your Ride</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-image: url('rating.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            height: 100vh;
            overflow: hidden;
        }

        .container {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: rgba(255, 255, 255, 0.7);
            padding: 20px;
            border-radius: 10px;
            width: 400px;
            text-align: center;
        }

        h1, h2 {
            color: #333;
            margin-top: 10px;
        }

        input[type="number"],
        textarea,
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin-top: 10px;
            margin-bottom: 20px;
            box-sizing: border-box;
            border: none;
            border-radius: 5px;
        }

        textarea {
            height: 100px;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Rate Your Ride</h1>
    <?php if(isset($message)) { ?>
        <div><?php echo $message; ?></div>
    <?php } ?>
    <?php if(isset($error_message)) { ?>
        <div style="color: red;"><?php echo $error_message; ?></div>
    <?php } ?>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label for="passenger_id">Passenger ID:</label>
        <input type="number" id="passenger_id" name="passenger_id" required>

        <label for="feedback">Feedback:</label>
        <textarea id="feedback" name="feedback" required></textarea>

        <label for="star">Star Rating:</label>
        <input type="number" id="star" name="star" min="1" max="5" required>

        <input type="submit" value="Submit Rating">
    </form>
</div>

</body>
</html>
