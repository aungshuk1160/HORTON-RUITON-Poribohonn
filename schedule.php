<!DOCTYPE html>
<html>
<head>
    <title>Bus Schedule</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('bus.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 50px; /* Adjust the margin-top to center the table */
        }

        table, th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
        }

        h2 {
            text-align: center;
            color: white;
        }
    </style>
</head>
<body>

<h2>Bus Schedule</h2>

<table>
    <thead>
        <tr>
            <th>Bus ID</th>
            <th>Departure Time</th>
            <th>Arrival Time</th>
            <th>Destination</th>
            <th>Starting Location</th>
        </tr>
    </thead>
    <tbody>
        <?php
        // Include the database connection file
        include 'dbconnect.php';

        // Fetch schedule data from the database
        $sql = "SELECT * FROM schedule";
        $result = $conn->query($sql);

        // Output schedule data
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['bus_id'] . "</td>";
                echo "<td>" . $row['departure_time'] . "</td>";
                echo "<td>" . $row['arrival_time'] . "</td>";
                echo "<td>" . $row['destination'] . "</td>";
                echo "<td>" . $row['starting_location'] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='5'>No schedule available</td></tr>";
        }

        // Close the database connection
        $conn->close();
        ?>
    </tbody>
</table>

</body>
</html>
