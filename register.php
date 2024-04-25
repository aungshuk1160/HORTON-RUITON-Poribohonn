<?php 
require_once("dbconnect.php");

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST['name'];
    $password = $_POST['password'];
    $phone_number = $_POST['phone_number'];
    $email = $_POST['email'];
    $address = $_POST['address'];

    // Prepare and execute SQL query to insert data into the database
    $sql = "INSERT INTO passenger (name, password, email, address, phone_no) VALUES (?, ?, ?, ?, ?)";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $name, $password, $email, $address, $phone_number);

    if ($stmt->execute()) {
        // Get the ID of the newly inserted passenger
        $passenger_id = $stmt->insert_id;

        // Update tpassenger_id in the ticket table
        $update_sql = "UPDATE ticket SET tpassenger_id = ? WHERE tpassenger_id IS NULL";
        $update_stmt = $conn->prepare($update_sql);
        $update_stmt->bind_param("i", $passenger_id);
        $update_stmt->execute();

        // Redirect to the login page after successful signup
        header("Location: login.php");
        exit(); // Ensure that no more output is sent
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close statement and database connection
    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <link rel="stylesheet" type="text/css" href="style.css">
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
            position: relative;
        }

        .form {
            background: rgba(255, 255, 255, 0.8);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
            text-align: center;
            margin-top: 40px; /* Shifted down */
        }

        input[type="text"],
        input[type="password"],
        input[type="tel"],
        input[type="email"],
        button {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        button {
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }

        button:hover {
            opacity: 0.8;
        }
    </style>
</head>
<body>
    <div class="form">
        <h2>Register</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <input type="text" name="name" placeholder="Name" required><br><br>
            <input type="password" name="password" placeholder="Password" required><br><br>
            <input type="tel" name="phone_number" placeholder="Phone Number" required><br><br>
            <input type="email" name="email" placeholder="Email" required><br><br>
            <input type="text" name="address" placeholder="Address" required><br><br>
            <button type="submit">Register</button>
        </form>
        <br>
        <a href="login.php">Back to Login</a> <!-- Added "Back to Login" link -->
    </div>
</body>
</html>
