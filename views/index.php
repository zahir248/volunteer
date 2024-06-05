<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <style>
        body, html {
            height: 100%;
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            position: relative;
        }

        .bg {
            /* The image used */
            background-image: url('/volunteer/images/event-volunteers.jpg');

            /* Full height */
            height: 100%;

            /* Center and scale the image nicely */
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }

        .container {
            position: absolute;
            top: 20%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
        }

        .container button {
            background-color: #4CAF50; /* Green */
            border: none;
            color: white;
            padding: 15px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
            border-radius: 4px;
        }

        .container button:hover {
            background-color: #45a049;
        }

        /* Style for the organizer button */
        .organizer-button {
            background-color: #007bff; /* Blue */
            border: none;
            color: white;
            padding: 15px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
            border-radius: 4px;
            position: absolute;
            top: 10px;
            right: 10px;
        }

        .organizer-button:hover {
            background-color: #007bff;
        }
    </style>
</head>
<body>
    <div class="bg">
        <div class="container">
            <h1>Welcome to Volunteer Match</h1>
            <h4>A platform for matching volunteers</h4>
            <button onclick="window.location.href='signin.php'">Sign In</button>
            <button onclick="window.location.href='register.php'">Register Now</button>
        </div>
    </div>
    <!-- Organizer login button -->
    <button class="organizer-button" onclick="window.location.href='organizer_signin.php'">Organizer Centre</button>
</body>
</html>
