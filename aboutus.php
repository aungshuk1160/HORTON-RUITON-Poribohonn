<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us</title>
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
            text-align: center; /* Center align text */
        }
        h1, p {
            text-align: center;
        }
        p {
            line-height: 1.6;
            margin-bottom: 20px; /* Add margin bottom to the paragraphs */
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
        .bus {
            width: 100px;
            display: block;
            margin: 20px auto;
            position: relative;
            animation: moveBus 10s linear infinite;
        }
        @keyframes moveBus {
            0% { left: -200px; }
            100% { left: calc(100% + 200px); }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>About Us</h1>
        <p>Welcome to our bus management service! We provide a convenient platform for buying bus tickets online. With our service, you can easily book bus tickets from the comfort of your home, and make payments using your credit card or Bkash.</p>
        <p>Our platform also allows you to check bus schedules, making it easier for you to plan your journey ahead of time. We are committed to providing you with a seamless and hassle-free experience for all your bus travel needs.</p>
        <p style="margin-bottom: 40px;">Start your journey with us today!</p> <!-- Increased margin bottom -->
        <a href="schedule.php" class="button">View Bus Schedule</a>
        <img src="aboutus.png" alt="Bus" class="bus">
    </div>
</body>
</html>
