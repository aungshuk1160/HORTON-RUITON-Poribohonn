<!DOCTYPE html>
<html>
<head>
    <title>Cancel Ticket</title>
    <style>
        body {
            background-image: url('bus_pic.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            position: relative;
            font-family: Arial, sans-serif; /* Added font-family */
        }

        .welcome-text {
            font-size: 54px;
            font-weight: bold;
            text-align: center;
            margin-bottom: 50px;
            background-color: #1E90FF; /* Changed background color */
            color: white; /* Changed text color */
            padding: 20px;
            border-radius: 10px;
        }

        .options {
            background: rgba(255, 255, 255, 0.8);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            margin-top: 20px; /* Added margin-top */
        }

        .options h2 {
            margin-bottom: 20px;
            font-size: 24px;
        }

        .options button {
            padding: 15px 30px;
            margin: 10px;
            border: none;
            border-radius: 10px;
            background-color: #4CAF50;
            color: white;
            cursor: pointer;
            font-size: 20px;
        }

        .options button:hover {
            opacity: 0.8;
        }

        .form {
            background: rgba(255, 255, 255, 0.8);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
            text-align: center;
            display: none;
            margin-top: 20px; /* Added margin-top */
        }

        input[type="text"],
        input[type="password"],
        input[type="tel"],
        input[type="email"],
        input[type="date"],
        input[type="time"],
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
    <div class="welcome-text">
        Welcome to <span style="font-size: 54px; color: yellow;">HORTON-RUITON Poribohon</span>
    </div>

    <div class="options">
        <h2>Select an Option</h2>
        <button onclick="window.location.href='getticket.php'">Book Ticket</button>
        <button onclick="window.location.href='schedule.php'">Schedule</button> <!-- Added link to schedule.php -->
        <button onclick="toggleCancelForm()">Cancel Ticket</button>
    </div>

    <div id="cancelForm" class="form">
        <h2>Cancel Ticket</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <input type="text" name="ticket_number" placeholder="Enter Ticket Number" required><br><br>
            <button type="submit">Cancel</button>
        </form>
        <?php
        // Include the database connection file
        include 'dbconnect.php';

        // Check if the form is submitted
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Check if the ticket number is provided
            if (isset($_POST["ticket_number"])) {
                // Get the ticket number from the form
                $ticket_number = $_POST["ticket_number"];

                // Prepare and execute the SQL query to delete the ticket from ticketinfo table
                $sql = "DELETE FROM ticketinfo WHERE ticket_no = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("s", $ticket_number);

                if ($stmt->execute()) {
                    // Ticket cancellation successful
                    echo "<p>Ticket Cancellation Successful</p>";
                } else {
                    // Error occurred while canceling ticket
                    echo "<p>Error: " . $conn->error . "</p>";
                }

                // Close the prepared statement
                $stmt->close();
            } else {
                // Ticket number not provided
                echo "<p>Ticket number not provided</p>";
            }
        }

        // Close the database connection
        $conn->close();
        ?>
    </div>

    <script>
        function toggleCancelForm() {
            var cancelForm = document.getElementById('cancelForm');
            if (cancelForm.style.display === 'none') {
                cancelForm.style.display = 'block';
            } else {
                cancelForm.style.display = 'none';
            }
        }
    </script>
</body>
</html>
