<!DOCTYPE html>
<html>
<head>
    <title>Purchase Ticket</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('buses.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }
        .transparent-form {
            background-color: rgba(255, 255, 255, 0.5);
            padding: 20px;
            border-radius: 10px;
            width: 300px;
            margin: 0 auto;
        }
        .transparent-form input[type="date"] {
            width: 100%;
            padding: 8px;
            margin: 5px 0;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .transparent-form input[type="submit"] {
            width: 100%;
            background-color: #4CAF50;
            color: white;
            padding: 10px 0;
            margin-top: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .transparent-form input[type="submit"]:hover {
            background-color: #45a049;
        }

        .plane {
            margin: 20px auto;
            max-width: 300px;
            background: white;
        }

        .select {
            height: 250px;
            position: relative;
            overflow: hidden;
            text-align: center;
        }

        .select h1 {
            width: 60%;
            margin: 100px auto 35px auto;
        }

        .exit {
            position: relative;
            height: 50px;
        }

        .exit:before,
        .exit:after {
            content: "EXIT";
            font-size: 14px;
            line-height: 18px;
            padding: 0px 2px 2px 2px;
            display: block;
            position: absolute;
            background: red;
            color: white;
            top: 50%;
            transform: translate(0, -50%);
            border-radius: 5px;
        }

        .exit:before {
            left: 10px;
        }

        .exit:after {
            right: 10px;
        }

        ol {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .seats {
            display: flex;
            flex-direction: row;
            flex-wrap: nowrap;
            justify-content: flex-start;
        }

        .seat {
            display: flex;
            flex: 0 0 14.28%;
            padding: 5px;
            position: relative;
        }

        .seat label {
            display: block;
            position: relative;
            width: 100%;
            text-align: center;
            font-size: 14px;
            font-weight: bolder;
            line-height: 1.5rem;
            padding: 4px 0;
            background: #5bfc60;
            border-radius: 5px;
            color: black;
        }

        .seat label:hover {
            cursor: pointer;
            box-shadow: 0 0 0px 2px green;
        }

        .seat:nth-child(3) {
            margin-right: 14%;
        }

        .seat input[type=checkbox] {
            position: absolute;
        }

        .seat input[type=checkbox]:checked+label {
            background: #656e65;
        }
    </style>
</head>
<body>

<div class="transparent-form">
    <h2>Purchase Ticket</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label for="journey_date">Journey Date:</label>
        <input type="date" id="journey_date" name="journey_date" required>

        <div class="plane">
            <div class="select">
                <h1>Please select a seat</h1>
            </div>
            <div class="exit"></div>
            <ol>
                <?php for ($i = 1; $i <= 10; $i++) { ?>
                    <li>
                        <ol class="seats">
                            <?php for ($j = 1; $j <= 4; $j++) { ?>
                                <li class="seat">
                                    <input type="checkbox" id="<?php echo $i . $j; ?>" name="selected_seats[]" value="<?php echo $i . $j; ?>" />
                                    <label for="<?php echo $i . $j; ?>"><?php echo $i . $j; ?></label>
                                </li>
                            <?php } ?>
                        </ol>
                    </li>
                <?php } ?>
            </ol>
            <div class="exit"></div>
        </div>

        <input type="submit" value="Submit">
    </form>
</div>

<?php 
require_once("dbconnect.php");

// Function to get the next passenger ID
function getNextPassengerId($conn) {
    $result = $conn->query("SELECT MAX(id) AS max_id FROM passenger");
    $row = $result->fetch_assoc();
    return $row['max_id'] + 1;
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $journey_date = $_POST['journey_date'];
    $selected_seats = isset($_POST['selected_seats']) ? implode(',', $_POST['selected_seats']) : '';

    // Set price for each ticket
    $price = 500;

    // Get the next passenger ID
    $passenger_id = getNextPassengerId($conn);

    // Prepare and execute SQL query to insert data into the database
    $stmt = $conn->prepare("INSERT INTO ticket (journey_date, price, tpassenger_id, selected_seats) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("siss", $journey_date, $price, $passenger_id, $selected_seats);

    if ($stmt->execute()) {
        // Redirect to payment.php after successful submission
        header("Location: payment.php");
        exit(); // Ensure that no more output is sent
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close statement and database connection
    $stmt->close();
}
?>

</body>
</html>
