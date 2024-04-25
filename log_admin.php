<?php
session_start();
require_once("dbconnect.php");

// Initialize login error message
$login_error = "";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Prepare and bind the SQL statement
    $sql = "SELECT * FROM admin WHERE name = ? AND password = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username, $password);

    // Execute the statement
    $stmt->execute();

    // Store result
    $result = $stmt->get_result();

    // Check if there is a row with matching credentials
    if ($result->num_rows == 1) {
        // Authentication successful, redirect to admin.php
        $_SESSION['admin_logged_in'] = true;
        header("location: admin.php");
        exit;
    } else {
        // Set login error message
        $login_error = "Invalid username or password";
    }

    // Close statement and database connection
    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <style>
        body {
            background-image: url('adlog.png');
            background-size: cover;
            background-position: center;
            height: 100vh;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        form {
            background-color: rgba(255, 255, 255, 0.8); /* Transparent white background */
            padding: 20px;
            border-radius: 10px;
            width: 300px;
            text-align: center;
            position: relative;
        }
        form input[type="text"],
        form input[type="password"],
        form input[type="submit"] {
            width: calc(100% - 20px); /* Subtracting padding */
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            display: block;
            text-align: center;
            text-decoration: none;
            color: black;
        }
        form input[type="submit"] {
            background-color: #4CAF50;
            cursor: pointer;
            color: white;
        }
        .login-error {
            color: red;
            font-weight: bold;
            background-color: yellow;
            padding: 5px;
            border-radius: 5px;
            text-align: center;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <h2>Admin Login</h2>
        <?php if(isset($login_error)) { ?>
            <div class="login-error"><?php echo $login_error; ?></div>
        <?php } ?>
        <label for="username">Username:</label><br>
        <input type="text" id="username" name="username"><br>
        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password"><br><br>
        <input type="submit" value="Login">
    </form>
</body>
</html>
