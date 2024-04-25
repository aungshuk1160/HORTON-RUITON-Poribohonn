<?php 
session_start();
require_once("dbconnect.php");

// Initialize login error message
$login_error = "";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve phone number and password entered by the user
    $phone_no = $_POST['phone_no'];
    $password = $_POST['password'];

    // Prepare and execute SQL query to check credentials
    $sql = "SELECT * FROM passenger WHERE phone_no = ? AND password = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $phone_no, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if a matching record is found
    if ($result->num_rows == 1) {
        // Set session variables
        $_SESSION["loggedin"] = true;
        
        // Redirect to home.php or any other page
        header("location: home.php");
        exit;
    } else {
        // Set login error message
        $login_error = "Invalid phone number or password";
    }

    // Close the prepared statement
    $stmt->close();
}

// Close the database connection
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            background-image: url('bus.jpg');
            background-size: cover;
            background-position: center;
            height: 100vh;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
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
        form input[type="submit"],
        .register-btn {
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
        form input[type="submit"],
        .register-btn {
            background-color: #4CAF50;
            cursor: pointer;
            color: white;
        }
        .register-btn {
            background-color: #008CBA;
        }
        .button-group {
            margin-top: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
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
        .top-right {
            position: absolute;
            top: 20px;
            right: 10px; /* Adjusted position to right */
            font-size: 2em; /* Double the font size */
            margin-top: 1em; /* Move down one step */
        }
        .top-right a {
            color: white;
            text-decoration: none;
            margin-left: 10px;
        }
        .toggle-password {
            position: absolute;
            top: 36px;
            left: 10px;
            cursor: pointer;
        }
        .options {
            position: absolute;
            top: 80px; /* Adjusted position */
            left: 20px;
            display: flex;
            background-color: rgba(255, 255, 255, 0.7);
            padding: 10px;
            border-radius: 5px;
        }
        .options a {
            color: #333;
            text-decoration: none;
            margin-right: 20px; /* Double the margin */
            font-size: 2em; /* Double the font size */
        }
    </style>
</head>
<body>
    <div class="top-right"> <!-- Added div for top right corner -->
        <a href="log_admin.php">Admin</a> <!-- Admin button -->
    </div>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <h2>Login</h2>
        <?php if(isset($login_error)) { ?>
            <div class="login-error"><?php echo $login_error; ?></div>
        <?php } ?>
        <label for="phone_no">Phone Number:</label><br>
        <input type="text" id="phone_no" name="phone_no"><br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password">
        <span class="toggle-password" onclick="togglePassword()">Show</span><br><br>
        <input type="submit" value="Login">
        <div class="button-group">
            <span>Don't have an account?</span>
            <a href="register.php" class="register-btn">Register</a>
        </div>
    </form>
    <div class="options">
        <a href="aboutus.php">About us</a>
        <a href="rating.php">Rating</a>
        <a href="helpline.php">Helpline</a>
    </div>
    <script>
        function togglePassword() {
            var passwordField = document.getElementById("password");
            if (passwordField.type === "password") {
                passwordField.type = "text";
                document.querySelector(".toggle-password").innerText = "Hide";
            } else {
                passwordField.type = "password";
                document.querySelector(".toggle-password").innerText = "Show";
            }
        }
    </script>
</body>
</html>
