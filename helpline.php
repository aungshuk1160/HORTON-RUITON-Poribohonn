<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Helpline</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(to right, #7F7FD5, #86A8E7, #91EAE4);
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        .container {
            max-width: 800px;
            background-color: rgba(255, 255, 255, 0.9);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            text-align: center;
        }
        h1, p {
            text-align: center;
        }
        p {
            line-height: 1.6;
            margin-bottom: 10px;
        }
        .contact-info {
            margin-top: 20px;
            margin-bottom: 20px;
        }
        .button {
            display: inline-block;
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Helpline</h1>
        <div class="contact-info">
            <p><strong>Horton Ruiton Bus Service</strong></p>
            <p><strong>Phone:</strong> 0123456789</p>
            <p><strong>Email:</strong> info@hortonruitonbus.com</p>
            <p><strong>Address:</strong> 1234 Main Street, Dhaka, Bangladesh</p>
        </div>
        <a href="schedule.php" class="button">View Bus Schedule</a>
    </div>
</body>
</html>
