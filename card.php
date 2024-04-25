<?php
// Include the database connection file
require_once 'dbconnect.php';

// Initialize payment success variable
$payment_successful = false;

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize input
    $card_number = filter_input(INPUT_POST, 'card_number', FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

    // Generate a unique payment ID (you may implement your own logic)
    $payment_id = uniqid();

    // Insert card number and password into the card_payment table
    $sql = "INSERT INTO card_payment (payment_id, card_number, password) VALUES ('$payment_id', '$card_number', '$password')";

    if ($conn->query($sql) === TRUE) {
        $payment_successful = true;
    } else {
        echo "Error adding card number: " . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Card Payment</title>
    <style>
        body {
            background-image: url('card.jpg');
            background-size: cover;
            font-family: Arial, sans-serif;
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
            color: green;
            text-align: center;
            margin-bottom: 20px;
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
        /* Style for bKash button */
        .bkash-button {
            margin-top: 20px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php if($payment_successful): ?>
            <div class="payment-successful">Payment successful !!</div>
        <?php endif; ?>
        <h2>Card Payment</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <div class="form-group">
                <label for="card_number">Card Number:</label>
                <input type="text" id="card_number" name="card_number" placeholder="Enter card number" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" placeholder="Enter password" required>
            </div>
            <button type="submit" class="btn">Submit</button>
            <div class="bkash-button">
                <a href="payment.php" class="btn">bKash</a>
            </div>
        </form>
        <a href="login.php" class="logout-button">Logout</a>
    </div>
</body>
</html>
