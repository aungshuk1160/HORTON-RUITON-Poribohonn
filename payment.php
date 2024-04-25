<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>bKash Payment</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('bkash.png');
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 300px;
            margin: 100px auto;
            background-color: rgba(255, 255, 255, 0.8);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            position: relative; /* Position relative for absolute positioning */
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
        }
        .form-group input[type="text"],
        .form-group input[type="password"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }
        .btn {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .btn:hover {
            background-color: #45a049;
        }
        /* Style for payment successful text */
        .payment-successful {
            font-size: 24px;
            font-weight: bold;
            color: white;
            text-align: center;
            margin-bottom: 20px;
            background-color: blue;
            padding: 10px;
            border-radius: 5px;
        }
        /* Style for logout button */
        .logout-button {
            position: absolute;
            bottom: 10px;
            right: 10px;
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .logout-button:hover {
            background-color: #45a049;
        }
        /* Style for card button */
        .card-button {
            margin-top: 20px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php
        require_once("dbconnect.php");

        // Initialize variables
        $bkash_no = $password = "";
        $payment_successful = false;

        // Check if form is submitted
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Collect form data
            $bkash_no = $_POST['bkash_no'];
            $password = $_POST['password'];

            // Prepare and execute SQL query to insert data into database
            $stmt = $conn->prepare("INSERT INTO bkash_payment (bkash_no, password) VALUES (?, ?)");
            $stmt->bind_param("ss", $bkash_no, $password);

            if ($stmt->execute()) {
                // Set payment successful flag
                $payment_successful = true;
            } else {
                echo "Error: " . $stmt->error;
            }

            // Close statement
            $stmt->close();
        }
        ?>
        <?php if($payment_successful): ?>
            <div class="payment-successful">Payment successful !!</div>
        <?php endif; ?>
        <h2>bKash Payment</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <div class="form-group">
                <label for="bkash_no">bKash Number:</label>
                <input type="text" id="bkash_no" name="bkash_no" placeholder="Enter bKash number" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" placeholder="Enter password" required>
            </div>
            <button type="submit" class="btn">Submit</button>
            <div class="card-button">
                <a href="card.php" class="btn">Card</a>
            </div>
        </form>
        <a href="login.php" class="logout-button">Logout</a>
    </div>
</body>
</html>
